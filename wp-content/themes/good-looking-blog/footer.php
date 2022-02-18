<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Good_Looking_Blog
 */

?>
	<footer id="colophon" class="site-footer" itemscope itemtype="https://schema.org/WPFooter">
        <?php good_looking_blog_footer_top(); ?>
        <div class="footer-bottom">
            <div class="container">
                <?php 
                    good_looking_blog_footer_site_info();
                    good_looking_blog_footer_menu(); 
                ?> 
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
