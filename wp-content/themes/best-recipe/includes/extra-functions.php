<?php

/**
 * Extra functions to enhance the theme functionality
 */

/**
 * Function to list post categories in customizer options
 */
function good_looking_blog_get_categories($select = true, $taxonomy = 'category', $slug = false)
{
    /* Option list of all categories */
    $categories = array();

    $args = array(
        'hide_empty' => false,
        'taxonomy'   => $taxonomy
    );

    $catlists = get_terms($args);
    if ($select) $categories[''] = __('Choose Category', 'best-recipe');
    foreach ($catlists as $category) {
        if ($slug) {
            $categories[$category->slug] = $category->name;
        } else {
            $categories[$category->term_id] = $category->name;
        }
    }

    return $categories;
}

/**
 * Get page ids from page name.
 */
function best_recipe_get_id_from_page($slider_pages)
{
    if ($slider_pages) {
        $ids = array();
        foreach ($slider_pages as $p) {
            if (!empty($p['page'])) {
                $page_ids = get_page_by_title($p['page']);
                $ids[] = $page_ids->ID;
            }
        }
        return $ids;
    } else {
        return false;
    }
}

/**
 * Entry Header
 */
function good_looking_blog_entry_header()
{
    if (is_single()) { ?>
        <header class="entry-header">
            <div class="category--wrapper">
                <?php good_looking_blog_category(); ?>
            </div>
            <div class="entry-title-wrapper">
                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
            </div>
            <?php good_looking_blog_single_author_meta(); ?>
        </header>
    <?php } elseif( is_home() ) { ?>
        <header class="entry-header">
            <div class="entry-meta">
                <?php good_looking_blog_category(); ?>
            </div><!-- .entry-meta -->
            <div class="entry-details">
                <?php
                the_title('<h3 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>');
                if (has_excerpt()) {
                    the_excerpt('<p>', '</p>');
                } else {
                ?><p> <?php echo wp_trim_words(get_the_content(), 25, ''); ?></p>
                <?php }
                good_looking_blog_author_meta();
                ?>
            </div>
        </header><!-- .entry-header -->
    <?php } else { ?>
        <header class="entry-header">
			<div class="entry-meta">
				<?php good_looking_blog_category(); ?>
			</div><!-- .entry-meta -->
			<div class="entry-details">
				<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );	?>
			</div>
		</header><!-- .entry-header -->
    <?php
    }
}

function good_looking_blog_post_thumbnail()
{

    if (post_password_required() || is_attachment()) {
        return;
    }

    if (is_singular()) : ?>

        <div class="post-thumbnail">
            <?php the_post_thumbnail('full', array('itemprop' => 'image')); ?>
        </div><!-- .post-thumbnail -->

    <?php else : ?>

        <figure class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()) { ?>
                <?php the_post_thumbnail('blog-post', array('itemprop' => 'image'));
                } else {
                    good_looking_blog_get_fallback_svg('blog-post');
                } ?>
            </a>
        </figure>

<?php
    endif; // End is_singular().
}