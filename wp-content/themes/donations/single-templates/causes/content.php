<?php
/**
 * The default template for displaying content
 *
 *
 * @package ZoTheme
 * @subpackage Zo Theme
 * @since 1.0.0
 */
?>
<?php
global $smof_data;
$post_meta = zo_post_meta_data();
$currency = apply_filters('tb_currency', TBDonationsPageSetting::$currency);
$tb_currency = get_option('tb_currency', 'USD');
$symbol_position = get_option('symbol_position', 0);
$symbol = $currency[$tb_currency]['symbol'];
$result = apply_filters('zo_getmetadonors', get_the_ID());
$goal = get_post_meta(get_the_ID(),'zodonations_goals',true);
$zodonations_location = get_post_meta(get_the_ID(), 'zodonations_location', true);
$zodonations_endday = get_post_meta(get_the_ID(), 'zodonations_endday', true);
$width = '50';
if($result['raised'] < $goal){
    $width = round($result['raised']*100/$goal, 2);
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('zo-cause-detail'); ?>>
    <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
        <div class="zo-cause-box">
            <?php if(has_post_thumbnail()) : ?>
            <div class="zo-cause-header">
                <div class="zo-cause-image">
                        <?php the_post_thumbnail( 'full' ); ?>
                </div>
                <div class="zo-cause-overlay">
                    <?php echo do_shortcode('[zodonations_form donation_id='.get_the_ID().' label_btn="Donate Now" ]'); ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="zo-cause-info">

                <div class="zo-cause-progress">
                    <div class="percent" style="width: <?php echo esc_attr($width);?>%;"></div>
                    <div class="number" style="left: <?php echo esc_attr($width);?>%;"><?php echo do_shortcode($width);?>%</div>
                </div>

                <ul class="zo-cause-meta">
                    <li class="raised">
                        <span><i class="fa fa-money"></i>
						<?php
						if($symbol_position != 1):
							printf(__('%s%s'), $symbol, number_format($result['raised']));
						else:
							printf(__('%s%s'), number_format($result['raised']), $symbol);					
						endif;
						?></span>
                        <label><?php _e('Raised', THEMENAME); ?></label>
                    </li>
                    <li class="donors">
                        <span><i class="fa fa-life-ring"></i> <?php printf('%s',$result['donors']);?></span>
                        <label><?php _e('Donors', THEMENAME); ?></label>
                    </li>
                    <li class="goal">
                        <span><i class="fa fa-heart-o"></i>
						<?php
						if($symbol_position != 1):
							printf(__('%s%s'), $symbol, number_format($goal));
						else:
							printf(__('%s%s'), number_format($goal), $symbol);					
						endif;
						?></span>
                        <label><?php _e('Goal', THEMENAME); ?></label>
                    </li>
                </ul>

            </div>
        </div>

        <ul class="zo-cause-meta-info">
            <li>
                <label><?php _e('Start', THEMENAME); ?></label>
                <span><?php echo mysql2date("h:i A - M d Y", $post_meta->_zo_donation_startdate); ?></span>
            </li>
            <li>
                <label><?php  _e('End', THEMENAME); ?></label>
                <span><?php echo mysql2date("h:i A - M d Y", $zodonations_endday); ?></span>
            </li>
            <li>
                <label><i class="fa fa-map-marker"></i></label>
                <span><?php echo do_shortcode($zodonations_location); ?></span>
            </li>
            <li>
                <label><i class="fa fa-phone"></i></label>
                <span><?php echo do_shortcode($post_meta->_zo_donation_phone); ?></span>
            </li>
            <li>
                <label><i class="fa fa-envelope"></i></label>
                <span><a href="mailto:<?php echo esc_attr($post_meta->_zo_donation_email); ?>"><?php echo do_shortcode($post_meta->_zo_donation_email); ?></a></span>
            </li>
        </ul>
        <?php if( $smof_data['google_calendar'] == 1 ) : ?>
            <div class="calendar">
                <div id="calendar-event"
                     data-start = "<?php echo esc_attr(mysql2date("c", $post_meta->_zo_donation_startdate)); ?>"
                     data-end = "<?php echo esc_attr(mysql2date("c", $zodonations_endday)); ?>"
                     data-location = "<?php echo esc_attr($zodonations_location); ?>"
                     data-phone = "<?php echo esc_attr($post_meta->_zo_donation_phone); ?>"
                     data-email = "<?php echo esc_attr($post_meta->_zo_donation_email); ?>"
                     data-title = "<?php echo get_the_title(); ?>"
                     data-summary = "<?php echo esc_attr(strip_tags(get_the_excerpt())) . "<br />" . get_the_permalink(); ?>">
                    <button id="btn-calendar-event" class="btn btn-default"><?php _e('Add To Calendar', THEMENAME); ?></button>
                </div>
            </div>
        <?php endif; ?>
        <div class="social-share">
            <h3><?php _e('Share this event', THEMENAME); ?></h3>
            <?php zo_social_share(); ?>
        </div>
    </div>

    <div class="col-md-8 col-lg-8 col-sm-6 col-xs-12">
        <h2 class="zo-cause-title"><?php the_title(); ?></h2>

        <div class="zo-cause-content">
            <?php the_content(); ?>
        </div>
    </div>
    <div class="clearfix"></div>
    <?php
    wp_link_pages( array(
        'before'      => '<div class="pagination loop-pagination"><span class="page-links-title">' . __( 'Pages:',THEMENAME) . '</span>',
        'after'       => '</div>',
        'link_before' => '<span class="page-numbers">',
        'link_after'  => '</span>',
    ) );
    ?>
</article>
