<?php
/**
 * @var $this WPBakeryShortCode_VC_Column
 */
$output = $font_color = $el_class = $width = $offset = $font_size_col = $font_line_height = $font_weight_col = '';
extract( shortcode_atts( array(
	'font_color'=>'',
    'el_class' => '',
    'width' => '1/1',
    'column_responsive_large'=>'',
    'column_responsive_medium'=>'',
    'column_responsive_small'=>'',
    'column_responsive_extra_small'=>'',
    'image_transition'=>'',
    'css'=>'',
    'offset'=>'',
    'animation' => '',
    'column_border' => false,
    'column_style' => '',
    'list_style' => '',
    'text_align' => '',
    'font_size_col' => '',
    'font_line_height' => '',
    'font_weight_col' => ''
), $atts ) );

$el_class = $this->getExtraClass( $el_class );
$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );
/* Responsive */
    $responsive = '';
    if($column_responsive_large){
        $responsive .= ' hidden-lg';
    }
    if($column_responsive_medium){
        $responsive .= ' hidden-md';
    }
    if($column_responsive_small){
        $responsive .= ' hidden-sm';
    }
    if($column_responsive_extra_small){
        $responsive .= ' hidden-xs';
    }

/* Animation */
if ($animation) {
    wp_enqueue_script( 'waypoints');
    $animation .= '  wpb_animate_when_almost_visible wpb_'.$animation;
}

/* Text Align */
$styles = array();
$class_align = '';
if (!empty($text_align)) {
    $styles[] = " text-align: $text_align;";
    $class_align = " align-$text_align";
}

$el_class .= ' wpb_column vc_column_container '.$list_style.' ' . $animation .' '.$column_style.$class_align;
$style = $this->buildStyle( $font_color );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width . ' ' . $el_class . $responsive . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$output .= "\n\t" . '<div class="' . $css_class . ' ' . vc_shortcode_custom_css_class( $css, ' ' ) . '"' . $style . '>';
$output .= "\n\t\t" . '<div class="wpb_wrapper" style="font-size:'.$font_size_col.';font-weight:'.$font_weight_col.';line-height:'.$font_line_height.';">';
$output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content );
$output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.wpb_wrapper' );
$output .= "\n\t" . '</div> ' . $this->endBlockComment( $el_class ) . "\n";
echo do_shortcode($output);