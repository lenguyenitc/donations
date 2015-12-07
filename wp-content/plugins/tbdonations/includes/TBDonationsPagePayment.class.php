<?php
/**
 * Class to handle all custom post type definitions for Restaurant Reservations
 */

if ( !defined( 'ABSPATH' ) )
	exit;

if ( !class_exists( 'TBDonationsPagePayment' ) ) {
	class TBDonationsPagePayment {
		
		public function __construct() {

			// Call when plugin is initialized on every page load		
			require_once( TBDONS_PLG_DIR . '/includes/TBDonationsDB.class.php' );
			$this->db = new TBDonationsDB();
			add_action( 'admin_menu', array( $this, 'add_page_payment_menu') );

		}
		
		function add_page_payment_menu() {
			add_submenu_page('edit.php?post_type=tbdonations', __('Payments','tbdonations'), __('Payments','tbdonations'), 'manage_options', 'payments', array($this,'PagePayment'));
		}
		
		function PagePayment(){
			ob_start();
			require_once( TBDONS_PLG_DIR.'/views/payments.php' );
			echo ob_get_clean();
		}
	}
}
