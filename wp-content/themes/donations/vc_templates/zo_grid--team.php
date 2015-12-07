<?php 
    /* Get Categories */
        $taxo = 'team-category';
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
<div class="zo-grid-wraper zo-team-layout1 <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <?php if( isset($atts['filter']) && $atts['filter'] == 1 && $atts['layout']=='masonry'):?>
        <div class="zo-grid-filter">
            <ul>
                <li><a class="active" href="#" data-group="all">All</a></li>
                <?php foreach($atts['categories'] as $category):?>
                    <?php $term = get_term( $category, 'category' );?>
                    <li><a href="#" data-group="<?php echo esc_attr('category-'.$term->slug);?>">
                            <?php echo __($term->name, THEMENAME);?>
                        </a>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    <?php endif;?>
    <div class="row zo-grid <?php echo esc_attr($atts['grid_class']);?>">
        <?php
        $posts = $atts['posts'];
        while($posts->have_posts()){
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach(zoGetCategoriesByPostID(get_the_ID()) as $category){
                $groups[] = '"category-'.$category->slug.'"';
            }
            $team_meta = zo_post_meta_data();
            $zo_title_size = isset( $atts['zo_title_size'] ) ? $atts['zo_title_size'] : 'h2';
            ?>
            <div class="zo-team-wrap <?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]'>
                <div class="zo-team-header">
                    <div class="zo-team-image">
                        <?php echo the_post_thumbnail('full'); ?>
                        <div class="overlay">
                            <ul class="social">
                                <?php if(!empty($team_meta->_zo_team_facebook)) : ?>
                                    <li><a href="<?php echo esc_attr($team_meta->_zo_team_facebook); ?>"><i class="fa fa-facebook"></i></a></li>
                                <?php endif; ?>
                                <?php if(!empty($team_meta->_zo_team_twitter)) : ?>
                                    <li><a href="<?php echo esc_attr($team_meta->_zo_team_twitter); ?>"><i class="fa fa-twitter"></i></a></li>
                                <?php endif; ?>
                                <?php if(!empty($team_meta->_zo_team_linkedin)) : ?>
                                    <li><a href="<?php echo esc_attr($team_meta->_zo_team_linkedin); ?>"><i class="fa fa-linkedin"></i></a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="zo-team-detail">
                    <<?php echo esc_attr($zo_title_size); ?> class="zo-team-name">
                        <?php the_title();?>
                    </<?php echo esc_attr($zo_title_size); ?>>

                    <?php if(!empty($team_meta->_zo_team_position)) : ?>
                        <div class="zo-team-position"><?php echo esc_attr($team_meta->_zo_team_position); ?></div>
                    <?php endif; ?>

                </div>

            </div>
            <?php
        }
        wp_reset_postdata();
        ?>
    </div>
</div>