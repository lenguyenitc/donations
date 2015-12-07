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
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('news-thumbnail'); ?>>
    <?php if(has_post_thumbnail()) : ?>
    <div class="zo-news-header col-md-4 col-lg-4 col-sm-4 col-xs-3">
        <div class="zo-news-image">
            <?php the_post_thumbnail( 'medium' ); ?>
        </div>
        <div class="zo-news-overlay">
            <a class="btn-readmore" title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><i class="fa fa-plus-circle"></i></a>
        </div>
    </div>
    <?php endif ?>
    <?php if(has_post_thumbnail()) : ?>
    <div class="zo-news-detail col-md-8 col-lg-8 col-sm-8 col-xs-9">
    <?php else : ?>
    <div class="zo-news-detail col-md-12 col-lg-12 col-sm-12 col-xs-12">
    <?php endif; ?>
        <ul class="zo-news-meta">
            <li class="date"><i class="fa fa-calendar"></i> <span><?php echo get_the_date("d M Y"); ?></span></li>
            <li class="tag"><?php the_terms( get_the_ID(), 'category', '<i class="fa fa-folder-o"></i>', ', ' ); ?></li>
        </ul>
        <<?php echo esc_attr($zo_title_size); ?> class="zo-news-title"><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php the_title(); ?></a></<?php echo esc_attr($zo_title_size); ?>>
        <div class="zo-news-content">
            <?php echo trim(substr(get_the_excerpt(), 0, 130)); ?>
        </div>
    </div>
</article>
