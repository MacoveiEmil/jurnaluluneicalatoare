<?php
/**
 * Contact Map Section Theme Option.
 * 
 * @package Good_Looking_Blog
 */

function good_looking_blog_customize_register_map( $wp_customize ) {
    
    /** Google Map Settings */
    $wp_customize->add_section(
        'google_map_settings',
        array(
            'title'    => __( 'Google Map Section', 'good-looking-blog' ),
            'priority' => 20,
            'panel'    => 'contact_page_settings',
        )
    );

    /** Contact Form */
    $wp_customize->add_setting(
        'ed_googlemap',
        array(
            'default'           => true,
            'sanitize_callback' => 'good_looking_blog_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Good_Looking_Blog_Toggle_Control( 
            $wp_customize,
            'ed_googlemap',
            array(
                'section'       => 'google_map_settings',
                'label'         => __( 'Google Map Settings', 'good-looking-blog' ),
                'description'   => __( 'Disable to hide the Google Map Settings', 'good-looking-blog' ),
            )
        )
    );

    $wp_customize->add_setting(
        'contact_google_map_iframe',
        array(
            'default'           => '',
            'sanitize_callback' => 'good_looking_blog_sanitize_google_map_iframe',
        )
    );
    
    $wp_customize->add_control(
        'contact_google_map_iframe',
        array(
            'section'         => 'google_map_settings',
            'label'           => __( 'Embeded Google Map', 'good-looking-blog' ),
            'type'            => 'textarea',
        )
    );

    }
add_action( 'customize_register', 'good_looking_blog_customize_register_map' );