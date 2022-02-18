<?php
/**
 * Miscellaneous Settings
 *
 * @package Good_Looking_Blog
 */
if( ! function_exists( 'good_looking_blog_customize_register_post_page_settings' ) ) :

function good_looking_blog_customize_register_post_page_settings( $wp_customize ) {

    /** Miscellaneous Settings */
    $wp_customize->add_section(
        'post_page_settings',
        array(
            'title'    => esc_html__( 'Post Settings', 'good-looking-blog' ),
            'priority' => 20,
            'panel'    => 'general_settings',
        )
    );

    /** Line break */
    $wp_customize->add_setting(
        'post_page_note_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Good_Looking_Blog_Note_Control( 
            $wp_customize,
            'post_page_note_text',
            array(
                'section'	  => 'post_page_settings',
                'label'       => esc_html__( 'Single Post Settings', 'good-looking-blog' ),
                'description' => '<hr/>',
            )
        )
    ); 
    
    /** Hide Author Section */
    $wp_customize->add_setting( 
        'ed_post_author', 
        array(
            'default'           => false,
            'sanitize_callback' => 'good_looking_blog_sanitize_checkbox'
        ) 
    );

    $wp_customize->add_control(
        new Good_Looking_Blog_Toggle_Control( 
            $wp_customize,
            'ed_post_author',
            array(
                'section'     => 'post_page_settings',
                'label'	      => esc_html__( 'Hide Author', 'good-looking-blog' ),
                'description' => esc_html__( 'Enable to hide author shown below post title.', 'good-looking-blog' ),
            )
        )
    );

    /** Hide Posted Date */
    $wp_customize->add_setting( 
        'ed_post_date', 
        array(
            'default'           => false,
            'sanitize_callback' => 'good_looking_blog_sanitize_checkbox'
        ) 
    );

    $wp_customize->add_control(
        new Good_Looking_Blog_Toggle_Control( 
            $wp_customize,
            'ed_post_date',
            array(
                'section'     => 'post_page_settings',
                'label'	      => esc_html__( 'Hide Posted Date', 'good-looking-blog' ),
                'description' => esc_html__( 'Enable to hide posted date shown below post title.', 'good-looking-blog' ),
            )
        )
    );
    
    /** Hide Comment count in Banner meta */
    $wp_customize->add_setting( 
        'ed_banner_comments', 
        array(
            'default'           => false,
            'sanitize_callback' => 'good_looking_blog_sanitize_checkbox'
        ) 
    );

    $wp_customize->add_control(
        new Good_Looking_Blog_Toggle_Control( 
            $wp_customize,
            'ed_banner_comments',
            array(
                'section'     => 'post_page_settings',
                'label'	      => esc_html__( 'Hide comments', 'good-looking-blog' ),
                'description' => esc_html__( 'Enable to hide comments number shown below post title.', 'good-looking-blog' ),
            )
        )
    );

    $wp_customize->add_setting( 
        'ed_post_read_calc', 
        array(
            'default'           => false,
            'sanitize_callback' => 'good_looking_blog_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Good_Looking_Blog_Toggle_Control( 
            $wp_customize,
            'ed_post_read_calc',
            array(
                'section'     => 'post_page_settings',
                'label'       => esc_html__( 'Hide Post Reading Calculation', 'good-looking-blog' ),
                'description' => esc_html__( 'Enable to hide post reading calculation.', 'good-looking-blog' ),
            )
        )
    );

    $wp_customize->add_setting( 
        'read_words_per_minute', 
        array(
            'default'           => 200,
            'sanitize_callback' => 'good_looking_blog_sanitize_number_absint'
        ) 
    );
    
    $wp_customize->add_control(          
        'read_words_per_minute',
        array(
            'section'     => 'post_page_settings',
            'label'       => esc_html__( 'Read Words Per Minute', 'good-looking-blog' ),
            'type'        => 'number',
            'input_attrs'     => array(
                'min'   => 100,
                'max'   => 1000,
                'step'  => 10,
            )                 
        )
    );

    /** Related Posts section title */
    $wp_customize->add_setting(
        'related_post_title',
        array(
            'default'           => esc_html__( 'You might also like', 'good-looking-blog' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'related_post_title',
        array(
            'type'            => 'text',
            'section'         => 'post_page_settings',
            'label'           => esc_html__( 'Related Posts Section Title', 'good-looking-blog' ),
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'related_post_title', array(
        'selector'        => '.additional-post h3.post-title',
        'render_callback' => 'good_looking_blog_related_posts_title',
    ) );

}
endif;
add_action( 'customize_register', 'good_looking_blog_customize_register_post_page_settings' );