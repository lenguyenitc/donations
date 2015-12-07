<?php
vc_map(
    array(
        "name" => __("ZO Carousel", ZO_NAME),
        "base" => "zo_carousel",
        "class" => "vc-zo-carousel",
        "category" => __("ZoTheme Shortcodes", ZO_NAME),
        "params" => array(
            array(
                "type" => "loop",
                "heading" => __("Source",ZO_NAME),
                "param_name" => "source",
                'settings' => array(
                    'size' => array('hidden' => 0, 'value' => 10),
                    'order_by' => array('value' => 'date')
                ),
                "group" => __("Source Settings", ZO_NAME),
            ),
            array(
                "type" => "dropdown",
                "heading" => __("XSmall Devices",ZO_NAME),
                "param_name" => "xsmall_items",
                "edit_field_class" => "vc_col-sm-3 vc_carousel_item",
                "value" => array(1,2,3,4,5,6),
                "std" => 1,
                "group" => __("Carousel Settings", ZO_NAME)
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Small Devices",ZO_NAME),
                "param_name" => "small_items",
                "edit_field_class" => "vc_col-sm-3 vc_carousel_item",
                "value" => array(1,2,3,4,5,6),
                "std" => 2,
                "group" => __("Carousel Settings", ZO_NAME)
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Medium Devices",ZO_NAME),
                "param_name" => "medium_items",
                "edit_field_class" => "vc_col-sm-3 vc_carousel_item",
                "value" => array(1,2,3,4,5,6),
                "std" => 3,
                "group" => __("Carousel Settings", ZO_NAME)
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Large Devices",ZO_NAME),
                "param_name" => "large_items",
                "edit_field_class" => "vc_col-sm-3 vc_carousel_item",
                "value" => array(1,2,3,4,5,6),
                "std" => 4,
                "group" => __("Carousel Settings", ZO_NAME)
            ),
            array(
                "type" => "textfield",
                "heading" => __("Margin Items",ZO_NAME),
                "param_name" => "margin",
                "value" => "10",
                "description" => __("",ZO_NAME),
                "group" => __("Carousel Settings", ZO_NAME)
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Loop Items",ZO_NAME),
                "param_name" => "loop",
                "value" => array(
                    "True" => 1,
                    "False" => 0
                ),
                'std' => 1,
                "group" => __("Carousel Settings", ZO_NAME)
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Mouse Drag",ZO_NAME),
                "param_name" => "mousedrag",
                "value" => array(
                    "True" => 1,
                    "False" => 0
                ),
                'std' => 1,
                "group" => __("Carousel Settings", ZO_NAME)
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Touch Drag",ZO_NAME),
                "param_name" => "touchdrag",
                "value" => array(
                    "True" => 1,
                    "False" => 0
                ),
                'std' => 1,
                "group" => __("Carousel Settings", ZO_NAME)
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Show Nav",ZO_NAME),
                "param_name" => "nav",
                "value" => array(
                    "True" => 1,
                    "False" => 0
                ),
                'std' => 1,
                "group" => __("Carousel Settings", ZO_NAME)
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Show Dots",ZO_NAME),
                "param_name" => "dots",
                "value" => array(
                    "True" => 1,
                    "False" => 0
                ),
                'std' => 1,
                "group" => __("Carousel Settings", ZO_NAME)
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Center",ZO_NAME),
                "param_name" => "center",
                "value" => array(
                    "False" => 0,
                    "True" => 1
                ),
                'std' => 0,
                "group" => __("Carousel Settings", ZO_NAME)
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Auto Play",ZO_NAME),
                "param_name" => "autoplay",
                "value" => array(
                    "True" => 1,
                    "False" => 0
                ),
                'std' => 1,
                "group" => __("Carousel Settings", ZO_NAME)
            ),
            array(
                "type" => "textfield",
                "heading" => __("Auto Play TimeOut",ZO_NAME),
                "param_name" => "autoplaytimeout",
                "value" => "5000",
                "dependency" => array(
                    "element"=>"autoplay",
                    "value" => 1
                ),
                "description" => __("",ZO_NAME),
                "group" => __("Carousel Settings", ZO_NAME)
            ),
            array(
                "type" => "textfield",
                "heading" => __("Smart Speed",ZO_NAME),
                "param_name" => "smartspeed",
                "value" => "1000",
                "description" => __("Speed scroll of each item",ZO_NAME),
                "group" => __("Carousel Settings", ZO_NAME)
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Pause On Hover",ZO_NAME),
                "param_name" => "autoplayhoverpause",
                "dependency" => array(
                    "element"=>"autoplay",
                    "value" => 1
                ),
                "value" => array(
                    "True" => 1,
                    "False" => 0
                ),
                'std' => 1,
                "group" => __("Carousel Settings", ZO_NAME)
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __( 'Left Arrow', ZO_NAME ),
                'param_name' => 'left_arrow',
                'value' => 'fa fa-arrow-left',
                'settings' => array(
                    'emptyIcon' => 0, // default 1, display an "EMPTY" icon?
                    'iconsPerPage' => 200, // default 100, how many icons per/page to display
                ),
                'description' => __( 'Select icon from library.', ZO_NAME ),
                "group" => __("Carousel Settings", ZO_NAME)
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __( 'Right Arrow', ZO_NAME ),
                'param_name' => 'right_arrow',
                'value' => 'fa fa-arrow-right',
                'settings' => array(
                    'emptyIcon' => 0, // default 1, display an "EMPTY" icon?
                    'iconsPerPage' => 200, // default 100, how many icons per/page to display
                ),
                'description' => __( 'Select icon from library.', ZO_NAME ),
                "group" => __("Carousel Settings", ZO_NAME)
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Filter", ZO_NAME),
                "param_name" => "filter",
                "value" => array(
                    "Disable" => "false",
                    "Enable" => "true"
                ),
                'std' => "false",
                'description' => __('The filter don\'t work with Loop.', ZO_NAME),
                "group" => __("Carousel Settings", ZO_NAME)
            ),
            array(
                "type" => "textfield",
                "heading" => __("Extra Class",ZO_NAME),
                "param_name" => "class",
                "value" => "",
                "description" => __("",ZO_NAME),
                "group" => __("Template", ZO_NAME)
            ),
            array(
                "type" => "zo_template",
                "param_name" => "zo_template",
                "shortcode" => "zo_carousel",
                "admin_label" => true,
                "heading" => __("Shortcode Template",ZO_NAME),
                "group" => __("Template", ZO_NAME),
            )
        )
    )
);
global $zo_carousel;
$zo_carousel = array();
class WPBakeryShortCode_zo_carousel extends ZoShortcode{
    protected function content($atts, $content = null){
        //default value
        $atts_extra = shortcode_atts(array(
            'xsmall_items' => 1,
            'small_items' => 2,
            'medium_items' => 3,
            'large_items' => 4,
            'margin' => 0,
            'loop' => 1,
            'mousedrag' => 1,
            'touchdrag' => 1,
            'nav' => 1,
            'dots' => 1,
            'center' => 0,
            'autoplay' => 1,
            'autoplaytimeout' => '5000',
            'smartspeed' => '250',
            'autoplayhoverpause' => 1,
            'left_arrow' => 'fa fa-arrow-left',
            'right_arrow' => 'fa fa-arrow-right',
            'filter' => "false",
            'class' => '',
        ), $atts);
        global $zo_carousel;
        $atts = array_merge($atts_extra,$atts);
        wp_enqueue_style('owl-carousel',ZO_CSS.'owl.carousel.css','','2.0.0b','all');
        wp_enqueue_script('owl-carousel',ZO_JS.'owl.carousel.js',array('jquery'),'2.0.0b', true);
        wp_enqueue_script('owl-autoplay',ZO_JS.'owl.autoplay.js',array('jquery'),'2.0.0b', true);
        wp_enqueue_script('owl-navigation',ZO_JS.'owl.navigation.js',array('jquery'),'2.0.0b', true);
        wp_enqueue_script('owl-animate',ZO_JS.'owl.animate.js',array('jquery'),'2.0.0b', true);

        wp_enqueue_script('owl-carousel-zo',ZO_JS.'owl.carousel.zo.js',array('jquery'),'1.0.0', true);

        $source = $atts['source'];
        list($args, $posts) = vc_build_loop_query($source);
        $atts['posts'] = $posts;
        $html_id = zoHtmlID('zo-carousel');
        $atts['autoplaytimeout'] = isset($atts['autoplaytimeout']) ? (int)$atts['autoplaytimeout'] : 5000;
        $atts['smartspeed'] = isset($atts['smartspeed']) ? (int)$atts['smartspeed'] : 250;
        $left_arrow = isset($atts['left_arrow'])?$atts['left_arrow']:'fa fa-arrow-left';
        $right_arrow = isset($atts['right_arrow'])?$atts['right_arrow']:'fa fa-arrow-right';

        $zo_carousel[$html_id] = array(
            'margin' => (int)$atts['margin'],
            'loop' => $atts['loop'] == 1 ? true : false,
            'mouseDrag' => $atts['mousedrag'] == 1 ? true : false,
            'touchDrag' => $atts['touchdrag'] == 1 ? true : false,
            'nav' => $atts['nav'] == 1 ? true : false,
            'dots' => $atts['dots'] == 1 ? true : false,
            'center' => $atts['center'] == 1 ? true : false,
            'autoplay' => $atts['autoplay'] == 1 ? true : false,
            'autoplayTimeout' => $atts['autoplaytimeout'],
            'smartSpeed' => $atts['smartspeed'],
            'autoplayHoverPause' => $atts['autoplayhoverpause'] == 1 ? true : false,
            'navText' => array('<i class="'.$left_arrow.'"></i>','<i class="'.$right_arrow.'"></i>'),
            'dotscontainer' => $html_id.' .zo-dots',
            'items' => (int)$atts['large_items'],
            'responsive' => array(
                0 => array(
                    "items" => (int)$atts['xsmall_items'],
                ),
                768 => array(
                    "items" => (int)$atts['small_items'],
                ),
                992 => array(
                    "items" => (int)$atts['medium_items'],
                ),
                1200 => array(
                    "items" => (int)$atts['large_items'],
                )
            )
        );
        wp_localize_script('owl-carousel-zo', "zocarousel", $zo_carousel);
        $atts['template'] = 'template-'.str_replace('.php','',$atts['zo_template']). ' '. $atts['class'];
        $atts['html_id'] = $html_id;
        return parent::content($atts, $content);
    }
}

?>