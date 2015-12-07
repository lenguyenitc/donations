<div class="zo-progress-wraper zo-progress-layout-default <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <div class="zo-progress-body">
        <?php
            $item_class = 'zo-progress-item-wrap';
            $item_title     = $atts['item_title'];
            $icon           = $atts['icon'];
            $show_value     = $atts['show_value'];
            $value          = $atts['value'];
            $value_suffix   = $atts['value_suffix'];
            $bg_color       = $atts['bg_color'];
            $color          = $atts['color'];
            $width          = $atts['width'];
            $height         = $atts['height'];
            $border_radius  = $atts['border_radius'];
            $vertical       = ($atts['mode']=='vertical')?true:false;
            $striped        = ($atts['striped']=='yes')?true:false;
            $zo_progress_custom_icon = $atts['zo_progress_custom_icon'];
            $zo_progress_icon_color = $atts['zo_progress_icon_color'];
            $zo_progress_icon_font_size = $atts['zo_progress_icon_font_size'];
            $uqid = uniqid();
            ?>
            <div id = "zo-progress-<?php echo esc_attr($uqid); ?>" class="<?php echo esc_attr($item_class);?>">
                <style type="text/css">
                    #zo-progress-<?php echo esc_attr(uqid); ?> .zo-progress-main .zo-progress .progress-bar span:before {
                        border-color:<?php echo esc_attr($color);?> transparent transparent;
                    }
                </style>
                <div class="zo-progress-main <?php if( $zo_progress_custom_icon ) { echo 'bar-icon'; } ?> <?php if( $icon ) { echo 'bar-icon'; } ?>">
                    <?php if( $zo_progress_custom_icon ): ?>
                      <div class="zo-progress-icon"><i class="fa <?php echo esc_attr($zo_progress_custom_icon); ?>" style="color: <?php echo esc_attr($zo_progress_icon_color); ?>; font-size: <?php echo esc_attr($zo_progress_icon_font_size); ?>"></i></div>
                        <?php else: if( $icon ): ?>
                          <div class="zo-progress-icon"><i style="color: <?php echo esc_attr($zo_progress_icon_color); ?>; font-size: <?php echo esc_attr($zo_progress_icon_font_size); ?>" class="fa <?php echo esc_attr($icon); ?>"></i></div>
                      <?php endif; ?>
                    <?php endif; ?>
                    <div class="zo-progress progress<?php if($vertical){ echo ' vertical bottom'; } ?> <?php if($striped){echo ' progress-striped';}?>" 
                        style="background-color:<?php echo esc_attr($bg_color);?>;
                        width:<?php echo esc_attr($width);?>;
                        height:<?php echo esc_attr($height);?>;
                        border-radius:<?php echo esc_attr($border_radius);?>;
                        border-color: <?php echo esc_attr($color);?>;" >
                        <?php if($item_title):?>
                            <div class="zo-progress-title">
                                <?php echo apply_filters('the_title',$item_title);?>
                            </div>
                        <?php endif;?>
                        <div id="item-<?php echo esc_attr($atts['html_id']); ?>" 
                            class="progress-bar" role="progressbar" 
                            data-valuetransitiongoal="<?php echo esc_attr($value); ?>" 
                            style="background-color:<?php echo esc_attr($color);?>; line-height:<?php echo esc_attr($height);?>;"
                            >
                            <span style="background-color:<?php echo esc_attr($color);?>;">
                                <?php if($show_value): ?>
                                    <?php echo esc_attr($value_suffix);?>
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>
                </div>  
			</div>
    </div>
</div>