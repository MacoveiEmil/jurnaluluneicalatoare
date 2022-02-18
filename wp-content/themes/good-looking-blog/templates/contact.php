<?php 
/**
 * Template Name: Contact page
*  
 * @package Good_Looking_Blog
 */   

$ed_googlemap = get_theme_mod( 'ed_googlemap', true );
$google_map   = get_theme_mod( 'contact_google_map_iframe' );

get_header(); ?>   
    <div class="contact-wrapper" id="contact">
        <div class="container">
            <div class="contact-main-wrap">
                <div class="contact-widget-wrap contact-info-wrap">
                    <?php 
                    the_title( '<h1 class="page-title">', '</h1>' );
                    the_content(); ?>
                    <ul class="contact-info">
                        <?php 
                        /**
                         * 
                         * @hooked good_looking_blog_location           - 10
                         * @hooked good_looking_blog_mail               - 20
                         * @hooked good_looking_blog_phone              - 30
                         */
                        do_action( 'good_looking_blog_contact_page_details' );
                        ?>
                    </ul>
                </div>
                <?php if( $ed_googlemap && $google_map ){ ?>
                    <div class="map">
                        <?php echo htmlspecialchars_decode( $google_map ); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php good_looking_blog_contact_form(); ?>

<?php get_footer();