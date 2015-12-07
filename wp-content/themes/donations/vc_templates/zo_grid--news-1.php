<?php 
    /* Get Categories */
        $taxo = 'category';
        $_category = array();
        if(!isset($atts['cat']) || $atts['cat']==''){
            $terms = get_terms($taxo);
            foreach ($terms as $cat){
                $_category[] = $cat->term_id;
            }
        } else {
            $_category  = explode(',', $atts['cat']);
        }
        $atts['categories'] = $_category;
?>
<div class="zo-grid-wraper <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">

    <div class="row zo-grid zo-grid-news <?php echo esc_attr($atts['grid_class']);?>">
        <?php
        $posts = $atts['posts'];
        $i = 0;
        while($posts->have_posts()){
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach(zoGetCategoriesByPostID(get_the_ID()) as $category){
                $groups[] = '"category-'.$category->slug.'"';
            }
            $class_first_item = 'zo-grid-item first col-md-12 col-lg-12 col-xs-12 col-sm-12';
        ?>
            <div class="<?php echo do_shortcode($i == 0 ? esc_attr($class_first_item) : esc_attr($atts['item_class']));?>">
                <?php
                $i == 0 ? get_template_part( 'single-templates/news/content', 'teaser') : get_template_part( 'single-templates/news/content', 'thumbnail');
                ?>
            </div>
            <?php
            $i++;
        }
        wp_reset_postdata();
        ?>
    </div>
</div>