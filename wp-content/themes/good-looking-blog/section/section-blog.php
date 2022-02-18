<?php
/**
 * Blog Section 
 * 
 * @package Good_Looking_Blog
 */

$blog_section_title = get_theme_mod( 'blog_section_title', __( 'Blog Posts', 'good-looking-blog' ) );
$ed_blog_section    = get_theme_mod( 'ed_blog_section', false );

if( ! $ed_blog_section && !( 'page' == get_option( 'show_on_front' ) ) && ( have_posts() || is_active_sidebar( 'blog' ) ) ){ ?>
    <section id="blog_section" class="blog-posts-section<?php echo is_active_sidebar( 'sidebar' ) ? esc_attr( ' blog-sidebar-activate' ) : esc_attr( ' blog-sidebar-deactivate' ); ?>">
        <div class="container">
            <div id="primary" class="content-area">
                <div class="page-grid">                   
                    <div id="main" class="site-main">
                        <?php if( $blog_section_title ){ ?>
                            <header class="section-header">
                                <h2 class="section-title">
                                    <?php echo esc_html( $blog_section_title ); ?>
                                </h2>
                            </header>
                        <?php } ?>
                            <div class="blog-post-wrapper">
                                <?php 
                                while ( have_posts() ){ 
                                    the_post(); 
                                    get_template_part( 'template-parts/content', get_post_type() );
                                } wp_reset_postdata(); ?>
                            </div>
                        <?php good_looking_blog_nav(); ?>
                    </div>
                    <?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
                        <aside id="secondary" class="widget-area">
                            <ul id="sidebar">
                                <?php dynamic_sidebar( 'sidebar' ); ?>
                            </ul>
                        </aside>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php }