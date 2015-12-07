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
<article id="post-<?php the_ID(); ?>" <?php post_class('zo-cause-full-width'); ?>>
    <?php
    $style = '';
    if( has_post_thumbnail() ) {
        $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
        $style = 'style="background-image: url(' . esc_url($large_image_url[0]) . ');"';
    }
    ?>
    <div class="zo-cause-inner" <?php echo do_shortcode($style); ?>>
        <div class="container">
            <div class="row">
                <div class="zo-cause-box col-md-6 col-lg-6 col-sm-12 col-xs-12">

                    <div class="zo-cause-info">

                        <<?php echo esc_attr($zo_title_size); ?> class="zo-cause-title"><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php the_title(); ?></a></<?php echo esc_attr($zo_title_size); ?>>

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

                    <div class="zo-cause-content">
                        <?php the_excerpt(); ?>
                    </div>

                    <p class="readmore"><a class="btn btn-default" title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php _e('Donate Now', THEMENAME); ?></a></p>
                </div>
            </div>
        </div>
    </div>
</article>
