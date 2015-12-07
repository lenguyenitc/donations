<?php

/**
 * Auto create css from Meta Options.
 * 
 * @author ZoTheme
 * @version 1.0.0
 */
class ZoTheme_DynamicCss
{

    function __construct()
    {
        add_action('wp_head', array($this, 'generate_css'));
    }

    /**
     * generate css inline.
     *
     * @since 1.0.0
     */
    public function generate_css()
    {
        global $smof_data, $zo_base;
        $css = $this->css_render();
        if (! $smof_data['dev_mode']) {
            $css = $zo_base->compressCss($css);
        }
        echo '<style type="text/css" data-type="zo_shortcodes-custom-css">'.$css.'</style>';
    }

    /**
     * header css
     *
     * @since 1.0.0
     * @return string
     */
    public function css_render()
    {
        global $smof_data, $zo_meta;
        ob_start();

        /* custom css.  */
        echo wp_filter_nohtml_kses(trim($smof_data['custom_css']))."\n";
        /* ==========================================================================
           Start Header
        ========================================================================== */
            /* Header Fixed Only Page */
            if (!empty($zo_meta->_zo_header_fixed_bg_color)) {
                echo "#zo-header.header-fixed-page {
                    background-color: ".esc_attr($zo_meta->_zo_header_fixed_bg_color).";
                }"."\n";
            }
            if (!empty($zo_meta->_zo_header_fixed_bg_color)) {
                echo "#zo-header.header-fixed-page {
                    background-color: ".esc_attr($zo_meta->_zo_header_fixed_bg_color).";
                }"."\n";
            }
            /* End Header Fixed Only Page */

            /* Menu Fixed Only Page */
            if (!empty($zo_meta->_zo_header_fixed_menu_color)) {
                echo "#zo-header.header-fixed-page #zo-header-navigation .main-navigation #menu-main-menu > li > a {
                    color: ".esc_attr($zo_meta->_zo_header_fixed_menu_color).";
                }"."\n";
            }
            if (!empty($zo_meta->_zo_header_fixed_menu_color_hover)) {
                echo "#zo-header.header-fixed-page #zo-header-navigation .main-navigation #menu-main-menu > li > a:hover {
                    color: ".esc_attr($zo_meta->_zo_header_fixed_menu_color_hover).";
                }"."\n";
            }
            if (!empty($zo_meta->_zo_header_fixed_menu_color_active)) {
                echo "#zo-header.header-fixed-page #zo-header-navigation .main-navigation #menu-main-menu > li.current-menu-item > a,
                    #zo-header.header-fixed-page #zo-header-navigation .main-navigation #menu-main-menu > li.current-menu-ancestor > a,
                    #zo-header.header-fixed-page #zo-header-navigation .main-navigation #menu-main-menu > li.current_page_item > a,
                    #zo-header.header-fixed-page #zo-header-navigation .main-navigation #menu-main-menu > li.current_page_ancestor > a {
                    color: ".esc_attr($zo_meta->_zo_header_fixed_menu_color_active).";
                }"."\n";
            }
            /* End Menu Fixed Only Page */
            /* Start Page Title */
            if (!empty($zo_meta->_zo_page_title_margin)) {
                echo "body #page .page-title {
                    margin: ".esc_attr($zo_meta->_zo_page_title_margin).";
                }"."\n";
            }
            /* End Page Title */
        /* ==========================================================================
           End Header
        ========================================================================== */
        return ob_get_clean();
    }
}

new ZoTheme_DynamicCss();