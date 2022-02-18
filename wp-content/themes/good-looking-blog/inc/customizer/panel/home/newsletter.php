<?php
/**
 * Newsletter Settings
 * 
 * @package Good_Looking_Blog
 */
if( ! function_exists( 'good_looking_blog_newsletter_frontpage_settings' ) ) :

function good_looking_blog_newsletter_frontpage_settings( $wp_customize ){
    
	$wp_customize->add_section( 'good_looking_blog_newsletter', 
	    array(
	        'title'         => esc_html__( 'Newsletter Section', 'good-looking-blog' ),
	        'priority'      => 30,
	        'panel'         => 'frontpage_settings'
	    ) 
	);

    /** Hide Newsletter Section */
    $wp_customize->add_setting( 
        'ed_newsletter_section', 
        array(
            'default'           => true,
            'sanitize_callback' => 'good_looking_blog_sanitize_checkbox'
        ) 
    );

    $wp_customize->add_control(
        new Good_Looking_Blog_Toggle_Control( 
            $wp_customize,
            'ed_newsletter_section',
            array(
                'section'     => 'good_looking_blog_newsletter',
                'label'	      => esc_html__( 'Hide Newsletter Section', 'good-looking-blog' ),
                'description' => esc_html__( 'Enable to hide newsletter section.', 'good-looking-blog' ),
            )
        )
    );

    $wp_customize->add_setting(
        'newsletter_shortcode',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'newsletter_shortcode',
        array(
            'label'             => esc_html__( 'Newsletter Shortcode', 'good-looking-blog' ),
            'description'       => esc_html__( 'Please download BlossomThemes Email Newsletter and place the shortcode for newsletter section', 'good-looking-blog' ),
            'type'              => 'text',
            'section'           => 'good_looking_blog_newsletter',
        )
    );
}
endif;
add_action( 'customize_register', 'good_looking_blog_newsletter_frontpage_settings' );