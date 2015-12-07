<?php
/**
 * Plugin Name: WooAuction
 * Plugin URI: http://joomexp.com
 * Description: Plugin auction
 * Version: 1.0.1
 * Author: JoomExp
 * Author URI: http://joomexp.com
 * Requires at least: 4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'WA_VERSION', '1.0.1' );
define( 'WA', 'Woo Action' );
define( 'WA_PLUGIN_FILE', __FILE__ );
define( 'WA_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WA_PLUGIN_ADMIN_DIR', WA_PLUGIN_DIR . '/admin' );

if( !class_exists('Woo_Auction') ){

	class Woo_Auction {

		function __construct() {
			// Check if WooCommerce is active
			if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

			    $this->includes();
				$this->init_hook();
			}
		}

		public function includes() {
			require_once ( WA_PLUGIN_DIR . '/includes/class-wa-helper.php' );
			require_once ( WA_PLUGIN_DIR . '/includes/class-wa-cron.php' );
			require_once ( WA_PLUGIN_DIR . '/includes/class-wa-custom-woo-archive-loop.php' );
			require_once ( WA_PLUGIN_DIR . '/includes/class-wa-custom-post-template.php' );
			require_once ( WA_PLUGIN_DIR . '/includes/class-wa-post-types.php' );
			require_once ( WA_PLUGIN_DIR . '/includes/class-wa-table-orders.php' );
			require_once ( WA_PLUGIN_DIR . '/includes/class-wa-table-bids.php' );
			require_once ( WA_PLUGIN_DIR . '/includes/class-wa-page-orders.php' );
			require_once ( WA_PLUGIN_DIR . '/includes/class-wa-page-settings.php' );
			require_once ( WA_PLUGIN_ADMIN_DIR . '/class-wa-admin.php' );
			require_once ( WA_PLUGIN_DIR . '/includes/shortcodes/class-wa-shortcodes.php' );
		}

		function init_hook(){
            register_activation_hook( __FILE__, array( $this, 'install' ) );
            register_deactivation_hook( __FILE__, array( $this, 'uninstall' ) );
            
			add_action( 'init', array( &$this, 'register_wa_assets' ) );
			add_action( 'after_setup_theme', array( &$this, 'wa_setup_image_size' ) );	
			add_action( 'woocommerce_payment_complete_order_status_completed', array( &$this, 'wa_update_product_auction_after_payment_completed' ), 10, 2 );
 

			// limit qantity auction product
			add_filter( 'woocommerce_is_sold_individually', array( &$this, 'wa_remove_all_quantity_fields' ), 10, 2 );

			// get next price bid (ajax)
			add_action( 'wp_ajax_wa_next_price_bid_product', array( &$this, 'wa_next_price_bid_product' ) );
			add_action( 'wp_ajax_nopriv_wa_next_price_bid_product', array( &$this, 'wa_next_price_bid_product' ) );

			// check proce bid (ajax)
			add_action( 'wp_ajax_wa_save_price_bid_product', array( &$this, 'wa_save_price_bid_product' ) );
			add_action( 'wp_ajax_nopriv_wa_save_price_bid_product', array( &$this, 'wa_save_price_bid_product' ) );
		
			// get_bids_by_productid (ajax)
			add_action( 'wp_ajax_wa_get_bids_by_productid', array( &$this, 'wa_get_bids_by_productid' ) );
			add_action( 'wp_ajax_nopriv_wa_get_bids_by_productid', array( &$this, 'wa_get_bids_by_productid' ) );
		
			// wa_add_to_cart (ajax)
			add_action( 'wp_ajax_wa_add_to_cart', array( &$this, 'wa_add_to_cart' ) );
			add_action( 'wp_ajax_nopriv_wa_add_to_cart', array( &$this, 'wa_add_to_cart' ) );
            
            // wa_update_current_bid_price (ajax)
			add_action( 'wp_ajax_wa_update_current_bid_price', array( &$this, 'wa_update_current_bid_price' ) );
			add_action( 'wp_ajax_nopriv_wa_update_current_bid_price', array( &$this, 'wa_update_current_bid_price' ) );
		}
        
        function install() {
            $this->wa_create_page();
        }
        
        function uninstall() {
            
        }
        
        function wa_create_page(){
            global $wpdb;
            $the_page_title = 'Auction List';
            $the_page_name = 'auction-list';

            $the_page = get_page_by_title( $the_page_title );

            if ( ! $the_page ) {

                // Create post object
                $_p = array();
                $_p['post_title'] = $the_page_title;
                $_p['post_content'] = "[wa_product_list]";
                $_p['post_status'] = 'publish';
                $_p['post_type'] = 'page';
                $_p['comment_status'] = 'closed';
                $_p['ping_status'] = 'closed';
                $_p['post_category'] = array(1); // the default 'Uncatrgorised'
                // Insert the post into the database
                $the_page_id = wp_insert_post( $_p );

            }
            else {
                // the plugin may have been previously active and the page may just be trashed...
                $the_page_id = $the_page->ID;
                //make sure the page is not trashed...
                $the_page->post_status = 'publish';
                $the_page_id = wp_update_post( $the_page );
            }
        }
        
        /**
        * wa_update_current_bid_price
        */
        function wa_update_current_bid_price(){
        	extract( $_POST );
            $highest_bid_row = $this->wa_get_highest_bid_by_productid( $product_id );
            $_post = get_post( $product_id, ARRAY_A );
			$meta_fields = get_post_custom( $product_id );
            $price = $meta_fields['_wa_start_price'][0];

            if( isset( $highest_bid_row[0]['price'] ) )
            	$price = $highest_bid_row[0]['price'];
            

            $current_bid_price = WA_Helper::currency( $price );
            echo json_encode( array('highest_bid' => $current_bid_price) ) ;
            exit;
        }

		/*
		wa_update_product_auction_after_payment_completed
		*/
		function wa_update_product_auction_after_payment_completed( $order_id ) {
			$order = new WC_Order( $order_id );
			$items = $order->get_items();
			foreach ( $items as $item ) {
			    $product_id = $item['product_id'];
			    $meta_fields = get_post_custom( $product_id );

			    if( $meta_fields['_wa_product-type'][0] != 'woo_auction' )
			    	continue;

			    
				$wpdb->update(
						$wpdb->posts,
						array( 'post_status' => 'pending'),
						array( 'id' => $product_id ),
						array( '%s' ),
						array( '%d' )
					);
			}
		}

		/*
		wa_remove_all_quantity_fields
		*/
		function wa_remove_all_quantity_fields( $return, $product ) {
			$meta_fields = get_post_custom($product->id);

			if( $meta_fields['_wa_product-type'][0] == 'woo_auction' )
		    	return true;
		}

		function wa_add_to_cart() {
			global $woocommerce;
			extract( $_POST );
			$result_arr = array();
			$user_ID = get_current_user_id();

			// check has productid
			if( !isset( $product_id ) ) {
				$result_arr['st'] = 'fail';
				$result_arr['mess'] = __('Add to cart fail.', 'wa');
				echo json_encode( $result_arr ); exit; 
			}

			// check has type
			if( !isset( $type ) ) {
				$result_arr['st'] = 'fail';
				$result_arr['mess'] = __('Add to cart fail.', 'wa');
				echo json_encode( $result_arr ); exit; 
			}

			
			$row_highest_bid = $this->wa_get_highest_bid_by_productid( $product_id );
			$_post = get_post( $product_id, ARRAY_A );
			$meta_fields = get_post_custom( $product_id );
			$dates = ( isset( $meta_fields['_auction_dates'] ) )? unserialize( $meta_fields['_auction_dates'][0] ) : "";
			$date_now = date( 'Y/m/d H:i:s' );
			$date_end = date( $dates['end'] );

			if( $type == 'add_to_cart' ) { 
				// check user login
				if( !isset( $user_ID ) || $user_ID == 0 ) {
					$result_arr['st'] = 'fail';
					$result_arr['mess'] = __('You need login after add to cart.', 'wa');
					echo json_encode( $result_arr ); exit; 
				}

				// check date bid date end
				if( $date_end > $date_now ) {
					$result_arr['st'] = 'fail';
					$result_arr['mess'] = __('Add to cart fail.', 'wa');
					echo json_encode( $result_arr ); exit; 
				}

				// check user bid
				if( $row_highest_bid[0]['user_id'] != $user_ID ) {
					$result_arr['st'] = 'fail';
					$result_arr['mess'] = __('Add to cart fail.', 'wa');
					echo json_encode( $result_arr ); exit; 
				}

				// check prie bid < _wa_reserve_price 
				if( $row_highest_bid[0]['price'] < $meta_fields['_wa_reserve_price'][0] ) {
					$result_arr['st'] = 'fail';
					$result_arr['mess'] = __('Add to cart fail.', 'wa');
					echo json_encode( $result_arr ); exit; 
				}
 				
				$_update_price = $row_highest_bid[0]['price'];
			}else if( $type == 'buy_now') {
				$_update_price = $meta_fields['_wa_buy_it_now_price'][0];
			}

			// update price
			update_post_meta( $product_id, '_price', $_update_price );

			// add to cart
			$car_number = $woocommerce->cart->add_to_cart( $product_id, 1 );
			if( empty( $car_number ) ) {
				$result_arr['st'] = 'fail';
				$result_arr['mess'] = __('Add to cart fail.');
				echo json_encode( $result_arr ); exit; 
			}

			$cart_url = WC()->cart->get_cart_url();

			$result_arr['st'] = 'success';
			$result_arr['mess'] = __('Add to cart success.');
			$result_arr['view_cart'] = '<a class="btn btn-primary" href="'. $cart_url .'">'. __('View cart') .' <i class="ion-bag"></i></a>';
			echo json_encode( $result_arr ); exit;
		}

		function wa_get_bids_by_productid() {
			extract( $_POST );
			require_once ( WA_PLUGIN_DIR . '/includes/class-wa-db.php' );

			$db = new WA_Db();
			$arr_query = array(
				"tableName" => "wa_product_bids AS a",
				"select" => "a.*, b.user_nicename",
				"join" => array(
					array(
						"tableName" => "users AS b",
						"on" => "a.user_id = b.ID",
						)
					),
				"orderField" => "a.price DESC",
				"where" => "a.product_id = " . $product_id,
				);
			
			$rows = $db->fetch( $arr_query );

			$result_arr = array();
			if( count( $rows ) > 0 ) {
				global $user_ID;

				// price format currency
				foreach( $rows as $index=>$row ){
					$rows[$index]['price'] = WA_Helper::currency( $row['price'] );
				}

				$result_arr['st'] = count( $rows ); 
				$result_arr['bids'] = $rows; 
				$result_arr['user_id_current'] = $user_ID; 
				$result_arr['template'] = "{{#bids}}
					<div class='wa-bid-item row {{isuser}}'>
						<div class='col-md-4 col-sm-4 col-xs-4 wa-text-uppercase'>{{user_nicename}}</div>
						<div class='col-md-4 col-sm-4 col-xs-4 wa-text-right'>{{{price}}}</div>
						<div class='col-md-4 col-sm-4 col-xs-4 wa-text-right'>{{date}}</div>
					</div>
				{{/bids}}";
			} else{
				$result_arr['st'] = '0'; 
			}

			echo json_encode( $result_arr );
			exit;
		}

		function wa_next_price_bid_product( $ajax = true ){
			extract( $_POST );
			$next_price = 0;

			// query max price bid product
			$max_bid_price = $this->get_max_bid_price_by_productid( $product_id );

			// query product info
			$product = get_post( $product_id, 'OBJECT' );
			$meta_fields = get_post_custom( $product->ID );

			if ( empty( $max_bid_price ) ) {
				$next_price = $meta_fields['_wa_start_price'][0];
			} else {
				$next_price = $max_bid_price + $meta_fields['_wa_bid_increment'][0];
				$highest_bid = $max_bid_price;
			}

			if( $ajax == false )
				return $next_price; //number_format( $next_price, 2 );

			$result_arr = array( 
				'next_price' => number_format( $next_price, 2 ), 
				'step_price' => number_format( $meta_fields['_wa_bid_increment'][0], 2 ) );

			if( isset( $highest_bid ) )
				$result_arr['highest_bid'] = WA_Helper::currency( $highest_bid );

			echo json_encode( $result_arr );
			exit;
		}

		function wa_save_price_bid_product() {
			extract( $_POST );
			$check_price = $this->wa_check_bid_product( $product_id, $price );
			$result_arr = array();
            
            do_action('after_wa_bid');
            
			if( $check_price == false ){
				$next_price = $this->wa_next_price_bid_product( false );
				$highest_price = $this->wa_get_highest_bid_by_productid( $product_id );

				$result_arr['st'] = 'fail';
				$result_arr['ico'] = '<i class="ion-ios-close" style="color: red"></i>';
				$result_arr['mess'] = 'Bid fail.';
				$result_arr['next_price'] = $next_price;
				$result_arr['highest_price'] = WA_Helper::currency( $highest_price[0]['price'] );
			} else{
				global $user_ID;

				require_once ( WA_PLUGIN_DIR . '/includes/class-wa-db.php' );
				$db = new WA_Db();
				$arr_query = array(
					"tableName" => "wa_product_bids",
					"arrItems" => array(
						"product_id" => $product_id,
						"user_id" => $user_ID,
						"date" => date('Y-m-d H:i:s'),
						"price" => $price,
						"status" => 1,
						)
					);
				
				$rowID = $db->insert( $arr_query );

				$result_arr['st'] = 'success';
				$result_arr['ico'] = '<i class="ion-ios-checkmark" style="color: green"></i>';
				$result_arr['mess'] = 'Bid success, thank you!';
			}
            
            do_action('before_wa_bid');
            
			echo json_encode( apply_filters( 'before_wa_result_bid_data', $result_arr ) );
			exit;
		}

		function wa_check_bid_product( $pID, $price ) {
			$_post = get_post( $pID, ARRAY_A );
			$meta_fields = get_post_custom( $pID );
			$dates = ( isset( $meta_fields['_auction_dates'] ) )? unserialize( $meta_fields['_auction_dates'][0] ) : "";

			$next_price = $this->wa_next_price_bid_product( false );
			$status = true;
			$user_ID = get_current_user_id();

			if( !isset( $user_ID ) || $user_ID == 0 ) 
				$status = false;

			$date_now = date( 'Y/m/d H:i:s' );
			$date_end = date( $dates['end'] );
			if( $date_now > $date_end )
				$status = false;

			if( $price < $next_price )
				$status = false;
			
			return $status;
		}

		function get_max_bid_price_by_productid( $pID ) {
			require_once ( WA_PLUGIN_DIR . '/includes/class-wa-db.php' );

			$db = new WA_Db();
			$arr_query = array(
				"tableName" => "wa_product_bids AS a",
				"select" => "MAX(a.price) AS max_bid_price",
				"where" => "a.product_id = " . $pID,
				);
			$bid = $db->fetch( $arr_query );
			return $bid[0]['max_bid_price'];
		}

		function wa_get_highest_bid_by_productid( $pID ) {
			$db = new WA_Db();
			$arr_query = array(
				"tableName" => "wa_product_bids AS a",
				"select" => "a.*",
				"where" => "a.product_id = " . $pID,
				"orderField" => "a.price DESC",
				"limit" => array(
					"start" => 0,
					"count" => 1
					)
				);

			$bid = $db->fetch( $arr_query );
			return $bid;
		}

		function count_bid_by_productid( $pID ){
			require_once ( WA_PLUGIN_DIR . '/includes/class-wa-db.php' );
			
			$db = new WA_Db();
			$arr_query = array(
				"tableName" => "wa_product_bids",
				"select" => "count(id) AS count",
				"where" => "product_id = " . $pID,
				);

			$bid = $db->fetch( $arr_query );
			return $bid[0]['count'];
		}

		function wa_render_btn_single_page() {
			global $product;
			$highest_bid_row = $this->wa_get_highest_bid_by_productid( $product->id );
			$meta_fields = get_post_custom($product->id);
            $dates = ( isset( $meta_fields['_auction_dates'] ) )? unserialize( $meta_fields['_auction_dates'][0] ) : "";
			$user_ID = get_current_user_id();

			$url_login = wp_login_url() . '?redirect_to=' . get_permalink( $product->id );

			$btn_html_arr = array(
				'login' 		=> '<a href="'. $url_login .'" class="btn btn-default">'. __('Bid', 'wa') .'</a>',
				'add_to_cart' 	=> '<button class="btn btn-primary wa-add-to-cart-js" data-productid="'. $product->id .'">'. __('Add to cart', 'wa') .'</button>',
				'bid' 			=> '<button id="wa-product-open-modal-bid-js" data-product-id="'. $product->id .'" class="btn btn-default"  data-toggle="modal" data-target="#wa_product_bid_modal">'. __('Bid', 'wa') .'</button>',
				//'buy_now' 		=> '<button class="btn btn-primary wa-buy-now-js" data-product-id="'. $product->id .'">'. __('Buy now', 'wa') .' ('. WA_Helper::currency( $meta_fields['_wa_buy_it_now_price'][0] ) .')</button>',
				'buy_now' 		=> '<button class="btn btn-primary wa-buy-now-js" data-product-id="'. $product->id .'">'. __('Buy now', 'wa') .'</button>',
				);


			$auction_status_name = array('expired', 'doing');
			$auction_status = $auction_status_name[1];
            $date_now = date( 'Y/m/d H:i:s' );
            $date_end = date( $dates['end'] );
			if( !isset( $user_ID ) || $user_ID == 0 && $date_now > $date_end ) {
				$user = get_userdata( $highest_bid_row[0]['user_id'] );
                return "<p>{$user->user_nicename} Won!</p>"; 
            }

			if( !isset( $user_ID ) || $user_ID == 0 ) 
				return $btn_html_arr['login'] . ' ' . $btn_html_arr['buy_now'];

			if( $date_now > $date_end ) {
				if( count( $highest_bid_row ) <= 0 )
					return "";

				if( $highest_bid_row[0]['price'] < $meta_fields['_wa_reserve_price'][0] )
					return "";

				if( $highest_bid_row[0]['user_id'] == $user_ID ) {
					return $btn_html_arr['add_to_cart'];
				} else {
					$user = get_userdata( $highest_bid_row[0]['user_id'] );
                    return "<p>{$user->user_nicename} Won!</p>";
				}
			
			}

			return $btn_html_arr['bid'] . ' ' . $btn_html_arr['buy_now'];

		}

		function wa_setup_image_size() {
			add_image_size( 'wa_thumb_product', 680, 420, true );
		}

		function register_wa_assets() {
			// bootstrap
			wp_register_script( 'script.bootstrap', WA_PLUGIN_URL . '/assets/js/bootstrap.min.js', array( 'jquery' ) );
			wp_register_style( 'style.bootstrap', WA_PLUGIN_URL . '/assets/css/bootstrap.min.css' );

			// datetimepicker
			wp_register_script( 'jquery.datetimepicker', WA_PLUGIN_URL . '/assets/js/jquery.datetimepicker.js', array( 'jquery' ) );
			wp_register_style( 'jquery.datetimepicker', WA_PLUGIN_URL . '/assets/css/jquery.datetimepicker.css' );
			
			// countdown
			wp_register_script( 'jquery.countdown', WA_PLUGIN_URL . '/assets/js/jquery.countdown.min.js', array( 'jquery' ) );
			
			// mustache
			wp_register_script( 'script.mustache', WA_PLUGIN_URL . '/assets/js/mustache.js' );

			// Plugin
			wp_register_script( 'script.wooauction', WA_PLUGIN_URL . '/assets/js/woo_auction.js', array( 'jquery' ) );
			wp_register_style( 'style.wooauction', WA_PLUGIN_URL . '/assets/css/woo_auction.css' );

			$_bootstrap = get_option( 'wa_include_boptstrap', 'no' );
			if( $_bootstrap == 'yes' && ! is_admin() ) {
				wp_enqueue_script('jquery');
				wp_enqueue_script('script.bootstrap');
				wp_enqueue_style('style.bootstrap');
			}
		}
	}
}

$Woo_Auction = new Woo_Auction();
?>