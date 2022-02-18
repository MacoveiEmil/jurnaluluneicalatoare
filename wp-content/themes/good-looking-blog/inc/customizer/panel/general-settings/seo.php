<?php
/**
 * SEO Settings
 *
 * @package Good_Looking_Blog
 */
if( ! function_exists( 'good_looking_blog_customize_register_general_seo' ) ) :

function good_looking_blog_customize_register_general_seo( $wp_customize ) {
    
    /** SEO Settings */
    $wp_customize->add_section(
        'seo_settings',
        array(
            'title'    => esc_html__( 'SEO Settings', 'good-looking-blog' ),
            'priority' => 40,
            'panel'    => 'general_settings',
        )
    );
    
    $wp_customize->add_setting( 
        'ed_breadcrumb', 
        array(
            'default'           => true,
            'sanitize_callback' => 'good_looking_blog_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Good_Looking_Blog_Toggle_Control( 
			$wp_customize,
			'ed_breadcrumb',
			array(
				'section'     => 'seo_settings',
				'label'	      => esc_html__( 'Enable Breadcrumb', 'good-looking-blog' ),
                'description' => esc_html__( 'Enable to show breadcrumb in inner pages.', 'good-looking-blog' ),
			)
		)
	);
    
    /** Breadcrumb Home Text */
    $wp_customize->add_setting(
        'home_text',
        array(
            'default'           => esc_html__( 'Home', 'good-looking-blog' ),
            'sanitize_callback' => 'sanitize_text_field' 
        )
    );
    
    $wp_customize->add_control(
        'home_text',
        array(
            'type'    => 'text',
            'section' => 'seo_settings',
            'label'   => esc_html__( 'Breadcrumb Home Text', 'good-looking-blog' ),
        )
    );  
    /** SEO Settings Ends */
    
}
endif;
add_action( 'customize_register', 'good_looking_blog_customize_register_general_seo' );