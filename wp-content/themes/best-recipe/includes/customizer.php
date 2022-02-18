<?php
/**
 * Theme Customizer
 *
 * @package Best Recipe
 */

function good_looking_blog_register_custom_controls( $wp_customize ){    
    // Load our custom control.
    require_once get_template_directory() . '/inc/custom-controls/note/class-note-control.php';
    require_once get_template_directory() . '/inc/custom-controls/radioimg/class-radio-image-control.php';
    require_once get_template_directory() . '/inc/custom-controls/repeater/class-repeater-setting.php';
    require_once get_template_directory() . '/inc/custom-controls/repeater/class-control-repeater.php';
    require_once get_template_directory() . '/inc/custom-controls/toggle/class-toggle-control.php';    
            
    // Register the control type.
    $wp_customize->register_control_type( 'Good_Looking_Blog_Radio_Image_Control' );
    $wp_customize->register_control_type( 'Good_Looking_Blog_Toggle_Control' );
}
add_action( 'customize_register', 'good_looking_blog_register_custom_controls' );

function best_recipe_overide_values( $wp_customize ){
    $wp_customize->get_section( 'good_looking_blog_newsletter' )->priority = 55;
    $wp_customize->get_setting( 'editor_post_section_title' )->default = esc_html__( 'Recipes Of The Week', 'best-recipe' );
}
add_action( 'customize_register', 'best_recipe_overide_values', 999 );

function good_looking_blog_customize_register_frontpage_banner( $wp_customize ) {
	
    $wp_customize->get_section( 'header_image' )->panel                    = 'frontpage_settings';
    $wp_customize->get_section( 'header_image' )->title                    = esc_html__( 'Banner Section', 'best-recipe' );
    $wp_customize->get_section( 'header_image' )->priority                 = 10;
    $wp_customize->get_control( 'header_image' )->active_callback          = 'best_recipe_banner_ac';
    $wp_customize->get_control( 'header_video' )->active_callback          = 'best_recipe_banner_ac';
    $wp_customize->get_control( 'external_header_video' )->active_callback = 'best_recipe_banner_ac';
    $wp_customize->get_section( 'header_image' )->description              = '';                                               
    $wp_customize->get_setting( 'header_image' )->transport                = 'refresh';
    $wp_customize->get_setting( 'header_video' )->transport                = 'refresh';
    $wp_customize->get_setting( 'external_header_video' )->transport       = 'refresh';
    
    /** Banner Options */
    $wp_customize->add_setting(
		'ed_banner_section',
		array(
			'default'			=> 'slider_banner',
			'sanitize_callback' => 'good_looking_blog_sanitize_select'
		)
	);

	$wp_customize->add_control(
        'ed_banner_section',
        array(
            'label'	      => esc_html__( 'Banner Options', 'best-recipe' ),
            'description' => esc_html__( 'Choose banner as static image/video or as a slider.', 'best-recipe' ),
            'section'     => 'header_image',
            'type'        => 'select',
            'choices'     => array(
                'no_banner'        => esc_html__( 'Disable Banner Section', 'best-recipe' ),
                'slider_banner'    => esc_html__( 'Banner as Slider', 'best-recipe' ),
            ),
            'priority'      => 5,
        )               
	);
    
    $wp_customize->add_setting(
		'slider_type',
		array(
			'default'			=> 'latest_posts',
			'sanitize_callback' => 'good_looking_blog_sanitize_select'
		)
	);

	$wp_customize->add_control(
        'slider_type',
        array(
            'label'	  => __( 'Slider Content Style', 'best-recipe' ),
            'section' => 'header_image',
            'type'    => 'select',
            'choices' => array(
                'latest_posts' => esc_html__( 'Latest Posts', 'best-recipe' ),
                'category'     => esc_html__( 'Category', 'best-recipe' ),
                'pages'        => esc_html__( 'Pages', 'best-recipe' ),
            ),
            'active_callback' => 'best_recipe_banner_ac'
        )	
	);

    $wp_customize->add_setting(
		'slider_cat',
		array(
			'default'			=> '',
			'sanitize_callback' => 'good_looking_blog_sanitize_select'
		)
	);

	$wp_customize->add_control(
        'slider_cat',
        array(
            'label'	          => esc_html__( 'Slider Category', 'best-recipe' ),
            'section'         => 'header_image',
            'type'            => 'select',
            'choices'         => good_looking_blog_get_categories(),
            'active_callback' => 'best_recipe_banner_ac'
        )
	);

    $wp_customize->add_setting( 
        new Good_Looking_Blog_Repeater_Setting( 
            $wp_customize, 
            'slider_pages', 
            array(
                'default'           => '',
                'sanitize_callback' => array( 'Good_Looking_Blog_Repeater_Setting', 'sanitize_repeater_setting' ),
            ) 
        ) 
    );
    
    $wp_customize->add_control(
		new Good_Looking_Blog_Control_Repeater(
			$wp_customize,
			'slider_pages',
			array(
				'section' => 'header_image',				
				'label'	  => esc_html__( 'Slider Pages', 'best-recipe' ),
				'fields'  => array(
                    'page' => array(
                        'type'    => 'select',
                        'label'   => esc_html__( 'Select Page for slider', 'best-recipe' ),
                        'choices' => good_looking_blog_get_posts( 'page', true )
                    )
                ),
                'row_label' => array(
                    'type'  => 'field',
                    'value' => esc_html__( 'pages', 'best-recipe' ),
                    'field' => 'page'
                ),
                'active_callback' => 'best_recipe_banner_ac'
			)
		)
	);

    $wp_customize->add_setting(
        'slider_auto',
        array(
            'default'           => true,
            'sanitize_callback' => 'good_looking_blog_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Good_Looking_Blog_Toggle_Control( 
			$wp_customize,
			'slider_auto',
			array(
				'section'     => 'header_image',
				'label'       => __( 'Slider Auto', 'best-recipe' ),
                'description' => __( 'Enable slider auto transition.', 'best-recipe' ),
                'active_callback' => 'best_recipe_banner_ac'
			)
		)
	);
    
    /** Slider Loop */
    $wp_customize->add_setting(
        'slider_loop',
        array(
            'default'           => true,
            'sanitize_callback' => 'good_looking_blog_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Good_Looking_Blog_Toggle_Control( 
			$wp_customize,
			'slider_loop',
			array(
				'section'     => 'header_image',
				'label'       => __( 'Slider Loop', 'best-recipe' ),
                'description' => __( 'Enable slider loop.', 'best-recipe' ),
                'active_callback' => 'best_recipe_banner_ac'
			)
		)
	); 
}

