<?php

/**
 * Front Page
 *
 * @package Best_Recipe
 */

$home_sections =  array('banner', 'about', 'blog', 'video', 'newsletter', 'editor-pick', 'instagram');

if ('posts' == get_option('show_on_front')) {
    get_header();
    foreach ($home_sections as $section) {
        get_template_part('section/section-' . esc_attr($section));
    }
    get_footer();
} elseif ('page' == get_option('show_on_front')) {
    include(get_page_template());
}
