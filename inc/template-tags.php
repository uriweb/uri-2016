<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package uri2016
 */

if ( ! function_exists( 'uri2016_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function uri2016_posted_on() {
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

// 	$posted_on = sprintf(
// 		esc_html_x( 'Posted on %s', 'post date', 'uri2016' ),
// 		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
// 	);
	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'uri2016' ), $time_string );

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'uri2016' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'uri2016_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function uri2016_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
//			do not generate the category list
// 		$categories_list = get_the_category_list( esc_html__( ', ', 'uri2016' ) );
// 		if ( $categories_list && uri2016_categorized_blog() ) {
// 			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'uri2016' ) . '</span>', $categories_list ); // WPCS: XSS OK.
// 		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'uri2016' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'uri2016' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'uri2016' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'uri2016' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link button">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function uri2016_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'uri2016_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'uri2016_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so uri2016_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so uri2016_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in uri2016_categorized_blog.
 */
function uri2016_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'uri2016_categories' );
}
add_action( 'edit_category', 'uri2016_category_transient_flusher' );
add_action( 'save_post',     'uri2016_category_transient_flusher' );


/**
 * Print the Media Contact
 */
function uri2016_media_contact($post) {
	if( empty( $post ) ) {
		return FALSE;
	}
	
	$field = get_field( 'media_contact', $post->ID );

  if ( !empty( $field ) ) {
    echo $field;
  }
}


/**
 * Print the featured image caption
 */
function uri2016_thumbnail_caption($post) {
	if( empty( $post ) ) {
		return FALSE;
	}

  $thumbnail_id    = get_post_thumbnail_id($post->ID);
  $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

  if ($thumbnail_image && isset($thumbnail_image[0])) {
    echo nl2br($thumbnail_image[0]->post_excerpt);
  }
}


/**
 * Customize the previous / next links at the bottom of the page
 */
function uri2016_post_navigation(){
	$navigation = '';
	$previous   = get_previous_post_link( '<div class="nav-previous">%link</div>', '%title', true );
	$next       = get_next_post_link( '<div class="nav-next">%link</div>', '%title', true );

	// Only add markup if there's somewhere to navigate to.
	if ( $previous || $next ) {
		$navigation = _navigation_markup( $previous . $next, 'post-navigation' );
	}

	echo $navigation;
}