<?php
/**
 * Add row params
 * 
 * @author ZoTheme
 * @since 1.0.0
 */
if (shortcode_exists('vc_row')) {
    vc_add_param('vc_row', array(
        'type' => 'checkbox',
        'heading' => __("Content Full Width", THEMENAME),
        'param_name' => 'full_width',
        'value' => array(
            'Yes' => true
        ),
        'description' => __("Yes = full width, default content boxed.", THEMENAME)
    ));
    vc_remove_param("vc_row", "el_id");
    vc_remove_param("vc_row", "parallax");
    vc_remove_param("vc_row", "parallax_image");
    vc_add_param("vc_row", array(
        "type" => "textfield",
        "heading" => __("Extra id name", THEMENAME),
        "param_name" => "row_id"
    ));
    vc_add_param("vc_row", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Row color", THEMENAME),
        "param_name" => "row_color",
        "value" => "",
        "description" => __("Select color for row.", THEMENAME)
    ));
    vc_add_param("vc_row_inner", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Row color", THEMENAME),
        "param_name" => "row_color",
        "value" => "",
        "description" => __("Select color for row.", THEMENAME)
    ));
    vc_add_param("vc_row", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Heading color", THEMENAME),
        "param_name" => "row_head_color",
        "value" => "",
        "description" => __("Select color for head.", THEMENAME)
    ));
    vc_add_param("vc_row_inner", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Heading color", THEMENAME),
        "param_name" => "row_head_color",
        "value" => "",
        "description" => __("Select color for head.", THEMENAME)
    ));
    vc_add_param("vc_row", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Link color", THEMENAME),
        "param_name" => "row_link_color",
        "value" => "",
        "description" => __("Select color for link.", THEMENAME)
    ));
    vc_add_param("vc_row_inner", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Link color", THEMENAME),
        "param_name" => "row_link_color",
        "value" => "",
        "description" => __("Select color for link.", THEMENAME)
    ));
    vc_add_param("vc_row", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Link color hover", THEMENAME),
        "param_name" => "row_link_color_hover",
        "value" => "",
        "description" => __("Select color for link hover.", THEMENAME)
    ));
    vc_add_param("vc_row_inner", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __("Link color hover", THEMENAME),
        "param_name" => "row_link_color_hover",
        "value" => "",
        "description" => __("Select color for link hover.", THEMENAME)
    ));
    vc_add_param("vc_row", array(
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
    vc_add_param('vc_row', array(
        'type' => 'dropdown',
        'heading' => __("Background Style", THEMENAME),
        'param_name' => 'bg_style',
        'value' => array(
            'Default' => '',
            'Image / Parallax' => 'img_parallax',
            'Image / Fixed' => 'img_fixed',
            'Hosted Video' => 'hvideo',
            'Background Effect' => 'bg-effect-lg'
        ),
        'group' => 'Design Options',
        'description' => __("Select the kind of background would you like to set for this row.", THEMENAME)
    ));
    vc_add_param('vc_row', array(
        'type' => 'textfield',
        'heading' => __("Parallax Speed", THEMENAME),
        'param_name' => 'bd_p_speed',
        'group' => 'Design Options',
        "dependency" => array(
            "element" => "bg_style",
            "value" => array(
                "img_parallax"
            )
        ),
        'description' => __("Set speed moving for parallax default 0.1 .", THEMENAME)
    ));
    vc_add_param('vc_row', array(
        'type' => 'textfield',
        'heading' => __("MP4 (URL)", THEMENAME),
        'param_name' => 'bg_video_mp4',
        'group' => 'Design Options',
        "dependency" => array(
            "element" => "bg_style",
            "value" => array(
                "hvideo"
            )
        ),
        'description' => __(".mp4 video.", THEMENAME)
    ));
    vc_add_param('vc_row', array(
        'type' => 'textfield',
        'heading' => __("WEBM (URL)", THEMENAME),
        'param_name' => 'bg_video_webm',
        'group' => 'Design ptions',
        "dependency" => array(
            "element" => "bg_style",
            "value" => array(
                "hvideo"
            )
        ),
        'description' => __(".webm video.", THEMENAME)
    ));
    vc_add_param('vc_row', array(
        'type' => 'dropdown',
        'heading' => __("Overlay Color", THEMENAME),
        'param_name' => 'overlay_row',
        'value' => array(
            'No' => '',
            'Yes' => 'yes'
        ),
        'group' => 'Design Options'
    ));
    vc_add_param("vc_row", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __('Color', THEMENAME),
        "param_name" => "overlay_color",
        'group' => 'Design Options',
        "dependency" => array(
            "element" => "overlay_row",
            "value" => array(
                "yes"
            )
        ),
        "description" => ''
    ));
    vc_add_param('vc_row', array(
        'type' => 'textfield',
        'heading' => __("Opacity", THEMENAME),
        'param_name' => 'overlay_opacity',
        'group' => 'Design Options',
        "dependency" => array(
            "element" => "overlay_row",
            "value" => array(
                "yes"
            )
        ),
        'description' => __("Set opacity overlay color - ex: 0.6 .", THEMENAME)
    ));
    vc_add_param('vc_row', array(
        'type' => 'dropdown',
        'heading' => __("Custom Background Color", THEMENAME),
        'param_name' => 'background_color_row',
        'value' => array(
            'No' => '',
            'Yes' => 'yes'
        ),
        'group' => 'Design Options'
    ));
    vc_add_param("vc_row", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __('BG Color Left', THEMENAME),
        "param_name" => "background_color_row_left",
        'group' => 'Design Options',
        "dependency" => array(
            "element" => "background_color_row",
            "value" => array(
                "yes"
            )
        ),
        "description" => ''
    ));
    vc_add_param("vc_row", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __('BG Color Right', THEMENAME),
        "param_name" => "background_color_row_right",
        'group' => 'Design Options',
        "dependency" => array(
            "element" => "background_color_row",
            "value" => array(
                "yes"
            )
        ),
        "description" => ''
    ));
    vc_add_param('vc_row', array(
        'type' => 'dropdown',
        'heading' => __("Row Arrow", THEMENAME),
        'param_name' => 'row_arrow',
        'value' => array(
            'No' => '',
            'Yes' => 'yes'
        ),
        'group' => 'Design Options'
    ));
    vc_add_param('vc_row', array(
        'type' => 'dropdown',
        'heading' => __("Arrow Position", THEMENAME),
        'param_name' => 'arrow_position',
        'value' => array(
            'Top' => 'top',
            'Bottom' => 'bottom'
        ),
        'group' => 'Design Options',
        "dependency" => array(
            "element" => "row_arrow",
            "value" => array(
                "yes"
            )
        ),
    ));
    vc_add_param("vc_row", array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __('Arrow Color', THEMENAME),
        "param_name" => "arrow_color",
        'group' => 'Design Options',
        "dependency" => array(
            "element" => "row_arrow",
            "value" => array(
                "yes"
            )
        ),
        "description" => ''
    ));
}