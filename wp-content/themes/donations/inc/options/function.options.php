<?php
global $zo_base;
/* get local fonts. */
$local_fonts = is_admin() ? $zo_base->getListLocalFontsName() : array() ;
/**
 * Home Options
 * 
 * @author ZoTheme
 */
$this->sections[] = array(
    'title' => __('Main Options', THEMENAME),
    'icon' => 'el-icon-dashboard',
    'fields' => array(
        array(
            'id' => 'intro_product',
            'type' => 'intro_product',
        )
    )
);
/* Start Dummy Data*/
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
$msg = $disabled = '';
if (!class_exists('WPBakeryVisualComposerAbstract') or !class_exists('ZoThemeCore') or !function_exists('cptui_create_custom_post_types')){
    $disabled = ' disabled ';
    $msg='You should be install visual composer, ZoTheme and Custom Post Type UI plugins to import data.';
}
$this->sections[] = array(
    'icon' => 'el-icon-briefcase',
    'title' => __('Demo Content', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => '<input type=\'button\' name=\'sample\' id=\'dummy-data\' '.$disabled.' value=\'Import Now\' /><div class=\'zo-dummy-process\'><div  class=\'zo-dummy-process-bar\'></div></div><div id=\'zo-msg\'><span class="zo-status"></span>'.$msg.'</div>',
            'id' => 'theme',
            'icon' => true,
            'default' => 'charity',
            'options' => array(
                'charity' => get_template_directory_uri().'/assets/images/dummy/charity.png'
            ),
            'type' => 'image_select',
            'title' => 'Select Theme'
        )
    )
);
/* End Dummy Data*/
/**
 * Header Options
 * 
 * @author ZoTheme
 */
$this->sections[] = array(
    'title' => __('Header', THEMENAME),
    'icon' => 'el-icon-credit-card',
    'fields' => array(
        array(
            'id' => 'header_layout',
            'title' => __('Layouts', THEMENAME),
            'subtitle' => __('select a layout for header', THEMENAME),
            'default' => '',
            'type' => 'image_select',
            'options' => array(
                '' => get_template_directory_uri().'/inc/options/images/header/h-default.png'
            )
        ),
        array(
            'id'       => 'header_height',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'title'    => __('Header Height', THEMENAME),
            'output' => array('#zo-header'),
            'width' => false,
            'default'  => array(
                'height'  => '100px'
            ),
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'header_margin',
            'title' => __('Margin', THEMENAME),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('body #zo-header'),
            'default' => array(
                'margin-top'     => '0',
                'margin-right'   => '0',
                'margin-bottom'  => '0',
                'margin-left'    => '0',
                'units'          => 'px',
            )
        ),
        array(
            'subtitle' => __('in pixels, top right bottom left, ex: 10px 10px 10px 10px', THEMENAME),
            'id' => 'header_padding',
            'title' => __('Padding', THEMENAME),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('body #zo-header'),
            'default' => array(
                'padding-top'     => '0',
                'padding-right'   => '0',
                'padding-bottom'  => '0',
                'padding-left'    => '0',
                'units'          => 'px',
            )
        ),
        array(
            'subtitle' => __('enable sticky mode for menu.', THEMENAME),
            'id' => 'menu_sticky',
            'type' => 'switch',
            'title' => __('Sticky Header', THEMENAME),
            'default' => false,
        ),
        array(
            'id'       => 'menu_sticky_height',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'title'    => __('Sticky Header Height', THEMENAME),
            'width' => false,
            'default'  => array(
                'height'  => '80px'
            ),
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => __('enable sticky mode for menu Tablets.', THEMENAME),
            'id' => 'menu_sticky_tablets',
            'type' => 'switch',
            'title' => __('Sticky Tablets', THEMENAME),
            'default' => false,
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => __('enable sticky mode for menu Mobile.', THEMENAME),
            'id' => 'menu_sticky_mobile',
            'type' => 'switch',
            'title' => __('Sticky Mobile', THEMENAME),
            'default' => false,
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        )
    )
);

/* Header Top */

$this->sections[] = array(
    'title' => __('Header Top', THEMENAME),
    'icon' => 'el-icon-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Enable header top.', THEMENAME),
            'id' => 'enable_header_top',
            'type' => 'switch',
            'title' => __('Enable Header Top', THEMENAME),
            'default' => false,
        ),
        array(
            'id' => 'header_top_margin',
            'title' => __('Margin', THEMENAME),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('body #zo-header-top'),
            'default' => array(
                'margin-top'     => '0',
                'margin-right'   => '0',
                'margin-bottom'  => '0',
                'margin-left'    => '0',
                'units'          => 'px',
            ),
            'required' => array( 0 => 'enable_header_top', 1 => '=', 2 => 1 )
        ),
        array(
            'id' => 'header_top_padding',
            'title' => __('Padding', THEMENAME),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('body #zo-header-top'),
            'default' => array(
                'padding-top'     => '0',
                'padding-right'   => '0',
                'padding-bottom'  => '0',
                'padding-left'    => '0',
                'units'          => 'px',
            ),
            'required' => array( 0 => 'enable_header_top', 1 => '=', 2 => 1 )
        ),
    )
);

