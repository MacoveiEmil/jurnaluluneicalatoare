<?php

/**
 * Frontpage Editor posts section
 *
 * @package Good_Looking_Blog
 */

$editor_title       = get_theme_mod('editor_post_section_title',  esc_html__('Recipes Of The Week', 'best-recipe'));
$editor_posts_one   = get_theme_mod('editor_post_one');
$editor_posts_two   = get_theme_mod('editor_post_two');
$editor_posts_three = get_theme_mod('editor_post_three');
$editor_posts_four  = get_theme_mod('editor_post_four');
$editor_posts_five  = get_theme_mod('editor_post_five');
$editor_posts_six   = get_theme_mod('editor_post_six');
$ed_editor          = get_theme_mod('ed_editor_section', true);

if (!$ed_editor && ($editor_title || $editor_posts_one || $editor_posts_two || $editor_posts_three || $editor_posts_four || $editor_posts_five || $editor_posts_six)) { ?>
    <section id="editor_section" class="editors-picks-section">
        <div class="container">
            <div id="primary" class="content-area">
                <div class="page-grid">
                    <div class="site-main" id="main">
                        <?php if ($editor_title) { ?>
                            <header class="section-header">
                                <h2 class="section-title">
                                    <?php echo esc_html($editor_title); ?>
                                </h2>
                            </header>
                            <?php }
                        if ($editor_posts_one || $editor_posts_two || $editor_posts_three || $editor_posts_four || $editor_posts_five || $editor_posts_six) {
                            $editor_args = array(
                                'post_status'    => 'publish',
                                'post_type'      => 'post',
                                'orderby'        => 'post__in',
                                'posts_per_page' => -1,
                                'post__in'       => array($editor_posts_one, $editor_posts_two, $editor_posts_three, $editor_posts_four, $editor_posts_five, $editor_posts_six)
                            );
                            $editor_qry = new WP_Query($editor_args);
                            if ($editor_qry->have_posts()) { ?>
                                <div class="editor-choice-wrapper">
                                    <?php while ($editor_qry->have_posts()) {
                                        $editor_qry->the_post(); ?>
                                        <div class="editor-post">
                                            <div class="image">
                                                <figure class="post-thumbnail">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php if (has_post_thumbnail()) { ?>
                                                        <?php the_post_thumbnail('good_looking_blog_editor', array('itemprop' => 'image'));
                                                        } else {
                                                            good_looking_blog_get_fallback_svg('good_looking_blog_editor');
                                                        } ?>
                                                    </a>
                                                </figure>
                                            </div>
                                            <header class="entry-header">
                                                <div class="entry-meta">
                                                    <?php good_looking_blog_category(); ?>
                                                </div>
                                                <div class="entry-details">
                                                    <?php
                                                    the_title(sprintf('<h3 class="entry-title"><a href="%s">',  esc_url(get_permalink())), '</a></h3>');
                                                    good_looking_blog_author_meta();
                                                    if (has_excerpt()) {
                                                        the_excerpt();
                                                    } else {
                                                    ?><p> <?php echo wp_trim_words(get_the_content(), 25, ''); ?></p>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </header>
                                        </div>
                                    <?php }  ?>
                                </div>
                        <?php }
                            wp_reset_postdata();
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php }
