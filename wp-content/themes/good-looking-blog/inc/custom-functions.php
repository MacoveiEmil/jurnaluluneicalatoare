<?php 
/**
 * Good Looking Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Good_Looking_Blog
 */

$good_looking_blog_theme_data = wp_get_theme();
if( ! defined( 'GOOD_LOOKING_BLOG_VERSION' ) ) define( 'GOOD_LOOKING_BLOG_VERSION', $good_looking_blog_theme_data->get( 'Version' ) );
if( ! defined( 'GOOD_LOOKING_BLOG_NAME' ) ) define( 'GOOD_LOOKING_BLOG_NAME', $good_looking_blog_theme_data->get( 'Name' ) );

if ( ! function_exists( 'good_looking_blog_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function good_looking_blog_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on good looking blog, use a find and replace
		 * to change 'good-looking-blog' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'good-looking-blog', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary-menu' => esc_html__( 'Primary', 'good-looking-blog' ),
				'footer-menu'  => esc_html__( 'Footer Menu', 'good-looking-blog' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'good_looking_blog_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 55,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_image_size( 'good_looking_blog_popular_posts', 447, 367, true );
		add_image_size( 'good_looking_blog_archive', 420, 345, true );
		add_image_size( 'good_looking_blog_editor', 446, 297, true );

	}
endif;
add_action( 'after_setup_theme', 'good_looking_blog_setup' );

if( ! function_exists( 'good_looking_blog_content_width' ) ) :
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function good_looking_blog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'good_looking_blog_content_width', 820 );
}
endif;
add_action( 'after_setup_theme', 'good_looking_blog_content_width', 0 );

if( ! function_exists( 'good_looking_blog_scripts' ) ) :

/**
 * Enqueue scripts and styles.
 */
function good_looking_blog_scripts() {

	// Use minified libraries if SCRIPT_DEBUG is false
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_style( 'good-looking-blog-google-fonts', good_looking_blog_google_fonts_url(), array(), null );

	wp_enqueue_style( 'good-looking-blog-style', get_stylesheet_uri(), array(), GOOD_LOOKING_BLOG_VERSION );
	wp_style_add_data( 'good-looking-blog-style', 'rtl', 'replace' );
	
	wp_enqueue_script( 'good-looking-blog-navigation', get_template_directory_uri() . '/inc/assets/js/navigation.js', array(), GOOD_LOOKING_BLOG_VERSION, true );

	wp_enqueue_script( 'good-looking-blog-accessibility', get_template_directory_uri() . '/js' . $build . '/modal-accessibility' . $suffix . '.js', array(), GOOD_LOOKING_BLOG_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script( 'good-looking-blog-custom', get_template_directory_uri() . '/js' . $build . '/custom' . $suffix . '.js',array( 'jquery' ), GOOD_LOOKING_BLOG_VERSION, true );
		
}
endif;
add_action( 'wp_enqueue_scripts', 'good_looking_blog_scripts' );

if ( ! function_exists( 'good_looking_blog_admin_scripts' ) ) :
/**
 * Enqueue admin css
*/
function good_looking_blog_admin_scripts() {
	wp_enqueue_style( 'good-looking-blog-admin-style', get_template_directory_uri() . '/inc/assets/css/admin.css', array(),	GOOD_LOOKING_BLOG_VERSION );
}
endif;
add_action( 'admin_enqueue_scripts', 'good_looking_blog_admin_scripts' );

if( ! function_exists( 'good_looking_blog_body_classes' ) ) :
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
	function good_looking_blog_body_classes( $classes ) {

		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		if(  is_archive() || is_search() ){
			$classes[] = 'layout-grid';
		}

		if( get_background_image() ) {
			$classes[] = 'custom-background-image';
		}
		
		// Adds a class of custom-background-color to sites with a custom background color.
		if( get_background_color() != 'ffffff' ) {
			$classes[] = 'custom-background-color';
		}

		$classes[] = good_looking_blog_sidebar_layout();

		return $classes;
	}
endif;
add_filter( 'body_class', 'good_looking_blog_body_classes' );

if( ! function_exists( 'good_looking_blog_pingback_header' ) ) :
/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function good_looking_blog_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
endif;
add_action( 'wp_head', 'good_looking_blog_pingback_header' );

if ( ! function_exists( 'good_looking_blog_widgets_init' ) ) :
/**
 * Good Looking Blog Widget Areas
 * 
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * @package Good_Looking_Blog
 */
function good_looking_blog_widgets_init(){    
    $sidebars = array(
        'sidebar'   => array(
            'name'        => __( 'Sidebar', 'good-looking-blog' ),
            'id'          => 'sidebar', 
            'description' => __( 'Default Sidebar', 'good-looking-blog' ),
        ),
        'ad-home'      => array(
            'name'        => __( 'Homepage Advertisement', 'good-looking-blog' ),
            'id'          => 'ad-home',
            'description' => __( 'Place an "Image" widget for advertisement in the homepage. Recommended image size is 1440px by 230px.', 'good-looking-blog' ),
        ),
        'footer-one'=> array(
            'name'        => __( 'Footer One', 'good-looking-blog' ),
            'id'          => 'footer-one', 
            'description' => __( 'Add footer one widgets here.', 'good-looking-blog' ),
        ),
        'footer-two'=> array(
            'name'        => __( 'Footer Two', 'good-looking-blog' ),
            'id'          => 'footer-two', 
            'description' => __( 'Add footer two widgets here.', 'good-looking-blog' ),
        ),
        'footer-three'=> array(
            'name'        => __( 'Footer Three', 'good-looking-blog' ),
            'id'          => 'footer-three', 
            'description' => __( 'Add footer three widgets here.', 'good-looking-blog' ),
        ),
        'footer-four'=> array(
            'name'        => __( 'Footer Four', 'good-looking-blog' ),
            'id'          => 'footer-four', 
            'description' => __( 'Add footer four widgets here.', 'good-looking-blog' ),
        )
    );
    
    foreach( $sidebars as $sidebar ){
        register_sidebar( array(
    		'name'          => esc_html( $sidebar['name'] ),
    		'id'            => esc_attr( $sidebar['id'] ),
    		'description'   => esc_html( $sidebar['description'] ),
    		'before_widget' => '<section id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</section>',
    		'before_title'  => '<h2 class="widget-title" itemprop="name">',
    		'after_title'   => '</h2>',
    	) );
    }

}
endif;
add_action( 'widgets_init', 'good_looking_blog_widgets_init' );