/* Logo */
$this->sections[] = array(
    'title' => __('Logo', THEMENAME),
    'icon' => 'el-icon-picture',
    'subsection' => true,
    'fields' => array(
        array(
            'title' => __('Select Logo', THEMENAME),
            'subtitle' => __('Select an image file for your logo.', THEMENAME),
            'id' => 'main_logo',
            'type' => 'media',
            'url' => true,
            'default' => array(
                'url'=>get_template_directory_uri().'/assets/images/logo.png'
            )
        ),
        array(
            'id'       => 'main_logo_height',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'title'    => __('Logo Height', THEMENAME),
            'width' => false,
            'default'  => array(
                'height'  => '100px'
            ),
        ),
        array(
            'id'       => 'sticky_logo_height',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'title'    => __('Sticky Logo Height', THEMENAME),
            'width' => false,
            'default'  => array(
                'height'  => '60px'
            ),
        ),
    )
);

/* Menu */
$this->sections[] = array(
    'title' => __('Menu', THEMENAME),
    'icon' => 'el-icon-tasks',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Menu position.', THEMENAME),
            'id' => 'menu_position',
            'title' => __('Menu Position', THEMENAME),
            'options' => array(
                1 => 'Menu Left',
                2 => 'Menu Right',
                3 => 'Menu Center',
            ),
            'type' => 'select',
            'default' => '2'
        ),
        array(
            'id' => 'menu_margin_first_level',
            'title' => __('Menu Margin - First Level', THEMENAME),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('#zo-header-navigation .main-navigation .menu-main-menu > li > a',
                '#zo-header-navigation .main-navigation .menu-main-menu > ul > li > a'),
            'default' => array(
                'margin-top'     => '0',
                'margin-right'   => '0',
                'margin-bottom'  => '0',
                'margin-left'    => '0',
                'units'          => 'px',
            )
        ),
        array(
            'id' => 'menu_padding_first_level',
            'title' => __('Menu Padding - First Level', THEMENAME),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('#zo-header-navigation .main-navigation .menu-main-menu > li > a',
                          '#zo-header-navigation .main-navigation .menu-main-menu > ul > li > a'),
            'default' => array(
                'padding-top'     => '0',
                'padding-right'   => '0',
                'padding-bottom'  => '0',
                'padding-left'    => '0',
                'units'          => 'px',
            )
        ),
        array(
            'id' => 'menu_fontsize_first_level',
            'type' => 'typography',
            'title' => __('Menu Font Size - First Level', THEMENAME),
            'google' => false,
            'font-backup' => false,
            'all_styles' => false,
            'color' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'line-height' => false,
            'text-align' => false,
            'output'  => array('#zo-header-navigation .main-navigation .menu-main-menu > li > a',
                                '#zo-header-navigation .main-navigation .menu-main-menu > ul > li > a'),
            'units' => 'px',
            'default' => array(
                'font-size' => '12px',
            )
        ),
        array(
            'id' => 'menu_fontsize_sub_level',
            'type' => 'typography',
            'title' => __('Menu Font Size - Sub Level', THEMENAME),
            'google' => false,
            'font-backup' => false,
            'all_styles' => false,
            'color' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'line-height' => false,
            'text-align' => false,
            'output'  => array('#zo-header-navigation .main-navigation .menu-main-menu > li ul a',
                                '#zo-header-navigation .main-navigation .menu-main-menu > ul > li ul a'),
            'units' => 'px',
            'default' => array(
                'font-size' => '12px',
            )
        ),
        array(
            'subtitle' => __('enable sub menu border bottom.', THEMENAME),
            'id' => 'menu_border_color_bottom',
            'type' => 'switch',
            'title' => __('Border Bottom Menu Item Sub Level', THEMENAME),
            'default' => false,
        ),
        array(
            'subtitle' => __('Enable mega menu.', THEMENAME),
            'id' => 'menu_mega',
            'type' => 'switch',
            'title' => __('Mega Menu', THEMENAME),
            'default' => true,
        ),
        array(
            'subtitle' => __('Enable menu first level uppercase.', THEMENAME),
            'id' => 'menu_first_level_uppercase',
            'type' => 'switch',
            'title' => __('Menu First Level Uppercase', THEMENAME),
            'default' => false,
        ),
        array(
            'id' => 'menu_icon_font_size',
            'type' => 'typography',
            'title' => __('Menu Icon Font Size', THEMENAME),
            'google' => false,
            'font-backup' => false,
            'all_styles' => false,
            'color' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'line-height' => false,
            'text-align' => false,
            'output'  => array('#zo-header.zo-main-header .menu-main-menu > li > a i'),
            'units' => 'px',
            'default' => array(
                'font-size' => '12px',
            )
        ),
    )
);

/* Stick Menu */
$this->sections[] = array(
    'title' => __('Stick Menu', THEMENAME),
    'icon' => 'el-icon-tasks',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'stick_menu_fontsize_first_level',
            'type' => 'typography',
            'title' => __('Stick Menu Font Size - First Level', THEMENAME),
            'google' => false,
            'font-backup' => false,
            'all_styles' => false,
            'color' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'line-height' => false,
            'text-align' => false,
            'output'  => array('#zo-header.header-fixed #zo-header-navigation .main-navigation .menu-main-menu > li > a',
                '#zo-header.header-fixed #zo-header-navigation .main-navigation .menu-main-menu > ul > li > a'),
            'units' => 'px',
            'default' => array(
                'font-size' => '12px',
            )
        ),
        array(
            'id' => 'sticky_menu_fontsize_sub_level',
            'type' => 'typography',
            'title' => __('Sticky Menu Font Size - Sub Level', THEMENAME),
            'google' => false,
            'font-backup' => false,
            'all_styles' => false,
            'color' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'line-height' => false,
            'text-align' => false,
            'output'  => array('#zo-header.header-fixed #zo-header-navigation .main-navigation .menu-main-menu > li ul li a',
                      '#zo-header.header-fixed #zo-header-navigation .main-navigation .menu-main-menu > ul > li ul li a '),
            'units' => 'px',
            'default' => array(
                'font-size' => '12px',
            )
        ),
        array(
            'id' => 'sticky_menu_icon_font_size',
            'type' => 'typography',
            'title' => __('Sticky Menu Icon Font Size', THEMENAME),
            'google' => false,
            'font-backup' => false,
            'all_styles' => false,
            'color' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'line-height' => false,
            'text-align' => false,
            'output'  => array('#zo-header.zo-main-header.header-fixed .menu-main-menu > li > a i'),
            'units' => 'px',
            'default' => array(
                'font-size' => '12px',
            )
        ),

    )
);

