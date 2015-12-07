<?php

add_action( 'pre_get_posts', 'wa_custom_woo_archive_loop' );

function wa_custom_woo_archive_loop($query) {
    if ( !is_admin() && is_post_type_archive( 'product' ) && $query->is_main_query() ) {
       	$query->set('meta_query', array(
            array(
           	  'key' => '_wa_product-type',
             	'value' => 'woo_auction',
             	'compare' => '!='
             	)
         	)
       	);   
    }
}

?>
