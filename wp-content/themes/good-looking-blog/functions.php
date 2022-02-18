<?php
/**
 * Good Looking Blog functions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Good_Looking_Blog
 */

 /**
 * After Setup Theme Hooks, Styles and Scripts
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

 /**
 * Extra functions which will enhance theme's functionality
 */
require get_template_directory() . '/inc/extra-functions.php';

/**
 * Custom Controls
 */
require get_template_directory() . '/inc/custom-controls/custom-control.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Plugin Recommendation
*/
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';

/**
 * Add theme compatibility function for woocommerce if active
*/
if( is_woocommerce_activated() ){
    require get_template_directory() . '/inc/woo-functions.php';    
}

/**
 * Metabox
 */
require get_template_directory() . '/inc/metabox.php';