/**
 * Page Title
 *
 * @author ZoTheme
 */
$this->sections[] = array(
    'title' => __('Page Title & BC', THEMENAME),
    'icon' => 'el-icon-map-marker',
    'fields' => array(
        array(
            'id' => 'page_title_layout',
            'title' => __('Layouts', THEMENAME),
            'subtitle' => __('select a layout for page title', THEMENAME),
            'default' => '5',
            'type' => 'image_select',
            'options' => array(
                '' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-0.png',
                '1' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-1.png',
                '2' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-2.png',
                '3' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-3.png',
                '4' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-4.png',
                '5' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-5.png',
                '6' => get_template_directory_uri().'/inc/options/images/pagetitle/pt-s-6.png',
            )
        ),
        array(
            'id'       => 'page_title_background',
            'type'     => 'background',
            'title'    => __( 'Background', THEMENAME ),
            'subtitle' => __( 'page title background with image, color, etc.', THEMENAME ),
            'output'   => array('.page-title'),
            'default'   => array(
                'background-color'=>'#fcc403',
                'background-image'=> '',
                'background-repeat'=>'no-repeat',
                'background-size'=>'cover',
                'background-attachment'=>'',
                'background-position'=>'center center'
            )
        ),
        array(
            'id' => 'page_title_margin',
            'title' => __('Margin', THEMENAME),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('body .page-title'),
            'default' => array(
                'margin-top'     => '0',
                'margin-right'   => '0',
                'margin-bottom'  => '70px',
                'margin-left'    => '0',
                'units'          => 'px',
            )
        ),
        array(
            'id' => 'page_title_padding',
            'title' => __('Padding', THEMENAME),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('body .page-title'),
            'default' => array(
                'padding-top'     => '100px',
                'padding-right'   => '0',
                'padding-bottom'  => '100px',
                'padding-left'    => '0',
                'units'          => 'px',
            )
        ),
    )
);
/* Page Title */
$this->sections[] = array(
    'icon' => 'el-icon-podcast',
    'title' => __('Page Title', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'page_title_typography',
            'type' => 'typography',
            'title' => __('Typography', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('.page-title #page-title-text h1'),
            'units' => 'px',
            'subtitle' => __('Typography option with title text.', THEMENAME),
            'default' => array(
                'color' => '#333',
                'font-style' => 'normal',
                'font-weight' => '400',
                'font-family' => 'Lato',
                'google' => true,
                'font-size' => '24px',
                'line-height' => '38px',
                'text-align' => 'center'
            )
        ),
    )
);
/* Breadcrumb */
$this->sections[] = array(
    'icon' => 'el-icon-random',
    'title' => __('Breadcrumb', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('The text before the breadcrumb home.', THEMENAME),
            'id' => 'breacrumb_home_prefix',
            'type' => 'text',
            'title' => __('Breadcrumb Home Prefix', THEMENAME),
            'default' => 'Home'
        ),
        array(
            'id' => 'breacrumb_typography',
            'type' => 'typography',
            'title' => __('Typography', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('.page-title #breadcrumb-text','.page-title #breadcrumb-text ul li a'),
            'units' => 'px',
            'subtitle' => __('Typography option with title text.', THEMENAME),
            'default' => array(
                'color' => '',
                'font-style' => 'normal',
                'font-weight' => '400',
                'font-family' => 'Lato',
                'google' => true,
                'font-size' => '15px',
                'line-height' => '25px',
                'text-align' => 'left'
            )
        ),
    )
);

/**
 * Body
 *
 * @author ZoTheme
 */
$this->sections[] = array(
    'title' => __('Body', THEMENAME),
    'icon' => 'el-icon-website',
    'fields' => array(
        array(
            'subtitle' => __('Set layout boxed default(Wide).', THEMENAME),
            'id' => 'body_layout',
            'type' => 'switch',
            'title' => __('Boxed Layout', THEMENAME),
            'default' => false,
        ),
        array(
            'id'       => 'body_background',
            'type'     => 'background',
            'title'    => __( 'Background', THEMENAME ),
            'subtitle' => __( 'body background with image, color, etc.', THEMENAME ),
            'output'   => array('body'),
        ),
        array(
            'id' => 'body_margin',
            'title' => __('Margin', THEMENAME),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('body #page'),
            'default' => array(
                'margin-top'     => '0',
                'margin-right'   => '0',
                'margin-bottom'  => '0',
                'margin-left'    => '0',
                'units'          => 'px',
            )
        ),
        array(
            'id' => 'body_padding',
            'title' => __('Padding', THEMENAME),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('body #page'),
            'default' => array(
                'padding-top'     => '0',
                'padding-right'   => '0',
                'padding-bottom'  => '0',
                'padding-left'    => '0',
                'units'          => 'px',
            )
        ),
    )
);

/**
 * Content
 * 
 * Archive, Pages, Single, 404, Search, Category, Tags .... 
 * @author ZoTheme
 */
