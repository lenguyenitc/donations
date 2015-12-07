<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'WA_Page_Order' ) ) {
	class WA_Page_Order {
		function __construct() {
			add_action( 'admin_menu', array( $this, 'add_page_wa_order_menu' ) );
			add_action( 'woocommerce_checkout_order_processed', array( &$this, 'wa_payment_complete' ) );
		}

		function add_page_wa_order_menu() {
			$parent_slug = 'edit.php?post_type=wooauction';
			$page_title = __('Orders','wa');
			$menu_title = __('Orders','wa');
			$capability = 'manage_options';
			$menu_slug = 'orders';
			$function = array($this,'wa_page_orders');
			
			add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
		}

		function wa_page_orders() {
			$query = array(
				"tableName" => "wa_product_orders AS a",
				"select" => "a.date AS order_date, a.status AS order_status, a.extra_fields AS order_extra_fields, b.*",
				"join" => array(
					array(
						"tableName" => "woocommerce_order_items AS b",
						"on" => "a.order_id = b.order_id",
						)
					),
				"orderField" => "a.id DESC",
				"where" => "b.order_item_type = 'line_item'"
				);

			$params = array(
				"manage_post_per_page" => 10,
				"manage_header_columns" => array("Order", "Order status", "Order date"),
				"manage_content_columns" => array("order_id", "order_status", "order_date"),
				"filter" => array( &$this, 'filter_order' ),
				"manage_query" => $query,
				);

			WA_Helper::create_list_page( $params );
		}

		function filter_order( $field, $field_datas ){
			$result = "";
			$field_data = $field_datas[$field];

			$order_statuses = array(
				'wc-pending'    => __( 'Pending Payment', 'wa' ),
				'wc-processing' => __( 'Processing', 'wa' ),
				'wc-on-hold'    => __( 'On Hold', 'wa' ),
				'wc-completed'  => __( 'Completed', 'wa' ),
				'wc-cancelled'  => __( 'Cancelled', 'wa' ),
				'wc-refunded'   => __( 'Refunded', 'wa' ),
				'wc-failed'     => __( 'Failed', 'wa' ),
				);

			$order = new WC_Order( $field_datas['order_id'] );

			switch( $field ){
				case 'order_id':
					$result = "<b><a href='post.php?post={$field_data}&action=edit'>#{$field_data}</a></b>";
					break;
				case 'order_status':
					$result = $order_statuses[$order->post_status];
					break;
				default: 
					$result = $field_data;
					break;
			}

			return $result;
		}

		function wa_payment_complete( $id ) {
			require_once ( WA_PLUGIN_DIR . '/includes/class-wa-db.php' );

			$db = new WA_Db();
			$params = array(
				"tableName" => "wa_product_orders",
				"arrItems" => array(
					"order_id" => $id,
					"date" => date('Y/m/d H:i:s'),
					"status" => 0
					)
				);

			$db->insert($params);
			echo "success.";
		}
	}
}

new WA_Page_Order();
?>