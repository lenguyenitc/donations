<?php
global $smof_data;
/** @var $this WPBakeryShortCode_VC_Row */
extract( shortcode_atts( array(
    'el_class' => '',
    'row_id' => '',
	'animation' => '',
	'full_width' => false,
	'bg_style' => '',
	'bd_p_speed' => 0.1,
	'bg_video_mp4' => '',
	'bg_video_webm' => '',
    'row_data' => '',
	'row_color' => '',
    'row_head_color' => '',
    'row_link_color' => '',
    'row_link_color_hover' => '',
    'overlay_row' => '',
    'overlay_color' => '',
    'overlay_opacity' => '0.6',
    'background_color_row' => '',
    'background_color_row_left' => '',
    'background_color_row_right' => '',
    'row_arrow' => '',
    'arrow_position' => '',
    'arrow_color' => '',
	'css' => '',
), $atts ) );
$row_style = ''; $video_style = '';
/* Row ID */
if($row_id){
    $row_id = "id=$row_id";
}
/* Row Color */
if($row_color){
    $row_style .= "color:$row_color;";
}
/* Overlay Row */
$html_overlay_row = '';
if($overlay_row == 'yes') {
    $html_overlay_row .= '<div class="zo-overlay-color" style="background-color: '.$overlay_color.'; opacity: '.$overlay_opacity.';"></div>';
}
$class_overlay_row = '';
if($overlay_row == 'yes') {
    $class_overlay_row .= 'row-overlay-color';
}
/* End Overlay Row */
/* Custom Background Color */
$html_custom_bg_color = '';
if($background_color_row == 'yes') {
    $html_custom_bg_color .= '<div class="zo-custom-bg-left" style="background-color: '.$background_color_row_left.';"></div><div class="zo-custom-bg-right" style="background-color: '.$background_color_row_right.';"></div>';
}
$class_custom_bg_color = '';
if($background_color_row == 'yes') {
    $class_custom_bg_color .= 'row-custom-bg-color';
}
/* End Custom Background Color */
/* Row Arrow */
$html_row_arrow = '';
$class_row_arrow = '';
if($row_arrow == 'yes') {
    $class_row_arrow .= 'row-arrow';
}
if(($row_arrow == 'yes') && ($arrow_position == 'top')) {
    $class_row_arrow .= ' row-arrow-top';
    $html_row_arrow .= '<span class="zo-row-arrow" style="border-top-color: '.$arrow_color.';"></span>';
}
if(($row_arrow == 'yes') && ($arrow_position == 'bottom')) {
    $class_row_arrow .= ' row-arrow-bottom';
    $html_row_arrow .= '<span class="zo-row-arrow" style="border-bottom-color: '.$arrow_color.';"></span>';
}
/* End Row Arrow */
/* Link Color */
$link_style = "";
$uqid = uniqid();
$class_link = ' .zo_'.$uqid;
if($row_link_color || $row_link_color_hover || $row_head_color){
    $link_style .= '<style type="text/css">';
    if($row_head_color){
        $link_style .= "".$class_link." h1,".$class_link." h2,".$class_link." h3,".$class_link." h4,".$class_link." h5,".$class_link." h6 {color: $row_head_color}";
    }
    if($row_link_color){
        $link_style .= "".$class_link." a{color: $row_link_color}";
    }
    if($row_link_color_hover){
        $link_style .= "".$class_link." a:hover{color: $row_link_color_hover}";
    }
    $link_style .= '</style>';
}
/* End Link Color */
/* Background effect */
$bg_effect = '';
if($bg_style == 'bg-effect-lg'){
    $bg_effect = "bg-effect-lg";
}
/* Class Animation For Row */
if ($animation) {
    wp_enqueue_script( 'waypoints');
    $animation .= '  wpb_animate_when_almost_visible wpb_'.$animation;
}
/* Row Full Width */
$class_full_width = '';
if($full_width) {
    $class_full_width = 'zo-row-full-width';
}
/** BG Style Image */
switch ($bg_style){
    case 'img_parallax':
        if($smof_data['paralax']){
            $el_class .= " zo_parallax";
            $row_data .= " data-speed = $bd_p_speed";
            $row_style .= "background-position: 50% 0;background-attachment:fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;";
        }
        break;
    case 'img_fixed':
        $row_style .= "background-attachment:fixed;background-repeat: no-repeat;";
        break;
    case 'hvideo':
        $el_class .= "row-bg-video";
        $video_style = '<div class="zo-bg-video">'.do_shortcode('[video autoplay="on" loop="on" preload="none" height="0" width="0" mp4="'.$bg_video_mp4.'" webm="'.$bg_video_webm.'"]').'</div>';
        break;
}
$class_img_fixed = '';
if ($bg_style == 'img_fixed') {
    $class_img_fixed = 'background-image-fixed';
}
$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row zo_'. $uqid. ' ' .$class_full_width. ' ' .$bg_effect. ' ' .$class_img_fixed. ' ' .$class_row_arrow. ' ' .$class_custom_bg_color. ' ' .$class_overlay_row. ' ' . ( $this->settings( 'base' ) === 'zo_row_inner' ? 'zo_inner ' : '' ) . get_row_css_class() .$animation . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$style = ' style ="'.$row_style.'"';  //$this->buildStyle();
?>
<div <?php echo esc_attr( $row_id ); ?> class="<?php echo esc_attr( $css_class ); ?>"<?php echo esc_attr($row_data); ?><?php echo do_shortcode($style); ?>>
    <?php echo ''.$video_style; ?>
    <?php echo ''.$html_overlay_row; ?>
    <?php echo ''.$html_custom_bg_color; ?>
    <?php echo ''.$html_row_arrow; ?>
    <?php if(!$full_width): ?><div class="container"><div class="row"><?php endif ; ?>
    <?php if($full_width): ?><div class="container-fluid"><div class="row"><?php endif ; ?>
    <?php echo wpb_js_remove_wpautop( $content ); ?>
    <?php if(!$full_width): ?></div></div><?php endif ; ?>
    <?php if($full_width): ?></div></div><?php endif ; ?>
    <?php echo ''.$link_style; ?>
</div>
