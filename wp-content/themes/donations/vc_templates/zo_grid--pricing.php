<?php
/* get categories */
$taxo = 'categories-pricing';

$_category = array();
if(!isset($atts['cat']) || $atts['cat']==''){
    $terms = get_terms($taxo);

    foreach ($terms as $cat){
        if(isset($cat->term_id))
            $_category[] = $cat->term_id;
    }
} else {
    $_category  = explode(',', $atts['cat']);
}
$atts['categories'] = $_category;

?>

<div class="zo-grid-wraper zo-grid-pricing zo-grid-pricing-layout-1 <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <div class="zo-grid <?php echo esc_attr($atts['grid_class']);?> zo-gird-pricing-item-wrap">
        <?php
        $posts = $atts['posts'];
        while($posts->have_posts()) {
            $posts->the_post();
            $zo_title_size = isset( $atts['zo_title_size'] ) ? $atts['zo_title_size'] : 'h2';
            $pricing_meta = zo_post_meta_data();
            if( strpos($pricing_meta->_zo_price, '.') !== false )
                $price = explode('.', esc_attr($pricing_meta->_zo_price));
            ?>
            <div class="zo-grid-item-pricing <?php echo esc_attr($atts['item_class']);?> <?php echo ( $pricing_meta->_zo_is_feature == 1 ) ? ' pricing-feature-item' : 'pricing-item' ?> ">
                <div class="zo-grid-item-pricing-inner">
                    <div class="zo-grid-pricing-wrap">
                        <?php if ( $pricing_meta->_zo_is_feature == 1 ) : ?>
                            <div class="zo-grid-pricing-best"><span><?php _e('BEST',THEMENAME); ?></span></div>
                        <?php endif ?>
                        <<?php echo esc_attr($zo_title_size); ?>>
                            <?php the_title();?>
                        </<?php echo esc_attr($zo_title_size); ?>>
                        <div class="zo-price-wrap">
                            <?php if(isset($price)) : ?>
                            <span class="price"><sup>$</sup><?php echo esc_attr($price[0]); ?></span>
                            <?php else : ?>
                            <span class="price"><sup>$</sup>><?php echo esc_attr($pricing_meta->_zo_price); ?></span>
                            <?php endif; ?>
                            <div class="sub-price">
                                <?php if(isset($price)) : ?>
                                    <span><?php echo '.' . esc_attr($price[1]) ?></span>
                                <?php endif; ?>
                                <span class="time"><?php echo '/'. esc_attr($pricing_meta->_zo_value) ?></span>
                            </div>
                        </div>
                        <?php echo ( isset($pricing_meta->_zo_sub_title) && !empty($pricing_meta->_zo_sub_title) ) ? '<div class="zo-pricing-subtitle"><span>'. esc_attr($pricing_meta->_zo_sub_title) .'</span></div>' : ''; ?>
                    </div>

                    <div class="zo-price-meta-wrap">
                        <?php
                        for ($i=1; $i <= 10 ; $i++) {
                            $pricing_option = $pricing_meta->{"_zo_option".$i};
                            if ( !empty( $pricing_option ) ) echo '<div class="option-item">'. esc_attr($pricing_option) .'</div>';
                        }
                        ?>
                    </div>

                    <div class="zo-pricing-button text-center">
                        <?php
                        echo '<a class="btn btn-pricing" href=" '. esc_url($pricing_meta->_zo_button_url) .' ">'. esc_attr($pricing_meta->_zo_button_text) .'</a>';
                        ?>
                    </div>
                </div>
            </div>
        <?php
        }
    wp_reset_postdata();
    ?>
</div>
</div>