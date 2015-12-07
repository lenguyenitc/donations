<?php
/**
 * Add tabs params
 * 
 * @author ZoTheme
 * @since 1.0.0
 */
if (shortcode_exists('vc_tab')) {
    vc_add_param("vc_tab", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Tab Background Color", THEMENAME),
        "param_name" => "zo_tab_bg_color",
        "value" => ""
    ));
    vc_add_param("vc_tab", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Tab Border Color", THEMENAME),
        "param_name" => "zo_tab_border_color",
        "value" => ""
    ));
    vc_add_param("vc_tab", array(
        "type" => "textfield",
        "heading" => __("Tab Icon", THEMENAME),
        "param_name" => "zo_tab_icon"
    ));
}