<?php
/**
 * Contact Form Settings
 * 
 * @package Good_Looking_Blog
 */

function good_looking_blog_contact_page_info( $wp_customize ){
    
	$wp_customize->add_section( 'contact_info_section', 
	    array(
	        'title'         => esc_html__( 'Contact Details Section', 'good-looking-blog' ),
	        'priority'      => 10,
            'panel'         => 'contact_page_settings',
	    ) 
	);

	$wp_customize->add_setting(
		'location_title',
		array(
			'default'           => __( 'Visit Us:', 'good-looking-blog' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'			=> 'postMessage'
		)
	);
	
	$wp_customize->add_control(
		'location_title',
		array(
			'section'           => 'contact_info_section',
			'label'             => __( 'Location Title', 'good-looking-blog' ),
			'type'              => 'text',
		)
	);

	$wp_customize->selective_refresh->add_partial( 'location_title', array(
        'selector'        => '.contact-info .location-wrapper .location-details span.location-title',
        'render_callback' => 'good_looking_blog_contact_location_title',
    ) );

	$wp_customize->add_setting(
		'location',
		array(
			'default'           => __( '27 Division St, New York, NY 10002, USA', 'good-looking-blog' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'			=> 'postMessage'
		)
	);
	
	$wp_customize->add_control(
		'location',
		array(
			'section'           => 'contact_info_section',
			'label'             => __( 'Location Description', 'good-looking-blog' ),
			'type'              => 'text',
		)
	);

	$wp_customize->selective_refresh->add_partial( 'location', array(
        'selector'        => '.contact-info .location-wrapper .location-details .location-desc',
        'render_callback' => 'good_looking_blog_contact_location_description',
    ) );

	$wp_customize->add_setting(
		'mail_title',
		array(
			'default'           => __( 'Mail Us:', 'good-looking-blog' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'			=> 'postMessage'
		)
	);
	
	$wp_customize->add_control(
		'mail_title',
		array(
			'section'           => 'contact_info_section',
			'label'             => __( 'Mail Title', 'good-looking-blog' ),
			'type'              => 'text',
		)
	);

	$wp_customize->selective_refresh->add_partial( 'mail_title', array(
        'selector'        => '.contact-info .email-wrapper .email-details span.email-title',
        'render_callback' => 'good_looking_blog_contact_email_title',
    ) );

	$wp_customize->add_setting(
		'mail_description',
		array(
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
			'transport'			=> 'postMessage'
		)
	);
	
	$wp_customize->add_control(
		'mail_description',
		array(
			'section'           => 'contact_info_section',
			'label'             => __( 'Email Address', 'good-looking-blog' ),
			'description'		=> __( 'You can add multiple emails by seperating it with comma. For example: xyz@gmail.com, abc@yahoo.com', 'good-looking-blog' ), 
			'type'              => 'text',
		)
	);

	$wp_customize->selective_refresh->add_partial( 'mail_description', array(
        'selector'        => '.contact-info .email-wrapper .email-details .email-desc',
        'render_callback' => 'good_looking_blog_contact_email_description',
    ) );
       
	$wp_customize->add_setting(
		'phone_title',
		array(
			'default'           => __( 'Phone Us:', 'good-looking-blog' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'			=> 'postMessage'
		)
	);
	
	$wp_customize->add_control(
		'phone_title',
		array(
			'section'           => 'contact_info_section',
			'label'             => __( 'Phone Us Title', 'good-looking-blog' ),
			'type'              => 'text',
		)
	);

	$wp_customize->selective_refresh->add_partial( 'phone_title', array(
        'selector'        => '.contact-info .phone-wrapper .phone-details .phone-title',
        'render_callback' => 'good_looking_blog_contact_phone_title',
    ) );

	$wp_customize->add_setting(
		'phone_number',
		array(
			'default'           => __( '+1 (800) 123 456 789', 'good-looking-blog' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'			=> 'postMessage'
		)
	);
	
	$wp_customize->add_control(
		'phone_number',
		array(
			'section'           => 'contact_info_section',
			'label'             => __( 'Phone Number', 'good-looking-blog' ),
			'description'       => __( 'You can add multiple phone number seperating with comma', 'good-looking-blog' ),
			'type'              => 'text',
		)
	);

	$wp_customize->selective_refresh->add_partial( 'phone_number', array(
        'selector'        => '.contact-info .phone-wrapper .phone-details .phone-number',
        'render_callback' => 'good_looking_blog_contact_phone_number',
    ) );
}

add_action( 'customize_register', 'good_looking_blog_contact_page_info' );