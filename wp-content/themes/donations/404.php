<?php
/**
 * The template for displaying 404 pages (Not Found)
 * 
 * @package ZoTheme
 * @subpackage Zo Theme
 * @since 1.0.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main" class="container">

			<article id="post-0" class="entry-error404 no-results not-found">
				<header class="entry-header">
                    <img src="<?php print get_template_directory_uri(); ?>/assets/images/direction.png" alt="<?php _e('404 Page Not Found', THEMENAME); ?>" />
                    <h1><?php _e('404', THEMENAME); ?></h1>
                    <h2><?php _e('PAGE NOT FOUND', THEMENAME); ?></h2>
				</header>

				<div class="entry-content">
                    <p><?php _e('Whoops, sorry, this page does not exist.', THEMENAME); ?></p>
				</div><!-- .entry-content -->
                
                <footer class="entry-footer">
                    <a class="btn btn-default btn-home" href="<?php echo home_url(); ?>"><?php _e('Go Back Home', THEMENAME); ?></a>
                </footer>
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>