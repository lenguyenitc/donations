<?php 
	$icon_name = "icon_" . $atts['icon_type'];
	$iconClass = isset($atts[$icon_name])?$atts[$icon_name]:'';
?>
<div class="zo-fancyboxes-wraper <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
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
    <div class="row zo-fancyboxes-body">
        <div class="zo-fancybox-item">
            <?php 
            $image_url = '';
            if (!empty($atts['image'])) {
                $attachment_image = wp_get_attachment_image_src($image, 'full');
                $image_url = $attachment_image[0];
            }
            ?>
            <?php if($image_url):?>
            <div class="fancy-box-image">
                <img src="<?php echo esc_attr($image_url);?>" />
            </div>
            <?php else:?>
			<div class="fancy-box-icon">
				<i class="<?php echo esc_attr($iconClass);?>"></i>
			</div>
            <?php endif;?>
            <?php if($atts['title_item']):?>
                <h3><?php echo apply_filters('the_title',$atts['title_item']);?></h3>
            <?php endif;?>
            <?php if( isset($atts['description_item']) && $atts['description_item']): ?>
            <div class="fancy-box-content">
                <?php echo apply_filters('the_content',$atts['description_item']);?>
            </div>
            <?php endif; ?>
            <?php if($atts['button_text']!=''):?>
                <div class="zo-fancyboxes-foot">
                    <?php
                    $class_btn = ($atts['button_type']=='button')?'btn btn-large':'';
                    ?>
                    <a href="<?php echo esc_url($atts['button_link']);?>" class="<?php echo esc_attr($class_btn);?>"><?php echo esc_attr($atts['button_text']);?></a>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>