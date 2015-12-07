<?php 
function wa_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'wa_excerpt_more');

function wa_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'wa_excerpt_length', 99999 );

function wa_product_grid_func( $atts ){
	extract( shortcode_atts( array(
        'el_class' => 'default',
        'post_per_page' => 6,
        'orderby' => 'ID',
        'columns' => '3',
    ), $atts ) );

	$current_datetimes = date('Y/m/d H:i:s');

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array(
        'posts_per_page' => $post_per_page,
        'post_type' => 'product',
        'paged' => $paged,
        'orderby' => $orderby,
        'meta_query' => array(
        	array(
        		'key' => '_wa_product-type',
        		'value' => 'woo_auction',
        		'compare' => '='
        		),
        	array(
        		'key' => '_wa_dates_end',
        		'value' => $current_datetimes,
        		'compare' => '>',
        		'type' => 'DATETIME'
        		)
        	),
    );
	$posts = new WP_Query( $args );

	ob_start(); 
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery.countdown');
	wp_enqueue_script('script.wooauction');
	wp_enqueue_style('style.wooauction');

	$_class = array( 'wa-product-grid-content', $el_class );
	$_col = 12 / $columns;
	
	echo implode( '', array( 
		"<div class='". implode(' ', $_class) ."'>", 
			"<div class='wa-product-grid-content-inner row'>" ) 
	);


	while ( $posts->have_posts() ) { 
		$posts->the_post();
		$meta_fields = get_post_custom($posts->ID);
		$dates = ( isset( $meta_fields['_auction_dates'] ) )? unserialize( $meta_fields['_auction_dates'][0] ) : "";
		$date_now = date( 'Y/m/d H:i:s' );
		$date_start = date( $dates['start'] );
		$date_end = date( $dates['end'] );

		$date_countdown = $dates['end'];
		$_extra_class = array();
        $_extra_data = array('date_start' => $dates['start'], 
                        'date_end' => $dates['end'], 
                        'view' => 'list');

		if( $date_now < $date_start ) {
			array_push( $_extra_class, 'wa-product-not-start' );
            $date_countdown = $dates['start'];
            $_extra_data['status'] = 'close';
		}else {
			$_extra_data['status'] = 'open';
		}

		$_status_auction_class = ( $_extra_data['status'] == 'close' )? 'wa-product-not-start' : '';
		echo implode('', array(
				'<div class=\'wa-grid-item col-sm-12 col-md-'. $_col . ' '. $_status_auction_class .'\'>',
			)
		);
		include ( __DIR__ . '/html-productgrid.php' );
		echo implode('', array(
				'</div>',
			)
		);
	}

	echo implode( '', array( 
			"</div>", 
		"</div>" ) 
	);

	?>
	<nav class="navigation paging-navigation clearfix" role="navigation">
		<div class="pagination loop-pagination">
		<?php
			$big = 999999999; // need an unlikely integer

			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $posts->max_num_pages,
				'prev_text' => __( '<i class="fa fa-angle-double-left"></i>', THEMENAME ),
				'next_text' => __( '<i class="fa fa-angle-double-right"></i>', THEMENAME ),
			) );
		?>
		</div>
	</nav>
	<?php

	wp_reset_postdata();
	return ob_get_clean();
}

?>
