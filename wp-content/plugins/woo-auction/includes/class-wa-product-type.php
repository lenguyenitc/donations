<?php
if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( !class_exists( 'WC_Product_Woo_Auction') ) {
	if( !class_exists( 'WC_Product') )
		require_once ( WA_PLUGIN_DIR . '/../woocommerce/includes/abstracts/abstract-wc-product.php' );

	class WC_Product_Woo_Auction extends WC_Product {
	    public function __construct( $product ) {
	       $this->product_type = 'woo_auction';
	       parent::__construct( $product );
	       // add additional functions here
	    }
	}

}