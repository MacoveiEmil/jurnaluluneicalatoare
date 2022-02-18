<?php
/**
 * Contact Form Settings
 * 
 * @package Good_Looking_Blog
 */

function good_looking_blog_contact_page_form( $wp_customize ){
    
	$wp_customize->add_section( 'contact_page_form', 
	    array(
	        'title'         => esc_html__( 'Contact Form Section', 'good-looking-blog' ),
	        'priority'      => 30,
            'panel'         => 'contact_page_settings',
	    ) 
	);

	$wp_customize->add_setting(
		'contact_form_title',
		array(
			'default'           => __( 'Ready to Talk', 'good-looking-blog' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'			=> 'postMessage'
		)
	);
	
	$wp_customize->add_control(
		'contact_form_title',
		array(
			'section'           => 'contact_page_form',
			'label'             => __( 'Contact Form Title', 'good-looking-blog' ),
			'type'              => 'text',
		)
	);

	$wp_customize->selective_refresh->add_partial( 'contact_form_title', array(
        'selector'        => '.page-template-contact .contact-form-wrapper .section-header h2.section-title',
        'render_callback' => 'good_looking_blog_contact_form_title',
    ) );

	$wp_customize->add_setting(
		'contact_form_shortcode',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	
	$wp_customize->add_control(
		'contact_form_shortcode',
		array(
			'section'           => 'contact_page_form',
			'label'             => __( 'Contact Form Shortcode', 'good-looking-blog' ),
            'description'       => __( 'Please generate the shortcode from contact form 7 widget', 'good-looking-blog' ),
			'type'              => 'text',
		)
	);
}

add_action( 'customize_register', 'good_looking_blog_contact_page_form' );