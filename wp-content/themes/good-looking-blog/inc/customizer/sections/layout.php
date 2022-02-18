<?php
/**
 * Layout Settings
 *
 * @package Good_Looking_Blog
 */
if ( ! function_exists( 'good_looking_blog_customize_register_layout' ) ) :

function good_looking_blog_customize_register_layout( $wp_customize ) {
    
    /** Layout Settings */
    $wp_customize->add_section( 
        'layout_settings',
         array(
            'priority'    => 45,
            'capability'  => 'edit_theme_options',
            'title'       => esc_html__( 'Layout Settings', 'good-looking-blog' ),
            'description' => esc_html__( 'Change different page layout from here.', 'good-looking-blog' ),
        ) 
    );

    /** Page Sidebar layout */
    $wp_customize->add_setting( 
        'page_sidebar_layout', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'good_looking_blog_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Good_Looking_Blog_Radio_Image_Control(
			$wp_customize,
			'page_sidebar_layout',
			array(
				'section'	  => 'layout_settings',
				'label'		  => esc_html__( 'Page Sidebar Layout', 'good-looking-blog' ),
				'description' => esc_html__( 'This is the general sidebar layout for pages. You can override the sidebar layout for individual page in respective page.', 'good-looking-blog' ),
				'choices'	  => array(
					'no-sidebar'    => get_template_directory_uri() . '/images/sidebar/general-full.jpg',
					'left-sidebar'  => get_template_directory_uri() . '/images/sidebar/general-left.jpg',
                    'right-sidebar' => get_template_directory_uri() . '/images/sidebar/general-right.jpg',
				)
			)
		)
	);
    
    /** Post Sidebar layout */
    $wp_customize->add_setting( 
        'post_sidebar_layout', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'good_looking_blog_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Good_Looking_Blog_Radio_Image_Control(
			$wp_customize,
			'post_sidebar_layout',
			array(
				'section'	  => 'layout_settings',
				'label'		  => esc_html__( 'Post Sidebar Layout', 'good-looking-blog' ),
				'description' => esc_html__( 'This is the general sidebar layout for posts & custom post. You can override the sidebar layout for individual post in respective post.', 'good-looking-blog' ),
				'choices'	  => array(
					'no-sidebar'    => get_template_directory_uri() . '/images/sidebar/general-full.jpg',
					'left-sidebar'  => get_template_directory_uri() . '/images/sidebar/general-left.jpg',
                    'right-sidebar' => get_template_directory_uri() . '//images/sidebar/general-right.jpg',
				)
			)
		)
	);
    
    /** Post Sidebar layout */
    $wp_customize->add_setting( 
        'layout_style', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'good_looking_blog_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Good_Looking_Blog_Radio_Image_Control(
			$wp_customize,
			'layout_style',
			array(
				'section'	  => 'layout_settings',
				'label'		  => esc_html__( 'Default Sidebar Layout', 'good-looking-blog' ),
				'description' => esc_html__( 'This is the general sidebar layout for whole site.', 'good-looking-blog' ),
				'choices'	  => array(
					'no-sidebar'    => get_template_directory_uri() . '/images/sidebar/general-full.jpg',
                    'left-sidebar'  => get_template_directory_uri() . '/images/sidebar/general-left.jpg',
                    'right-sidebar' => get_template_directory_uri() . '/images/sidebar/general-right.jpg',
				)
			)
		)
	);
}
endif;
add_action( 'customize_register', 'good_looking_blog_customize_register_layout' );