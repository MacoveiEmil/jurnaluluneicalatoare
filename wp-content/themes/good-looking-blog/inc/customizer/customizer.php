<?php
/**
 * Good Looking Blog Theme Customizer
 *
 * @package Good_Looking_Blog
 */

if ( ! function_exists( 'good_looking_blog_customize_register' ) ) :
	/**
	 * Add postMessage support for site title and description for the Theme Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	function good_looking_blog_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
		$wp_customize->get_setting( 'background_color' )->transport = 'refresh';
		$wp_customize->get_setting( 'background_image' )->transport = 'refresh';
		
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial(
				'blogname',
				array(
					'selector'        => '.site-title a',
					'render_callback' => 'good_looking_blog_customize_partial_blogname',
				)
			);
			$wp_customize->selective_refresh->add_partial(
				'blogdescription',
				array(
					'selector'        => '.site-description',
					'render_callback' => 'good_looking_blog_customize_partial_blogdescription',
				)
			);
		}
	}
endif;
add_action( 'customize_register', 'good_looking_blog_customize_register' );

if( ! function_exists( 'good_looking_blog_customize_preview_js' ) ) :
	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 */
	function good_looking_blog_customize_preview_js() {
		wp_enqueue_script( 'good-looking-blog-customizer', get_template_directory_uri() . '/inc/assets/js/customizer.js', array( 'customize-preview' ), GOOD_LOOKING_BLOG_VERSION, true );
	}
endif;
add_action( 'customize_preview_init', 'good_looking_blog_customize_preview_js' );

if( ! function_exists( 'good_looking_blog_customize_script' ) ) :
	function good_looking_blog_customize_script(){

		wp_enqueue_style( 'good-looking-blog-customize', get_template_directory_uri() . '/inc/assets/css/customize.css', array(), GOOD_LOOKING_BLOG_VERSION );
		wp_enqueue_script( 'good-looking-blog-customize', get_template_directory_uri() . '/inc/assets/js/customize.js', array( 'jquery', 'customize-controls' ), GOOD_LOOKING_BLOG_VERSION, true );
		
	}
endif;
add_action( 'customize_controls_enqueue_scripts', 'good_looking_blog_customize_script' );

$good_looking_blog_panels    = array( 'general-settings', 'home', 'contact' );

$good_looking_blog_sections  = array( 'footer', 'theme-info', 'layout' );

$good_looking_blog_sub_sections = array( 
	'general-settings'	=> array ( 'appearance', 'header', 'post-page', 'seo' ),
	'home'              => array( 'banner', 'blog-posts', 'newsletter', 'editor-pick','instagram' ),
	'contact'			=> array( 'contact-detail', 'contact-form', 'contact-map' )
);

foreach( $good_looking_blog_panels as $panel ){
    require get_template_directory() . '/inc/customizer/panel/' . $panel . '.php';
}

foreach( $good_looking_blog_sub_sections as $sub => $sec ){
    foreach( $sec as $sections ){        
        require get_template_directory() . '/inc/customizer/panel/' . $sub . '/' . $sections . '.php';
    }
}

foreach( $good_looking_blog_sections as $section ){
    require get_template_directory() . '/inc/customizer/sections/' . $section . '.php';
}

/**
 * Sanitization functions
 */
require get_template_directory() . '/inc/customizer/sanitization-functions.php';

/**
 *Active callback functions
 */
require get_template_directory() . '/inc/customizer/active-callback.php';

/**
 *Partial refresh functions
 */
require get_template_directory() . '/inc/customizer/partial-refresh.php';