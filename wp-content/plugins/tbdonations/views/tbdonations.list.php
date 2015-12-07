<?php
$currency = apply_filters('tb_currency', TBDonationsPageSetting::$currency);
$tb_currency = get_option('tb_currency', 'USD');
$symbol_position = get_option('symbol_position', 0);
$symbol = $currency[$tb_currency]['symbol'];
?>
<?php if ( $wp_query->have_posts() ): ?>
<div class="tbdonations_wrap list <?php echo $el_class;?>">
	<?php while ($wp_query->have_posts()) : $wp_query->the_post();
		$result = apply_filters('tb_getmetadonors', get_the_ID());
		$goal = get_post_meta(get_the_ID(),'tbdonations_goals',true);
        $tbdonations_location = get_post_meta(get_the_ID(), 'tbdonations_location', true);
		$width = '100';
		if($result['raised'] < $goal){
			$width = $result['raised']*100/$goal;
		}
	?>
    <div id="post-<?php the_ID(); ?>" <?php post_class('row'); ?>>
		<?php if (has_post_thumbnail()) { ?>
			<div class="donation-thumbnail col-md-3 text-center">
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
		<div class="donation-content col-md-9">
			<h2>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>
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
			<div class="blog-info col-md-12">
				<div class="donation-stat col-md-8">
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
					<?php printf(__('Donors %s'),$result['donors']);?>
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
				<div class="info-right col-md-4 text-right">
					<ul class="share-link">
						<li><a class="fafa-facebook" href="<?php echo esc_url('https://www.facebook.com/sharer/sharer.php?u='.get_the_permalink()); ?>"><i class="fa fa-facebook"></i></a></li>
						<li><a class="fafa-twitter" href="<?php echo esc_url('https://twitter.com/home?status='.get_the_permalink()); ?>"><i class="fa fa-twitter"></i></a></li>
						<li><a class="fafa-google"href="<?php echo esc_url('https://plus.google.com/share?url='.get_the_permalink()); ?>"><i class="fa fa-google"></i></a></li>
					</ul>
				</div>
			</div>
			<p><?php echo wp_trim_words( get_the_content(), $trim_words, '' );?></p>
		</div>
    </div>
<?php
	endwhile;
	wp_reset_query();
else: 
		echo 'No Result!';
endif;
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