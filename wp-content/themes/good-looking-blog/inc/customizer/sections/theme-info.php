<?php
/**
 * Good Looking Blog Pro Theme Info
 *
 * @package Good_Looking_Blog
 */
if( ! function_exists( 'good_looking_blog_customizer_theme_info' ) ) :

function good_looking_blog_customizer_theme_info( $wp_customize ) {
	
    $wp_customize->add_section( 'theme_info', 
        array(
            'title'    => esc_html__( 'Information Links' , 'good-looking-blog' ),
            'priority' => 6,
		)
    );

	/** Important Links */
	$wp_customize->add_setting( 'theme_info_theme',
        array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $theme_info = '<ul>';
    $theme_info .= sprintf( __( '<li>View documentation: %1$sClick here.%2$s</li>', 'good-looking-blog' ),  '<a href="' . esc_url( 'https://glthemes.com/documentation/good-looking-blog/' ) . '" target="_blank">', '</a>' );
    $theme_info .= sprintf( __( '<li>Theme info: %1$sClick here.%2$s</li>', 'good-looking-blog' ),  '<a href="' . esc_url( 'https://glthemes.com/wordpress-theme/good-looking-blog/' ) . '" target="_blank">', '</a>' );
    $theme_info .= sprintf( __( '<li>Support ticket: %1$sClick here.%2$s</li>', 'good-looking-blog' ),  '<a href="' . esc_url( 'https://glthemes.com/support/' ) . '" target="_blank">', '</a>' );
    $theme_info .= sprintf( __( '<li>More WordPress Themes: %1$sClick here.%2$s</li>', 'good-looking-blog' ),  '<a href="' . esc_url( 'https://glthemes.com/wordpress-theme/' ) . '" target="_blank">', '</a>' );
    $theme_info .= '</ul>';

	$wp_customize->add_control( new Good_Looking_Blog_Note_Control( $wp_customize,
        'theme_info_theme',
            array(
                'label'       => esc_html__( 'Important Links' , 'good-looking-blog' ),
                'section'     => 'theme_info',
                'description' => $theme_info
    		)
        )
    );

}
endif;
add_action( 'customize_register', 'good_looking_blog_customizer_theme_info' );

if( class_exists( 'WP_Customize_Section' ) ) :
/**
 * Adding Go to Pro Section in Customizer
 * https://github.com/justintadlock/trt-customizer-pro
 */
class Good_Looking_Blog_Customize_Section_Pro extends WP_Customize_Section {

    /**
     * The type of customize section being rendered.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $type = 'pro-section';

    /**
     * Custom button text to output.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $pro_text = '';

    /**
     * Custom pro button URL.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $pro_url = '';

    /**
     * Add custom parameters to pass to the JS via JSON.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function json() {
        $json = parent::json();

        $json['pro_text'] = $this->pro_text;
        $json['pro_url']  = esc_url( $this->pro_url );

        return $json;
    }

    /**
     * Outputs the Underscore.js template.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    protected function render_template() { ?>
        <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
            <h3 class="accordion-section-title">
                {{ data.title }}
                <# if ( data.pro_text && data.pro_url ) { #>
                    <a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
                <# } #>
            </h3>
        </li>
    <?php }
}
endif;

if ( ! function_exists( 'good_looking_blog_sections_pro' ) ) :

function good_looking_blog_sections_pro( $manager ) {
    // Register custom section types.
    $manager->register_section_type( 'Good_Looking_Blog_Customize_Section_Pro' );

    // Register sections.
    $manager->add_section(
        new Good_Looking_Blog_Customize_Section_Pro(
            $manager,
            'good_looking_blog_view_pro',
            array(
                'title'    => esc_html__( 'Pro Available', 'good-looking-blog' ),
                'priority' => 5, 
                'pro_text' => esc_html__( 'VIEW PRO THEME', 'good-looking-blog' ),
                'pro_url'  => 'https://glthemes.com/wordpress-theme/good-looking-blog-pro/'
            )
        )
    );
}
endif;
add_action( 'customize_register', 'good_looking_blog_sections_pro' );