function best_recipe_customize_register_about_section( $wp_customize ){

    /** About Section Settings  */
    $wp_customize->add_section(
        'about_section',
        array(
            'title'    => __( 'About Section', 'best-recipe' ),
            'priority' => 20,
            'panel'    => 'frontpage_settings',
        )
    );

    /** Enable About Section */
    $wp_customize->add_setting( 
        'ed_abt_sec', 
        array(
            'default'           => true,
            'sanitize_callback' => 'good_looking_blog_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Good_Looking_Blog_Toggle_Control( 
            $wp_customize,
            'ed_abt_sec',
            array(
                'section'     => 'about_section',
                'label'	      => esc_html__( 'Enable About Section', 'best-recipe' ),
                'description' => esc_html__( 'Enable to hide About section.', 'best-recipe' ),
            )
        )
    );

    /** Title Text */
    $wp_customize->add_setting( 
        'about_title', 
        array(
            'default'           => esc_html__( 'Hello there! I am Jessica. Start cooking with me', 'best-recipe' ), 
            'sanitize_callback' => 'sanitize_text_field',
            'transport'			=> 'postMessage',
        ) 
    );
    
    $wp_customize->add_control(
        'about_title',
        array(
            'section'         => 'about_section',
            'label'           => __( 'Section Title', 'best-recipe' ),
            'type'            => 'text',
        )   
    );

    $wp_customize->selective_refresh->add_partial( 'about_title', array(
        'selector'        => '.home .site .about .section-header h2.section-header__title',
        'render_callback' => 'education_center_pro_get_about_title',
    ) );

    /** About Content */
    $wp_customize->add_setting( 
        'about_content', 
        array(
            'default'           => '', 
            'sanitize_callback' => 'wp_kses_post',
        ) 
    );
    
    $wp_customize->add_control(
        'about_content',
        array(
            'section'         => 'about_section',
            'label'           => __( 'Section Description', 'best-recipe' ),
            'type'            => 'textarea',
        )   
    );

    /** View More Label */
    $wp_customize->add_setting(
        'read_more_lbl',
        array(
            'default'           => esc_html__( 'Read More', 'best-recipe' ),
            'sanitize_callback' => 'sanitize_text_field', 
            'transport'			=> 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'read_more_lbl',
        array(
            'type'            => 'text',
            'section'         => 'about_section',
            'label'           => __( 'View More Text', 'best-recipe' ),
        )
    );

    $wp_customize->selective_refresh->add_partial( 'read_more_lbl', array(
        'selector'        => '.home .site .about .about__intro a.btn-primary',
        'render_callback' => 'education_center_pro_get_read_more_lbl',
    ) );

    /** View More Link */
    $wp_customize->add_setting(
        'read_more_link',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'read_more_link',
        array(
            'label'           => __( 'View More Link', 'best-recipe' ),
            'section'         => 'about_section',
            'type'            => 'text',
        )
    );

    /** About Featured Image */
	$wp_customize->add_setting( 
		'about_featured_image', 
		array(
			'default' 			=> '',
			'sanitize_callback' => 'esc_url_raw'
    	)
	);
 
    $wp_customize->add_control( 
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'about_featured_image', 
			array(
				'label'      => __( 'Upload an image', 'best-recipe' ),
				'section'    => 'about_section',
			)
    	)
	);

}
add_action( 'customize_register', 'best_recipe_customize_register_about_section' );

