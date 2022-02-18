<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Good_Looking_Blog
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="https://schema.org/Blog">
	
	<div class="image">
		<?php good_looking_blog_post_thumbnail(); ?>
	</div>

	<?php 
		if( ! is_front_page() ) echo '<div class="archive-content-wrapper">'; 
		/* 
		@hooked good_looking_blog_entry_header 
		*/
		do_action( 'good_looking_blog_post_entry_header' ); 
		/**
		 * @hooked good_looking_blog_entry_content - 15
		 * @hooked good_looking_blog_entry_footer - 20
		 */
		do_action( 'good_looking_blog_post_entry_content' ); 
		
		if ( ! is_front_page() ) echo '</div>'; 
	?>

</article><!-- #post-<?php the_ID(); ?> -->
