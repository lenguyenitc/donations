<?php
/**
 * Add tabs params
 * 
 * @author ZoTheme
 * @since 1.0.0
 */
if (shortcode_exists('vc_accordion_tab')) {
    vc_add_param("vc_accordion_tab", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Accordion Background Color", THEMENAME),
        "param_name" => "zo_accordion_bg_color",
        "value" => "",
    ));
    vc_add_param("vc_accordion_tab", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Accordion Border Color", THEMENAME),
        "param_name" => "zo_accordion_border_color",
        "value" => "",
    ));
    vc_add_param("vc_accordion_tab", array(
        "type" => "textfield",
        "heading" => __("Accordion Icon", THEMENAME),
        "param_name" => "zo_accordion_icon",
        "description" => __("Select icon website(http://fortawesome.github.io/Font-Awesome/icons;https://icomoon.io/app/)",THEMENAME)
    ));
}