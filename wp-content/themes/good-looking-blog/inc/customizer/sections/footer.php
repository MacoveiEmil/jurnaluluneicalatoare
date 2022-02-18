<?php
/**
 * Footer Setting
 *
 * @package Good_Looking_Blog
 */
if( ! function_exists( 'good_looking_blog_customize_register_footer' ) ) :

function good_looking_blog_customize_register_footer( $wp_customize ) {
    
    $wp_customize->add_section(
        'footer_settings',
        array(
            'title'      => esc_html__( 'Footer Settings', 'good-looking-blog' ),
            'priority'   => 199,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Footer Copyright */
    $wp_customize->add_setting(
        'footer_copyright',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'footer_copyright',
        array(
            'label'       => esc_html__( 'Footer Copyright Text', 'good-looking-blog' ),
            'section'     => 'footer_settings',
            'type'        => 'textarea',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'footer_copyright', array(
        'selector'        => '.footer-bottom .site-info .copy-right',
        'render_callback' => 'good_looking_blog_get_footer_copyright',
    ) );
        
}
endif;
add_action( 'customize_register', 'good_looking_blog_customize_register_footer' );