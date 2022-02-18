<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Good_Looking_Blog
 */

if ( ! function_exists( 'good_looking_blog_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function good_looking_blog_posted_on() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';   
		
		$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
		);
    
    	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';
	
		echo '<span class="posted-on">' . $posted_on . '</span>'; 

	}
endif;

if ( ! function_exists( 'good_looking_blog_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function good_looking_blog_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( '%s', 'post author', 'good-looking-blog' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" itemprop="url"><span itemprop="name">' . esc_html( get_the_author() ) . '</span></a></span>'
		);

		echo '<span class="byline" itemprop="author" itemscope itemtype="https://schema.org/Person"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'good_looking_blog_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function good_looking_blog_post_thumbnail() {
	
		if ( post_password_required() || is_attachment() ) {
			return;
		}

		if ( is_singular() ) : ?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail( 'full', array( 'itemprop' => 'image' ) ); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<figure class="post-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php if( has_post_thumbnail() ) { ?>
						<?php the_post_thumbnail( 'good_looking_blog_popular_posts', array( 'itemprop' => 'image' ) );
					}else{
						good_looking_blog_get_fallback_svg( 'good_looking_blog_popular_posts' );
					} ?>
				</a>
			</figure>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		/**
         * Triggered after the opening <body> tag.
         *
         */
		do_action( 'wp_body_open' );
	}
endif;

if( ! function_exists( 'good_looking_blog_get_posts' ) ) :
	/**
	 * Fuction to list Custom Post Type
	*/
	function good_looking_blog_get_posts( $post_type = 'post', $slug = false ){    
		$args = array(
			'posts_per_page'   => -1,
			'post_type'        => $post_type,
			'post_status'      => 'publish',
			'suppress_filters' => true 
		);
		$posts_array = get_posts( $args );
		
		// Initate an empty array
		$post_options = array();
		$post_options[''] = __( ' -- Choose -- ', 'good-looking-blog' );
		if ( ! empty( $posts_array ) ) {
			foreach ( $posts_array as $posts ) {
				if( $slug ){
					$post_options[ $posts->post_title ] = $posts->post_title;
				}else{
					$post_options[ $posts->ID ] = $posts->post_title;    
				}
			}
		}
		return $post_options;
		wp_reset_postdata();
	}
endif;

if ( ! function_exists( 'good_looking_blog_tag' ) ) :
/**
 * Prints tags
 */
function good_looking_blog_tag(){
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		$tags_list = get_the_tag_list( '', ' ' );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<div class="cat-tags" itemprop="about">' . esc_html__( '%1$sTags:%2$s %3$s', 'good-looking-blog' ) . '</div>', '<span class="tags-title">', '</span>', $tags_list );
		}
	}
}
endif;

if( ! function_exists( 'good_looking_blog_get_svg_icons' ) ) :
	/**
	 * Fuction to list svg
	*/
	function good_looking_blog_get_svg_icons(){    

		$social_media = [ 'facebook', 'twitter', 'digg', 'instagram', 'pinterest', 'telegram', 'getpocket', 'dribbble', 'behance', 'unsplash', 'five-hundred-px', 'linkedin', 'wordpress', 'parler', 'mastodon', 'medium', 'slack', 'codepen', 'reddit', 'twitch', 'tiktok', 'snapchat', 'spotify', 'soundcloud', 'apple_podcast', 'patreon', 'alignable', 'skype', 'github', 'gitlab', 'youtube', 'vimeo', 'dtube', 'vk', 'ok', 'rss', 'facebook_group', 'discord', 'tripadvisor', 'foursquare', 'yelp', 'hacker_news', 'xing', 'flipboard', 'weibo', 'tumblr', 'qq', 'strava', 'flickr' ];
		
		// Initate an empty array
		$svg_options = array();
		$svg_options[''] = __( ' -- Choose -- ', 'good-looking-blog' );
		
			foreach ( $social_media as $svg ) {			
				$svg_options[ $svg ] = esc_html( $svg );				
			}
		
		return $svg_options;
	}
endif;