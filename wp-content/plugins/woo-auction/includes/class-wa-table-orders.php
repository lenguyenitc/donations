<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'WA_Table_Orders' ) ) {
	class WA_Table_Orders {
		function __construct() {
			add_action( 'delete_post', array( $this, 'wa_meta_delete_post') );

			register_activation_hook( WA_PLUGIN_FILE, array( &$this, 'create_table_wa_product_order' ) );
			register_deactivation_hook( WA_PLUGIN_FILE, array( &$this, 'drop_table_wa_product_order' ) );  
		}

		function create_table_wa_product_order() {
			global $wpdb;
			$table_name = $wpdb->prefix . 'wa_product_orders';			
			$charset_collate = $wpdb->get_charset_collate();
			$sql = "CREATE TABLE $table_name (
				id mediumint(9) NOT NULL AUTO_INCREMENT,
				order_id mediumint(9),
				date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
				status mediumint(1) DEFAULT 0,
				extra_fields text NOT NULL,
				PRIMARY KEY (id)
			) $charset_collate;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
		}

		function drop_table_wa_product_order() {
			global $wpdb;
			$table_name = $wpdb->prefix . 'wa_product_orders';
			$sql = "DROP TABLE IF EXISTS $table_name;";
			
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			$wpdb->query( $wpdb->prepare(( $sql )));
		}

		function wa_meta_delete_post( $post_id ) {

			if ( get_post_type( $post_id ) == 'shop_order' ) {
				global $wpdb;
				$wpdb->query( $wpdb->prepare( "
					DELETE FROM " . $wpdb->prefix . "wa_product_orders
					WHERE       order_id = %d
				", $post_id ) );
			}
		}
	}
}

new WA_Table_Orders();
?>