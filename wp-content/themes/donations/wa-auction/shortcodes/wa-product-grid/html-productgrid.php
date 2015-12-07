<?php 
	global $product, $post, $Woo_Auction;
	$current_price = $Woo_Auction->get_max_bid_price_by_productid( $post->ID );
?>
<div class="wa-grid-item-inner">
	<div id="wa-carousel-item-<?php echo esc_attr($post->ID); ?>" class="wa-grid-thumb carousel slide" data-ride="carousel">
		<?php  
			$attachment_ids = $product->get_gallery_attachment_ids();
			if ( count( $attachment_ids ) >= 2 ){
				echo '<div class="carousel-inner" role="listbox">';
				foreach( $attachment_ids as $index => $attachID ){
					$firs_active = ( $index == 0 ) ? 'active' : ''; 
					echo "<div class='item wa-carousel-item {$firs_active}'>" . wp_get_attachment_image( $attachID, 'wa_thumb_product' ) . "</div>";
				}
				echo '</div>';
				?>
				<a class="left carousel-control" href="#wa-carousel-item-<?php echo esc_attr($post->ID); ?>" role="button" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				    <span class="sr-only"><?php _e('Previous', THEMENAME); ?></span>
			  	</a>
			  	<a class="right carousel-control" href="#wa-carousel-item-<?php echo esc_attr($post->ID); ?>" role="button" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				    <span class="sr-only"><?php _e('Next', THEMENAME); ?></span>
			  	</a>
				<?php
			} else if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'wa_thumb_product' );
			} else {
                echo '<img src=\''. WA_PLUGIN_URL .'/assets/images/no-image.jpg\' />';
            }
		?>
	</div>
	<div class="wa-grid-info">
		<div class="wa-countdown">
			<span class="countdown wa-countdown-inner" data-extradata="<?php echo esc_attr( json_encode( $_extra_data ) ); ?>" data-datatime="<?php echo esc_attr($date_countdown); ?>" data-format="%-w week%!w %-d day%!d %H:%M:%S">
			  	<span class="clock"></span>
			</span>
			<div class="wa-bid-info">
				<span>
					<i class="ion-ios-pricetag-outline" title="<?php _e('bids', THEMENAME) ?>"></i>
					<?php echo do_shortcode( $Woo_Auction->count_bid_by_productid( $post->ID ) ); ?>
				</span>
				<span>
					<i class="ion-social-usd-outline" title="<?php _e('current price', THEMENAME) ?>"></i>
					<?php echo ( empty($current_price) ) ? WA_Helper::currency( $meta_fields['_wa_start_price'][0] ) : WA_Helper::currency( $current_price ); ?>
				</span>
				<span>
					<i class="ion-ios-heart-outline" title="<?php _e('buy now price', THEMENAME) ?>"></i>
					<?php echo WA_Helper::currency( $meta_fields['_wa_buy_it_now_price'][0] ); ?>
				</span>
			</div>
		</div>
		
		<div class="wa-title">
			<h5 class="wa-text-uppercase">
				<a class="wa-url" href="<?php echo esc_url( get_permalink($posts->ID) ); ?>">
					<h4><?php the_title(); ?></h4>
				</a>
			</h5>
		</div>
		<div class="wa-description">
			<?php the_excerpt(); ?>
			<a href="<?php get_permalink($post->ID); ?>"><?php _e('Read More', THEMENAME); ?> <i class="fa fa-angle-double-right"></i></a>
		</div>
	</div>
</div>