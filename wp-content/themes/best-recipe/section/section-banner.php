<?php

/**
 * Frontpage Banner
 *
 * @package Best_Recipe
 */

$banner           = get_theme_mod('ed_banner_section', 'slider_banner');
$slider_type      = get_theme_mod('slider_type', 'latest_posts');
$slider_cat       = get_theme_mod('slider_cat');
$slider_pages     = get_theme_mod('slider_pages');

$image_size = 'homepage-slider';

$args = array(
    'post_status'         => 'publish',
    'ignore_sticky_posts' => true
);

if ($slider_type === 'category' && $slider_cat) {
    $args['post_type']      = 'post';
    $args['cat']            = $slider_cat;
    $args['posts_per_page'] = -1;
} elseif ($slider_type == 'pages' && $slider_pages) {
    $args['post_type']      = 'page';
    $args['posts_per_page'] = -1;
    $args['post__in']       = best_recipe_get_id_from_page($slider_pages);
    $args['orderby']        = 'post__in';
} else {
    $args['post_type']      = 'post';
    $args['posts_per_page'] = $posts_per_page;
}

$qry = new WP_Query($args);

if ($banner == 'slider_banner' && $qry->have_posts()) { ?>
    <section id="banner_section" class="site-banner banner-slider style-one">
        <div class="item-wrap owl-carousel">
            <?php while ($qry->have_posts()) {
                $qry->the_post(); ?>
                <div class="item">
                    <?php if (has_post_thumbnail()) {
                        the_post_thumbnail($image_size, array('itemprop' => 'image'));
                    } else {
                        good_looking_blog_get_fallback_svg($image_size);
                    } ?>
                    <div class="banner-caption">
                        <div class="container">
                            <div class="cat-links">
                                <?php
                                good_looking_blog_category();
                                the_title(sprintf('<h2 class="banner-title"><a href="%s">',  esc_url(get_permalink())), '</a></h2>');
                                ?>
                            </div>
                            <?php good_looking_blog_author_meta(); ?>
                        </div>
                    </div>
                </div>
            <?php }
            wp_reset_postdata(); ?>
        </div>
    </section>
    <!-- section banner slider ends  -->
<?php }
