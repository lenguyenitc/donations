<?php
/**
 * The Template for displaying all single posts
 *
 * @package ZoTheme
 * @subpackage Zo Theme
 * @since 1.0.0
 */

get_header(); ?>
    <div class="<?php zo_main_class(); ?>">
        <div class="row">
            <div id="primary" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div id="content" role="main">

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php get_template_part( 'single-templates/causes/content'); ?>

                        <?php zo_post_nav(); ?>

                        <?php comments_template( '', true ); ?>

                    <?php endwhile; // end of the loop. ?>

                </div><!-- #content -->
            </div><!-- #primary -->
        </div>
    </div>
<?php get_footer(); ?>