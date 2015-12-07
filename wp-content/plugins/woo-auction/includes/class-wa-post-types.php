<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( !class_exists('WA_Custom_Post_types') ) {
	class WA_Custom_Post_types {
		var $is_auction = false;

		function __construct() {

			add_action( 'init', array( &$this, 'load_cpts' ) );
			add_filter( 'pre_get_posts', array( &$this, 'wa_fields' ) );
			add_filter( 'manage_edit-wooauction_columns', array( &$this, 'wooauction_table_head' ) );
			add_action( 'manage_product_posts_custom_column', array( &$this, 'manage_wooauction_columns' ) );
			
		}

		function load_cpts() {
			$labels = array(
				'name'               => __( 'Woo Auction', 'wa' ),
				'singular_name'      => __( 'Auction', 'wa' ),
				'menu_name'          => __( 'Woo Auctions', 'wa' ),
				'name_admin_bar'     => __( 'Auction', 'wa' ),
				'add_new'            => __( 'Add Product', 'wa' ),
				'add_new_item'       => __( 'Add New Auction', 'wa' ),
				'new_item'           => __( 'New Auction', 'wa' ),
				'edit_item'          => __( 'Edit Auction', 'wa' ),
				'view_item'          => __( 'View Auction', 'wa' ),
				'all_items'          => __( 'All Auctions', 'wa' ),
				'search_items'       => __( 'Search Auctions', 'wa' ),
				'parent_item_colon'  => __( 'Parent Auctions:', 'wa' ),
				'not_found'          => __( 'No auction found.', 'wa' ),
				'not_found_in_trash' => __( 'No auction found in Trash.', 'wa' )
			);

			$args = array(
				'labels' => $labels,
				'menu_icon' => 'dashicons-hammer',
				'public' => true,
				'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
				'capability_type' => 'post',
			  	'capabilities' => array(
				    'create_posts' => 'do_not_allow',
				  	),
			  	'map_meta_cap' => true, 
			);

			// Create filter so addons can modify the arguments
			$args = apply_filters( 'wooauction_args', $args );

			// Add an action so addons can hook in before the post type is registered
			do_action( 'wooauction_pre_register' );

			register_post_type( 'wooauction', $args );

			// Add an action so addons can hook in after the post type is registered
			do_action( 'wooauction_post_register' );
		}

		function wa_fields( $query ) {
			global $wpdb, $post_type;
			$this->is_auction = true;

			if( $post_type == 'wooauction' ) {

				$meta_query = array(
                   	array(
	                   	'key' => '_wa_product-type',
	                 	'value' => 'woo_auction',
	                 	'compare' => '='
	                 	)
                );

				$query->set( 'post_type', 'product' );
				$query->set( 'posts_per_page', 10 );
				$query->set( 'meta_query', $meta_query );

			}
			
			return $query;
		}

		function wooauction_table_head( $columns ) {
			$columns = array(
				"cb" 					=> "<input type=\"checkbox\" />",
				"title" 				=> __("Title", "wa"),
				"wa_start_price" 		=> __("Start price", "wa"),
				"wa_bid_increment" 		=> __("Bid increment", "wa"),
				"wa_reserve_price" 		=> __("Reserve price", "wa"),
				"wa_buy_it_now_price" 	=> __("Buy it now price", "wa"),
				"wa_auction_dates" 		=> __("Dates Start/End", "wa"),
				);

		    return $columns;
		}

		function manage_wooauction_columns( $column ) {
			if( $this->is_auction == false ) return;

			global $post;
			$custom = get_post_custom( $post->ID );
			$dates = ( isset( $custom['_auction_dates'] ) )? unserialize( $custom['_auction_dates'][0] ) : "";

			switch ( $column ) {
				case "wa_start_price":
					echo ( isset($custom['_wa_start_price'][0]) )? $custom['_wa_start_price'][0] : '-';
					break;

				case "wa_bid_increment":
					echo ( isset($custom['_wa_bid_increment'][0]) )? $custom['_wa_bid_increment'][0] : '-';
					break;

				case "wa_reserve_price":
					echo ( isset($custom['_wa_reserve_price'][0]) )? $custom['_wa_reserve_price'][0] : '-';
					break;

				case "wa_buy_it_now_price":
					echo ( isset($custom['_wa_buy_it_now_price'][0]) )? $custom['_wa_buy_it_now_price'][0] : '-';
					break;	

				case "wa_auction_dates":
					echo ( isset($dates['start']) )? "<p>Start: {$dates['start']}</p>" : '';
					echo ( isset($dates['end']) )? "<p>End: {$dates['end']}</p>" : '';
					break;			 
			}
		}
	}
}

new WA_Custom_Post_types();
?>