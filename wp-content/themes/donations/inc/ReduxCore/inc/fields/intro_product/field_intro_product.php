<?php

/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @subpackage  Field_Info
 * @author      Daniel J Griffiths (Ghost1227)
 * @author      Dovy Paukstys
 * @version     3.0.0
 */

// Exit if accessed directly
if (! defined('ABSPATH')) {
    exit();
}

// Don't duplicate me!
if (! class_exists('ReduxFramework_intro_product')) {

    /**
     * Main ReduxFramework_info class
     *
     * @since 1.0.0
     */
    class ReduxFramework_intro_product
    {

        /**
         * Field Constructor.
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since 1.0.0
         * @access public
         * @return void
         */
        function __construct($field = array(), $value = '', $parent)
        {
            $this->parent = $parent;
            $this->field  = $field;
            $this->value  = $value;
        }

        /**
         * Field Render Function.
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since 1.0.0
         * @access public
         * @return void
         */
        public function render()
        {
            $theme = wp_get_theme();
            
            echo '</td></tr></table>';
            ?>
            <div class="intro-product">
                <div class="zo-logo"><img alt="ZOTHEME" src="<?php echo get_template_directory_uri() . '/assets/images/zotheme.png'; ?>"></div>
                <div class="zo-tools">
                    <ul>
                        <li><a href="#"><i class="dashicons dashicons-album"></i><span>V<?php echo esc_attr($theme->get('Version')); ?></span></a></li>
                        <li><a href="<?php echo esc_url('http://zotheme.com/forum'); ?>"><i class="dashicons dashicons-groups"></i><span><?php esc_html_e("Forum Support", 'redux-framework'); ?></span></a></li>
                        <li><a href="<?php echo esc_url('http://themeforest.net/user/ZOTHEME/portfolio?WT.ac=portfolio_item&WT.z_author=ZOTHEME'); ?>"><i class="dashicons dashicons-products"></i><span><?php esc_html_e("ZOTHEME", 'redux-framework'); ?></span></a></li>
                        <li><a href="mailto:wp@zotheme.com"><i class="dashicons dashicons-email"></i><span><?php esc_html_e("Contact Now", 'redux-framework'); ?></span></a></li>
                    </ul>
                </div>
                <div class="zo-content">
                    <p><?php echo esc_attr($theme->get('Description')); ?></p>
                </div>
            </div>
            <?php
        }

        /**
         * Enqueue Function.
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since 1.0.0
         * @access public
         * @return void
         */
        public function enqueue()
        {
            wp_enqueue_style(
                'redux-field-intro-product-css',
                ReduxFramework::$_url . 'inc/fields/intro_product/field_intro_product.css',
                array(),
                time(),
                'all'
            );
        }
    }
}