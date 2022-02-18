<?php
/**
 * Good_Looking_Blog Customizer Partials
 *
 * @package Good_Looking_Blog
 */

if( ! function_exists( 'good_looking_blog_customize_partial_blogname' ) ) :
/* Render the site title for the selective refresh partial.
 *
 * @return void
 */
function good_looking_blog_customize_partial_blogname() {
	bloginfo( 'name' );
}
endif;

if( ! function_exists( 'good_looking_blog_customize_partial_blogdescription' ) ) :
/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function good_looking_blog_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
endif;

if( ! function_exists( 'good_looking_blog_editor_posts_title' ) ) :
/**
 * Editor Post Title
*/
function good_looking_blog_editor_posts_title(){
    return get_theme_mod( 'editor_post_section_title', __( 'Editor Posts', 'good-looking-blog' ) );
}
endif;

if( ! function_exists( 'good_looking_blog_blog_posts_title' ) ) :
/**
 * Blog Post Title
*/
function good_looking_blog_blog_posts_title(){
    return get_theme_mod( 'blog_section_title', __( 'Blog Posts', 'good-looking-blog' ) );
}
endif;

if( ! function_exists( 'good_looking_blog_instagram_title' ) ) :
/**
 * Instagram Section Title
*/
function good_looking_blog_instagram_title(){
    return get_theme_mod( 'instagram_title', __( 'Instagram', 'good-looking-blog' ) );
}
endif;

if( ! function_exists( 'good_looking_blog_related_posts_title' ) ) :
/**
 * Related Posts Title
*/
function good_looking_blog_related_posts_title(){
    return get_theme_mod( 'related_post_title', __( 'You might also like', 'good-looking-blog' ) );
}
endif;


if( ! function_exists( 'good_looking_blog_banner_title' ) ) :
/**
 * Banner Title
*/
function good_looking_blog_banner_title(){
    return get_theme_mod( 'banner_title', __( 'Donec Cras Ut Eget Justo Nec Semper Sapien Viverra Ante', 'good-looking-blog' ) );
}
endif;

if( ! function_exists( 'good_looking_blog_banner_content' ) ) :
/**
 * Banner Content
*/
function good_looking_blog_banner_content(){
    return get_theme_mod( 'banner_content', __( 'Structured gripped tape invisible moulded cups for sauppor firm hold strong powermesh front liner sport detail.', 'good-looking-blog' ) );
}
endif;

if( ! function_exists( 'good_looking_blog_banner_btn_label' ) ) :
/**
 * Banner Button Label
*/
function good_looking_blog_banner_btn_label(){
    return get_theme_mod( 'banner_btn_label', __( 'Read More', 'good-looking-blog' ) );
}
endif;

if( ! function_exists( 'good_looking_blog_banner_btn_two_label' ) ) :
/**
 * Banner Button Two Label
*/
function good_looking_blog_banner_btn_two_label(){
    return get_theme_mod( 'banner_btn_two_label', __( 'About Us', 'good-looking-blog' ) );
}
endif;

if( ! function_exists( 'good_looking_blog_get_footer_copyright' ) ) :
/**
 * Show Author link in footer
*/
function good_looking_blog_get_footer_copyright(){
    $copyright = get_theme_mod( 'footer_copyright' );
    echo '<span class="copy-right">';
    if( ! empty( $copyright ) ){
        echo wp_kses_post( $copyright );
    }else{
        esc_html_e( 'Copyright &copy; ', 'good-looking-blog' ) . date_i18n( esc_html__( 'Y', 'good-looking-blog' ) );
        echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>. ';
    }
    echo '</span>';
}
endif;

if( ! function_exists( 'good_looking_blog_ed_author_link' ) ) :
/**
 * Show Author link in footer
*/
function good_looking_blog_ed_author_link(){
    
    echo '<span class="author-link">'; 
    esc_html_e( 'Developed By ', 'good-looking-blog' );
    echo '<a href="' . esc_url( 'https://glthemes.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Good Looking Themes.', 'good-looking-blog' ) . '</a>';
    echo '</span>';
    
}
endif;

if( ! function_exists( 'good_looking_blog_ed_wp_link' ) ) :
/**
 * Show WordPress link in footer
*/
function good_looking_blog_ed_wp_link(){

    printf( esc_html__( '%1$s Powered by %2$s%3$s', 'good-looking-blog' ), '<span class="wp-link">', '<a href="'. esc_url( __( 'https://wordpress.org/', 'good-looking-blog' ) ) .'" target="_blank">WordPress</a>.', '</span>' );

    if ( function_exists( 'the_privacy_policy_link' ) ) {
        the_privacy_policy_link( '<span class="policy_link">', '</span>');
    }
}
endif;

if( ! function_exists( 'good_looking_blog_contact_location_title' ) ) :
/**
 * Contact Location Title
*/
function good_looking_blog_contact_location_title(){
    return get_theme_mod( 'location_title', __( 'Visit Us:', 'good-looking-blog' ) );
}
endif;
        
if( ! function_exists( 'good_looking_blog_contact_location_description' ) ) :
/**
 * Contact Location Description
*/
function good_looking_blog_contact_location_description(){
    return get_theme_mod( 'location', __( '27 Division St, New York, NY 10002, USA', 'good-looking-blog' ) );
}
endif;
        
if( ! function_exists( 'good_looking_blog_contact_email_title' ) ) :
/**
 * Contact Email Title
*/
function good_looking_blog_contact_email_title(){
    return get_theme_mod( 'mail_title', __( 'Mail Us:', 'good-looking-blog' ) );
}
endif;
        
if( ! function_exists( 'good_looking_blog_contact_email_description' ) ) :
/**
 * Contact Email Description
*/
function good_looking_blog_contact_email_description(){
    return get_theme_mod( 'mail_description', __( '27 Division St, New York, NY 10002, USA', 'good-looking-blog' ) );
}
endif;
        
if( ! function_exists( 'good_looking_blog_contact_phone_title' ) ) :
/**
 * Contact Phone Title
*/
function good_looking_blog_contact_phone_title(){
    return get_theme_mod( 'phone_title', __( 'Phone Us:', 'good-looking-blog' ) );
}
endif;
        
if( ! function_exists( 'good_looking_blog_contact_phone_number' ) ) :
/**
 * Contact Phone Number
*/
function good_looking_blog_contact_phone_number(){
    return get_theme_mod( 'phone_number', __( '+1 (800) 123 456 789', 'good-looking-blog' ) );
}
endif;
        
if( ! function_exists( 'good_looking_blog_contact_form_title' ) ) :
/**
 * Contact Page Form Title
*/
function good_looking_blog_contact_form_title(){
    return get_theme_mod( 'contact_form_title', __( 'Ready to Talk', 'good-looking-blog' ) );
}
endif;