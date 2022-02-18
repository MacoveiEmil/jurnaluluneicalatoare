<?php
/**
 * Instagram Settings
 * 
 * @package Good_Looking_Blog
 */

if( ! function_exists( 'good_looking_blog_instagram_section' ) ) :

function good_looking_blog_instagram_section( $wp_customize ){
    
	$wp_customize->add_section( 'instagram_section', 
	    array(
	        'title'         => esc_html__( 'Instagram Section', 'good-looking-blog' ),
	        'priority'      => 60,
	        'panel'         => 'frontpage_settings'
	    ) 
	);

    /** Hide Instagram Section */
    $wp_customize->add_setting( 
        'ed_instagram_section', 
        array(
            'default'           => true,
            'sanitize_callback' => 'good_looking_blog_sanitize_checkbox'
        ) 
    );

    $wp_customize->add_control(
        new Good_Looking_Blog_Toggle_Control( 
            $wp_customize,
            'ed_instagram_section',
            array(
                'section'     => 'instagram_section',
                'label'	      => esc_html__( 'Hide Instagram Section', 'good-looking-blog' ),
                'description' => esc_html__( 'Enable to hide instagram section.', 'good-looking-blog' ),
            )
        )
    );

     /** Instagram title */
     $wp_customize->add_setting(
        'instagram_title',
        array(
            'default'           => esc_html__( 'Instagram', 'good-looking-blog' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'instagram_title',
        array(
            'section'           => 'instagram_section',
            'label'             => esc_html__( 'Section Title', 'good-looking-blog' ),
            'type'              => 'text',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'instagram_title', array(
        'selector'        => '.instagram-section .section-header h2.section-title',
        'render_callback' => 'good_looking_blog_instagram_title',
    ) );

    $wp_customize->add_setting(
        'instagram_shortcode',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'instagram_shortcode',
        array(
            'label'             => esc_html__( 'Instagram Shortcode', 'good-looking-blog' ),
            'type'              => 'text',
            'section'           => 'instagram_section',
        )
    );
}
endif;
add_action( 'customize_register', 'good_looking_blog_instagram_section' );