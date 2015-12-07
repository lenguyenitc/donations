<?php
vc_map(
	array(
		"name" => __("ZO Progress Bar", ZO_NAME),
	    "base" => "zo_progressbar",
	    "class" => "vc-zo-progressbar",
	    "category" => __("ZoTheme Shortcodes", ZO_NAME),
	    "params" => array(
	        array(
	            "type" => "dropdown",
	            "heading" => __("Mode",ZO_NAME),
	            "param_name" => "mode",
	            "value" => array(
	            	"Horizontal" => "horizontal",
	            	"Vertical" => "vertical"
	            	),
	            "group" => __("Progress Bar Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Item Title",ZO_NAME),
	            "param_name" => "item_title",
	            "value" => "",
	            "description" => __("",ZO_NAME),
	            "group" => __("Progress Bar Settings", ZO_NAME)
	        ),
            /* Start Icon */
            array(
                'type' => 'dropdown',
                'heading' => __( 'Icon library', ZO_NAME ),
                'value' => array(
                    __( 'Font Awesome', ZO_NAME ) => 'fontawesome',
                    __( 'Open Iconic', ZO_NAME ) => 'openiconic',
                    __( 'Typicons', ZO_NAME ) => 'typicons',
                    __( 'Entypo', ZO_NAME ) => 'entypo',
                    __( 'Linecons', ZO_NAME ) => 'linecons',
                    __( 'Pixel', ZO_NAME ) => 'pixelicons',
                    __( 'P7 Stroke', ZO_NAME ) => 'pe7stroke',
                ),
                'param_name' => 'icon_type',
                'description' => __( 'Select icon library.', 'js_composer' ),
                "group" => __("Progress Bar Settings", ZO_NAME)
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', ZO_NAME ),
                'param_name' => 'icon_fontawesome',
                'value' => '',
                'settings' => array(
                    'emptyIcon' => true, // default true, display an "EMPTY" icon?
                    'type' => 'fontawesome',
                    'iconsPerPage' => 200, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'fontawesome',
                ),
                'description' => __( 'Select icon from library.', ZO_NAME ),
                "group" => __("Progress Bar Settings", ZO_NAME)
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', ZO_NAME ),
                'param_name' => 'icon_openiconic',
                'value' => '',
                'settings' => array(
                    'emptyIcon' => true, // default true, display an "EMPTY" icon?
                    'type' => 'openiconic',
                    'iconsPerPage' => 200, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'openiconic',
                ),
                'description' => __( 'Select icon from library.', ZO_NAME ),
                "group" => __("Progress Bar Settings", ZO_NAME)
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', ZO_NAME ),
                'param_name' => 'icon_typicons',
                'value' => '',
                'settings' => array(
                    'emptyIcon' => true, // default true, display an "EMPTY" icon?
                    'type' => 'typicons',
                    'iconsPerPage' => 200, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'typicons',
                ),
                'description' => __( 'Select icon from library.', ZO_NAME ),
                "group" => __("Progress Bar Settings", ZO_NAME)
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', ZO_NAME ),
                'param_name' => 'icon_entypo',
                'value' => '',
                'settings' => array(
                    'emptyIcon' => true, // default true, display an "EMPTY" icon?
                    'type' => 'entypo',
                    'iconsPerPage' => 200, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'entypo',
                ),
                'description' => __( 'Select icon from library.', ZO_NAME ),
                "group" => __("Progress Bar Settings", ZO_NAME)
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', ZO_NAME ),
                'param_name' => 'icon_linecons',
                'value' => '',
                'settings' => array(
                    'emptyIcon' => true, // default true, display an "EMPTY" icon?
                    'type' => 'linecons',
                    'iconsPerPage' => 200, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'linecons',
                ),
                'description' => __( 'Select icon from library.', ZO_NAME ),
                "group" => __("Progress Bar Settings", ZO_NAME)
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', ZO_NAME ),
                'param_name' => 'icon_pixelicons',
                'value' => '',
                'settings' => array(
                    'emptyIcon' => true, // default true, display an "EMPTY" icon?
                    'type' => 'pixelicons',
                    'iconsPerPage' => 200, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'pixelicons',
                ),
                'description' => __( 'Select icon from library.', ZO_NAME ),
                "group" => __("Progress Bar Settings", ZO_NAME)
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', ZO_NAME ),
                'param_name' => 'icon_pe7stroke',
                'value' => '',
                'settings' => array(
                    'emptyIcon' => true, // default true, display an "EMPTY" icon?
                    'type' => 'pe7stroke',
                    'iconsPerPage' => 200, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'pe7stroke',
                ),
                'description' => __( 'Select icon from library.', ZO_NAME ),
                "group" => __("Progress Bar Settings", ZO_NAME)
            ),
            /* End Icon */
			array(
			"type" => "dropdown",
			"heading" => __ ( 'Show Value', ZO_NAME ),
			"param_name" => "show_value",
			"value" => array(
					"Yes" => "true",
					"No" => "false"
			),
			"description" => '',
			"group" => __("Progress Bar Settings", ZO_NAME)
			),
			array(
				"type" => "textfield",
				"class" => "",
				"value" => "60",
				"heading" => __ ( "Value", ZO_NAME ),
				"param_name" => "value",
				"description" => "Number only, ex: 60",
				"group" => __("Progress Bar Settings", ZO_NAME)
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __ ( "Value Suffix", ZO_NAME ),
				"group" => __("Progress Bar Settings", ZO_NAME),
				"param_name" => "value_suffix",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"heading" => __ ( 'Background Color Bar', ZO_NAME ),
				"param_name" => "bg_color",
				"group" => __("Progress Bar Settings", ZO_NAME),
				"value" =>"#e9e9e9",
				"description" => __('Background color for wrapper bar. Default is #e9e9e9',ZO_NAME)
			),
			array(
				"type" => "colorpicker",
				"heading" => __ ( 'Progress Color', ZO_NAME ),
				"param_name" => "color",
				"group" => __("Progress Bar Settings", ZO_NAME),
				"description" => __('Background color for progress.',ZO_NAME)
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __ ( "Width", ZO_NAME ),
				"param_name" => "width",
				"value" => "250px",
				"group" => __("Progress Bar Settings", ZO_NAME),
				"description" => "in px"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __ ( "Height", ZO_NAME ),
				"param_name" => "height",
				"value" => "50px",
				"group" => __("Progress Bar Settings", ZO_NAME),
				"description" => "in px"
			),
			array(
			    "type" => "textfield",
			    "heading" => __ ( 'Border Radius', ZO_NAME ),
			    "param_name" => "border_radius",
			    "group" => __("Progress Bar Settings", ZO_NAME),
			    "description" => 'px,%,...'
			),
			array(
	            "type" => "dropdown",
	            "heading" => __("Striped",ZO_NAME),
	            "param_name" => "striped",
	            "value" => array(
	            	"Yes" => "yes",
	            	"No" => "no"
	            	),
	            "group" => __("Progress Bar Settings", ZO_NAME)
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
	            "shortcode" => "zo_progressbar",
	            "group" => __("Template", ZO_NAME),
	        )
	    )
	)
);
class WPBakeryShortCode_zo_progressbar extends ZoShortcode{
	protected function content($atts, $content = null){
		$atts_extra = shortcode_atts(array(
			'mode' => 'horizontal',
			'item_title' => '',
			'show_value' => 'false',
			'value'=> '60',
			'value_suffix'=> '',
			'bg_color'=> '#e9e9e9',
			'color'=> '',
			'width'=> '250px',
			'height'=> '50px',
			'border_radius'=> '',
			'striped'=> 'no',
			'class' => '',
			    ), $atts);

        $atts['icon_type'] = isset($atts['icon_type']) ? $atts['icon_type'] : 'fontawesome';

		$atts = array_merge($atts_extra,$atts);
        if($atts['icon_type']=='pe7stroke'){
            wp_enqueue_style('zo-icon-pe7stroke', ZO_CSS. 'Pe-icon-7-stroke.css');
        }else{
            vc_icon_element_fonts_enqueue( $atts['icon_type'] );
        }
		/* CSS */
	    wp_register_style('bootstrap-progressbar', ZO_CSS . "bootstrap-progressbar.min.css","","0.7.0","all");
	    wp_enqueue_style('bootstrap-progressbar');
	    /* JS */
	    wp_register_script('bootstrap-progressbar', ZO_JS . "bootstrap-progressbar.min.js",array('jquery'),"0.7.0",true);
	    wp_register_script('zo-progressbar', ZO_JS . "bootstrap-progressbar.zo.js",array('jquery','bootstrap-progressbar'),"1.0.0",true);
	    wp_enqueue_script('zo-progressbar');
	    wp_enqueue_script('waypoints');
	    /* Layout */
        $html_id = zoHtmlID('zo-progressbar');
        /* Get Icon */
        $icon_name = "icon_" . $atts['icon_type'];
        $atts['icon'] = isset($atts[$icon_name]) ? $atts[$icon_name] : '';
        $atts['template'] = 'template-'.str_replace('.php','',$atts['zo_template']) . ' '. $atts['class'];
        $atts['html_id'] = $html_id;
		return parent::content($atts, $content);
	}
}

?>