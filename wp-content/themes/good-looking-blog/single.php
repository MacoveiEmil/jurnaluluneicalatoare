<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Good_Looking_Blog
 */

get_header();
?>
	<div id="primary" class="content-area">
		<div class="container">
            <div class="breadcrumb-wrapper">
				<?php good_looking_blog_breadcrumb(); ?>
			</div>
			<div class="page-grid">
				<main id="main" class="site-main">
					<?php
						while ( have_posts() ) :
							
							the_post();

							get_template_part( 'template-parts/content', 'single' );

						endwhile; // End of the loop.

						good_looking_blog_author_box(); 
						
						good_looking_blog_nav(); 
						
						good_looking_blog_get_related_posts();

						good_looking_blog_get_comments(); 
					
					?>
				</main><!-- #main -->
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
<?php
get_footer();
