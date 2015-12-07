<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package ZoTheme
 * @subpackage Zo Theme
 * @since 1.0.0
 */
?>
<?php
global $smof_data;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-blog entry-post">
        <?php if(has_post_thumbnail()) : ?>
        <div class="entry-header">
            <div class="entry-feature entry-feature-image">
                    <?php the_post_thumbnail( 'full' ); ?>
            </div>
        </div>
        <?php endif ?>
        <div class="entry-meta"><?php zo_archive_detail(); ?></div>
        <!-- .entry-header -->
        <h2 class="entry-title"><?php the_title(); ?></h2>
		<div class="entry-content">
			<?php the_content();
	    		wp_link_pages( array(
	        		'before'      => '<div class="pagination loop-pagination"><span class="page-links-title">' . __( 'Pages:',THEMENAME) . '</span>',
	        		'after'       => '</div>',
	        		'link_before' => '<span class="page-numbers">',
	        		'link_after'  => '</span>',
	    		) );
			?>
		</div>
		<!-- .entry-content -->
	</div>
	<!-- .entry-blog -->
</article>
<!-- #post -->