$this->sections[] = array(
    'title' => __('Content', THEMENAME),
    'icon' => 'el-icon-compass',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'container_background',
            'type'     => 'background',
            'title'    => __( 'Background', THEMENAME ),
            'subtitle' => __( 'Container background with image, color, etc.', THEMENAME ),
            'output'   => array('#main'),
        ),
        array(
            'id' => 'container_margin',
            'title' => __('Margin', THEMENAME),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('body #page #main'),
            'default' => array(
                'margin-top'     => '0',
                'margin-right'   => '0',
                'margin-bottom'  => '0',
                'margin-left'    => '0',
                'units'          => 'px',
            )
        ),
        array(
            'id' => 'container_padding',
            'title' => __('Padding', THEMENAME),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('body #page #main'),
            'default' => array(
                'padding-top'     => '0',
                'padding-right'   => '0',
                'padding-bottom'  => '70px',
                'padding-left'    => '0',
                'units'          => 'px',
            )
        )
    )
);

/**
 * Page Loadding
 * 
 * 
 * @author ZoTheme
 */
$this->sections[] = array(
    'title' => __('Page Loadding', THEMENAME),
    'icon' => 'el-icon-compass',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Enable page loadding.', THEMENAME),
            'id' => 'enable_page_loadding',
            'type' => 'switch',
            'title' => __('Enable Page Loadding', THEMENAME),
            'default' => false,
        ),
        array(
            'subtitle' => __('Select Style Page Loadding.', THEMENAME),
            'id' => 'page_loadding_style',
            'type' => 'select',
            'options' => array(
                '1' => 'Style 1',
                '2' => 'Style 2'
            ),
            'title' => __('Page Loadding Style', THEMENAME),
            'default' => 'style-1',
            'required' => array( 0 => 'enable_page_loadding', 1 => '=', 2 => 1 )
        )     
    )
);

/**
 * Footer
 *
 * @author ZoTheme
 */
$this->sections[] = array(
    'title' => __('Footer', THEMENAME),
    'icon' => 'el-icon-credit-card',
);

/* Footer top */
$this->sections[] = array(
    'title' => __('Footer Top', THEMENAME),
    'icon' => 'el-icon-fork',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Enable footer top.', THEMENAME),
            'id' => 'enable_footer_top',
            'type' => 'switch',
            'title' => __('Enable Footer Top', THEMENAME),
            'default' => true,
        ),
        array(
            'id'       => 'footer_background',
            'type'     => 'background',
            'title'    => __( 'Background', THEMENAME ),
            'subtitle' => __( 'footer background with image, color, etc.', THEMENAME ),
            'output'   => array('footer #zo-footer-top'),
            'default'   => array(
                'background-color'=>'#333',
                'background-image'=> get_template_directory_uri().'/assets/images/bg-footer.jpg',
                'background-repeat'=>'repeat-x',
                'background-size'=>'cover',
                'background-attachment'=>'',
                'background-position'=>'center center'
            ),
            'required' => array( 0 => 'enable_footer_top', 1 => '=', 2 => 1 )
        ),
        array(
            'id' => 'footer_margin',
            'title' => __('Margin', THEMENAME),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('footer #zo-footer-top'),
            'default' => array(
                'margin-top'     => '0',
                'margin-right'   => '0',
                'margin-bottom'  => '0',
                'margin-left'    => '0',
                'units'          => 'px',
            ),
            'required' => array( 0 => 'enable_footer_top', 1 => '=', 2 => 1 )
        ),
        array(
            'id' => 'footer_padding',
            'title' => __('Padding', THEMENAME),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('footer #zo-footer-top'),
            'default' => array(
                'padding-top'     => '0',
                'padding-right'   => '0',
                'padding-bottom'  => '0',
                'padding-left'    => '0',
                'units'          => 'px',
            ),
            'required' => array( 0 => 'enable_footer_top', 1 => '=', 2 => 1 )
        ),
        array(
            'subtitle' => __('enable button back to top.', THEMENAME),
            'id' => 'footer_bottom_back_to_top',
            'type' => 'switch',
            'title' => __('Back To Top', THEMENAME),
            'default' => true,
        )
    )
);

/* footer botton */
$this->sections[] = array(
    'title' => __('Footer Bottom', THEMENAME),
    'icon' => 'el-icon-bookmark',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Enable footer bottom.', THEMENAME),
            'id' => 'enable_footer_bottom',
            'type' => 'switch',
            'title' => __('Enable Footer Bottom', THEMENAME),
            'default' => false,
        ),
        array(
            'id'       => 'footer_botton_background',
            'type'     => 'background',
            'title'    => __( 'Background', THEMENAME ),
            'subtitle' => __( 'background with image, color, etc.', THEMENAME ),
            'output'   => array('footer #zo-footer-bottom'),
            'default'   => array(),
            'required' => array( 0 => 'enable_footer_bottom', 1 => '=', 2 => 1 )
        ),
        array(
            'id' => 'footer_bottom_margin',
            'title' => __('Margin', THEMENAME),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'margin',
            'output' => array('footer #zo-footer-bottom'),
            'default' => array(
                'margin-top'     => '0',
                'margin-right'   => '0',
                'margin-bottom'  => '0',
                'margin-left'    => '0',
                'units'          => 'px',
            ),
            'required' => array( 0 => 'enable_footer_bottom', 1 => '=', 2 => 1 )
        ),
        array(
            'id' => 'footer_bottom_padding',
            'title' => __('Padding', THEMENAME),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('footer #zo-footer-bottom'),
            'default' => array(
                'padding-top'     => '100px',
                'padding-right'   => '0',
                'padding-bottom'  => '80px',
                'padding-left'    => '0',
                'units'          => 'px',
            ),
            'required' => array( 0 => 'enable_footer_bottom', 1 => '=', 2 => 1 )
        )
    )
);

