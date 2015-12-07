<?php
$currency = apply_filters('tb_currency', TBDonationsPageSetting::$currency);
$tb_currency = get_option('tb_currency', 'USD');
$symbol_position = get_option('symbol_position', 0);
$symbol = $currency[$tb_currency]['symbol'];
?>
<?php if ( $wp_query->have_posts() ): ?>
<div class="tbdonations_wrap grid <?php echo $el_class;?>">
	<div class="row">
		<?php while ($wp_query->have_posts()) : $wp_query->the_post();
			$result = apply_filters('tb_getmetadonors', get_the_ID());
			$goal = get_post_meta(get_the_ID(),'tbdonations_goals',true);
			$tbdonations_location = get_post_meta(get_the_ID(), 'tbdonations_location', true);
			$post_class = $col_xs . ' ' . $col_sm . ' ' . $col_md . ' '.  $col_lg;
			$width = '100';
			if($result['raised'] < $goal){
				$width = $result['raised']*100/$goal;
			}
		?>
		<div id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
			<?php if (has_post_thumbnail()) { ?>
				<div class="donation-thumbnail">
					<a href="<?php echo esc_url(the_permalink())?>">
					<?php
					$attachment_full_image = '';
					$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
					$attachment_full_image = $attachment_image[0];
					if ($crop_image == 1) {
						$image_resize = matthewruddy_image_resize($attachment_image[0], $width_image, $height_image, true, false);
						echo '<img class="cropped" src="' . esc_attr($image_resize['url']) . '" alt="">';
					} else {
						echo get_the_post_thumbnail(get_the_ID());
					}
					?>
					</a>
				</div>
			<?php } ?>
			<div class="donation-content">
				<h3>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
				<div class="donation-meta">
					<span><i class="fa fa-calendar"></i> 
						<?php echo get_the_date('Y-m-d H:i', get_the_ID()); ?>
					</span>					
					<?php if($tbdonations_location): ?>
					<span>
						<i class="fa fa-map-marker"></i> 
						<?php echo $tbdonations_location;?> 
					</span>
					<?php endif; ?>
				</div>
				<div class="progress_bar">
					<span style="width: <?php echo $width;?>%;"></span>
				</div>
				<div class="blog-info">
					<div class="donation-stat">
						<span>
						<i class="fa fa-child"></i>
						<?php
						if($symbol_position != 1):
							printf(__('Raised %s%s'), $symbol, number_format($result['raised']));
						else:
							printf(__('Raised %s%s'), number_format($result['raised']), $symbol);					
						endif;
						?>
						</span>
						<span>
						<i class="fa fa-users"></i>
						<?php printf(__('Donors<br>%s'),$result['donors']);?>
						</span>
						<span>
						<i class="fa fa-thumbs-up"></i>
						<?php
						if($symbol_position != 1):
							printf(__('Goal %s%s'), $symbol, number_format($goal));
						else:
							printf(__('Goal %s%s'), number_format($goal), $symbol);					
						endif;
						?>
						</span>
					</div>  
				</div>
				<div class="donate_now">
					<a class="wpb_button  wpb_wpb_button wpb_regularsize" href="<?php the_permalink(); ?>"><?php _e('Read More', 'tbdonations'); ?></a>
				</div> 
			</div>
		</div>
<?php
	endwhile;
	wp_reset_query();
else: 
		echo 'No Result!';
endif; ?>
	</div>
	<div class="clear"></div> 
<?php
if($show_pagination): ?>
	<div class="pagination">
		<?php
		$big = 999999999; // need an unlikely integer

		echo paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages,
				'prev_text' => __( '<i class="fa fa-angle-left"></i>', THEMENAME ),
				'next_text' => __( '<i class="fa fa-angle-right"></i>', THEMENAME ),
		) );
		?>
	</div>
</div>
<?php endif; ?>