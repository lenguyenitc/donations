<?php
vc_map(
	array(
		"name" => __("ZO Fancy Box", ZO_NAME),
	    "base" => "zo_fancybox",
	    "class" => "vc-zo-fancy-boxes",
	    "category" => __("ZoTheme Shortcodes", ZO_NAME),
	    "params" => array(
	    	array(
	            "type" => "textfield",
	            "heading" => __("Title",ZO_NAME),
	            "param_name" => "title",
	            "value" => "",
	            "description" => __("Title Of Fancy Icon Box",ZO_NAME),
	            "group" => __("General Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "textarea",
	            "heading" => __("Description",ZO_NAME),
	            "param_name" => "description",
	            "value" => "",
	            "description" => __("Description Of Fancy Icon Box",ZO_NAME),
	            "group" => __("General Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Content Align",ZO_NAME),
	            "param_name" => "content_align",
	            "value" => array(
	            	"Default" => "default",
	            	"Left" => "left",
	            	"Right" => "right",
	            	"Center" => "center"
	            	),
	            "group" => __("General Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Select Number Cols",ZO_NAME),
	            "param_name" => "zo_cols",
	            "value" => array(
	            	"1 Column",
	            	"2 Columns",
	            	"3 Columns",
	            	"4 Columns",
	            	"6 Columns",
	            	),
	            "group" => __("Fancy Icon Settings", ZO_NAME)
	        ),
	        /* Start Items */
	        array(
	            "type" => "heading",
	            "heading" => __("Fancy Box 1",ZO_NAME),
	            "param_name" => "heading_1",
	            'dependency' => array(
	            	"element"=>"zo_cols",
	            	"value"=>array(
						"2 Columns",
						"6 Columns",
						"4 Columns",
						"3 Columns",
						"1 Column"
						)
	            	),
	            "group" => __("Fancy Icon Settings", ZO_NAME)
	        ),
	        array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon Item 1', ZO_NAME ),
				'param_name' => 'icon1',
	            'value' => '',
				'settings' => array(
					'emptyIcon' => true, // default true, display an "EMPTY" icon?
					'iconsPerPage' => 200, // default 100, how many icons per/page to display
				),
				'dependency' => array(
	            	"element"=>"zo_cols",
	            	"value"=>array(
						"2 Columns",
						"6 Columns",
						"4 Columns",
						"3 Columns",
						"1 Column"
						)
	            	),
				'description' => __( 'Select icon from library.', ZO_NAME ),
				"group" => __("Fancy Icon Settings", ZO_NAME)
			),
			array(
	            "type" => "attach_image",
	            "heading" => __("Image Item 1",ZO_NAME),
	            "param_name" => "image1",
	            'dependency' => array(
	            	"element"=>"zo_cols",
	            	"value"=>array(
						"2 Columns",
						"6 Columns",
						"4 Columns",
						"3 Columns",
						"1 Column"
						)
	            	),
	            "group" => __("Fancy Icon Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Title Item 1",ZO_NAME),
	            "param_name" => "title1",
	            'dependency' => array(
	            	"element"=>"zo_cols",
	            	"value"=>array(
						"2 Columns",
						"6 Columns",
						"4 Columns",
						"3 Columns",
						"1 Column"
						)
	            	),
	            "value" => "",
	            "description" => __("Title Of Item",ZO_NAME),
	            "group" => __("Fancy Icon Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "textarea",
	            "heading" => __("Content Item 1",ZO_NAME),
	            "param_name" => "description1",
	            'dependency' => array(
	            	"element"=>"zo_cols",
	            	"value"=>array(
						"2 Columns",
						"6 Columns",
						"4 Columns",
						"3 Columns",
						"1 Column"
						)
	            	),
	            "group" => __("Fancy Icon Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Link 1",ZO_NAME),
	            "param_name" => "button_link1",
	            'dependency' => array(
	            	"element"=>"zo_cols",
	            	"value"=>array(
						"2 Columns",
						"6 Columns",
						"4 Columns",
						"3 Columns",
						"1 Column"
						)
	            	),
	            "value" => "",
	            "description" => __("",ZO_NAME),
	            "group" => __("Fancy Icon Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "heading",
	            "heading" => __("Fancy Box 2",ZO_NAME),
	            "param_name" => "heading_2",
	            'dependency' => array(
	            	"element"=>"zo_cols",
	            	"value"=>array(
						"2 Columns",
						"6 Columns",
						"4 Columns",
						"3 Columns",
						)
	            	),
	            "group" => __("Fancy Icon Settings", ZO_NAME)
	        ),
	        array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon Item 2', ZO_NAME ),
				'param_name' => 'icon2',
				'dependency' => array(
						"element"=>"zo_cols",
						"value"=>array(
							"2 Columns",
							"6 Columns",
							"4 Columns",
							"3 Columns",
						)
					),
	            'value' => '',
				'settings' => array(
					'emptyIcon' => true, // default true, display an "EMPTY" icon?
					'iconsPerPage' => 200, // default 100, how many icons per/page to display
				),
				'description' => __( 'Select icon from library.', ZO_NAME ),
				"group" => __("Fancy Icon Settings", ZO_NAME)
			),
			array(
	            "type" => "attach_image",
	            "heading" => __("Image Item 2",ZO_NAME),
	            'dependency' => array(
	            	"element"=>"zo_cols",
	            	"value"=>array(
						"2 Columns",
						"6 Columns",
						"4 Columns",
						"3 Columns",
						)
					),
	            "param_name" => "image2",
	            "group" => __("Fancy Icon Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Title Item 2",ZO_NAME),
	            "param_name" => "title2",
	            "value" => "",
	            'dependency' => array(
	            	"element"=>"zo_cols",
	            	"value"=>array(
						"2 Columns",
						"6 Columns",
						"4 Columns",
						"3 Columns",
						)
	            	),
	            "description" => __("Title Of Item",ZO_NAME),
	            "group" => __("Fancy Icon Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "textarea",
	            "heading" => __("Content Item 2",ZO_NAME),
	            'dependency' => array(
	            	"element"=>"zo_cols",
	            	"value"=>array(
						"2 Columns",
						"6 Columns",
						"4 Columns",
						"3 Columns",
						)
	            	),
	            "param_name" => "description2",
	            "group" => __("Fancy Icon Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Link 2",ZO_NAME),
	            "param_name" => "button_link2",
	            "value" => "",
	            'dependency' => array(
	            	"element"=>"zo_cols",
	            	"value"=>array(
						"2 Columns",
						"6 Columns",
						"4 Columns",
						"3 Columns",
						)
	            	),
	            "description" => __("",ZO_NAME),
	            "group" => __("Fancy Icon Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "heading",
	            "heading" => __("Fancy Box 3",ZO_NAME),
	            "param_name" => "heading_3",
	            'dependency' => array(
	            	"element"=>"zo_cols",
	            	"value"=>array(
						"6 Columns",
						"4 Columns",
						"3 Columns",
						)
	            	),
	            "group" => __("Fancy Icon Settings", ZO_NAME)
	        ),
	        array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon Item 3', ZO_NAME ),
				'dependency' => array(
					"element"=>"zo_cols",
					"value"=>array(
						"6 Columns",
						"4 Columns",
						"3 Columns",
						)
					),
				'param_name' => 'icon3',
	            'value' => '',
				'settings' => array(
					'emptyIcon' => true, // default true, display an "EMPTY" icon?
					'iconsPerPage' => 200, // default 100, how many icons per/page to display
				),
				'description' => __( 'Select icon from library.', ZO_NAME ),
				"group" => __("Fancy Icon Settings", ZO_NAME)
			),
			array(
	            "type" => "attach_image",
	            "heading" => __("Image Item 3",ZO_NAME),
	            'dependency' => array(
	            	"element"=>"zo_cols",
	            	"value"=>array(
						"6 Columns",
						"4 Columns",
						"3 Columns",
						)
	            	),
	            "param_name" => "image3",
	            "group" => __("Fancy Icon Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Title Item 3",ZO_NAME),
	            "param_name" => "title3",
	            "value" => "",
	            'dependency' => array(
	            	"element"=>"zo_cols",
	            	"value"=>array(
						"6 Columns",
						"4 Columns",
						"3 Columns",
						)
	            	),
	            "description" => __("Title Of Item",ZO_NAME),
	            "group" => __("Fancy Icon Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "textarea",
	            "heading" => __("Content Item 3",ZO_NAME),
	            'dependency' => array(
	            	"element"=>"zo_cols",
	            	"value"=>array(
						"6 Columns",
						"4 Columns",
						"3 Columns",
						)
	            	),
	            "param_name" => "description3",
	            "group" => __("Fancy Icon Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Link 3",ZO_NAME),
	            "param_name" => "button_link3",
	            "value" => "",
	            'dependency' => array(
	            	"element"=>"zo_cols",
	            	"value"=>array(
						"6 Columns",
						"4 Columns",
						"3 Columns",
						)
	            	),
	            "description" => __("",ZO_NAME),
	            "group" => __("Fancy Icon Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "heading",
	            "heading" => __("Fancy Box 4",ZO_NAME),
	            "param_name" => "heading_4",
	            'dependency' => array(
					"element"=>"zo_cols",
					"value"=>array(
						"6 Columns",
						"4 Columns",
						)
					),
	            "group" => __("Fancy Icon Settings", ZO_NAME)
	        ),
	        array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon Item 4', ZO_NAME ),
				'param_name' => 'icon4',
				'dependency' => array(
					"element"=>"zo_cols",
					"value"=>array(
						"6 Columns",
						"4 Columns",
						)
					),
	            'value' => '',
				'settings' => array(
					'emptyIcon' => true, // default true, display an "EMPTY" icon?
					'iconsPerPage' => 200, // default 100, how many icons per/page to display
				),
				'description' => __( 'Select icon from library.', ZO_NAME ),
				"group" => __("Fancy Icon Settings", ZO_NAME)
			),
			array(
	            "type" => "attach_image",
	            "heading" => __("Image Item 4",ZO_NAME),
	            "param_name" => "image4",
	            'dependency' => array(
	            	"element"=>"zo_cols",
	            	"value"=>array(
						"6 Columns",
						"4 Columns",
						)
	            	),
	            "group" => __("Fancy Icon Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Title Item 4",ZO_NAME),
	            "param_name" => "title4",
	            "value" => "",
	            'dependency' => array(
	            	"element"=>"zo_cols",
	            	"value"=>array(
						"6 Columns",
						"4 Columns",
						)
	            	),
	            "description" => __("Title Of Item",ZO_NAME),
	            "group" => __("Fancy Icon Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "textarea",
	            "heading" => __("Content Item 4",ZO_NAME),
	            "param_name" => "description4",
	            'dependency' => array(
	            	"element"=>"zo_cols",
	            	"value"=>array(
						"6 Columns",
						"4 Columns",
						)
	            	),
	            "group" => __("Fancy Icon Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Link 4",ZO_NAME),
	            "param_name" => "button_link4",
	            "value" => "",
	            'dependency' => array(
	            	"element"=>"zo_cols",
	            	"value"=>array(
						"6 Columns",
						"4 Columns",
						)
	            	),
	            "description" => __("",ZO_NAME),
	            "group" => __("Fancy Icon Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "heading",
	            "heading" => __("Fancy Box 6",ZO_NAME),
	            "param_name" => "heading_6",
	            'dependency' => array(
					"element"=>"zo_cols",
					"value"=>"6 Columns"
					),
	            "group" => __("Fancy Icon Settings", ZO_NAME)
	        ),
	        array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon Item 6', ZO_NAME ),
				'param_name' => 'icon6',
				'dependency' => array(
					"element"=>"zo_cols",
					"value"=>"6 Columns"
					),
	            'value' => '',
				'settings' => array(
					'emptyIcon' => true, // default true, display an "EMPTY" icon?
					'iconsPerPage' => 200, // default 100, how many icons per/page to display
				),
				'description' => __( 'Select icon from library.', ZO_NAME ),
				"group" => __("Fancy Icon Settings", ZO_NAME)
			),
			array(
	            "type" => "attach_image",
	            "heading" => __("Image Item 6",ZO_NAME),
	            'dependency' => array(
	            	"element"=>"zo_cols",
	            	"value"=>"6 Columns"
	            	),
	            "param_name" => "image6",
	            "group" => __("Fancy Icon Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Title Item 6",ZO_NAME),
	            "param_name" => "title6",
	            "value" => "",
	            'dependency' => array(
	            	"element"=>"zo_cols",
	            	"value"=>array(
						"6 Columns",
						)
	            	),
	            "description" => __("Title Of Item",ZO_NAME),
	            "group" => __("Fancy Icon Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "textarea",
	            "heading" => __("Content Item 6",ZO_NAME),
	            'dependency' => array(
	            	"element"=>"zo_cols",
	            	"value"=>"6 Columns"
	            	),
	            "param_name" => "description6",
	            "group" => __("Fancy Icon Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Link 6",ZO_NAME),
	            "param_name" => "button_link6",
	            "value" => "",
	            'dependency' => array(
	            	"element"=>"zo_cols",
	            	"value"=>array(
						"6 Columns",
						)
	            	),
	            "description" => __("",ZO_NAME),
	            "group" => __("Fancy Icon Settings", ZO_NAME)
	        ),
	        /* End Items */
	        array(
	            "type" => "dropdown",
	            "heading" => __("Button Type",ZO_NAME),
	            "param_name" => "button_type",
	            "value" => array(
	            	"Button" => "button",
	            	"Text" => "text"
	            	),
	            "group" => __("Buttons Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "textfield",
	            "heading" => __("Text",ZO_NAME),
	            "param_name" => "button_text",
	            "value" => "",
	            "description" => __("",ZO_NAME),
	            "group" => __("Buttons Settings", ZO_NAME)
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
	            "admin_label" => true,
	            "heading" => __("Shortcode Template",ZO_NAME),
	            "shortcode" => "zo_fancybox",
	            "group" => __("Template", ZO_NAME),
	        )
		)
	)
);
class WPBakeryShortCode_zo_fancybox extends ZoShortcode{
	protected function content($atts, $content = null){
		$atts_extra = shortcode_atts(array(
			'title' => '',
			'description' => '',
			'content_align' => 'default',
			'zo_cols' => '1 Column',
			'button_type'=> 'button',
			'button_text'=> '',
			'class' => '',
			    ), $atts);
		$atts = array_merge($atts_extra,$atts);
        $html_id = zoHtmlID('zo-fancy-box');
        $atts['template'] = 'template-'.str_replace('.php','',$atts['zo_template']). ' content-align-' . $atts['content_align'] . ' '. $atts['class'];
        $atts['html_id'] = $html_id;
		return parent::content($atts, $content);
	}
}

?>