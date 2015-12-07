<?php
vc_map(
	array(
		"name" => __("ZO Grid", ZO_NAME),
	    "base" => "zo_grid",
	    "class" => "vc-zo-grid",
	    "category" => __("ZoTheme Shortcodes", ZO_NAME),
	    "params" => array(
	    	array(
	            "type" => "loop",
	            "heading" => __("Source",ZO_NAME),
	            "param_name" => "source",
	            'settings' => array(
	                'size' => array('hidden' => false, 'value' => 10),
	                'order_by' => array('value' => 'date')
	            ),
	            "group" => __("Source Settings", ZO_NAME),
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Layout Type",ZO_NAME),
	            "param_name" => "layout",
	            "value" => array(
	            	"Basic" => "basic",
	            	"Masonry" => "masonry",
	            	),
	            "group" => __("Grid Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Columns XS Devices",ZO_NAME),
	            "param_name" => "col_xs",
	            "edit_field_class" => "vc_col-sm-3 vc_column",
	            "value" => array(1,2,3,4,6,12),
	            "std" => 1,
	            "group" => __("Grid Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Columns SM Devices",ZO_NAME),
	            "param_name" => "col_sm",
	            "edit_field_class" => "vc_col-sm-3 vc_column",
	            "value" => array(1,2,3,4,6,12),
	            "std" => 2,
	            "group" => __("Grid Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Columns MD Devices",ZO_NAME),
	            "param_name" => "col_md",
	            "edit_field_class" => "vc_col-sm-3 vc_column",
	            "value" => array(1,2,3,4,6,12),
	            "std" => 3,
	            "group" => __("Grid Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Columns LG Devices",ZO_NAME),
	            "param_name" => "col_lg",
	            "edit_field_class" => "vc_col-sm-3 vc_column",
	            "value" => array(1,2,3,4,6,12),
	            "std" => 4,
	            "group" => __("Grid Settings", ZO_NAME)
	        ),
	        array(
	            "type" => "dropdown",
	            "heading" => __("Filter on Masonry",ZO_NAME),
	            "param_name" => "filter",
	            "value" => array(
                    "Disable" => 0,
	            	"Enable" => 1
	            ),
	            "dependency" => array(
	            	"element" => "layout",
	            	"value" => "masonry"
                ),
	            "group" => __("Grid Settings", ZO_NAME)
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
	            "shortcode" => "zo_grid",
	            "admin_label" => true,
	            "heading" => __("Shortcode Template",ZO_NAME),
	            "group" => __("Template", ZO_NAME),
	        )
	    )
	)
);
class WPBakeryShortCode_zo_grid extends ZoShortcode{
	protected function content($atts, $content = null){
		wp_enqueue_script('zo-grid-pagination',ZO_JS.'zogrid.pagination.js',array('jquery'),'1.0.0',true);
        $html_id = zoHtmlID('zo-grid');
        $source = $atts['source'];
        list($args, $wp_query) = vc_build_loop_query($source);

        $paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

	    if($paged > 1){
	    	$args['paged'] = $paged;
	    	$wp_query = new WP_Query($args);
	    }
        $atts['cat'] = isset($args['cat'])?$args['cat']:'';
        /* get posts */
        $atts['posts'] = $wp_query;
        $grid = shortcode_atts(array(
            'col_lg' => 4,
            'col_md' => 3,
            'col_sm' => 2,
            'col_xs' => 1,
            'layout' => 'basic',
                ), $atts);
        $col_lg = 12 / $grid['col_lg'];
        $col_md = 12 / $grid['col_md'];
        $col_sm = 12 / $grid['col_sm'];
        $col_xs = 12 / $grid['col_xs'];
        $atts['item_class'] = "zo-grid-item col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-xs-{$col_xs}";
        $atts['grid_class'] = "zo-grid";
        $class = isset($atts['class'])?$atts['class']:'';
        $atts['template'] = 'template-'.str_replace('.php','',$atts['zo_template']). ' '. $class;
        if ($grid['layout'] == 'masonry') {
            wp_enqueue_script('zo-jquery-shuffle');
            $atts['grid_class'] .= " zo-grid-{$grid['layout']}";
        }
        $atts['html_id'] = $html_id;
		return parent::content($atts, $content);
	}
}

?>