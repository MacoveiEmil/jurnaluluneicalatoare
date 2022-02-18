<?php
/**
 * Contact Page Theme Option.
 * 
 * @package Good_Looking_Blog
 */
    
function good_looking_blog_customize_register_contact( $wp_customize ) {
    
    /** contact Page Settings */
    $wp_customize->add_panel( 
        'contact_page_settings',
         array(
            'priority'    => 45,
            'title'       => __( 'Contact Page Settings', 'good-looking-blog' ),
            'description' => __( 'Customize contact Page Sections', 'good-looking-blog' ),
        ) 
    );

}
add_action( 'customize_register', 'good_looking_blog_customize_register_contact' );