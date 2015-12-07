<?php
/* Get Categories */
$taxo = 'category';
$_category = array();
if (!isset($atts['cat']) || $atts['cat'] == '') {
    $terms = get_terms($taxo);
    foreach ($terms as $cat) {
        $_category[] = $cat->term_id;
    }
} else {
    $_category = explode(',', $atts['cat']);
}
$atts['categories'] = $_category;
?>
<div class="zo-grid-wrapper zo-event-wrapper <?php echo esc_attr($atts['template']); ?>" id="<?php echo esc_attr($atts['html_id']); ?>">
    <?php if( isset($atts['filter']) && $atts['filter'] == 1 && $atts['layout']=='masonry'):?>

        <div class="zo-grid-filter">
            <ul>
                <li><a class="active" href="#" data-group="all">All</a></li>
                <?php foreach ($atts['categories'] as $category): ?>
                    <?php $term = get_term($category, 'category'); ?>
                    <li><a href="#" data-group="<?php echo esc_attr('category-' . $term->slug); ?>">
                            <?php echo __($term->name, THEMENAME); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <div class="row zo-grid zo-grid-event <?php echo esc_attr($atts['grid_class']); ?>">
        <?php
        $posts = $atts['posts'];
        while ($posts->have_posts()) :
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach (zoGetCategoriesByPostID(get_the_ID()) as $category) {
                $groups[] = '"category-' . $category->slug . '"';
            }
            $zo_title_size = isset($atts['zo_title_size']) ? $atts['zo_title_size'] : 'h2';
            ?>
            <div class="<?php echo esc_attr($atts['item_class']);?>"
                 data-groups='[<?php echo implode(',', $groups);?>]'>
                <?php get_template_part('single-templates/events/content', 'icon') ?>
            </div>
        <?php
        endwhile;
        wp_reset_postdata();
        ?>
    </div>
</div>