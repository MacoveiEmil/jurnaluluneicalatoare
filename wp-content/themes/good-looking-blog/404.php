<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Good_Looking_Blog
 */

get_header();

good_looking_blog_breadcrumb();
?>
    <div class="content-area" id="primary">
        <div class="container">
            <div id="main" class="site-main">
                <section class="error-404 not-found">
                    <header class="page-header">
                        <h2 class="page-title">
                        <span><?php echo esc_html__( '404', 'good-looking-blog' ); ?></span>
                            <?php echo esc_html__( 'page not found', 'good-looking-blog' ); ?>
                        </h2>
                        <div class="subtitle">
                            <p><?php echo esc_html__( 'Oops! The page you’re looking for does not exist.
                                It might have been removed. Try the search below...', 'good-looking-blog' ); ?></p>
                        </div>
                        <div class="error404-search">
							<?php get_search_form(); ?>
                        </div>
                    </header>
                </section>
                <!-- End of error section -->
                <div class="additional-post">
					<?php good_looking_blog_get_posts_list( 'latest' ); ?>
                </div>
            </div>

        </div>
    </div>

<?php
get_footer();
