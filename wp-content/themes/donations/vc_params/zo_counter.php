<?php

$zo_template_attribute = array(
    'type' => 'zo_template_img',
    'param_name' => 'zo_template',
    "shortcode" => "zo_counter",
    "heading" => __("Shortcode Template",THEMENAME),
    "admin_label" => true,
    "group" => __("Template", THEMENAME),
);
vc_add_param('zo_counter',$zo_template_attribute);