<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'WA_Cron' ) ) {
	class WA_Cron {
		function __construct() {
			require_once ( WA_PLUGIN_DIR . '/includes/class-wa-db.php' );
			
			$mail_type = get_option( 'wa_wpmail_or_smtp', 'wp_mail' );
			if( $mail_type == 'smtp_mail' )
				add_action( 'phpmailer_init', array( &$this, 'wa_phpmailer_init' ) );

			// add_action( 'init', array( $this, 'wa_each_product_auction' ) );

			if ( ! wp_next_scheduled( 'wa_task_hook' ) ) {
			  	wp_schedule_event( time(), 'hourly', 'wa_task_hook' );
			}

			add_action( 'wa_task_hook', array( &$this, 'wa_task_function' ) );
		}

		function wa_task_function() {
		  	$this->wa_each_product_auction();
		}

		function wa_each_product_auction() {
			global $Woo_Auction; 
			$current_datetimes = date( 'Y/m/d H:i:s' );
			$args = array( 
				'post_type' => 'product', 
				'posts_per_page' => -1,
				'meta_query' => array(
					array(
						'key' => '_wa_product-type',
	                 	'value' => 'woo_auction',
	                 	'compare' => '='
						),
		        	array(
		        		'key' => '_wa_dates_end',
		        		'value' => $current_datetimes,
		        		'compare' => '<',
		        		'type' => 'DATETIME'
		        		)
					)
				);

		    $loop = new WP_Query( $args ); 
            
            do_action('after_wa_cron_send_mail');
            
		    while ( $loop->have_posts() ) { 
		    	$loop->the_post(); 
		    	global $product; 

		    	$meta_fields = get_post_custom( $product->id ); 
		    	$has_send_mail = ( isset ( $meta_fields['_wa_count_send_mail'] ) ) ? true : false;

		    	// limit send mail
		    	if( $has_send_mail == true && $meta_fields['_wa_count_send_mail'] == 1 ) 
		    		continue;

		    	$dates = unserialize( $meta_fields['_auction_dates'][0] );
				$date_now = date( 'Y/m/d H:i:s' );
		    	$date_end = date( $dates['end'] );
		    	$highest_bid_price = 0;
		    	$user_bid = 0;
		    	
		    	//if( $date_now > $date_end ){
		    		$highest_bid_row = $Woo_Auction->wa_get_highest_bid_by_productid( $product->id );

		    		// have bid
		    		if( count( $highest_bid_row ) <= 0 ) {

		    			continue;
		    		}

		    		// get all user bid this product
		    		$users = $this->wa_mails_user_bid( $product->id );

		    		// bid price < reserve price
		    		if( $highest_bid_row[0]['price'] < $meta_fields['_wa_reserve_price'][0] && $has_send_mail == false ) {
		    			foreach( $users as $user ) {
		    				$this->wa_mail_data( $user['user_id'], $user['price'], $product, 'mail_lost' );
		    			}

		    			update_post_meta( $product->id, '_wa_count_send_mail', 1 );
		    			continue;
		    		}

		    		// Mail user lost
		    		$this->user_id_won = $highest_bid_row[0]['user_id'];
		    		$user_losts = array_map(  array( &$this, 'filter_user_lost' ) , $users );
		    		if( $has_send_mail == false ) {
		    			foreach( $user_losts as $user_lost ) { 

		    				if( $user_lost['user_id'] && $user_lost['price'] ) {
		    					$this->wa_mail_data( $user_lost['user_id'], $user_lost['price'], $product, 'mail_lost' );
		    				}
		    			}
	    			}

		    		// Mail user won
	    			$this->wa_mail_data( $highest_bid_row[0]['user_id'], $highest_bid_row[0]['price'], $product );
		    		
		    		if( $has_send_mail == false ) {
		    			update_post_meta( $product->id, '_wa_count_send_mail', 1 );
		    		}else {
		    			update_post_meta( $product->id, '_wa_count_send_mail', (int) $meta_fields['_wa_count_send_mail'][0] + 1 );
		    		}
		    	//}
		    }
		    wp_reset_query(); 
            
            do_action('before_wa_cron_send_mail');
		}

		function filter_user_lost( $users ) {
			if( $users['user_id'] != $this->user_id_won ) {
				return $users;
			}
		}

		function wa_mails_user_bid( $product_id ) {
			require_once ( WA_PLUGIN_DIR . '/includes/class-wa-db.php' );
			$users = array();

			$db = new WA_Db();
			$arr_query = array(
				"tableName" => "wa_product_bids AS a",
				"select" => "b.ID, a.price",
				"join" => array(
					array(
						"tableName" => "users AS b",
						"on" => "b.id = a.user_id"
						)
					),
				"where" => "a.product_id = " . $product_id,
				"groupByField" => "a.user_id",
				);

			$bid_users = $db->fetch( $arr_query );
			if( count( $bid_users ) > 0 ) {
				foreach( $bid_users as $user ) {
					array_push( $users, array( 'user_id' => $user['ID'], 'price' => $user['price'] ) );
				}
			}

			return $users;
		}

		function wa_mail_data( $user_id, $bid_price, $product, $mailTemp = 'mail_won' ) {
			$this->user = get_userdata( $user_id );
			$this->product_link = get_permalink( $product->id );

			$this->to = $this->user->user_email;
			$this->subject = get_option( 'wa_mail_subject', 'Auction' );
			$this->headers = array('Content-Type: text/html; charset=UTF-8');
			
			// body
			switch ( $mailTemp ) {
				case 'mail_lost':
					$order = array( '[username]', '[product_name]', '[price]', '[link]' );
					$replace = array( 
						$this->user->user_login, 
						$product->post->post_title, 
						WA_Helper::currency( $bid_price ), 
						$this->product_link );

					$temp_default = '<p>Hello [username],</p>
								<p>you\'ve lost in auctions: [product_name]</p>
								<p>Price: [price]</p>
								<p>Link product auction: [link]</p>
								&nbsp;
								<p>Thank you.</p>';
					$this->body = str_replace( $order, $replace, get_option( 'wa_content_mail_lost_template', $temp_default ) );
					break;
				
				default:
					$order = array( '[username]', '[product_name]', '[price]', '[link]' );
					$replace = array( 
						$this->user->user_login, 
						$product->post->post_title, 
						WA_Helper::currency( $bid_price ), 
						$this->product_link );

					$temp_default = '<p>Hello [username],</p>
								<p>You are  the winner in the auction: [product_name]</p>
								<p>Price: [price]</p>
								<p>Link order: [link]</p>
								&nbsp;
								<p>Thank you.</p>';
					$this->body = str_replace( $order, $replace, get_option( 'wa_content_mail_won_template', $temp_default ) );
					break;
			}
			

			return $this->wa_send_mail();
		}

		function wa_send_mail() {
			$mail_type = get_option( 'wa_wpmail_or_smtp', 'wp_mail' );

			if( $mail_type == 'smtp_mail' ) { 
				global $wpms_options, $phpmailer;
				require_once ( ABSPATH . WPINC . '/class-phpmailer.php ');
				require_once ( ABSPATH . WPINC . '/class-smtp.php' );
				$phpmailer = new PHPMailer( true );
				//$phpmailer->SMTPDebug = true;
				
				ob_start();
				$result = wp_mail( $this->to, $this->subject, $this->body, $this->headers );
				$mail_debug = ob_get_clean();
			}else {
				
				ob_start();
				$result = wp_mail( $this->to, $this->subject, $this->body, $this->headers );
				$mail_debug = ob_get_clean();
			}

			return $result;
		}

		function wa_phpmailer_init( $phpmailer ) {
			$phpmailer->Mailer = "smtp";
			$phpmailer->From = get_option( "wa_mail_from" );
			$phpmailer->FromName = get_option( "fromname" );
			$phpmailer->Sender = $phpmailer->From; //Return-Path
			$phpmailer->AddReplyTo( $phpmailer->From, $phpmailer->FromName ); //Reply-To
			$phpmailer->Host = get_option( "wa_SMTP_host" );
			$phpmailer->SMTPSecure = get_option( "wa_SMTP_secure" );
			$phpmailer->Port = get_option( "wa_SMTP_post" );
			$phpmailer->SMTPAuth = ( get_option( "wa_SMTP_authentication" ) == 1 ) ? TRUE : FALSE;
			if( $phpmailer->SMTPAuth ){
				$phpmailer->Username = get_option( "wa_mail_username" );
				$phpmailer->Password = get_option( "wa_mail_password" );
			}
		}

	}
}

new WA_Cron();
?>