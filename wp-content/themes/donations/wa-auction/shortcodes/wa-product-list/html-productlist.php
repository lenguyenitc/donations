<?php 
global $product, $post, $Woo_Auction;
$current_price = $Woo_Auction->get_max_bid_price_by_productid( $post->ID );
$_item_close_class = ($_extra_data['status'] == 'close')? 'wa-item-close' : '';
?>
<div class="wa-product-item col-md-<?php echo esc_attr($_col); ?> col-sm-12 col-xs-12 <?php echo esc_attr($_item_close_class); ?>">
	<div class="wa-product-item-inner">
		<div class="row">
			<div class="col-md-4">
				<div id="wa-carousel-item-<?php echo esc_attr($post->ID); ?>" class="wa-product-item-thumb carousel slide" data-ride="carousel">
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
						    <span class="sr-only">Previous</span>
					  	</a>
					  	<a class="right carousel-control" href="#wa-carousel-item-<?php echo esc_attr($post->ID); ?>" role="button" data-slide="next">
						    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						    <span class="sr-only">Next</span>
					  	</a>
						<?php
					} else if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'wa_thumb_product' );
					} else {
                        echo '<img src=\''. WA_PLUGIN_URL .'/assets/images/no-image.jpg\' />';
                    }
					?>
				</div>
			</div>
			<div class="col-md-4">
				<ul class="wa-product-auction-info">
					<li class="wa-countdown-content">
						<div><i class="ion-ios-time-outline"></i></div>
						<span class="countdown wa-countdown-inner" data-extradata="<?php echo esc_attr( json_encode( $_extra_data ) ); ?>" data-datatime="<?php echo esc_attr($date_countdown); ?>" data-format="%-w week%!w %-d day%!d %H:%M:%S">
						  	<span class="clock"></span>
						</span>
					</li>
					<li class="wa-info-price-content">
						<div class="wa-bids-content">
							<div><i class="ion-ios-pricetag-outline"></i> <p><?php _e( 'Bids', 'wa' ); ?></p></div>
							<span class="wa-info-field-content">
								<?php echo do_shortcode( $Woo_Auction->count_bid_by_productid( $post->ID ) ); ?>
							</span>
						</div>
						<div class="wa-current-bids-content">
							<div><i class="ion-social-usd-outline"></i> <p><?php _e( 'Current price', 'wa' ); ?></p></div>
							<span class="wa-info-field-content">
								<?php 
								echo ( empty($current_price) ) ? WA_Helper::currency( $meta_fields['_wa_start_price'][0] ) : WA_Helper::currency( $current_price ); 
								?>
							</span>
						</div>
						<div class="wa-buy-bow-content">
							<div><i class="ion-ios-heart-outline"></i> <p><?php _e( 'Buy now price', 'wa' ); ?></p></div>
							<span class="wa-info-field-content"><?php echo WA_Helper::currency( $meta_fields['_wa_buy_it_now_price'][0] ); ?></span>
						</div>
					</li>
				</ul>
			</div>
			<div class="col-md-4">
				<div class="wa-product-entry-title">
					<a class="wa-url" href="<?php echo esc_url( get_permalink($posts->ID) ); ?>">
						<h2><?php the_title(); ?></h2>
					</a>
				</div>
				<div class="wa-product-entry-content">
					<?php the_excerpt(); ?>
					<p><a class="btn btn-default wa-btn-readmore" rel="" href="<?php echo esc_url( get_permalink($posts->ID) ); ?>" title="Green Construction"><?php _e( 'View Details', 'wa' ); ?></a></p>
				</div>
			</div>
		</div>
	</div>
</div>