<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package On_Point
 */
 
if ( ! function_exists( 'on_point_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function on_point_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<section id="paging-navigation" class="row align-center">
  	<nav class="small-12 large-11 large-offset-1 columns navigation" role="navigation">
  		<h2 class="show-for-sr"><?php _e( 'Posts navigation', 'on_point' ); ?></h2>
  		<div class="nav-links">
  
  			<?php if ( get_next_posts_link() ) : ?>
  			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav" aria-hidden="true">&larr;</span> Older posts', 'on_point' ) ); ?></div>
  			<?php endif; ?>
  
  			<?php if ( get_previous_posts_link() ) : ?>
  			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav" aria-hidden="true">&rarr;</span>', 'on_point' ) ); ?></div>
  			<?php endif; ?>
  
  		</div><!-- .nav-links -->
  	</nav><!-- .navigation -->
	</section><!-- #paging-navigation -->
	<?php
}
endif;

if ( ! function_exists( 'on_point_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function on_point_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<section id="single-post-navigation" class="row align-center">
  	<nav class="small-12 large-11 large-offset-1 columns navigation" role="navigation">
  		<h2 class="show-for-sr"><?php _e( 'Post navigation', 'on_point' ); ?></h2>
  		<div class="nav-links">
  			<?php
  				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav" aria-hidden="true">&larr;</span>&nbsp;%title', 'Previous post link', 'on_point' ) );
  				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav" aria-hidden="true">&rarr;</span>', 'Next post link',     'on_point' ) );
  			?>
  		</div><!-- .nav-links -->
  	</nav><!-- .navigation -->
	</section><!-- #post-navigation -->
	<?php
}
endif;

if ( ! function_exists( 'on_point_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function on_point_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'on-point' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'on-point' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'on_point_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function on_point_entry_footer() {
	// Hide category and tag text for pages.
/*
	if ( 'post' === get_post_type() ) {
		// translators: used between list items, there is a space after the comma 
		$categories_list = get_the_category_list( esc_html__( ', ', 'on-point' ) );
		if ( $categories_list && on_point_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'on-point' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		// translators: used between list items, there is a space after the comma 
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'on-point' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'on-point' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}
*/
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="show-for-sr"> on %s</span>', 'on-point' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'on-point' ),
			the_title( '<span class="show-for-sr">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function on_point_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'on_point_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'on_point_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) :
		// This blog has more than 1 category so on_point_categorized_blog should return true.
		return true;
	else :
		// This blog has only 1 category so on_point_categorized_blog should return false.
		return false;
	endif;
}

/**
 * Flush out the transients used in on_point_categorized_blog.
 */
function on_point_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'on_point_categories' );
}
add_action( 'edit_category', 'on_point_category_transient_flusher' );
add_action( 'save_post',     'on_point_category_transient_flusher' );

if ( ! function_exists( 'on_point_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since On Point 1.0
 */
function on_point_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;