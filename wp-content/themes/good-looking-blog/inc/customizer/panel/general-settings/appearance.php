<?php
/**
 * Appearance Settings
 *
 * @package Good_Looking_Blog
 */
if( ! function_exists( 'good_looking_blog_customize_register_appearance' ) ) :
    
function good_looking_blog_customize_register_appearance( $wp_customize ) {

    $wp_customize->get_section( 'colors' )->panel               = 'appearance_settings';
    $wp_customize->get_section( 'background_image' )->panel     = 'appearance_settings';
    
    $wp_customize->add_panel( 
        'appearance_settings', 
        array(
            'title'       => esc_html__( 'Appearance Settings', 'good-looking-blog' ),
            'priority'    => 25,
            'capability'  => 'edit_theme_options',
            'description' => esc_html__( 'Change color and body background.', 'good-looking-blog' ),
        ) 
    );

}
endif;
add_action( 'customize_register', 'good_looking_blog_customize_register_appearance' );