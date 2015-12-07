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

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-blog entry-post">
		<div class="entry-header">
		    <div class="entry-feature entry-quote"><?php $quote = zo_archive_quote(); ?></div>
		</div>
        <div class="entry-meta"><?php zo_archive_detail(); ?></div>
        <!-- .entry-header -->
        <h2 class="entry-title"><?php the_title(); ?></h2>
		<div class="entry-content">
		    <?php if($quote){ echo apply_filters('the_content', preg_replace('/<blockquote>(.*)<\/blockquote>/', '', get_the_content()));} else { the_content(); }
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
