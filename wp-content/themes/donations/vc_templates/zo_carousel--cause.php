<div class="zo-carousel zo-cause-layout1 <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <?php
    $posts = $atts['posts'];
    while ($posts->have_posts()) :
        $posts->the_post();
        $zo_title_size = isset($atts['zo_title_size']) ? $atts['zo_title_size'] : 'h2';
        ?>
        <div class="zo-carousel-item">
            <?php get_template_part('single-templates/causes/content','teaser') ?>
        </div>
    <?php
    endwhile;
    wp_reset_postdata();
    ?>
</div>
