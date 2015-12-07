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
$zo_title_size = isset( $atts['zo_title_size'] ) ? $atts['zo_title_size'] : 'h2';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('news-list'); ?>>
    <div class="zo-news-header col-md-4 col-lg-4 col-sm-4 col-xs-12">
        <div class="zo-news-image zo-news-video"><?php zo_archive_video(); ?></div>
    </div>

    <div class="zo-news-detail col-md-8 col-lg-8 col-sm-8 col-xs-12">
        <ul class="zo-news-meta">
            <li class="date"><i class="fa fa-calendar"></i> <span><?php echo get_the_date("d M Y"); ?></span></li>
            <li class="tag"><?php the_terms( get_the_ID(), 'category', '<i class="fa fa-folder-o"></i>', ', ' ); ?></li>
        </ul>

        <<?php echo esc_attr($zo_title_size); ?> class="zo-news-title"><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php the_title(); ?></a></<?php echo esc_attr($zo_title_size); ?>>
        <div class="zo-news-content">
            <?php the_excerpt(); ?>
        </div>
        <a class="zo-news-readmoregi" title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php _e('Read More ', THEMENAME) ?> <i class="fa fa-angle-double-right"></i></a>
    </div>
</article>