function best_recipe_customize_register_video_section( $wp_customize ){

    $wp_customize->add_section( 'best_recipe_video_section', 
	    array(
	        'title'         => esc_html__( 'Video Section', 'best-recipe' ),
	        'priority'      => 50,
	        'panel'         => 'frontpage_settings'
	    ) 
	);

    /** Enable Video Section */
    $wp_customize->add_setting( 
        'ed_video_sec', 
        array(
            'default'           => true,
            'sanitize_callback' => 'good_looking_blog_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Good_Looking_Blog_Toggle_Control( 
            $wp_customize,
            'ed_video_sec',
            array(
                'section'     => 'best_recipe_video_section',
                'label'	      => esc_html__( 'Enable Video Section', 'best-recipe' ),
                'description' => esc_html__( 'Enable to hide Video section.', 'best-recipe' ),
            )
        )
    );

    $wp_customize->add_setting(
        'video_section_title',
        array(
            'default'           => esc_html__( 'Watch if, Cook it', 'best-recipe' ),
            'sanitize_callback' => 'sanitize_text_field',
			'transport'			=>	'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'video_section_title',
        array(
            'section'           => 'best_recipe_video_section',
            'label'             => esc_html__( 'Section Title', 'best-recipe' ),
            'type'              => 'text',
        )
    );

 	$wp_customize->selective_refresh->add_partial( 'video_section_title', array(
        'selector'        => '.editors-picks-section .section-header h2.section-title',
        'render_callback' => 'best_recipe_video_section_title',
    ) );

    $wp_customize->add_setting(
		'video_post_one',
		array(
			'default'			=> '',
			'sanitize_callback' => 'good_looking_blog_sanitize_select'
		)
	);

	$wp_customize->add_control(
		'video_post_one',
		array(
			'label'   => esc_html__( 'Select Video post one', 'best-recipe' ),
			'section' => 'best_recipe_video_section',
			'choices' => good_looking_blog_get_posts( 'post', false ),
			'type'    => 'select'
		)		
	);

	$wp_customize->add_setting(
		'video_post_two',
		array(
			'default'			=> '',
			'sanitize_callback' => 'good_looking_blog_sanitize_select'
		)
	);

	$wp_customize->add_control(
		'video_post_two',
		array(
			'label'   => esc_html__( 'Select Video post two', 'best-recipe' ),
			'section' => 'best_recipe_video_section',
			'choices' => good_looking_blog_get_posts( 'post', false ),
			'type'    => 'select'
		)		
	);

	$wp_customize->add_setting(
		'video_post_three',
		array(
			'default'			=> '',
			'sanitize_callback' => 'good_looking_blog_sanitize_select'
		)
	);

	$wp_customize->add_control(
		'video_post_three',
		array(
			'label'   => esc_html__( 'Select Video post three', 'best-recipe' ),
			'section' => 'best_recipe_video_section',
			'choices' => good_looking_blog_get_posts( 'post', false ),
			'type'    => 'select'
		)		
	);

	$wp_customize->add_setting(
		'video_post_four',
		array(
			'default'			=> '',
			'sanitize_callback' => 'good_looking_blog_sanitize_select'
		)
	);

	$wp_customize->add_control(
		'video_post_four',
		array(
			'label'   => esc_html__( 'Select Video post four', 'best-recipe' ),
			'section' => 'best_recipe_video_section',
			'choices' => good_looking_blog_get_posts( 'post', false ),
			'type'    => 'select'
		)		
	);

	$wp_customize->add_setting(
		'video_post_five',
		array(
			'default'			=> '',
			'sanitize_callback' => 'good_looking_blog_sanitize_select'
		)
	);

	$wp_customize->add_control(
		'video_post_five',
		array(
			'label'   => esc_html__( 'Select Video post five', 'best-recipe' ),
			'section' => 'best_recipe_video_section',
			'choices' => good_looking_blog_get_posts( 'post', false ),
			'type'    => 'select'
		)		
	);

}
add_action( 'customize_register', 'best_recipe_customize_register_video_section' );