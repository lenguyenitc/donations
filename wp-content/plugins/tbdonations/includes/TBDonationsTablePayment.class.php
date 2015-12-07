<?php
/**
 * Class to handle all custom post type definitions for Restaurant Reservations
 */

if ( !defined( 'ABSPATH' ) )
	exit;

if ( !class_exists( 'TBDonationsTablePayment' ) ) {
	class TBDonationsTablePayment {
		
		public function __construct() {

			// Call when plugin is initialized on every page load
			add_action( 'delete_post', array( $this, 'tb_meta_delete_post') );

		}
		
		function tb_create_table_payment() {
			global $wpdb;
			$table_name = $wpdb->prefix . 'tbdonations_payment';			
			$charset_collate = $wpdb->get_charset_collate();
			$sql = "CREATE TABLE $table_name (
				id mediumint(9) NOT NULL AUTO_INCREMENT,
				donations_id mediumint(9),
				transaction_id mediumint(9),
				date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
				firstname tinytext NOT NULL,
				lastname tinytext NOT NULL,
				email tinytext NOT NULL,
				phone tinytext NOT NULL,
				paid mediumint(1) DEFAULT 0,
				amount integer,
				address tinytext,
				addition_notes text,
				mailing_list mediumint(1) DEFAULT 0,
				PRIMARY KEY (id)
			) $charset_collate;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
		}
		
		function tb_drop_table_payment() {
			global $wpdb;
			$table_name = $wpdb->prefix . 'tbdonations_payment';
			$sql = "DROP TABLE IF EXISTS $table_name;";
			
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			$wpdb->query( $wpdb->prepare(( $sql )));
		}
		
		function tb_meta_delete_post( $post_id ) {
			if ( get_post_type( $post_id ) == 'tbdonations' ) {
				global $wpdb;
				$wpdb->query( $wpdb->prepare( "
					DELETE FROM " . $wpdb->prefix . "tbdonations_payment
					WHERE       post_id = %d
				", $post_id ) );
			}
		}
	}
}
