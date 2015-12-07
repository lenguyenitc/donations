<div class="zo-grid-wraper <?php echo esc_attr($atts['template']); ?>"
     id="<?php echo esc_attr($atts['html_id']); ?>">

    <div class="row zo-grid zo-grid-news <?php echo esc_attr($atts['grid_class']); ?>">
        <?php
        $posts = $atts['posts'];
        ?>
        <div class="zo-grid-group first col-md-6 col-lg-6 col-sm-6 col-xs-12">
            <?php
            $i = 0;
            while ($posts->have_posts()) {
                $posts->the_post();
                $class_first_item = 'zo-grid-item first clearfix';
                if ($i == 0) :
                    ?>
                    <div class="<?php echo esc_attr($class_first_item); ?>">
                        <?php get_template_part('single-templates/news/content', 'teaser') ?>
                    </div>
                <?php
                endif;
                $i++;
            }
            ?>
        </div>
        <div class="zo-grid-group second col-md-6 col-lg-6 col-sm-6 col-xs-12">
            <div class="row">
            <?php
            $i = 0;
            while ($posts->have_posts()) {
                $posts->the_post();
                if ($i != 0) :
                    ?>
                    <div class="<?php echo esc_attr($atts['item_class']); ?>">
                        <?php get_template_part('single-templates/news/content', 'thumbnail') ?>
                    </div>
                <?php
                endif;
                $i++;
            }
            wp_reset_postdata();
            ?>
            </div>
        </div>
    </div>
</div>