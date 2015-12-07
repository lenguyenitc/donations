<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( !class_exists( 'WA_Admin' ) ) {

	class WA_Admin {
		function __construct() {
			require_once ( WA_PLUGIN_DIR . '/includes/class-wa-product-type.php' );
			add_filter( 'product_type_selector', array( &$this, 'wa_product_type' ) );

			add_filter( 'woocommerce_product_data_tabs', array( &$this, 'wa_product_tab' ) );
			add_action( 'woocommerce_product_data_panels', array( &$this, 'wa_product_tab_content' ) );
			add_action( 'save_post', array( &$this,'wa_update_custom_meta_fields' ) );

		}

		function wa_product_type($types) {
			$types[ 'woo_auction' ] = __( 'Auction', 'wa' );
			return $types;
		}

		function wa_product_tab($tabs) {
			$tabs['woo_auction_tab'] = array(
				'label'  => __( 'Auction', 'wa' ),
				'target' => 'woo_auction_tab',
				'class'  => array( 'show_if_woo_auction' ),
			);

			return $tabs;
		}

		function wa_fields_meta() {
			global $post;
			$custom = get_post_custom($post->ID); 
			// echo '<pre>'; print_r($custom); echo '</pre>';
			$dates = ( isset( $custom['_auction_dates'] ) )? unserialize( $custom['_auction_dates'][0] ) : "";
			$proxy_bidding = ( isset( $custom['_wa_proxy_bidding'][0] ) && $custom['_wa_proxy_bidding'][0] == 1  )? true : false;
			
			$fields = apply_filters( 'wa_fields_product_data_tabs', array(
					// "wa_fields[_wa_proxy_bidding]" => array(
					// 	"title" => "Proxy bidding?",
					// 	"type" => "checkbox",
					// 	"default" => $proxy_bidding,
					// 	"description" => "Enable proxy bidding"
					// ),
					"wa_fields[_wa_start_price]" => array(
						"title" => "Start price", 
						"type" => "number",
						"default" => ( isset( $custom['_wa_start_price'][0] ) )? $custom['_wa_start_price'][0] : 1,
					),
					"wa_fields[_wa_bid_increment]" => array(
						"title" => "Bid increment", 
						"type" => "number",
						"default" => ( isset( $custom['_wa_bid_increment'][0] ) )? $custom['_wa_bid_increment'][0] : 1,
					),
					"wa_fields[_wa_reserve_price]" => array(
						"title" => "Reserve price", 
						"type" => "number",
						"default" => ( isset( $custom['_wa_reserve_price'][0] ) )? $custom['_wa_reserve_price'][0] : 11,
					),
					"wa_fields[_wa_buy_it_now_price]" => array(
						"title" => "Buy it now price", 
						"type" => "number",
						"default" => ( isset( $custom['_wa_buy_it_now_price'][0] ) )? $custom['_wa_buy_it_now_price'][0] : 9,
					),
					"wa_fields[_auction_dates]" => array(
						"title" => "Auction dates",
						"type" => "auction_dates",
						"start" => ( isset( $dates['start'] ) )? $dates['start'] : date('Y-m-d H:i:s'),
						"end" => ( isset( $dates['end'] ) )? $dates['end'] : '',
					),
					"wa_fields[_wa_owner_name]" => array(
						"title" => "Owner name",
						"type" => "text",
						"default" => ( isset( $custom['_wa_owner_name'][0] ) )? $custom['_wa_owner_name'][0] : '',
					),
					"wa_fields[_wa_owner_address]" => array(
						"title" => "Address",
						"type" => "text",
						"default" => ( isset( $custom['_wa_owner_address'][0] ) )? $custom['_wa_owner_address'][0] : '',
					),
					"wa_fields[_wa_owner_email]" => array(
						"title" => "Email",
						"type" => "text",
						"default" => ( isset( $custom['_wa_owner_email'][0] ) )? $custom['_wa_owner_email'][0] : '',
					),
					"wa_fields[_wa_owner_phone]" => array(
						"title" => "Phone",
						"type" => "text",
						"default" => ( isset( $custom['_wa_owner_phone'][0] ) )? $custom['_wa_owner_phone'][0] : '',
					),
					"wa_fields[_wa_owner_fax]" => array(
						"title" => "Fax",
						"type" => "text",
						"default" => ( isset( $custom['_wa_owner_fax'][0] ) )? $custom['_wa_owner_fax'][0] : '',
					),
					"wa_fields[_wa_owner_url]" => array(
						"title" => "Url",
						"type" => "text",
						"default" => ( isset( $custom['_wa_owner_url'][0] ) )? $custom['_wa_owner_url'][0] : '',
					),
					"wa_fields[_wa_owner_description]" => array(
						"title" => "Description",
						"type" => "textarea",
						"default" => ( isset( $custom['_wa_owner_description'][0] ) )? $custom['_wa_owner_description'][0] : '',
					),
				) );

			return $fields;
		}

		function wa_product_tab_content() {
			// enqueue
			wp_enqueue_script('jquery');
			wp_enqueue_script('jquery.datetimepicker');
			wp_enqueue_style('jquery.datetimepicker');
			wp_enqueue_script('script.wooauction');
			wp_enqueue_style('style.wooauction');

			$wa_fields = $this->wa_fields_meta();

			ob_start();
			require_once ( WA_PLUGIN_DIR . '/views/view-custom-product-tab.php' );
			echo ob_get_clean();
		}

		function wa_update_custom_meta_fields( $post_id ) {
			//disable autosave,so custom fields will not be empty
			if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;

		    if( isset($_POST['wa_fields']) ){
		    	do_action('before_wa_fields_save', $_POST);

		    	// set value _wa_proxy_bidding
		    	$_POST['wa_fields']['_wa_proxy_bidding'] = ( isset( $_POST['wa_fields']['_wa_proxy_bidding'] ) )? $_POST['wa_fields']['_wa_proxy_bidding'] : 0;    	
		    	
		    	// save product type Woo
		    	update_post_meta( $post_id, '_wa_product-type', ( isset( $_POST['product-type'] ) )? $_POST['product-type'] : '' );
		    	
		    	$wa_fields = apply_filters( 'wa_fields_product_data_before_save', $_POST['wa_fields'] );

		    	$wa_fields['_wa_dates_start'] = $_POST['wa_fields']['_auction_dates']['start'];
		    	$wa_fields['_wa_dates_end'] = $_POST['wa_fields']['_auction_dates']['end'];

		    	// save
		    	foreach( $wa_fields as $f_name => $f_val ){
		    		update_post_meta( $post_id, $f_name, $f_val );
		    	}

		    	do_action('after_wa_fields_save', $_POST);
		    }
		}
	}

}

new WA_Admin();
?>