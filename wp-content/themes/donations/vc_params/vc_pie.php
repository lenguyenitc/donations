<?php
/**
 * Add row params
 * 
 * @author ZoTheme
 * @since 1.0.0
 */
if (shortcode_exists('vc_pie')) {
    vc_add_param("vc_pie", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Heading size", THEMENAME),
        "param_name" => "heading_size",
        "value" => array(
            "Default" => "h4",
            "Heading 1" => "h1",
            "Heading 2" => "h2",
            "Heading 3" => "h3",
            "Heading 4" => "h4",
            "Heading 5" => "h5",
            "Heading 6" => "h6"
        ),
        "description" => 'Select your heading size for title.'
    ));
    vc_add_param("vc_pie", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __('Title Color', THEMENAME),
        "param_name" => "title_color",
    ));
    vc_add_param("vc_pie", array(
        'type' => 'textfield',
        'heading' => __('Pie icon', THEMENAME),
        'param_name' => 'icon',
        'value' => '',
        'admin_label' => true
    ));
    vc_add_param("vc_pie", array(
        'type' => 'textfield',
        'heading' => __('Icon Size', THEMENAME),
        'param_name' => 'icon_size',
        'description' => __('Font size of icon', THEMENAME),
        'value' => '24',
        'admin_label' => true
    ));
    vc_add_param("vc_pie", array(
        'type' => 'colorpicker',
        'heading' => __('Icon Color', THEMENAME),
        'param_name' => 'icon_color',
        'value' => '#888',
        'admin_label' => true
    ));
    vc_remove_param("vc_pie", "color");
    vc_add_param("vc_pie", array(
        'type' => 'colorpicker',
        'heading' => __('Bar color', THEMENAME),
        'param_name' => 'color',
        'value' => '#00c3b6', // $pie_colors,
        'description' => __('Select pie chart color.', THEMENAME),
        'admin_label' => true,
        'param_holder_class' => 'vc-colored-dropdown'
    ));
    vc_add_param("vc_pie", array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Bar Width", THEMENAME),
        "param_name" => "pie_width",
        "value" => "12",
    ));
    vc_add_param("vc_pie", array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Description", THEMENAME),
        "param_name" => "desc",
        "value" => "",
    ));
    vc_add_param("vc_pie", array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Style", THEMENAME),
        "param_name" => "style",
        "value" => array(
            "Style 1" => "style1",
            "Style 2" => "style2"
        ),
        "description" => __("Select style for pie.", THEMENAME)
    ));
    vc_add_param("vc_pie", array(
        "type" => "textfield",
        "class" => "",
        "heading" => __("Icon", THEMENAME),
        "param_name" => "icon",
        "value" => "",
        "description" => __('You can find icon class at here: <a target="_blank" href="http://fontawesome.io/icons/">"http://fontawesome.io/icons/</a>. For example, fa fa-heart', THEMENAME)
    ));
}