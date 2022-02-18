<?php 
/**
 * Best Recipe functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Best_Recipe
 */

function best_recipe_after_theme_setup(){
    add_image_size( 'homepage-slider', 1475, 700, true );
    add_image_size( 'video-post-large', 670, 610, true );
    add_image_size( 'video-post-small', 323, 223, true );
    add_image_size( 'blog-post', 280, 210, true );
}
add_action( 'after_setup_theme', 'best_recipe_after_theme_setup' );

function best_recipe_styles() {
    $my_theme = wp_get_theme();
    $version  = $my_theme['Version'];

    wp_enqueue_style( 'good-looking-blog', get_template_directory_uri()  . '/style.css' );
    wp_enqueue_style( 'best-recipe', get_stylesheet_directory_uri() . '/style.css', array( 'good-looking-blog' ), $version );

    wp_enqueue_style( 'owl-carousel', get_stylesheet_directory_uri() . '/css/owl.carousel.css', array(), '2.3.4' );
    wp_enqueue_script( 'owl-carousel-js', get_stylesheet_directory_uri() . '/js/owl.carousel.js', array( 'jquery' ), '2.3.4', true );

    wp_enqueue_script( 'custom-child', get_stylesheet_directory_uri() . '/js/custom-child.js', array( 'jquery' ), $version, true );

    $array = array( 
        'rtl'           => is_rtl(),
        'auto'          => (bool) get_theme_mod( 'slider_auto', true ),
        'loop'          => (bool) get_theme_mod( 'slider_loop', true ),
    );
    
    wp_localize_script( 'custom-child', 'best_recipe_data', $array );

}
add_action( 'wp_enqueue_scripts', 'best_recipe_styles', 10 );