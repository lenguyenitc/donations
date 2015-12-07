<?php
/**
 * Class to handle all custom post type definitions for Restaurant Reservations
 */

if ( !defined( 'ABSPATH' ) )
	exit;

if ( !class_exists( 'TBDonationsPageSetting' ) ) {
	class TBDonationsPageSetting {		
		static $currency;
		public function __construct() {
			self::$currency = array(
				"USD" => array("title" => "United States Dollar( USD )", "symbol" =>"$"),
				"GBP" => array("title" => "United Kingdom( GBP )", "symbol" =>"£"),
				"EUR" => array("title" => "Euro Member Countries( EUR )", "symbol" =>"€"),
				"AUD" => array("title" => "Australia Dollar( AUD )", "symbol" =>"$"),
				"KRW" => array("title" => "Korea (South) Won( KRW )", "symbol" =>"₩"),
				"MYR" => array("title" => "Malaysia( MYR )", "symbol" =>"RM"),
				"NOK" => array("title" => "Norway( NOK )", "symbol" =>"kr"),
				"RUB" => array("title" => "Russia( RUB )", "symbol" =>"руб"),
				"SEK" => array("title" => "Sweden( SEK )", "symbol" =>"kr"),
				"SGD" => array("title" => "Singapore( SGD )", "symbol" =>"$"),
				"THB" => array("title" => "Thailand( THB )", "symbol" =>"฿"),
			);
			// Call when plugin is initialized on every page load
			add_action( 'admin_menu', array( $this, 'add_page_setting_menu'), 99 );

		}
		
		function add_page_setting_menu() {
			add_submenu_page('edit.php?post_type=tbdonations', __('Settings','tbdonations'), __('Settings','tbdonations'), 'manage_options', 'settings', array($this,'PageSettings'));
		}
		
		function PageSettings(){
			ob_start();
			require_once( ZODONS_PLG_DIR.'/views/settings.php' );
			echo ob_get_clean();
		}
	}
}
