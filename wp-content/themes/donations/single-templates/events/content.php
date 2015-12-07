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
<article id="post-<?php the_ID(); ?>" <?php post_class('event-detail'); ?>>
    <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
        <?php if(has_post_thumbnail()) : ?>
        <div class="zo-event-image ">
                <?php the_post_thumbnail( 'full' ); ?>
        </div>
        <?php endif; ?>

        <ul class="zo-event-meta">
            <li>
                <label><?php _e('Start', THEMENAME); ?></label>
                <span><?php echo mysql2date("h:i A - M d Y", $post_meta->_zo_event_startdate); ?></span>
            </li>
            <li>
                <label><?php  _e('End', THEMENAME); ?></label>
                <span><?php echo mysql2date("h:i A - M d Y", $post_meta->_zo_event_enddate); ?></span>
            </li>
            <li>
                <label><i class="fa fa-map-marker"></i></label>
                <span><?php echo esc_attr($post_meta->_zo_event_location); ?></span>
            </li>
            <li>
                <label><i class="fa fa-phone"></i></label>
                <span><?php echo esc_attr($post_meta->_zo_event_phone); ?></span>
            </li>
            <li>
                <label><i class="fa fa-envelope"></i></label>
                <span><?php echo esc_attr($post_meta->_zo_event_email); ?></span>
            </li>
        </ul>

        <?php if( $smof_data['google_calendar'] == 1 ) : ?>
            <div class="calendar">
                <div id="calendar-event"
                     data-start = "<?php echo mysql2date("c", $post_meta->_zo_event_startdate); ?>"
                     data-end = "<?php echo mysql2date("c", $post_meta->_zo_event_enddate); ?>"
                     data-location = "<?php echo esc_attr($post_meta->_zo_event_location); ?>"
                     data-phone = "<?php echo esc_attr($post_meta->_zo_event_phone); ?>"
                     data-email = "<?php echo esc_attr($post_meta->_zo_event_email); ?>"
                     data-title = "<?php the_title(); ?>"
                     data-summary = "<?php echo esc_attr(strip_tags(get_the_excerpt())) . get_the_permalink(); ?>">
                    <button id="btn-calendar-event" class="btn btn-default"><?php _e('Add To Calendar', THEMENAME); ?></button>
                </div>
            </div>
        <?php endif; ?>

        <div class="social-share">
            <h3><?php _e('Share this event', THEMENAME); ?></h3>
            <?php zo_social_share(); ?>
        </div>
    </div>

    <div class="zo-event-detail col-md-8 col-lg-8 col-sm-6 col-xs-12">
        <h2 class="zo-event-title"><?php the_title(); ?></h2>

        <div class="zo-event-content">
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
