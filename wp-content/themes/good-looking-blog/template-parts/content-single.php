<?php
/**
 * Template part for displaying post content in single.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Good_Looking_Blog
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-image">
		<?php 
		/**
		 * Post thumbnail
		 */
		good_looking_blog_post_thumbnail(); 
		/**
		 * Entry Header
		 */
		do_action( 'good_looking_blog_post_entry_header' );
		?>		
	</div>
	<div class="content-wrap">
		<?php 
		/**
		 * @hooked good_looking_blog_entry_content - 15
		 * @hooked good_looking_blog_entry_footer - 20
		 */
		do_action( 'good_looking_blog_post_entry_content' ) ; 
		?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