/**
 * Button Option
 *
 * @author ZoTheme
 */
$this->sections[] = array(
    'title' => __('Button', THEMENAME),
    'icon' => 'el el-bold',
    'fields' => array(
        array(
            'id' => 'button_font_size',
            'type' => 'typography',
            'title' => __('Button Font Size', THEMENAME),
            'google' => false,
            'font-backup' => false,
            'all_styles' => false,
            'color' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'line-height' => false,
            'text-align' => false,
            'output'  => array('.btn , button, .button, input[type="submit"]'),
            'units' => 'px',
            'default' => array(
                'font-size' => '12px',
            )
        ),
        array(
            'subtitle' => __('Enable button uppercase.', THEMENAME),
            'id' => 'button_text_uppercase',
            'type' => 'switch',
            'title' => __('Button Text Uppercase', THEMENAME),
            'default' => true,
        )
    )
);

/* Button Default */
$this->sections[] = array(
    'icon' => 'el el-minus',
    'title' => __('Button Default', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'btn_default_padding',
            'title' => __('Button Default - Padding', THEMENAME),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('.btn , button, .button, input[type="submit"]'),
            'default' => array(
                'padding-top'     => '15px',
                'padding-right'   => '25px',
                'padding-bottom'  => '15px',
                'padding-left'    => '25px',
                'units'          => 'px',
            ),
        ),
        array(
            'id'       => 'btn_default_border',
            'type'     => 'border',
            'title'    => __('Button Default - Border', THEMENAME),
            'output'   => array('.btn , button, .button, input[type="submit"]'),
            'default'  => array(
                'border-style'  => 'solid',
                'border-color'  => '#f0ba00',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            )
        ),
        array(
            'id'       => 'btn_default_border_hover',
            'type'     => 'border',
            'title'    => __('Button Default - Border Hover', THEMENAME),
            'output'   => array('.btn:hover, button:hover, .button:hover, input[type="submit"]:hover,.btn:focus, button:focus, .button:focus, input[type="submit"]:focus'),
            'default'  => array(
                'border-style'  => 'solid',
                'border-color'  => '#f0ba00',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            )
        ),
        array(
            'id'       => 'btn_default_border_radius',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'title'    => __('Button Default - Border Radius', THEMENAME),
            'width' => false,
            'default'  => array(
                'height'  => '40px'
            ),
        ),
    )
);

/* Button Primary */
$this->sections[] = array(
    'icon' => 'el el-minus',
    'title' => __('Button Primary', THEMENAME),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'btn_primary_padding',
            'title' => __('Button Primary - Padding', THEMENAME),
            'type' => 'spacing',
            'units' => 'px',
            'mode' => 'padding',
            'output' => array('.btn.btn-primary'),
            'default' => array(
                'padding-top'     => '15px',
                'padding-right'   => '25px',
                'padding-bottom'  => '15px',
                'padding-left'    => '25px',
                'units'          => 'px',
            ),
        ),
        array(
            'id'       => 'btn_primary_border',
            'type'     => 'border',
            'title'    => __('Button Primary - Border', THEMENAME),
            'output'   => array('.btn.btn-primary'),
            'default'  => array(
                'border-style'  => 'solid',
                'border-color'  => '#fcc403',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            )
        ),
        array(
            'id'       => 'btn_primary_border_hover',
            'type'     => 'border',
            'title'    => __('Button Primary - Border Hover', THEMENAME),
            'output'   => array('.btn.btn-primary:hover, .btn.btn-primary:focus'),
            'default'  => array(
                'border-style'  => 'solid',
                'border-color'  => '#fcc403',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            )
        ),
        array(
            'id'       => 'btn_primary_border_radius',
            'type'     => 'dimensions',
            'units'    => array('px'),
            'title'    => __('Button Primary - Border Radius', THEMENAME),
            'width' => false,
            'default'  => array(
                'height'  => '40px'
            ),
        ),
    )
);
/**
 * Styling
 * 
 * css color.
 * @author ZoTheme
 */
$this->sections[] = array(
    'title' => __('Styling', THEMENAME),
    'icon' => 'el-icon-adjust',
    'fields' => array(
        array(
            'subtitle' => __('set color main color.', THEMENAME),
            'id' => 'primary_color',
            'type' => 'color',
            'title' => __('Primary Color', THEMENAME),
            'default' => '#fcc403'
        ),
        array(
            'id' => 'secondary_color',
            'type' => 'color',
            'title' => __('Secondary Color', THEMENAME),
            'default' => '#ffdd00'
        ),
        array(
            'subtitle' => __('set color for tags <a></a>.', THEMENAME),
            'id' => 'link_color',
            'type' => 'link_color',
            'title' => __('Link Color', THEMENAME),
            'output'  => array('a','.navigation .pagination a','.navigation .pagination .current','.event-grid .zo-event-info .zo-event-title a','.event-grid .zo-event-title a'),
			'default'  => array(
				'regular'  => '#333333',
				'hover'    => '#fcc403',// purple
			)
        ),
    )
);

/** Header Top Color **/
$this->sections[] = array(
    'title' => __('Header Top Color', THEMENAME),
    'icon' => 'el-icon-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Set background color header top.', THEMENAME),
            'id' => 'bg_header_top_color',
            'type' => 'color',
            'title' => __('Background Color', THEMENAME),
            'default' => 'transparent'
        ),
        array(
            'subtitle' => __('Set color header top.', THEMENAME),
            'id' => 'header_top_color',
            'type' => 'color',
            'title' => __('Font Color', THEMENAME),
            'default' => ''
        )
    )
);

