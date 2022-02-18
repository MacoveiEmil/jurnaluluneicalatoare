<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Good_Looking_Blog
 */

if( ! function_exists( 'good_looking_blog_doctype' ) ) :
	/**
	 * Doctype Declaration
	*/
	function good_looking_blog_doctype(){
		?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
		<?php
	}
endif;
add_action( 'good_looking_blog_doctype', 'good_looking_blog_doctype' );

if( ! function_exists( 'good_looking_blog_head' ) ) :
	/**
	 * Before wp_head 
	*/
	function good_looking_blog_head(){
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php
	}
endif;
add_action( 'good_looking_blog_before_wp_head', 'good_looking_blog_head' );

if( ! function_exists( 'good_looking_blog_page_start' ) ) :
	/**
	 * Page Start
	*/
	function good_looking_blog_page_start(){
		?>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'good-looking-blog' ); ?></a>
		<?php
	}
endif;
add_action( 'good_looking_blog_before_header', 'good_looking_blog_page_start' );

if( ! function_exists( 'good_looking_blog_header' ) ) :
	/**
	 * Header
	 */
	function good_looking_blog_header(){
		/**
		 * Header Style One 
		 */
		
		?>
		<header id="masthead" class="site-header style-one" itemscope itemtype="https://schema.org/WPHeader">
			<div class="container">
				<div class="header-wrapper">
					<?php 
					/**
					 * Site Branding 
					*/
					good_looking_blog_site_branding();           
					?>
					<div class="nav-wrap">
						<div class="header-left">
							<?php 
							/**
							 * Primary navigation 
							*/
							good_looking_blog_primary_navigation(); 
							?>
						</div>
						<div class="header-right">
							<?php 
							/**
							 * Social links 
							*/
							good_looking_blog_social_links( true );
							/**
							 * Header Search 
							*/ 
							good_looking_blog_header_search();
							?>
						</div>
					</div><!-- #site-navigation -->
				</div>
			</div>
			<?php 
			/**
			 * Mobile navigation
			 */
			good_looking_blog_mobile_navigation(); 
			?>
		</header><!-- #masthead -->
	<?php
	}
endif;
add_action( 'good_looking_blog_header', 'good_looking_blog_header' );

if( ! function_exists( 'good_looking_blog_primary_page_header' ) ) :
/**
 * Page Header
*/
function good_looking_blog_primary_page_header(){ 
	if( is_front_page() ) return;

	if( is_search() || is_home() || is_archive() || is_singular( 'product' ) ){ ?>
		<header class="page-header">
			<div class="container">
				<div class="breadcrumb-wrapper">
					<?php good_looking_blog_breadcrumb(); ?>
				</div>
				<?php 
				if( is_woocommerce_activated() && is_singular( 'product' ) ){
					the_title( '<h2 class="page-title">','</h2>' ); 
				}
				if( is_search() ) { ?>
					<h1 class="page-title">
						<?php
						/* translators: %s: search query. */
						printf( esc_html__( '%s', 'good-looking-blog' ), get_search_query() );
						?>
					</h1>
				<?php } elseif( is_home() && ! is_front_page() ) { 	?>			
					<h1 class="page-title">
						<?php echo esc_html( get_theme_mod( 'blog_section_title', __( 'Blog Posts', 'good-looking-blog' ) ) ); ?>
					</h1>					
				<?php }
				 elseif ( is_archive() ) { 	
					if( is_woocommerce_activated() && is_shop() ){
						echo '<h1 class="page-title">';
						echo esc_html( get_the_title( wc_get_page_id( 'shop' ) ) );
						echo '</h1>';
					}elseif( is_author() ){
						the_archive_title( '<h1 class="page-title">', '</h1>' );
					}else{
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="archive-description">', '</div>' );		
					}
				} ?>
			</div>
		</header><!-- .page-header -->
	<?php 
	}elseif( is_page_template( 'templates/contact.php' ) ){ ?>
		<div class="breadcrumb-wrapper">
			<?php good_looking_blog_breadcrumb(); ?>
		</div>
	<?php }
}
endif;
add_action( 'good_looking_blog_before_posts_content', 'good_looking_blog_primary_page_header', 10 );

if( ! function_exists( 'good_looking_blog_entry_header' ) ) :
/**
 * Entry Header
*/
function good_looking_blog_entry_header(){ 
	if ( is_single() ) { ?>
		<header class="entry-header">
			<div class="category--wrapper">
				<?php good_looking_blog_category(); ?>
			</div>
			<div class="entry-title-wrapper">
				<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
			</div>
			<?php good_looking_blog_single_author_meta(); ?>
		</header>
	<?php } else { ?>
		<header class="entry-header">
			<div class="entry-meta">
				<?php good_looking_blog_category(); ?>
			</div><!-- .entry-meta -->
			<div class="entry-details">
				<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );	?>
			</div>
		</header><!-- .entry-header -->
	<?php }
}
endif;
add_action( 'good_looking_blog_post_entry_header', 'good_looking_blog_entry_header' );

