<?php global $product; ?>
<div class="wa-product-item col-md-<?php echo esc_attr($_col); ?> col-sm-12 col-xs-12">
	<div class="wa-product-item-inner">
		<div class="row">
			<div class="col-md-4">
				<div class="wa-product-item-thumb">
					<?php  
					$attachment_ids = $product->get_gallery_attachment_ids();

					$image_link = ( isset($attachment_ids[0]) )? wp_get_attachment_url( $attachment_ids[0] ) : "";
					echo ( !empty( $image_link ) )? "<img src='{$image_link}'>" : "";
					?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="wa-product-entry-title">
					<h2>
						<a class="wa-url" href="<?php echo esc_url( get_permalink($posts->ID) ); ?>"><?php the_title(); ?></a>
					</h2>
				</div>
				<ul class="wa-product-auction-info">
					<li>
						<span class="wa-info-field">
							<i class="ion-ribbon-b"></i> <?php _e( 'Bids', 'wa' ); ?>
						</span> 
						<span class="wa-info-field-content">
							0
						</span>
					</li>
					<li>
						<span class="wa-info-field">
							<i class="ion-social-usd"></i> <?php _e( 'Current Bid', 'wa' ); ?>
						</span> 
						<span class="wa-info-field-content"><?php echo WA_Helper::currency( $meta_fields['_wa_reserve_price'][0] ); ?></span>
					</li>
					<li>
						<span class="wa-info-field">
							<i class="ion-clock"></i> <?php _e( 'Time Remaining', 'wa' ); ?>
						</span>
						<span class="countdown wa-info-field-content" data-datatime="<?php echo "{$dates['end']}"; ?>" data-format="%-w week%!w %-d day%!d %H:%M:%S">
						  	<span class="clock"></span>
						</span>
					</li>
				</ul>
			</div>
			<div class="col-md-4">
				<div class="wa-product-entry-content">
					<?php the_content(); ?>
					<a class="btn btn-default btn-wa-readmore" rel="" href="<?php echo esc_url( get_permalink($posts->ID) ); ?>" title="Green Construction"><?php _e( 'View Details', 'wa' ); ?></a>
				</div>
			</div>
		</div>
	</div>
</div>