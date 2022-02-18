<?php
/**
 * General Settings
 * 
 * @package Good_Looking_Blog
 */
if( ! function_exists( 'good_looking_blog_customize_register_general_settings' ) ) :
    
function good_looking_blog_customize_register_general_settings( $wp_customize ) {
	
    /** General Settings Settings */
    $wp_customize->add_panel( 
        'general_settings',
            array(
            'priority'    => 45,
            'capability'  => 'edit_theme_options',
            'title'       => esc_html__( 'General Settings', 'good-looking-blog' ),
        ) 
    );    
 
}
endif;
add_action( 'customize_register', 'good_looking_blog_customize_register_general_settings' );