<?php
$output = $title = $zo_accordion_bg_color = $zo_accordion_border_color = $zo_accordion_icon = '';

extract(shortcode_atts(array(
	'title' => __("Section", "js_composer"),
	'zo_accordion_bg_color' => '',
    'zo_accordion_border_color' => '',
    'zo_accordion_icon' => ''
), $atts));
$icon = !empty($zo_accordion_icon) ? '<i class="fa '.$zo_accordion_icon.'"></i>' : '';
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion_section group', $this->settings['base'], $atts );
$output .= "\n\t\t\t" . '<div class="'.$css_class.'">';
    $output .= "\n\t\t\t\t" . '<h3 class="wpb_accordion_header ui-accordion-header" style="background-color: '.$zo_accordion_bg_color.';border-color: '.$zo_accordion_border_color.'"><a href="#'.sanitize_title($title).'">'. $icon .$title.'</a></h3>';
    $output .= "\n\t\t\t\t" . '<div class="wpb_accordion_content ui-accordion-content vc_clearfix" style="border-color: '.$zo_accordion_border_color.'">';
        $output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "js_composer") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
        $output .= "\n\t\t\t\t" . '</div>';
    $output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.wpb_accordion_section') . "\n";

echo do_shortcode($output);