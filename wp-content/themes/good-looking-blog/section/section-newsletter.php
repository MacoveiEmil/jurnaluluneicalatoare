<?php
/**
 * Newsletter Section
 * 
 * @package Good_Looking_Blog
 */
$newsletter_shortcode = get_theme_mod( 'newsletter_shortcode' );
$ed_newsletter        = get_theme_mod( 'ed_newsletter_section', true );

if( ! $ed_newsletter && is_btnw_activated() && $newsletter_shortcode ){ ?>
    <section id="newsletter_section" class="newsletter-section">
        <div class="container">
            <div class="dt-newsletter-wrapper">
                <div class="right-wrapper">
                    <?php 
                        if( $newsletter_shortcode ) echo do_shortcode( $newsletter_shortcode ); 
                    ?>
                </div>    
            </div>
        </div>
    </section>
<?php }
