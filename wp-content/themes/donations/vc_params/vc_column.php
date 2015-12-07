<?php
/**
 * Add column params
 * 
 * @author ZoTheme
 * @since 1.0.0
 */
if (shortcode_exists('vc_column')) {
    vc_add_param("vc_column", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __('Font Color', THEMENAME),
        "param_name" => "font_color",
        "description" => ''
    ));
    vc_add_param("vc_column", array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Font Size", THEMENAME),
        "param_name" => "font_size_col",
        "value" => ''
    ));
    vc_add_param("vc_column_inner", array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Font Size", THEMENAME),
        "param_name" => "font_size_col",
        "value" => ''
    ));
    vc_add_param("vc_column", array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Font Line Height", THEMENAME),
        "param_name" => "font_line_height",
        "value" => ''
    ));
    vc_add_param("vc_column_inner", array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Font Line Height", THEMENAME),
        "param_name" => "font_line_height",
        "value" => ''
    ));
    vc_add_param("vc_column", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Font Weight", THEMENAME),
        "admin_label" => true,
        "param_name" => "font_weight_col",
        "value" => array(
            "Normal" => "",
            "Italic" => "300",
            "Bold" => "700"
        )
    ));
    vc_add_param("vc_column_inner", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Font Weight", THEMENAME),
        "admin_label" => true,
        "param_name" => "font_weight_col",
        "value" => array(
            "Normal" => "",
            "Italic" => "300",
            "Bold" => "700"
        )
    ));
    vc_add_param("vc_column", array(
        "type" => "checkbox",
        "heading" => __('Responsive utilities', THEMENAME),
        "param_name" => "column_responsive_large",
        "value" => array(
            __("Hidden (Large devices)", THEMENAME) => true
        )
    ));
    vc_add_param("vc_column", array(
        "type" => "checkbox",
        "heading" => '',
        "param_name" => "column_responsive_medium",
        "value" => array(
            __("Hidden (Medium devices)", THEMENAME) => true
        )
    ));
    vc_add_param("vc_column", array(
        "type" => "checkbox",
        "heading" => '',
        "param_name" => "column_responsive_small",
        "value" => array(
            __("Hidden (Small devices)", THEMENAME) => true
        )
    ));
    vc_add_param("vc_column", array(
        "type" => "checkbox",
        "heading" => '',
        "param_name" => "column_responsive_extra_small",
        "value" => array(
            __("Hidden (Extra small devices)", THEMENAME) => true
        ),
        "description" => __("For faster mobile-friendly development, use these utility classes for showing and hiding content by device via media query.", THEMENAME)
    ));
    vc_add_param("vc_column", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Animation", THEMENAME),
        "admin_label" => true,
        "param_name" => "animation",
        "value" => array(
            "None" => "",
            "Right To Left" => "right-to-left",
            "Left To Right" => "left-to-right",
            "Bottom To Top" => "bottom-to-top",
            "Top To Bottom" => "top-to-bottom",
            "Scale Up" => "scale-up",
            "Fade In" => "fade-in"
        )
    ));
    vc_add_param("vc_column_inner", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __('Font Color', THEMENAME),
        "param_name" => "font_color",
        "description" => ''
    ));
    vc_add_param("vc_column_inner", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Animation", THEMENAME),
        "admin_label" => true,
        "param_name" => "animation",
        "value" => array(
            "None" => "",
            "Right To Left" => "right-to-left",
            "Left To Right" => "left-to-right",
            "Bottom To Top" => "bottom-to-top",
            "Top To Bottom" => "top-to-bottom",
            "Scale Up" => "scale-up",
            "Fade In" => "fade-in"
        )
    ));
    vc_add_param("vc_column", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Text Align", THEMENAME),
        "admin_label" => true,
        "param_name" => "text_align",
        "value" => array(
            "None" => "",
            "Inherit" => "inherit",
            "Initial" => "initial",
            "Justify" => "justify",
            "Left" => "left",
            "Right" => "right",
            "Center" => "center",
            "Start" => "start",
            "End" => "end"
        )
    ));
    vc_add_param("vc_column_inner", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Text Align", THEMENAME),
        "admin_label" => true,
        "param_name" => "text_align",
        "value" => array(
            "None" => "",
            "Inherit" => "inherit",
            "Initial" => "initial",
            "Justify" => "justify",
            "Left" => "left",
            "Right" => "right",
            "Center" => "center",
            "Start" => "start",
            "End" => "end"
        )
    ));
    vc_add_param("vc_column_inner", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Column Heading Style", THEMENAME),
        "admin_label" => true,
        "param_name" => "column_style",
        "value" => array(
            "Default" => "",
            "Title Primary Color" => "title-primary-color",
            "Title Secondary Color" => "title-secondary-color"
        ),
        "description" => __("Add some styles to column", THEMENAME)
    ));
    vc_add_param("vc_column", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Column Heading Style", THEMENAME),
        "admin_label" => true,
        "param_name" => "column_style",
        "value" => array(
            "Default" => "",
            "Title Primary Color" => "title-primary-color",
            "Title Secondary Color" => "title-secondary-color"
        ),
        "description" => __("Add some styles to column", THEMENAME)
    ));
    vc_add_param("vc_column", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("List Style", THEMENAME),
        "admin_label" => true,
        "param_name" => "list_style",
        "value" => array(
            "None" => "",
            "List Style Check" => "list-style-check",
            "List Style Check - Green" => "list-style-check green"
        )
    ));
    vc_add_param("vc_column_inner", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("List Style", THEMENAME),
        "admin_label" => true,
        "param_name" => "list_style",
        "value" => array(
            "None" => "",
            "List Style Check" => "list-style-check",
            "List Style Check - Green" => "list-style-check green"
        )
    ));
}