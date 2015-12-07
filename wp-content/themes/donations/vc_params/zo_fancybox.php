<?php
	$params = array(
		array(
			"type" => "dropdown",
			"heading" => __("Title Size",THEMENAME),
			"param_name" => "zo_title_size",
			"value" => array(
					"H2" => "h2",
					"H3" => "h3",
					"H4" => "h4",
					"H5" => "h5",
					"H6" => "h6"
			),
			"template" => array("zo_fancybox.php","zo_fancybox--layout-1.php", "zo_fancybox--layout-2.php", "zo_fancybox--layout-3.php")
		),
		array(
			"type" => "colorpicker",
			"heading" => __("Icon - Color",THEMENAME),
			"param_name" => "zo_fancybox_icon_color",
			"value" => "",
			"template" => array("zo_fancybox.php", "zo_fancybox--layout-2.php", "zo_fancybox--layout-3.php")
		),
		array(
			"type" => "colorpicker",
			"heading" => __("Icon - Boder Color",THEMENAME),
			"param_name" => "zo_fancybox_boder_color",
			"value" => "",
			"template" => array("zo_fancybox.php", "zo_fancybox--layout-2.php", "zo_fancybox--layout-3.php")
		),
		array(
			"type" => "colorpicker",
			"heading" => __("Icon - Background Color",THEMENAME),
			"param_name" => "zo_fancybox_bg_color",
			"value" => "",
			"template" => array("zo_fancybox.php", "zo_fancybox--layout-2.php", "zo_fancybox--layout-3.php")
		),
		array(
			"type" => "colorpicker",
			"heading" => __("Icon - Title Color",THEMENAME),
			"param_name" => "zo_fancybox_title_color",
			"value" => "",
			"template" => array("zo_fancybox.php", "zo_fancybox--layout-2.php", "zo_fancybox--layout-3.php")
		),
		array(
			"type" => "colorpicker",
			"heading" => __("Icon - Content Color",THEMENAME),
			"param_name" => "zo_fancybox_content_color",
			"value" => "",
			"template" => array("zo_fancybox.php", "zo_fancybox--layout-2.php", "zo_fancybox--layout-3.php")
		),
	    array(
            "type" => "dropdown",
            "heading" => __("Custom Color Text More Info",THEMENAME),
            "param_name" => "text_more_info",
            "value" => array(
            	'No' => '',
            	'Yes' => 'yes'
            	)
        ),
	    array(
            "type" => "colorpicker",
            "heading" => __("Color",THEMENAME),
            "param_name" => "text_more_info_color",
            'dependency' => array(
            	"element"=>"text_more_info",
            	"value"=>array(
					"yes"
					)
            	)
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Color Hover",THEMENAME),
            "param_name" => "text_more_info_color_hover",
            'dependency' => array(
            	"element"=>"text_more_info",
            	"value"=>array(
					"yes"
					)
            	)
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Custom Color Button More Info",THEMENAME),
            "param_name" => "button_more_info",
            "value" => array(
            	'No' => '',
            	'Yes' => 'yes'
            	)
        ),
	    array(
            "type" => "colorpicker",
            "heading" => __("Border Color",THEMENAME),
            "param_name" => "button_more_info_border_color",
            'dependency' => array(
            	"element"=>"button_more_info",
            	"value"=>array(
					"yes"
					)
            	)
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Border Color Hover",THEMENAME),
            "param_name" => "button_more_info_border_color_hover",
            'dependency' => array(
            	"element"=>"button_more_info",
            	"value"=>array(
					"yes"
					)
            	)
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Background Color",THEMENAME),
            "param_name" => "button_more_info_bg_color",
            'dependency' => array(
            	"element"=>"button_more_info",
            	"value"=>array(
					"yes"
					)
            	)
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Background Color Hover",THEMENAME),
            "param_name" => "button_more_info_bg_color_hover",
            'dependency' => array(
            	"element"=>"button_more_info",
            	"value"=>array(
					"yes"
					)
            	)
        ),
		/* Option Layout 1 */
		array(
			"type" => "colorpicker",
			"heading" => __("Content - Background Color",THEMENAME),
			"param_name" => "zo_fancybox_bg_content_color",
			"value" => "",
			"template" => array("zo_fancybox--layout-1.php")
		),
		array(
	        "type" => "textfield",
	        "class" => "",
	        "heading" => __("Months Old", THEMENAME),
	        "param_name" => "months_old",
	        "value" => '',
	        "template" => array("zo_fancybox--layout-1.php")
	    ),
	    array(
	        "type" => "textfield",
	        "class" => "",
	        "heading" => __("Class Size", THEMENAME),
	        "param_name" => "class_size",
	        "value" => '',
	        "template" => array("zo_fancybox--layout-1.php")
	    )
		/* End Option Layout 1 */
	);
	vc_remove_param('zo_fancybox','zo_template');
	$zo_template_attribute = array(
		'type' => 'zo_template_img',
	    'param_name' => 'zo_template',
	    "shortcode" => "zo_fancybox",
	    "heading" => __("Shortcode Template",THEMENAME),
	    "admin_label" => true,
	    "group" => __("Template", THEMENAME),
		);
	vc_add_param('zo_fancybox',$zo_template_attribute);
?>