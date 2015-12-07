<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( !class_exists( 'WA_Page_Setting_Options' ) ) {
	class WA_Page_Setting_Options {
		
		function __construct() {
			add_action( 'admin_menu', array( $this, 'add_page_wa_setting_menu' ) );
		}

		function add_page_wa_setting_menu() {
		 	global $submenu;
		 	$submenu['edit.php?post_type=wooauction'][10][2] = "post-new.php?post_type=product";
		 	unset( $submenu['edit.php?post_type=wooauction'][10] );

			$parent_slug = 'edit.php?post_type=wooauction';
			$page_title = __('Settings','wa');
			$menu_title = __('Settings','wa');
			$capability = 'manage_options';
			$menu_slug = 'wa-settings'; 
			$function = array($this,'wa_page_setting');
			
			add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
		}

		function wa_page_setting() {
			// save
			$this->wa_save_setting();

			// options arr
			$options = $this->wa_setting_fields();

			// include assets
			wp_enqueue_script('jquery');
			wp_enqueue_script('script.wooauction');
			wp_enqueue_style('style.wooauction');

			ob_start(); 
			require_once ( WA_PLUGIN_DIR . '/views/view-settings.php' );
			echo ob_get_clean();

		}

		function wa_setting_fields() {
			// cho get_option( 'wa_display_bid_increment' );
			$options = array(
				"general" =>  array(
					"title" => "General",
					"options" => array(
						"wa_setting[wa_countdown_format]" => array(
							"title" => "Auction countdown format",
							"type" => "text",
							//"default" => "%-w week%!w %-d day%!d %H:%M:%S",
							"default" => get_option( 'wa_countdown_format' , '%-w week%!w %-d day%!d %H:%M:%S' ),
							"description" => " countdown format"
							),

						"wa_setting[wa_include_boptstrap]" => array(
							"title" => __( 'Include Bootstrap 3', 'wa' ),
							"type" => "radio",
							"default" => get_option( 'wa_include_boptstrap', 'no' ),
							"options" => array(
								"No" => "no",
								"Yes" => "yes",
								)
							),

						"title_one" => array(
							"title" => "<h3>Single page display</h3>",
							"type" => "title",
							//"description" => "..."
							),
						"wa_setting[wa_display_owner_info]" => array(
							"title" => "Owner info",
							"type" => "checkbox",
							"default" => get_option( 'wa_display_owner_info', 1 ),
							"description" => " show/hide Owner info"
							),
						"wa_setting[wa_display_start_price]" => array(
							"title" => "Start price",
							"type" => "checkbox",
							//"default" => true,
							"default" => get_option( 'wa_display_start_price', 1 ),
							"description" => " show/hide Start price"
							),
						"wa_setting[wa_display_bid_increment]" => array(
							"title" => "Bid increment",
							"type" => "checkbox",
							//"default" => true,
							"default" => get_option( 'wa_display_bid_increment', 1 ),
							"description" => " show/hide Bid increment"
							),
						"wa_setting[wa_display_reserve_price]" => array(
							"title" => "Reserve price",
							"type" => "checkbox",
							//"default" => true,
							"default" => get_option( 'wa_display_reserve_price', 1 ),
							"description" => " show/hide Reserve price"
							),
						"wa_setting[wa_display_buy_now_price]" => array(
							"title" => "Buy now price",
							"type" => "checkbox",
							//"default" => true,
							"default" => get_option( 'wa_display_buy_now_price', 1 ),
							"description" => " show/hide Buy now price"
							),
						)
					),
				// "page_won_template" => array(
				// 	"title" => "Page won template",
				// 	"options" => array(
				// 		"wa_setting[wa_content_won_template]" => array(
				// 			"title" => "",
				// 			"id" => "wa_content_won_template",
				// 			"type" => "editor",
				// 			"default" => get_option( 'wa_content_won_template', '' ),
				// 			)
				// 		)
				// 	),
				"mail_config" => array(
					"title" => "Mail Config",
					"options" => array(
						
						"title_mail_config" => array(
							"title" => "<h3>Mail config</h3>",
							"type" => "title",
							),
						
						"wa_setting[wa_mail_subject]" => array(
							"title" => "Mail subject",
							"type" => "text",
							"default" => get_option( 'wa_mail_subject', 'Auction' ),
							"placeholder" => "Auction",
							),

						"wa_setting[wa_wpmail_or_smtp]" => array(
							"title" => "User WP-Mail or SMTP-Mail",
							"type" => "radio",
							"default" => get_option( 'wa_wpmail_or_smtp', 'wp_mail' ),
							"options" => array(
								"WP mail" => "wp_mail",
								"SMTP mail" => "smtp_mail",
								)
							),

						"wa_setting[wa_mail_from]" => array(
							"title" => "From",
							"type" => "text",
							"default" => get_option( 'wa_mail_from', '' ),
							"placeholder" => "you@mail.com"
							),
						
						"wa_setting[wa_mail_from_name]" => array(
							"title" => "From name",
							"type" => "text",
							"default" => get_option( 'wa_mail_from_name', '' ),
							"placeholder" => "Yourname"
							),
						
						"wa_setting[wa_SMTP_host]" => array(
							"title" => "SMTP host",
							"type" => "text",
							"placeholder" => "smtp.gmail.com",
							"default" => get_option( 'wa_SMTP_host', 'smtp.gmail.com' ),
							),
						
						"wa_setting[wa_SMTP_secure]" => array(
							"title" => "SMTP secure",
							"type" => "radio",
							"default" => get_option( 'wa_SMTP_secure', 'tls' ),
							"options" => array(
								"None" => "none",
								"SSL" => "ssl",
								"TLS" => "tls",
								)
							),
						
						"wa_setting[wa_SMTP_post]" => array(
							"title" => "SMTP post",
							"type" => "text",
							"placeholder" => "25",
							"default" => get_option( 'wa_SMTP_post', '25' ),
							),
						
						"wa_setting[wa_SMTP_authentication]" => array(
							"title" => "SMTP authentication",
							"type" => "radio",
							"default" => get_option( 'wa_SMTP_authentication', 1 ),
							"options" => array(
								"No" => 0,
								"Yes" => 1,
								)
							),
						
						"wa_setting[wa_mail_username]" => array(
							"title" => "Username",
							"type" => "text",
							"default" => get_option( 'wa_mail_username', '' ),
							"placeholder" => "you@mail.com",
							),
						
						"wa_setting[wa_mail_password]" => array(
							"title" => "Password",
							"type" => "password",
							"default" => '',
							),
						
						"title_two" => array(
							"title" => "<h3>Mail template user won</h3>",
							"type" => "title",
							),	
						
						"wa_setting[wa_content_mail_won_template]" => array(
							"title" => "",
							"id" => "wa_content_mail_won_template",
							"type" => "editor",
							"default" => get_option( 'wa_content_mail_won_template', '<p>Hello [username],</p>
								<p>You are  the winner in the auction: [product_name]</p>
								<p>Price: [price]</p>
								<p>Link order: [link]</p>
								&nbsp;
								<p>Thank you.</p>' ),
							"description" => "[username], [price], [link]",
							),
						
						"title_three" => array(
							"title" => "<h3>Mail template user lost</h3>",
							"type" => "title",
							),	
						
						"wa_setting[wa_content_mail_lost_template]" => array(
							"title" => "",
							"id" => "wa_content_mail_lost_template",
							"type" => "editor",
							"default" => get_option( 'wa_content_mail_lost_template', '<p>Hello [username],</p>
								<p>you\'ve lost in auctions: [product_name]</p>
								<p>Price: [price]</p>
								<p>Link product auction: [link]</p>
								&nbsp;
								<p>Thank you.</p>' ),
							"description" => "[username], [price], [link]",
							),
						)
					)
				);
            
            $options = apply_filters( 'wooauction_setting_options', $options );
			return $options;
		}

		function wa_save_setting() {
			if( ! isset( $_POST['wa_setting'] ) || count( $_POST['wa_setting'] ) <= 0 ) return;
            
            // action before save setting
            do_action('wa_before_save_setting', $_POST);
			
            $options = $_POST['wa_setting'];
			$variable_default = array(
				'wa_countdown_format' 		=> ( isset( $options['wa_countdown_format'] ) ) ? $options['wa_countdown_format'] : '%-w week%!w %-d day%!d %H:%M:%S',
				'wa_display_owner_info' 	=> ( isset( $options['wa_display_owner_info'] ) ) ? $options['wa_display_owner_info'] : 0,
				'wa_display_start_price' 	=> ( isset( $options['wa_display_start_price'] ) ) ? $options['wa_display_start_price'] : 0,
				'wa_display_bid_increment' 	=> ( isset( $options['wa_display_bid_increment'] ) ) ? $options['wa_display_bid_increment'] : 0,
				'wa_display_reserve_price' 	=> ( isset( $options['wa_display_reserve_price'] ) ) ? $options['wa_display_reserve_price'] : 0,
				'wa_display_buy_now_price' 	=> ( isset( $options['wa_display_buy_now_price'] ) ) ? $options['wa_display_buy_now_price'] : 0,
				);

			// not update if wa_mail_password empty
			if( empty( $options['wa_mail_password'] ) )
				unset( $options['wa_mail_password'] );

			$options = WA_Helper::define_variable( $options, $variable_default );
			
			foreach( $options as $f_name => $option ) {
				
				update_option( $f_name, $option, '' );
			}
            
            // action after save setting
            do_action('wa_after_save_setting', $_POST);
		}
		
	}
}

new WA_Page_Setting_Options();
?>