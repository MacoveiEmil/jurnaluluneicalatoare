<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Good_Looking_Blog
 */

 $sidebar = good_looking_blog_sidebar_layout();

if ( $sidebar == 'full-width' ){
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary" itemscope itemtype="http://schema.org/WPSideBar">
	<?php dynamic_sidebar( 'sidebar' ); ?>
</aside><!-- #secondary -->