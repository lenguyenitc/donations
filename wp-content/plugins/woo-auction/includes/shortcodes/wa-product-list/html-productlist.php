<?php 
global $product, $post, $Woo_Auction;
$current_price = $Woo_Auction->get_max_bid_price_by_productid( $post->ID );
?>
<div class="wa-product-item wa-product-item-style col-md-<?php echo esc_attr($_col); ?> col-sm-12 col-xs-12 <?php echo esc_attr( implode( ' ', $_extra_class ) ); ?>">
	<div class="wa-product-item-inner">
		<div class="row">
			<div class="col-md-6">
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
			<div class="col-md-6">
				<div class="wa-product-entry-title">
					<a class="wa-url" href="<?php echo esc_url( get_permalink($posts->ID) ); ?>">
						<h2 class="text-center"><?php the_title(); ?></h2>
					</a>
				</div>
                <ul class="wa-product-auction-info">
					<li class="wa-countdown-content">
						<span class="countdown wa-countdown-inner" data-extradata="<?php echo esc_attr( json_encode( $_extra_data ) ); ?>" data-datatime="<?php echo "{$date_countdown}"; ?>" data-format="%-w week%!w %-d day%!d %H:%M:%S">
						  	<span class="clock"></span>
						</span>
					</li>
					<li class="wa-info-price-content">
						<div class="wa-bids-content">
							<div><?php _e( 'Bids', 'wa' ); ?></div>
							<span class="wa-info-field-content">
								<?php echo $Woo_Auction->count_bid_by_productid( $post->ID ); ?>
							</span>
						</div>
						<div class="wa-current-bids-content">
							<div><?php _e( 'Current price', 'wa' ); ?></div>
							<span class="wa-info-field-content">
								<?php 
								echo ( empty($current_price) ) ? WA_Helper::currency( $meta_fields['_wa_start_price'][0] ) : WA_Helper::currency( $current_price ); 
								?>
							</span>
						</div>
						<div class="wa-buy-bow-content">
							<div><?php _e( 'Buy now price', 'wa' ); ?></div>
							<span class="wa-info-field-content"><?php echo WA_Helper::currency( $meta_fields['_wa_buy_it_now_price'][0] ); ?></span>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>