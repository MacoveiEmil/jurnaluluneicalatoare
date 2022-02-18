<?php 
/**
 * Section Section 
 * 
 * @package Good_Looking_Blog
 */

$instagram_title     = get_theme_mod( 'instagram_title',__( 'Instagram', 'good-looking-blog' ) );
$instagram_shortcode = get_theme_mod( 'instagram_shortcode' );
$ed_instagram        = get_theme_mod( 'ed_instagram_section', true );

if( ! $ed_instagram && ( $instagram_title || $instagram_shortcode ) ){ ?>
    <section id="instagram_section" class="instagram-section">
        <div class="container">
            <?php if( $instagram_title ){ ?>
                <div class="section-header">
                    <h2 class="section-title">
                        <?php echo esc_html( $instagram_title ); ?>
                    </h2>
                </div>
            <?php } if( $instagram_shortcode ){ ?>
                <div class="dt-instagram">
                    <?php echo do_shortcode( wp_kses_post( $instagram_shortcode ) ); ?>
                </div>
            <?php } ?>
        </div>
    </section>
<?php }