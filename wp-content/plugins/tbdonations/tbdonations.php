<?php
/**
 * @package TB Donations
 */
/*
Plugin Name: TB Donations
Plugin URI: http://themebears.com
Description: TB donations plugin wordpress.
Version: 1.0.0
Author: Themebears
Author URI: http://themebears.com
License: GPLv2 or later
Text Domain: tbdonations
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}
define( 'TBDONS_VER', '1.0.0' );
define( 'TBDONS', 'tbdonations' );
define( 'TBDONS_PLG_URL', plugin_dir_url( __FILE__ ) );
define( 'TBDONS_PLG_DIR', plugin_dir_path( __FILE__ ) );
class TBDonations{	
	public function __construct() {
		require_once( TBDONS_PLG_DIR . '/includes/TBDonationsCustomPostTypes.class.php' );
		require_once( TBDONS_PLG_DIR . '/includes/TBDonationsTablePayment.class.php' );
		require_once( TBDONS_PLG_DIR . '/includes/TBDonationsPagePayment.class.php' );
		require_once( TBDONS_PLG_DIR . '/includes/TBDonationsPageSetting.class.php' );
		require_once( TBDONS_PLG_DIR . '/includes/TBDonationsShortcodes.class.php' );
		$this->cpts = new TBDonationsCustomPostTypes();
		$this->settings = new TBDonationsPageSetting();
		$this->tablepayment = new TBDonationsTablePayment();
		$this->pagepayment = new TBDonationsPagePayment();
		$this->shortcodes = new TBDonationsShortcodes();
		register_activation_hook( __FILE__, array( $this, 'tb_install' ) );
		register_deactivation_hook( __FILE__, array( $this, 'tb_uninstall' ) );
	}
	
	function tb_install(){
		$this->tablepayment->tb_create_table_payment();
		$this->tb_create_page();
	}
	
	function tb_uninstall(){
		$this->tablepayment->tb_drop_table_payment();
		$this->tb_delete_page();
	}
	
	function tb_create_page(){
		global $wpdb;
		$the_page_title = 'Donation Success';
		$the_page_name = 'donation-success';
		// the menu entry...
		delete_option("tbdonations_page_title");
		add_option("tbdonations_page_title", $the_page_title, '', 'yes');
		// the slug...
		delete_option("tbdonations_page_name");
		add_option("tbdonations_page_name", $the_page_name, '', 'yes');
		// the id...
		delete_option("tbdonations_page_id");
		add_option("tbdonations_page_id", '0', '', 'yes');

		$the_page = get_page_by_title( $the_page_title );

		if ( ! $the_page ) {

			// Create post object
			$_p = array();
			$_p['post_title'] = $the_page_title;
			$_p['post_content'] = "Thanks for your order! Please wait redirecting...[tbdonations_success]";
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

		delete_option( 'tbdonations_page_id' );
		add_option( 'tbdonations_page_id', $the_page_id );
	}
	function tb_delete_page(){
		global $wpdb;

		$the_page_title = get_option( "tbdonations_page_title" );
		$the_page_name = get_option( "tbdonations_page_name" );

		//  the id of our page...
		$the_page_id = get_option( 'tbdonations_page_id' );
		if( $the_page_id ) {
			wp_delete_post( $the_page_id ); // this will trash, not delete
		}

		delete_option("tbdonations_page_title");
		delete_option("tbdonations_page_name");
		delete_option("tbdonations_page_id");
	}
}
$TBDonations = new TBDonations();
