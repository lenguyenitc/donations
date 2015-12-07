<?php
global $smof_data;
$title = $el_class = $value = $label_value= $units = $cl_hide_icon = $title_pie = $cl_hide_value = '';
extract(shortcode_atts(array(
    'title' => '',
    'heading_size'=>'h4',
    'title_color' => $smof_data['primary_color'],
    'desc' => '',
    'style' => 'style1',
    'icon' => '',
    'icon_size' => '24',
    'pie_width' => '12',
    'icon_color' => '#888',
    'el_class' => '',
    'value' => '50',
    'units' => '',
    'color' => $smof_data['primary_color'],
    'label_value' => ''
), $atts));

if($icon!=''){
    $cl_hide_value ='vc-pie-hide-value';
}

if($style=='style2'){
    if($icon==''){
        $cl_hide_icon = 'vc-pie-hide-icon';
    }
    $title_pie = $title;
}
wp_enqueue_script( 'waypoints');
wp_enqueue_script('progressCircle');
wp_enqueue_script('vc_pie_custom');
wp_enqueue_script('waypoints');

$el_class = $this->getExtraClass( $el_class );
$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_pie_chart wpb_content_element'.$el_class, $this->settings['base']);

$output = "\n\t".'<div class= "'.esc_attr($css_class).' '.esc_attr($style).'" data-pie-border="'.$pie_width.'" data-pie-value="'.esc_attr($value).'" data-pie-label-value="'.esc_attr($label_value).'" data-pie-units="'.esc_attr($units).'" data-pie-color="'.esc_attr(htmlspecialchars($color)).'">';
    $output .= "\n\t\t".'<div class="wpb_wrapper">';
        $output .= "\n\t\t\t".'<div class="vc_pie_wrapper">';
            $output .= "\n\t\t\t".'<span style="border-width:'.$pie_width.';" class="vc_pie_chart_back"></span>';
            $output .='<div class="vc_wrap_header">';
            $output .='<div class="vc-pie-info"><div class="vc-pie-inner"><h4>'.$title_pie.'</h4></div></div>';
            $output .= "\n\t\t\t".'<span class="vc_pie_chart_value '.$cl_hide_value.'"><i class="'.esc_attr($icon).' '.esc_attr($cl_hide_icon).'">'.$cl_hide_icon.'</i></span>';
            if($icon){
                $output.='<i class="'.esc_attr($icon).' '.esc_attr($cl_hide_icon).'" style="color:'.$icon_color.';font-size:'.$icon_size.'px">'.$cl_hide_icon.'</i>';
            }
            $output .='</div>';
            $output .= "\n\t\t\t".'<canvas width="101" height="101"></canvas>';
            $output .= "\n\t\t\t".'</div>';
        if ($title!='') {
            if($style=='style1'){
            $output .= '<'.$heading_size.' class="wpb_heading wpb_pie_chart_heading" style="color:'.$title_color.';">'.$title.'</'.$heading_size.'>';
            $output .= '<span class="">'.$desc.'</span>';
            }
        }
        //wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_pie_chart_heading'));
    $output .= "\n\t\t".'</div>'.$this->endBlockComment('.wpb_wrapper');
    $output .= "\n\t".'</div>'.$this->endBlockComment('.wpb_pie_chart')."\n";

echo ''.$output;