/** Header Main Color **/
$this->sections[] = array(
    'title' => __('Header Main Color', THEMENAME),
    'icon' => 'el-icon-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('set color for header background color.', THEMENAME),
            'id' => 'bg_header',
            'type' => 'color_rgba',
            'title' => __('Header Background Color', THEMENAME),
            'default' => array('color'=>'#000','alpha'=>'1', 'rgba'=>'rgba(0,0,0,1)')
        )
    )
);

/** Sticky Header Color **/
$this->sections[] = array(
    'title' => __('Sticky Header', THEMENAME),
    'icon' => 'el-icon-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('set color for sticky header.', THEMENAME),
            'id' => 'bg_sticky_header',
            'type' => 'color_rgba',
            'title' => __('Sticky Background Color', THEMENAME),
            'default' => array('color'=>'#000','alpha'=>'0.6', 'rgba'=>'rgba(0,0,0,0.6)'),
            'required' => array( 0 => 'menu_sticky', 1 => '=', 2 => 1 )
        )
    )
);

/** Menu Color **/

$this->sections[] = array(
    'title' => __('Menu Color', THEMENAME),
    'icon' => 'el-icon-minus',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Controls the text color of first level menu items.', THEMENAME),
            'id' => 'menu_color_first_level',
            'type' => 'color',
            'title' => __('Menu Font Color - First Level', THEMENAME),
            'default' => '#FFF'
        ),
        array(
            'subtitle' => __('Controls the text hover color of first level menu items.', THEMENAME),
            'id' => 'menu_color_hover_first_level',
            'type' => 'color',
            'title' => __('Menu Font Color Hover - First Level', THEMENAME),
            'default' => '#fcc403'
        ),
        array(
            'subtitle' => __('Controls the text hover color of first level menu items.', THEMENAME),
            'id' => 'menu_color_active_first_level',
            'type' => 'color',
            'title' => __('Menu Font Color Active - First Level', THEMENAME),
            'default' => '#fcc403'
        ),
        array(
            'subtitle' => __('Controls the text color of sub level menu items.', THEMENAME),
            'id' => 'menu_color_sub_level',
            'type' => 'color',
            'title' => __('Menu Font Color - Sub Level', THEMENAME),
            'default' => '#333333'
        ),
        array(
            'subtitle' => __('Controls the text hover color of sub level menu items.', THEMENAME),
            'id' => 'menu_color_hover_sub_level',
            'type' => 'color',
            'title' => __('Menu Font Color Hover - Sub Level', THEMENAME),
            'default' => '#ffffff'
        ),
        array(
            'subtitle' => __('Controls the text background color of sub level menu items.', THEMENAME),
            'id' => 'menu_bg_color_sub_level',
            'type' => 'color',
            'title' => __('Menu Background Color - Sub Level', THEMENAME),
            'default' => '#f5f5f5'
        ),
        array(
            'subtitle' => __('Controls the text background color hover of sub level menu items.', THEMENAME),
            'id' => 'menu_bg_color_hover_sub_level',
            'type' => 'color',
            'title' => __('Menu Background Color Hover - Sub Level', THEMENAME),
            'default' => '#fcc401'
        ),
        array(
            'subtitle' => __('Controls the border color of sub level menu items.', THEMENAME),
            'id' => 'menu_item_border_color',
            'type' => 'color',
            'title' => __('Border Color - Sub Level', THEMENAME),
            'default' => '',
            'required' => array( 0 => 'menu_border_color_bottom', 1 => '=', 2 => 1 )
        )
    )
);

/** Button Color **/

$this->sections[] = array(
    'title' => __('Button Color', THEMENAME),
    'icon' => 'el el-bold',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Controls the button text color.', THEMENAME),
            'id' => 'btn_default_color',
            'type' => 'color',
            'title' => __('Button Default - Font Color', THEMENAME),
            'default' => '#000000'
        ),
        array(
            'subtitle' => __('Controls the button text hover color.', THEMENAME),
            'id' => 'btn_default_color_hover',
            'type' => 'color',
            'title' => __('Button Default - Font Color Hover', THEMENAME),
            'default' => '#ffffff'
        ),
        array(
            'subtitle' => __('Controls the button background color.', THEMENAME),
            'id' => 'btn_default_bg_color',
            'type' => 'color',
            'title' => __('Button Default - Background Color', THEMENAME),
            'default' => '#ffffff'
        ),
        array(
            'subtitle' => __('Controls the button background color.', THEMENAME),
            'id' => 'btn_default_bg_color_hover',
            'type' => 'color',
            'title' => __('Button Default - Background Color Hover', THEMENAME),
            'default' => '#f0ba00'
        ),
        array(
            'subtitle' => __('Controls the button text color.', THEMENAME),
            'id' => 'btn_primary_color',
            'type' => 'color',
            'title' => __('Button Primary - Font Color', THEMENAME),
            'default' => '#000000'
        ),
        array(
            'subtitle' => __('Controls the button text hover color.', THEMENAME),
            'id' => 'btn_primary_color_hover',
            'type' => 'color',
            'title' => __('Button Primary - Font Color Hover', THEMENAME),
            'default' => '#000000'
        ),
        array(
            'subtitle' => __('Controls the button background color.', THEMENAME),
            'id' => 'btn_primary_bg_color',
            'type' => 'color',
            'title' => __('Button Primary - Background Color', THEMENAME),
            'default' => '#fcc403'
        ),
        array(
            'subtitle' => __('Controls the button background color.', THEMENAME),
            'id' => 'btn_primary_bg_color_hover',
            'type' => 'color',
            'title' => __('Button Primary - Background Color Hover', THEMENAME),
            'default' => '#ffffff'
        ),
    )
);

