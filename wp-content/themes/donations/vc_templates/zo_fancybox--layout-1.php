<?php 
  $uqid = uniqid();
  $class_link = 'zo-fancyboxes-'.$uqid;
?>
<div class="<?php echo esc_attr($class_link); ?> zo-fancyboxes-wraper zo-fancybox-layout-1 <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <?php if($atts['title']!=''):?>
        <div class="zo-fancyboxes-head">
            <div class="zo-fancyboxes-title">
                <?php echo apply_filters('the_title',$atts['title']);?>
            </div>
            <div class="zo-fancyboxes-description">
                <?php echo apply_filters('the_content',$atts['description']);?>
            </div>
        </div>
    <?php endif;?>
    <div class="zo-fancyboxes-body">
        <?php
            $columns = ((int)$atts['zo_cols'])?(int)$atts['zo_cols']:1;
            $class_bootstrap = "";
            switch($columns){
              case "1 Column":
               $class_bootstrap = "";
               break;
              case "2 Columns":
               $class_bootstrap = "col-xs-12 col-sm-6 col-md-4 col-lg-6";
               break;
              case "3 Columns":
               $class_bootstrap = "col-xs-12 col-sm-6 col-md-4 col-lg-4";
               break;
              case "4 Columns":
               $class_bootstrap = "col-xs-12 col-sm-6 col-md-4 col-lg-3";
               break;
              case "6 Columns":
               $class_bootstrap = "col-xs-12 col-sm-6 col-md-4 col-lg-2";
               break;

              default:
               $class_bootstrap = "";
               break;
             }
            $item_class = 'zo-fancy-box-item '.($class_bootstrap);
            for($i=1;$i<=$columns;$i++){ ?>
                <?php if($i!=5):?>
                <?php
                $icon = isset($atts['icon'.$i])?$atts['icon'.$i]:'';
                $content = isset($atts['description'.$i])?$atts['description'.$i]:'';
                $image = isset($atts['image'.$i])?$atts['image'.$i]:'';
                $title = isset($atts['title'.$i])?$atts['title'.$i]:'';
                $button_link = isset($atts['button_link'.$i])?$atts['button_link'.$i]:'';
                $image_url = '';
                if (!empty($image)) {
                    $attachment_image = wp_get_attachment_image_src($image, 'full');
                    $image_url = $attachment_image[0];
                }
                $zo_title_size = isset( $atts['zo_title_size'] ) ? $atts['zo_title_size'] : 'h2';
                $class_size = isset( $atts['class_size'] ) ? $atts['class_size'] : '';
                $months_old = isset( $atts['months_old'] ) ? $atts['months_old'] : '';
                $zo_fancybox_bg_content_color = isset( $atts['zo_fancybox_bg_content_color'] ) ? $atts['zo_fancybox_bg_content_color'] : '';
                $text_more_info = isset( $atts['text_more_info'] ) ? $atts['text_more_info'] : '';
                $text_more_info_color = isset( $atts['text_more_info_color'] ) ? $atts['text_more_info_color'] : '';
                $text_more_info_color_hover = isset( $atts['text_more_info_color_hover'] ) ? $atts['text_more_info_color_hover'] : '';
                $button_more_info = isset( $atts['button_more_info'] ) ? $atts['button_more_info'] : '';
                $button_more_info_border_color = isset( $atts['button_more_info_border_color'] ) ? $atts['button_more_info_border_color'] : '';
                $button_more_info_border_color_hover = isset( $atts['button_more_info_border_color_hover'] ) ? $atts['button_more_info_border_color_hover'] : '';
                $button_more_info_bg_color = isset( $atts['button_more_info_bg_color'] ) ? $atts['button_more_info_bg_color'] : '';
                $button_more_info_bg_color_hover = isset( $atts['button_more_info_bg_color_hover'] ) ? $atts['button_more_info_bg_color_hover'] : '';
                
                ?>
                    <div class="<?php echo esc_attr($item_class);?>">
                        <div class="zo-fancy-box-wrapper clearfix" style="background-color: <?php echo esc_attr($zo_fancybox_bg_content_color); ?>">
                            <?php if($image_url):?>
                            <div class="zo-fancy-box-image w50">
                                <img src="<?php echo esc_attr($image_url);?>" alt="" />
                                <div class="zo-fancy-box-meta">
                                    <span class="months-old"><?php echo esc_attr($months_old); ?><br /><?php _e('Months Old',THEMNAME); ?></span>
                                    <span class="class-size"><?php echo esc_attr($class_size); ?><br /><?php _e('Class Size',THEMNAME); ?></span>
                                </div>
                            </div>
                            <?php endif;?>
                            <div class="zo-fancy-box-main w50">
                                <?php if($title):?>
                                <div class="zo-fancy-box-title">
                                    <<?php echo esc_attr($zo_title_size); ?> class="zo-fancy-box-title">
                                        <?php echo apply_filters('the_title',$title);?>
                                    </<?php echo esc_attr($zo_title_size); ?>>
                                </div>    
                                <?php endif;?>
                                <div class="zo-fancy-box-content">
                                    <?php echo apply_filters('the_content',$content);?>
                                </div>
                                <?php if($atts['button_text']!=''):?>
                                    <div class="zo-fancy-box-readmore">
                                        <?php
                                        $class_btn = ($atts['button_type']=='button')?'btn btn-default btn-white':'';
                                        $text_button_color = '';
                                        $text_button_color_hover = '';
                                        $btn_border_color = '';
                                        $btn_bg_color = '';
                                        $btn_border_color_hover = '';
                                        $btn_bg_color_hover = '';
                                        if (($atts['button_type']=='text') && $text_more_info == 'yes') {
                                          $text_button_color = $text_more_info_color; 
                                          $text_button_color_hover = $text_more_info_color_hover; 
                                        }
                                        if (($atts['button_type']=='button') && $button_more_info == 'yes') {
                                          $btn_border_color = $button_more_info_border_color;
                                          $btn_bg_color = $button_more_info_bg_color;
                                          $btn_border_color_hover = $button_more_info_border_color_hover;
                                          $btn_bg_color_hover = $button_more_info_bg_color_hover;
                                        }
                                        ?>
                                        <a style="background-color: <?php echo esc_attr($btn_bg_color); ?>; border-color: <?php echo esc_attr($btn_border_color); ?>; color: <?php echo esc_attr($text_button_color); ?>" href="<?php echo esc_url($button_link);?>" class="<?php echo esc_attr($class_btn);?>"><?php echo esc_attr($atts['button_text']);?></a>
                                    </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
            <?php }
        ?>
    </div>
</div>
<style type="text/css">
  .<?php echo esc_attr($class_link); ?>.zo-fancybox-layout-1 .zo-fancy-box-readmore a:hover {
    color: <?php echo esc_attr($text_button_color_hover); ?> !important;
    border-color: <?php echo esc_attr($btn_border_color_hover); ?> !important;
    background-color: <?php echo esc_attr($btn_bg_color_hover); ?> !important;
  }
</style>