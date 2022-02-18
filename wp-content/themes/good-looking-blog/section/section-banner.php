<?php
/**
 * Frontpage Banner
 * 
 * @package Good_Looking_Blog
 */

$banner           = get_theme_mod( 'ed_banner_section', 'static_banner' );
$banner_title     = get_theme_mod( 'banner_title', __( 'Donec Cras Ut Eget Justo Nec Semper Sapien Viverra Ante', 'good-looking-blog' ) );
$banner_desc      = get_theme_mod( 'banner_content',  __( 'Structured gripped tape invisible moulded cups for sauppor firm hold strong powermesh front liner sport detail.', 'good-looking-blog' ) );
$btn_one          = get_theme_mod( 'banner_btn_label', __( 'Read More', 'good-looking-blog' ) );
$btn_one_url      = get_theme_mod( 'banner_link', '#' );
$btn_two          = get_theme_mod( 'banner_btn_two_label', __( 'About Us', 'good-looking-blog' ) );
$btn_two_url      = get_theme_mod( 'banner_btn_two_link', '#' );

if( ( $banner == 'static_banner' ) && has_custom_header() ){ ?>
    <section id="banner_section" class="site-banner<?php if( has_header_video() ) echo esc_attr( ' video-banner' ); ?>">
        <div class="static-banner">
            <div class="banner-wrapper">
                <div class="banner-image-wrapper">
                    <?php the_custom_header_markup(); ?>
                </div>                     
                <?php if( $banner_title || $banner_desc || $btn_one || $btn_two ) { ?> 
                    <div class="container">
                        <div class="banner-details-wrapper">
                            <div class="container">
                                <div class="overlay-details">
                                    <?php if( $banner_title ) { ?>
                                        <h2 class="item-title">
                                            <?php echo esc_html( $banner_title ); ?>
                                        </h2>
                                    <?php } if( $banner_desc ) { ?>
                                        <div class="banner-desc">
                                            <?php echo wp_kses_post( wpautop( $banner_desc ) ); ?>
                                        </div>
                                    <?php } if ( $btn_one || $btn_two) { ?>
                                        <div class="button-wrap">
                                            <?php if( $btn_one && $btn_one_url ) { ?>
                                                <a href="<?php echo esc_url( $btn_one_url ); ?>" class="primary-btn"><?php echo esc_html( $btn_one ); ?></a>
                                            <?php } if( $btn_two && $btn_two_url ) { ?>
                                                <a href="<?php echo esc_url( $btn_two_url ); ?>" class="primary-btn secondary-btn"><?php echo esc_html( $btn_two ); ?></a>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- section banner ends  -->
<?php } 