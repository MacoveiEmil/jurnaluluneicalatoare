<?php

/**
 * Video Section
 *
 * @package Best_Recipe
 */

$ed_section     = get_theme_mod('ed_video_sec', true);
$sec_title      = get_theme_mod('video_section_title', esc_html__('Watch if, Cook it', 'best-recipe'));
$video_one      = get_theme_mod('video_post_one');
$video_two      = get_theme_mod('video_post_two');
$video_three    = get_theme_mod('video_post_three');
$video_four     = get_theme_mod('video_post_four');
$video_five     = get_theme_mod('video_post_five');

if (!$ed_section && ($sec_title || $video_one || $video_two || $video_three || $video_four || $video_five)) { ?>
    <section id="video_section" class="video-section">
        <div class="container">
            <?php if ($sec_title) { ?>
                <header class="section-header">
                    <h2 class="section-title">
                        <?php echo esc_html($sec_title); ?>
                    </h2>
                </header>
                <?php }
            if ($video_one || $video_two || $video_three || $video_four || $video_five) {
                $video_args = array(
                    'post_status'    => 'publish',
                    'post_type'      => 'post',
                    'post__in'       => array($video_one, $video_two, $video_three, $video_four, $video_five),
                    'orderby'        => 'post__in',
                    'posts_per_page' => -1,
                );
                $video_qry = new WP_Query($video_args);
                if ($video_qry->have_posts()) { ?>
                    <div class="grid">
                        <?php while ($video_qry->have_posts()) {
                            $video_qry->the_post();
                            if ($video_qry->current_post == 2) {
                                $image_size = 'video-post-large';
                                $div_class  = 'large-post';
                            } else {
                                $image_size = 'video-post-small';
                                $div_class  = 'small-post';
                            }
                            if ($video_qry->current_post == 0 || $video_qry->current_post == 2 || $video_qry->current_post == 3) echo '<div class="' . esc_attr($div_class) . '">' ?>
                            <div class="video-posts">
                                <div class="image">
                                    <figure class="post-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php if (has_post_thumbnail()) { ?>
                                            <?php the_post_thumbnail($image_size, array('itemprop' => 'image'));
                                            } else {
                                                good_looking_blog_get_fallback_svg($image_size);
                                            } ?>
                                        </a>
                                    </figure>
                                </div>
                                <div class="content-wrapper">
                                    <div class="entry-meta">
                                        <?php good_looking_blog_category(); ?>
                                    </div>
                                    <?php
                                        the_title('<a href="' . esc_url( get_permalink() ) . '"><h5 class="entry-title">', '</h5></a>');
                                        good_looking_blog_author_meta();
                                    ?>
                                </div>
                            </div>
                        <?php if ($video_qry->current_post == 1 || $video_qry->current_post == 2 || $video_qry->current_post == 4) echo '</div>';
                        }
                        wp_reset_query(); ?>
                    </div>
            <?php }
            } ?>
        </div>
    </section>
<?php }
