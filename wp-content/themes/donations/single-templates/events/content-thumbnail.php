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
<article id="post-<?php the_ID(); ?>" <?php post_class('event-thumbnail'); ?>>
    <div class="zo-event-header">
        <?php if(has_post_thumbnail()) : ?>
        <div class="zo-event-image">
            <a title="<?php the_title(); ?>" href="<?php the_permalink() ?>">
                <?php the_post_thumbnail( 'medium' ); ?>
            </a>
        </div>
        <?php endif ?>
        <div class="zo-event-info">
            <ul class="zo-event-date">
                <li><i class="fa fa-calendar"></i> <span><?php echo mysql2date("d M Y", $post_meta->_zo_event_startdate); ?></span></li>
                <li><i class="fa fa-clock-o"></i> <span><?php echo mysql2date("h:iA", $post_meta->_zo_event_startdate); ?></span></li>
            </ul>
            <<?php echo esc_attr($zo_title_size); ?> class="zo-event-title"><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php the_title(); ?></a></<?php echo esc_attr($zo_title_size); ?>>

            <div class="zo-event-location">
                <i class="fa fa-map-marker"></i> <span><?php echo esc_attr($post_meta->_zo_event_location); ?></span>
            </div>

        </div>
    </div>
</article>