if( ! function_exists( 'good_looking_blog_entry_content' ) ) :
/**
 * Entry Content
*/
function good_looking_blog_entry_content(){ 
	if( is_front_page() ) return;
	?>
	<div class="entry-content" itemprop="text">
		<?php
			if( is_singular() ){
				the_content();    
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'good-looking-blog' ),
					'after'  => '</div>',
				) );
			}elseif( is_archive() ){
				the_excerpt();
				good_looking_blog_author_meta();
			}else{
				the_excerpt();
			}
		?>
	</div><!-- .entry-content -->
	<?php
}
endif;
add_action( 'good_looking_blog_post_entry_content', 'good_looking_blog_entry_content', 15 );

if( ! function_exists( 'good_looking_blog_entry_footer' ) ) :
/**
 * Entry Footer
*/
function good_looking_blog_entry_footer(){ 

	if( is_single() ){ ?>
		<footer class="entry-footer">
			<?php
				good_looking_blog_tag();
				if( get_edit_post_link() ){
					edit_post_link(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Edit <span class="screen-reader-text">%s</span>', 'good-looking-blog' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							get_the_title()
						),
						'<span class="edit-link">',
						'</span>'
					);
				}
			?>
		</footer><!-- .entry-footer -->
	<?php }
}
endif;
add_action( 'good_looking_blog_post_entry_content', 'good_looking_blog_entry_footer', 20 );

if( ! function_exists( 'good_looking_blog_location' ) ) :
/**
 * Location Settings
 */
function good_looking_blog_location(){
	$location_title = get_theme_mod( 'location_title', __( 'Visit Us:', 'good-looking-blog' ) );
	$location       = get_theme_mod( 'location', __( '27 Division St, New York, NY 10002, USA', 'good-looking-blog' ) );

	if( $location_title || $location ){ ?>
		<div class="location-wrapper">
			<li>
				<div class="location-wrap">
					<div class="icon">
						<?php echo wp_kses( good_looking_blog_social_icons_svg_list( 'location' ), get_kses_extended_ruleset() ); ?>
					</div>
				</div>
				<div class="location-details">
					<?php 
					if( $location_title ) echo '<span class="location-title">' . esc_html( $location_title ) . '</span>';
					if( $location ) echo '<div class="location-desc">' . esc_html( $location ) . '</div>'; 
					?>
				</div>
			</li>
		</div>
	<?php }
	}
endif;
add_action( 'good_looking_blog_contact_page_details', 'good_looking_blog_location', 10);
		
if( ! function_exists( 'good_looking_blog_mail' ) ) :
/**
 * Mail Settings
 */
function good_looking_blog_mail(){
	$mail_title       = get_theme_mod( 'mail_title', __( 'Mail Us:', 'good-looking-blog' ) );
	$mail_address     = get_theme_mod( 'mail_description' );
	$emails           = explode( ',', $mail_address);
	if( $mail_title || $mail_address ){ ?>
		<div class="email-wrapper">
			<li>
				<div class="email-wrap">
					<div class="icon">
						<?php echo wp_kses( good_looking_blog_social_icons_svg_list( 'email' ), get_kses_extended_ruleset() ); ?>	
					</div>
				</div>
				<div class="email-details">
					<?php if( $mail_title ){ ?>
						<span class="email-title">
							<?php echo esc_html( $mail_title ); ?>
						</span>
					<?php }
					if( $mail_address ){ ?>
						<div class="email-desc">
							<?php foreach( $emails as $email ){ ?>
								<a href="<?php echo esc_url( 'mailto:' . sanitize_email( $email ) ); ?>" class="email-link">
									<?php echo esc_html( $email ); ?>
								</a>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</li>
		</div>
	<?php }
}
endif;
add_action( 'good_looking_blog_contact_page_details', 'good_looking_blog_mail', 20 );
		
if( ! function_exists( 'good_looking_blog_phone' ) ) :
/**
 * Phone Settings
 */
function good_looking_blog_phone(){
	$phone_title        = get_theme_mod( 'phone_title', __( 'Phone Us:', 'good-looking-blog' ) ); 
	$phone_number       = get_theme_mod( 'phone_number', __( '+1 (800) 123 456 789', 'good-looking-blog' ) ); 

	$phones = explode( ',', $phone_number);

	if( $phone_title || $phone_number ){ ?>
		<div class="phone-wrapper">
			<li>
				<div class="phone-wrap">
					<div class="icon">
					<?php echo wp_kses( good_looking_blog_social_icons_svg_list( 'phone' ), get_kses_extended_ruleset() ); ?>					
					</div>
				</div>
				<div class="phone-details">
					<?php if( $phone_title ){ ?>
						<span class="phone-title">
							<?php echo esc_html( $phone_title ); ?>
						</span>
					<?php } 
					if( $phone_number ){ ?>
						<div class="phone-number">
							<?php foreach( $phones as $phone ){ ?>
								<a href="<?php echo esc_url( 'tel:' . preg_replace( '/[^\d+]/', '', $phone ) ); ?>" class="tel-link">
									<?php echo esc_html( $phone ); ?>
								</a>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</li>
		</div>
	<?php }
}
endif;
add_action( 'good_looking_blog_contact_page_details', 'good_looking_blog_phone', 30 );