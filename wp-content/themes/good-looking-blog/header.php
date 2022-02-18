<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Good_Looking_Blog
 */

    /**
    *  DOCTYPE hook
    * 
    * @hooked good_looking_blog_doctype
    */
    do_action( 'good_looking_blog_doctype' );
?>
<head itemscope itemtype="https://schema.org/WebSite">
<?php 
    /**
     * Before wp_head
     * 
     * @hooked good_looking_blog_head
    */
    do_action( 'good_looking_blog_before_wp_head' );

	wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">
<?php wp_body_open(); ?>

<?php
    /**
     * Before Header
     * 
     * @hooked good_looking_blog_page_start 
    */
    do_action( 'good_looking_blog_before_header' );

	/**
	 * Header
	 * 
	 * @hooked good_looking_blog_header 
	 */
	do_action( 'good_looking_blog_header' );

    /**
	 * * @hooked good_looking_blog_primary_page_header - 10
	*/
	do_action( 'good_looking_blog_before_posts_content' );