<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package ZoTheme
 * @subpackage Zo Theme
 * @since 1.0.0
 */
global $smof_data;
?>
    </div><!-- #main -->
    <footer>
        <?php if ( isset($smof_data['footer_bottom_back_to_top']) && $smof_data['footer_bottom_back_to_top'] == '1' ): ?>
        <div id="scroll_to_top"><i class="fa fa-angle-up"></i></div>
        <?php endif; ?>
        <?php if ( isset($smof_data['enable_footer_top']) && $smof_data['enable_footer_top'] == '1' ): ?>
            <div id="zo-footer-top">
                <div class="container">
                    <div class="row">
                        <?php if (is_active_sidebar('sidebar-5')) : ?>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3"><?php dynamic_sidebar('sidebar-5'); ?></div>
                        <?php endif; ?>
                        <?php if (is_active_sidebar('sidebar-6')) : ?>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3"><?php dynamic_sidebar('sidebar-6'); ?></div>
                        <?php endif; ?>
                        <?php if (is_active_sidebar('sidebar-7')) : ?>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3"><?php dynamic_sidebar('sidebar-7'); ?></div>
                        <?php endif; ?>
                        <?php if (is_active_sidebar('sidebar-8')) : ?>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3"><?php dynamic_sidebar('sidebar-8'); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ( isset($smof_data['enable_footer_bottom']) && $smof_data['enable_footer_bottom'] == '1'): ?>
            <div id="zo-footer-bottom">
                <div class="container">
                    <div class="row">
                        <?php if (is_active_sidebar('sidebar-9')) : ?>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php dynamic_sidebar('sidebar-9'); ?></div>
                        <?php endif; ?>
                        <?php if (is_active_sidebar('sidebar-10')) : ?>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php dynamic_sidebar('sidebar-10'); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </footer><!-- #site-footer -->
    </div><!-- #page -->
    <?php wp_footer(); ?>
</body>
</html>