/** Footer Top Color **/
$this->sections[] = array(
    'title' => __('Footer Top Color', THEMENAME),
    'icon' => 'el-icon-chevron-up',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Set color footer top.', THEMENAME),
            'id' => 'footer_top_color',
            'type' => 'color',
            'title' => __('Footer Top Color', THEMENAME),
            'default' => '#ffffff'
        ),
        array(
            'subtitle' => __('Set title color footer top.', THEMENAME),
            'id' => 'footer_headding_color',
            'type' => 'color',
            'title' => __('Footer Headding Color', THEMENAME),
            'default' => '#ffffff'
        ),
        array(
            'subtitle' => __('Set title link color footer top.', THEMENAME),
            'id' => 'footer_top_link_color',
            'type' => 'color',
            'title' => __('Footer Link Color', THEMENAME),
            'default' => '#ffffff'
        ),
        array(
            'subtitle' => __('Set title link color footer top.', THEMENAME),
            'id' => 'footer_top_link_color_hover',
            'type' => 'color',
            'title' => __('Footer Link Color Hover', THEMENAME),
            'default' => '#ffffff'
        )
    )
);

/** Footer Bottom Color **/
$this->sections[] = array(
    'title' => __('Footer Bottom Color', THEMENAME),
    'icon' => 'el-icon-chevron-down',
    'subsection' => true,
    'fields' => array(
        array(
            'subtitle' => __('Set color footer top.', THEMENAME),
            'id' => 'footer_bottom_color',
            'type' => 'color',
            'title' => __('Footer Bottom Color', THEMENAME),
            'default' => ''
        )
    )
);

/**
 * Typography
 * 
 * @author ZoTheme
 */
