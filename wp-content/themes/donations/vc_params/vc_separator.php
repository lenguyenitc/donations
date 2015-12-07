<?php
/*
 * Separator
 */
if (shortcode_exists('vc_separator')) {
    vc_remove_param('vc_separator', 'el_class');
    vc_add_param("vc_separator", array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Style Border Width", THEMENAME),
        "param_name" => "border_width",
        "value" => "1",
        "description" => "Defualt 1"
    ));
    vc_add_param("vc_separator", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Separator align", THEMENAME),
        "param_name" => "align",
        "value" => array(
            "Left" => "left",
            "Center" => "center",
            "Right" => "right"
        ),
        "description" => ""
    ));
    vc_add_param("vc_separator", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Show Arrow", THEMENAME),
        "param_name" => "separator_arrow",
        "value" => array(
            "No" => "no",
            "Yes" => "yes"
        ),
        "description" => ""
    ));
    vc_add_param("vc_separator", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Arrow Type", THEMENAME),
        "param_name" => "separator_arrow_type",
        "value" => array(
            "Border" => "border",
            "Image" => "image"
        ),
        "description" => ""
    ));
    vc_add_param("vc_separator", array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Arrow Width", THEMENAME),
        "param_name" => "arrow_width",
        "value" => "12",
        "description" => "Set Width for Arrow (Default 12)"
    ));
    vc_add_param("vc_separator", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Arrow Color", THEMENAME),
        "param_name" => "arrow_color",
        "value" => "",
        "description" => ""
    ));
    vc_add_param("vc_separator", array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Custom Sparator Width", THEMENAME),
        "param_name" => "custom_sparator_width",
        "value" => "",
        "description" => "Set Width Sparator Important: px, %"
    ));
}
?>