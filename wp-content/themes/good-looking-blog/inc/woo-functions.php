<?php 
/**
 * Woocommerce hooks and functions
 * 
 * @link https://docs.woothemes.com/document/third-party-custom-theme-compatibility/
 *
 * @package Good_Looking_Blog
 */

 /**
 * Woocommerce related hooks
*/
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content',  'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar',             'woocommerce_get_sidebar', 10 );
add_filter( 'woocommerce_show_page_title' ,     '__return_false' );

/**
 * Declare Woocommerce Support
*/
function good_looking_blog_woocommerce_support() {
    global $woocommerce;
    
    add_theme_support( 'woocommerce' );
    
    if( version_compare( $woocommerce->version, '3.0', ">=" ) ) {
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
    }
}
add_action( 'after_setup_theme', 'good_looking_blog_woocommerce_support');

/**
 * Before Content
 * Wraps all WooCommerce content in wrappers which match the theme markup
*/
function good_looking_blog_wc_wrapper(){    
    ?>
    <div id="primary" class="content-area">
        <div class="container">
            <div class="page-grid">
                <div id="main" class="site-main">
    <?php
}
add_action( 'woocommerce_before_main_content', 'good_looking_blog_wc_wrapper' );

/**
 * After Content
 * Closes the wrapping divs
*/
function good_looking_blog_wc_wrapper_end(){ ?>
                </div>
            </div>
        </div>
    </div>
    <?php 
}
add_action( 'woocommerce_after_main_content', 'good_looking_blog_wc_wrapper_end' );

