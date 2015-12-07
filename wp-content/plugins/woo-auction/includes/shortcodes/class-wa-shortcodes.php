<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'WA_Shortcode' ) ) {
	class WA_Shortcode {
		public $dir = '';
		public $listShortcode = array(); 

		function __construct() {
			$this->dir = WA_PLUGIN_DIR . '/includes/shortcodes/';
			$this->shortcode_init();
		}

		function shortcode_init() {
			$this->get_list_shortcode()
			->override_wa_shortcode_dir()
			->inc_shortcodes();
		}

		function get_list_shortcode() {
			$files = scandir( $this->dir );
			unset( $files[0] ); unset( $files[1] ); // remove '.' & '..'
			
			foreach( $files as $file ){
			 	if( is_dir( $this->dir . $file ) )
			  		$this->listShortcode[$file] = $this->dir . $file . '/' . $file . '.php';
			}

			return $this;
		}

		function inc_shortcodes() { 
			if( count( $this->listShortcode ) <= 0 ) return;
 			//print_r( $this->listShortcode );
			// include db class
			require_once( WA_PLUGIN_DIR . '/includes/class-wa-db.php' );
			foreach( $this->listShortcode as $_name => $shortcode ) {
				$path_include = $shortcode;
				if( is_file( $path_include ) ) {
					require_once ( $path_include ); 

					// add_shortcode( 'wa_product_list', 'wa_product_list_func' );
					$name_shortcode_func = trim( str_replace('-', '_', $_name) . '_func' );
					
					if( function_exists( $name_shortcode_func ) ) { 
						add_shortcode( str_replace('-', '_', $_name), $name_shortcode_func );
					}
				}
			}

			return $this;
		}

		function override_wa_shortcode_dir() {
			$shortcode_theme_custom_dir = get_template_directory() . '/wa-auction/shortcodes/';
			if( is_dir( $shortcode_theme_custom_dir ) ){
				//$files = scandir( $this->dir );
				$files = scandir( $shortcode_theme_custom_dir );
				unset( $files[0] ); unset( $files[1] ); // remove '.' & '..'

				foreach( $files as $file ) {
					
					if( is_dir( $shortcode_theme_custom_dir . $file . '/' ) ) { 
						$this->listShortcode[$file] = $shortcode_theme_custom_dir . $file . '/' . $file . '.php'; 

					}
				
				}
			}

			return $this;
		}
	}
}
new WA_Shortcode();
?>