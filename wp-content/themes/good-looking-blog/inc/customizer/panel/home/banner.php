<?php
/**
 * Banner Section
 *
 * @package Good_Looking_Blog
 */
if ( ! function_exists( 'good_looking_blog_customize_register_frontpage_banner' ) ) :

function good_looking_blog_customize_register_frontpage_banner( $wp_customize ) {
	
    $wp_customize->get_section( 'header_image' )->panel                    = 'frontpage_settings';
    $wp_customize->get_section( 'header_image' )->title                    = esc_html__( 'Banner Section', 'good-looking-blog' );
    $wp_customize->get_section( 'header_image' )->priority                 = 10;
    $wp_customize->get_control( 'header_image' )->active_callback          = 'good_looking_blog_banner_ac';
    $wp_customize->get_control( 'header_video' )->active_callback          = 'good_looking_blog_banner_ac';
    $wp_customize->get_control( 'external_header_video' )->active_callback = 'good_looking_blog_banner_ac';
    $wp_customize->get_section( 'header_image' )->description              = '';                                               
    $wp_customize->get_setting( 'header_image' )->transport                = 'refresh';
    $wp_customize->get_setting( 'header_video' )->transport                = 'refresh';
    $wp_customize->get_setting( 'external_header_video' )->transport       = 'refresh';
    
    /** Banner Options */
    $wp_customize->add_setting(
		'ed_banner_section',
		array(
			'default'			=> 'static_banner',
			'sanitize_callback' => 'good_looking_blog_sanitize_select'
		)
	);

	$wp_customize->add_control(
        'ed_banner_section',
        array(
            'label'	      => esc_html__( 'Banner Options', 'good-looking-blog' ),
            'description' => esc_html__( 'Choose banner as static image/video or as a slider.', 'good-looking-blog' ),
            'section'     => 'header_image',
            'type'        => 'select',
            'choices'     => array(
                'no_banner'        => esc_html__( 'Disable Banner Section', 'good-looking-blog' ),
                'static_banner'    => esc_html__( 'Static/Video CTA Banner', 'good-looking-blog' ),
            ),
            'priority'      => 5,
        )               
	);
    
    /** Title */
    $wp_customize->add_setting(
        'banner_title',
        array(
            'default'           => esc_html__( 'Donec Cras Ut Eget Justo Nec Semper Sapien Viverra Ante', 'good-looking-blog' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'			=> 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'banner_title',
        array(
            'label'           => esc_html__( 'Title', 'good-looking-blog' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'active_callback'   => 'good_looking_blog_banner_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'banner_title', array(
        'selector'        => '.site-banner .banner-details-wrapper h2.item-title',
        'render_callback' => 'good_looking_blog_banner_title',
    ) );
    
    /** Content */
    $wp_customize->add_setting(
        'banner_content',
        array(
            'default'           => esc_html__( 'Structured gripped tape invisible moulded cups for sauppor firm hold strong powermesh front liner sport detail.', 'good-looking-blog' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'			=> 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'banner_content',
        array(
            'label'           => esc_html__( 'Description', 'good-looking-blog' ),
            'section'         => 'header_image',
            'type'            => 'textarea',
            'active_callback'   => 'good_looking_blog_banner_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'banner_content', array(
        'selector'        => '.site-banner .banner-details-wrapper .banner-desc p',
        'render_callback' => 'good_looking_blog_banner_content',
    ) );

    /** Banner Button Label */
    $wp_customize->add_setting(
        'banner_btn_label',
        array(
            'default'           => esc_html__( 'Read More', 'good-looking-blog' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'			=> 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'banner_btn_label',
        array(
            'label'           => esc_html__( 'Button Label', 'good-looking-blog' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'active_callback'   => 'good_looking_blog_banner_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'banner_btn_label', array(
        'selector'        => '.site-banner .banner-details-wrapper .button-wrap a.primary-btn:first-child',
        'render_callback' => 'good_looking_blog_banner_btn_label',
    ) );
    
    /** Banner Link */
    $wp_customize->add_setting(
        'banner_link',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'banner_link',
        array(
            'label'           => esc_html__( 'Button Link', 'good-looking-blog' ),
            'section'         => 'header_image',
            'type'            => 'url',
            'active_callback'   => 'good_looking_blog_banner_ac'
        )
    ); 

    $wp_customize->add_setting(
        'banner_btn_two_label',
        array(
            'default'           => esc_html__( 'About Us', 'good-looking-blog' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'			=> 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'banner_btn_two_label',
        array(
            'label'           => esc_html__( 'Button 2 Label', 'good-looking-blog' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'active_callback'   => 'good_looking_blog_banner_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'banner_btn_two_label', array(
        'selector'        => '.site-banner .banner-details-wrapper .button-wrap a.secondary-btn',
        'render_callback' => 'good_looking_blog_banner_btn_two_label',
    ) );
    
    /** Banner Link */
    $wp_customize->add_setting(
        'banner_btn_two_link',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'banner_btn_two_link',
        array(
            'label'           => esc_html__( 'Button 2 Link', 'good-looking-blog' ),
            'section'         => 'header_image',
            'type'            => 'url',
            'active_callback'   => 'good_looking_blog_banner_ac'
        )
    ); 
    
}
endif;
add_action( 'customize_register', 'good_looking_blog_customize_register_frontpage_banner' );