$this->sections[] = array(
    'title' => __('Typography', THEMENAME),
    'icon' => 'el-icon-text-width',
    'fields' => array(
        array(
            'id' => 'font_body',
            'type' => 'typography',
            'title' => __('Body Font', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body'),
            'units' => 'px',
            'default' => array(
                'color' => '#878787',
                'font-style' => 'normal',
                'font-weight' => '400',
                'font-family' => 'Lato',
                'google' => true,
                'font-size' => '14px',
                'line-height' => '25px',
                'text-align' => ''
            ),
            'subtitle' => __('Typography option with each property can be called individually.', THEMENAME),
        ),
        array(
            'id' => 'font_h1',
            'type' => 'typography',
            'title' => __('H1', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h1'),
            'units' => 'px',
            'default' => array(
                'color' => '#fcc402',
                'font-style' => 'normal',
                'font-weight' => '400',
                'font-family' => 'Lato',
                'google' => true,
                'font-size' => '30px',
                'line-height' => '33px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'font_h2',
            'type' => 'typography',
            'title' => __('H2', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h2'),
            'units' => 'px',
            'default' => array(
                'color' => '#fcc402',
                'font-style' => 'normal',
                'font-weight' => '400',
                'font-family' => 'Lato',
                'google' => true,
                'font-size' => '24px',
                'line-height' => '25px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'font_h3',
            'type' => 'typography',
            'title' => __('H3', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h3'),
            'units' => 'px',
            'default' => array(
                'color' => '#fcc402',
                'font-style' => 'normal',
                'font-weight' => '400',
                'font-family' => 'Lato',
                'google' => true,
                'font-size' => '20px',
                'line-height' => '20px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'font_h4',
            'type' => 'typography',
            'title' => __('H4', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h4'),
            'units' => 'px',
            'default' => array(
                'color' => '#fcc402',
                'font-style' => 'normal',
                'font-weight' => '400',
                'font-family' => 'Lato',
                'google' => true,
                'font-size' => '18px',
                'line-height' => '18px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'font_h5',
            'type' => 'typography',
            'title' => __('H5', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h5'),
            'units' => 'px',
            'default' => array(
                'color' => '#fcc402',
                'font-style' => 'normal',
                'font-weight' => '400',
                'font-family' => 'Lato',
                'google' => true,
                'font-size' => '16px',
                'line-height' => '16px',
                'text-align' => ''
            )
        ),
        array(
            'id' => 'font_h6',
            'type' => 'typography',
            'title' => __('H6', THEMENAME),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output'  => array('body h6'),
            'units' => 'px',
            'default' => array(
                'color' => '#fcc402',
                'font-style' => 'normal',
                'font-weight' => '400',
                'font-family' => 'Lato',
                'google' => true,
                'font-size' => '14px',
                'line-height' => '16px',
                'text-align' => ''
            )
        )
    )
);

/* extra font. */
$this->sections[] = array(
    'title' => __('Extra Fonts', THEMENAME),
    'icon' => 'el el-fontsize',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'google-font-1',
            'type' => 'typography',
            'title' => __('Font 1', THEMENAME),
            'google' => true,
            'font-backup' => false,
            'font-style' => false,
            'color' => false,
            'text-align'=> false,
            'line-height'=>false,
            'font-size'=> false,
            'subsets'=> false,
            'default' => array(
                'font-weight' => '400',
                'font-family' => 'Lato'
            )
        ),
        array(
            'id' => 'google-font-selector-1',
            'type' => 'textarea',
            'title' => __('Selector 1', THEMENAME),
            'subtitle' => __('add html tags ID or class (body,a,.class,#id)', THEMENAME),
            'validate' => 'no_html',
            'default' => 'body .btn, #secondary .wg-title, #comments .comments-title, #comments .comment-reply-title',
        ),
        array(
            'id' => 'google-font-2',
            'type' => 'typography',
            'title' => __('Font 2', THEMENAME),
            'google' => true,
            'font-backup' => false,
            'font-style' => false,
            'color' => false,
            'text-align'=> false,
            'line-height'=>false,
            'font-size'=> false,
            'subsets'=> false,
            'default' => array(
                'font-weight' => '700',
                'font-family' => 'Lato'
            )
        ),
        array(
            'id' => 'google-font-selector-2',
            'type' => 'textarea',
            'title' => __('Selector 2', THEMENAME),
            'subtitle' => __('add html tags ID or class (body,a,.class,#id)', THEMENAME),
            'validate' => 'no_html',
            'default' => '#zo-footer-top .wg-title',
        ),
    )
);

/* local fonts. */
$this->sections[] = array(
    'title' => __('Local Fonts', THEMENAME),
    'icon' => 'el-icon-bookmark',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'local-fonts-1',
            'type'     => 'select',
            'title'    => __( 'Fonts 1', THEMENAME ),
            'options'  => $local_fonts,
            'default'  => '',
        ),
        array(
            'id' => 'local-fonts-selector-1',
            'type' => 'textarea',
            'title' => __('Selector 1', THEMENAME),
            'subtitle' => __('add html tags ID or class (body,a,.class,#id)', THEMENAME),
            'validate' => 'no_html',
            'default' => '',
            'required' => array(
                0 => 'local-fonts-1',
                1 => '!=',
                2 => ''
            )
        ),
        array(
            'id'       => 'local-fonts-2',
            'type'     => 'select',
            'title'    => __( 'Fonts 2', THEMENAME ),
            'options'  => $local_fonts,
            'default'  => '',
        ),
        array(
            'id' => 'local-fonts-selector-2',
            'type' => 'textarea',
            'title' => __('Selector 2', THEMENAME),
            'subtitle' => __('add html tags ID or class (body,a,.class,#id)', THEMENAME),
            'validate' => 'no_html',
            'default' => '',
            'required' => array(
                0 => 'local-fonts-2',
                1 => '!=',
                2 => ''
            )
        )
    )
);

/**
 * Custom CSS
 * 
 * extra css for customer.
 * @author ZoTheme
 */
$this->sections[] = array(
    'title' => __('Custom CSS', THEMENAME),
    'icon' => 'el-icon-bulb',
    'fields' => array(
        array(
            'id' => 'custom_css',
            'type' => 'ace_editor',
            'title' => __('CSS Code', THEMENAME),
            'subtitle' => __('create your css code here.', THEMENAME),
            'mode' => 'css',
            'theme' => 'monokai',
        )
    )
);
/**
 * Animations
 *
 * Animations options for theme. libs css, js.
 * @author ZoTheme
 */
$this->sections[] = array(
    'title' => __('Animations', THEMENAME),
    'icon' => 'el-icon-magic',
    'fields' => array(
        array(
            'subtitle' => __('Enable animation mouse scroll...', THEMENAME),
            'id' => 'smoothscroll',
            'type' => 'switch',
            'title' => __('Smooth Scroll', THEMENAME),
            'default' => false
        ),
        array(
            'subtitle' => __('Enable animation parallax for images...', THEMENAME),
            'id' => 'paralax',
            'type' => 'switch',
            'title' => __('Images Paralax', THEMENAME),
            'default' => true
        ),
    )
);
/**
 * Optimal Core
 * 
 * Optimal options for theme. optimal speed
 * @author ZoTheme
 */
$this->sections[] = array(
    'title' => __('Optimal Core', THEMENAME),
    'icon' => 'el-icon-idea',
    'fields' => array(
        array(
            'subtitle' => __('no minimize , generate css over time...', THEMENAME),
            'id' => 'dev_mode',
            'type' => 'switch',
            'title' => __('Dev Mode (not recommended)', THEMENAME),
            'default' => false
        )
    )
);

/**
 * Google API
 *
 * Google API option for manager API
 * @author VnZacky
 */
$this->sections[] = array(
    'title' => __('Google API', THEMENAME),
    'icon' => 'el-icon-googleplus',
    'fields' => array(
        array(
            'title' => __('Enable The Google Calendar', THEMENAME),
            'id' => 'google_calendar',
            'type' => 'switch',
            'default' => true
        ),
        array(
            'title' => __('Google Calendar API', THEMENAME),
            'subtitle' => __('Client ID for web application', THEMENAME),
            'desc' => __('<ol>
                            <li>Use <a href="'. esc_url("https://console.developers.google.com/start/api?id=calendar") .'" target="_blank">this wizard</a>
                               to create or select a project in the Google Developers Console and
                               automatically enable the API.</li>
                            <li>In the sidebar on the left, select <strong>Consent screen</strong>. Select an
                               <strong>EMAIL ADDRESS</strong> and enter a <strong>PRODUCT NAME</strong> if not already set and click
                               the <strong>Save</strong> button.</li>
                            <li>In the sidebar on the left, select <strong>Credentials</strong> and click <strong>Create new
                               Client ID</strong>.
                            </li>
                            <li>
                            Select the application type <strong>Web application</strong>. In the <strong>Authorized
                            JavaScript Origins</strong> field enter the URL http://localhost:8000. You
                            can leave the <strong>Authorized Redirect URIs</strong> field blank. Then click
                            the <strong>Create Client ID</strong> button.
                            </li>
                            </ol>', THEMENAME),
            'id' => 'google_calendar_api',
            'type' => 'text',
            'default' => '482870234107-gu86qoilapm0efqeg4da42v0def6gdc0.apps.googleusercontent.com',
            'required' => array( 'google_calendar', '=', 1 )
        )

    )
);