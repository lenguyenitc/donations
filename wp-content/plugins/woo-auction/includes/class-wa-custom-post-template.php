<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'WA_Custom_Post_Template' ) ) {
	class WA_Custom_Post_Template {
		function __construct() {
			add_filter( 'template_include', array( &$this, 'filter_single_template' ), 99 );
			add_action( 'template_redirect', array( &$this, 'wa_remove_shop_breadcrumbs' ) );
		}


		function wa_remove_shop_breadcrumbs(){
		 
			if (is_single()) {
				remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
			}
		}

		function filter_single_template( $single_template ) {		
			global $post;
			$single_page = is_single( $post );
			if ( !empty( $single_page ) && $post->post_type == 'product' ) {
				$meta_fields = get_post_custom($post->ID);
				if( isset($meta_fields['_wa_product-type'][0]) && $meta_fields['_wa_product-type'][0] == "woo_auction" ) {
					$custom_template = $this->override_wa_product_single_dir();

					if ( is_file( $custom_template ) ){ 


						//wp_enqueue_script('jquery');
						//wp_enqueue_script('script.bootstrap');
						//wp_enqueue_style('style.bootstrap');
						wp_enqueue_script('jquery.countdown');
						wp_enqueue_script('script.mustache');
						wp_enqueue_script('script.wooauction');
						wp_enqueue_style('style.wooauction');

						wp_localize_script( 'script.wooauction', 'wooauction', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
						$single_template =  $custom_template; 
					}
				}
			}

			return $single_template;
		}

		function override_wa_product_single_dir() {
			$template = WA_PLUGIN_DIR . '/views/view-custom-post-product-item.php';
			if( is_file( get_template_directory() . '/wa-auction/single-product.php' ) ){
				$template = get_template_directory() . '/wa-auction/single-product.php';
			}

			return $template;
		}
	}
}
new WA_Custom_Post_Template();
?>