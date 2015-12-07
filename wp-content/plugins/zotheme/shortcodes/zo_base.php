<?php

/**
 * Base shortcode for all LessTheme Shortcodes
 */

class ZoShortcode extends WPBakeryShortCode {

    protected function loadTemplate($atts, $content = null) {
        $output = '';
        $zo_template = isset($atts['zo_template']) ? $atts['zo_template'] : $this->shortcode.'.php';
        $files = $this->findShortcodeTemplates();
        if ($zo_template && isset($files[$zo_template])) {
            $this->setTemplate($files[$zo_template]->uri);
        } else {
            $this->findShortcodeTemplate();
        }
        if (!is_null($content))
            $content = apply_filters('vc_shortcode_content_filter', $content, $this->shortcode);
        if ($this->html_template) {
            ob_start();
            include( $this->html_template );
            $output = ob_get_contents();
            ob_end_clean();
        } else {
            trigger_error(sprintf(__('Template file is missing for `%s` shortcode. Make sure you have `%s` file in your theme folder.', 'js_composer'), $this->shortcode, 'wp-content/themes/your_theme/vc_templates/' . $this->shortcode . '.php'));
        }
        return apply_filters('vc_shortcode_content_filter_after', $output, $this->shortcode);
    }

    /**
     * 
     * @return Array(): array of all avaiable templates
     */
    protected function findShortcodeTemplates() {
        $theme_dir = get_template_directory() . '/vc_templates';
        $reg = "/^({$this->shortcode}\.php|{$this->shortcode}--.*\.php)/";
        $files = zoFileScanDirectory($theme_dir, $reg);
        $files = array_merge(zoFileScanDirectory(ZO_TEMPLATES, $reg), $files);
        return $files;
    }

}
