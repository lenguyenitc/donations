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
$zo_title_size = isset( $atts['zo_title_size'] ) ? $atts['zo_title_size'] : 'h2';

$currency = apply_filters('tb_currency', TBDonationsPageSetting::$currency);
$tb_currency = get_option('tb_currency', 'USD');
$symbol_position = get_option('symbol_position', 0);
$symbol = $currency[$tb_currency]['symbol'];

$post_meta = zo_post_meta_data();
$result = apply_filters('tb_getmetadonors', get_the_ID());
$goal = get_post_meta(get_the_ID(),'tbdonations_goals',true);
$zodonations_location = get_post_meta(get_the_ID(), 'tbdonations_location', true);
$zodonations_endday = get_post_meta(get_the_ID(), 'tbdonations_endday', true);
$width = '50';
if($result['raised'] < $goal){
    $width = round($result['raised']*100/$goal, 2);
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('zo-cause-list'); ?>>
    <div class="row">

        <div class="zo-cause-box col-md-5 col-lg-5 col-sm-12 col-xs-12">
            <?php if(has_post_thumbnail()) : ?>
            <div class="zo-cause-header">
                <div class="zo-cause-image">
                    <?php the_post_thumbnail( 'medium' ); ?>
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

        <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12">

            <<?php echo do_shortcode($zo_title_size); ?> class="zo-cause-title"><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php the_title(); ?></a></<?php echo do_shortcode($zo_title_size); ?>>

            <ul class="zo-cause-meta-info">
                <li class="location">
                    <label><i class="fa fa-map-marker"></i></label>
                    <span><?php echo do_shortcode($zodonations_location); ?></span>
                </li>

                <li class="start">
                    <label><?php _e('Start', THEMENAME); ?></label>
                    <span><?php echo mysql2date("h:i A - M d Y", $post_meta->_zo_donation_startdate); ?></span>
                </li>
                <li class="end">
                    <label><?php  _e('End', THEMENAME); ?></label>
                    <span><?php echo mysql2date("h:i A - M d Y", $zodonations_endday); ?></span>
                </li>

            </ul>

            <div class="zo-cause-content">
                <?php the_excerpt(); ?>
            </div>

            <p class="readmore"><a class="btn btn-default" title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php _e('Donate Now', THEMENAME); ?></a></p>

        </div>
    </div>
</article>
