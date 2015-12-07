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
$zo_title_size = isset( $atts['zo_title_size'] ) ? $atts['zo_title_size'] : 'h2';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('event-grid'); ?>>
    <?php if(has_post_thumbnail()) : ?>
    <div class="zo-event-image col-md-4 col-lg-4 col-sm-6 col-xs-12">
        <?php the_post_thumbnail( 'medium' ); ?>
    </div>
    <?php endif; ?>

    <?php if(has_post_thumbnail()) : ?>
    <div class="zo-event-info col-md-4 col-lg-4 col-sm-6 col-xs-12">
    <?php else : ?>
    <div class="zo-event-info col-md-8 col-lg-8 col-sm-12 col-xs-12">
    <?php endif; ?>
        <ul class="zo-event-date">
            <li><i class="fa fa-calendar"></i> <span><?php echo mysql2date("d M Y", $post_meta->_zo_event_startdate); ?></span></li>
            <li><i class="fa fa-clock-o"></i> <span><?php echo mysql2date("h:iA", $post_meta->_zo_event_startdate); ?></span></li>
        </ul>
        <<?php echo esc_attr($zo_title_size); ?> class="zo-event-title"><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php the_title(); ?></a></<?php echo esc_attr($zo_title_size); ?>>
        <div class="zo-event-location">
            <i class="fa fa-map-marker"></i> <span><?php echo esc_attr($post_meta->_zo_event_location); ?></span>
        </div>
    </div>
    <div class="zo-event-detail col-md-4 col-lg-4 col-sm-12 col-xs-12">
        <div class="zo-event-content">
            <?php the_excerpt(); ?>
        </div>
        <a class="readmore btn btn-default" title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php _e('Read More', THEMENAME) ?></a>
    </div>
</article>
