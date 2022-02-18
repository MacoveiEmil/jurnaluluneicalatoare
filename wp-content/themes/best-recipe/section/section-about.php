<?php

/**
 * About Section
 *
 * @package Best_Recipe
 */

$ed_abt_sec     = get_theme_mod('ed_abt_sec', true);
$sec_title      = get_theme_mod('about_title', esc_html__('Hello there! I am Jessica. Start cooking with me', 'best-recipe'));
$sec_content    = get_theme_mod('about_content');
$sec_btn        = get_theme_mod('read_more_lbl', esc_html__('Read More', 'best-recipe'));
$sec_btn_link   = get_theme_mod('read_more_link');
$sec_img        = get_theme_mod('about_featured_image');

if (!$ed_abt_sec && ($sec_title || $sec_content || $sec_img || ($sec_btn && $sec_btn_link))) { ?>
    <section id="about_section" class="about-section">
        <div class="container">
            <div class="content-wrapper">
                <?php if ($sec_img) echo '<div class="about-image"><img src="' . esc_url($sec_img) . '"></div>'; ?>
                <?php if ($sec_title || $sec_content || ($sec_btn && $sec_btn_link)) { ?>
                    <div class="about-content-wrapper">
                        <div class="about-content">
                            <?php
                            if ($sec_title) echo '<h2 class="section-title">' . esc_html($sec_title) . '</h2>';
                            if ($sec_content) echo '<div class="section-content">' . wp_kses_post(wpautop($sec_content)) . '</div>';
                            if ($sec_btn && $sec_btn_link) echo '<a href="' . esc_url($sec_btn_link) . '" target="_blank" class="btn-readmore">' . esc_html($sec_btn) . '</a>';
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php }
