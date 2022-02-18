<?php
/**
 * Blog Posts Settings
 * 
 * @package Good_Looking_Blog
 */
if ( ! function_exists( 'good_looking_blog_blog_posts_frontpage_settings' ) ) :

function good_looking_blog_blog_posts_frontpage_settings( $wp_customize ){
    
	$wp_customize->add_section( 'good_looking_blog_blog_posts', 
	    array(
	        'title'         => esc_html__( 'Blog Posts Section', 'good-looking-blog' ),
	        'priority'      => 20,
	        'panel'         => 'frontpage_settings'
	    ) 
	);

    /** Hide Blog Section */
    $wp_customize->add_setting( 
        'ed_blog_section', 
        array(
            'default'           => false,
            'sanitize_callback' => 'good_looking_blog_sanitize_checkbox'
        ) 
    );

    $wp_customize->add_control(
        new Good_Looking_Blog_Toggle_Control( 
            $wp_customize,
            'ed_blog_section',
            array(
                'section'     => 'good_looking_blog_blog_posts',
                'label'	      => esc_html__( 'Hide Blog Section', 'good-looking-blog' ),
                'description' => esc_html__( 'Enable to hide blog section.', 'good-looking-blog' ),
            )
        )
    );

    /** Blog title */
    $wp_customize->add_setting(
        'blog_section_title',
        array(
            'default'           => esc_html__( 'Blog Posts', 'good-looking-blog' ),
            'sanitize_callback' => 'sanitize_text_field',
			'transport'			=>	'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'blog_section_title',
        array(
            'section'           => 'good_looking_blog_blog_posts',
            'label'             => esc_html__( 'Section Title', 'good-looking-blog' ),
            'type'              => 'text',
        )
    );

	$wp_customize->selective_refresh->add_partial( 'blog_section_title', array(
        'selector'        => '.blog-posts-section .section-header h2.section-title',
        'render_callback' => 'good_looking_blog_blog_posts_title',
    ) );
}
endif;
add_action( 'customize_register', 'good_looking_blog_blog_posts_frontpage_settings' );