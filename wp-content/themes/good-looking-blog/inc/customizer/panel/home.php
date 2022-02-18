<?php
/**
 * Front Page Settings
 * 
 * @package Good_Looking_Blog
 */
if ( ! function_exists( 'good_looking_blog_customize_register_frontpage' ) ) :

function good_looking_blog_customize_register_frontpage( $wp_customize ) {
	
    /** Front Page Settings */
    $wp_customize->add_panel( 
        'frontpage_settings',
         array(
            'priority'    => 40,
            'capability'  => 'edit_theme_options',
            'title'       => esc_html__( 'Front Page Settings', 'good-looking-blog' ),
            'description' => esc_html__( 'Static Home Page settings.', 'good-looking-blog' ),
        ) 
    );    
      
}
endif;
add_action( 'customize_register', 'good_looking_blog_customize_register_frontpage' );