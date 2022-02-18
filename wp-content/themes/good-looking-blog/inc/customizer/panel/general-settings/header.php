<?php
/**
 * Social Settings
 *
 * @package Good_Looking_Blog
 */
if( ! function_exists( 'good_looking_blog_customize_register_social_links' ) ) :

function good_looking_blog_customize_register_social_links( $wp_customize ) {

    /*--------------------------
     * SOCIAL LINKS SECTION
     --------------------------*/
    
    $wp_customize->add_section(
        'social_settings',
        array(
            'panel'     => 'general_settings',
            'title'         => esc_html__( 'Header Settings', 'good-looking-blog' ),
            'priority'  => 10,
        )
    );

    /** Enable Search */
    $wp_customize->add_setting( 
        'ed_search', 
        array(
            'default'           => false,
            'sanitize_callback' => 'good_looking_blog_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Good_Looking_Blog_Toggle_Control( 
            $wp_customize,
            'ed_search',
            array(
                'section'     => 'social_settings',
                'label'	      => esc_html__( 'Enable Search', 'good-looking-blog' ),
                'description' => esc_html__( 'Enable to show Search icon at header.', 'good-looking-blog' ),
            )
        )
    );
    
    /** Enable Social Links */
    $wp_customize->add_setting( 
        'ed_social_links', 
        array(
            'default'           => false,
            'sanitize_callback' => 'good_looking_blog_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
		new Good_Looking_Blog_Toggle_Control( 
			$wp_customize,
			'ed_social_links',
			array(
				'section'     => 'social_settings',
				'label'	      => esc_html__( 'Enable Social Links', 'good-looking-blog' ),
                'description' => esc_html__( 'Enable to show social links at header.', 'good-looking-blog' ),
			)
		)
	);

    /** 
     * Social Share Repeater 
     * */
    $wp_customize->add_setting( 
        new Good_Looking_Blog_Repeater_Setting( 
            $wp_customize, 
            'social_links', 
            array(
                'default' => '',
                'sanitize_callback' => array( 'Good_Looking_Blog_Repeater_Setting', 'sanitize_repeater_setting' ),
            ) 
        ) 
    );
    
    $wp_customize->add_control(
		new Good_Looking_Blog_Control_Repeater(
			$wp_customize,
			'social_links',
			array(
				'section' => 'social_settings',
				'label'   => esc_html__( 'Social Links', 'good-looking-blog' ),
				'fields'  => array(
                    'glb_icon' => array(
                        'type'        => 'select',
                        'label'       => esc_html__( 'Social Media', 'good-looking-blog' ),
                        'choices'     => good_looking_blog_get_svg_icons()
                    ),
                    'glb_link' => array(
                        'type'        => 'url',
                        'label'       => esc_html__( 'Link', 'good-looking-blog' ),
                        'description' => esc_html__( 'Example: https://facebook.com', 'good-looking-blog' ),
                    ),
                    'glb_checkbox' => array(
                        'type'        => 'checkbox',
                        'label'       => esc_html__( 'Open link in new tab', 'good-looking-blog' ),
                    )
                ),
                'row_label' => array(
                    'type'  => 'field',
                    'value' => esc_html__( 'links', 'good-looking-blog' ),
                    'field' => 'link'
                )                        
			)
		)
	);

    /*--------------------------
     * SOCIAL LINKS SECTION END
     --------------------------*/
}
endif;
add_action( 'customize_register', 'good_looking_blog_customize_register_social_links' );
