<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package uri2016
 */

	if( in_array( 'category-experts', get_post_class($post->ID) ) ) {

		get_template_part( 'template-parts/post-expert' );

	} elseif( in_array( 'category-uri-in-the-news', get_post_class($post->ID) ) ) {

		get_template_part( 'template-parts/post-uri-in-the-news' );

	} elseif( in_array( 'category-news', get_post_class($post->ID) ) ) {

		get_template_part( 'template-parts/post-news' );

	} elseif( in_array( 'category-features', get_post_class($post->ID) ) ) {

		get_template_part( 'template-parts/post-features' );

	} else {

		$category = get_the_category();
		$cat_parent = 0;
		$category_parent_id = $category[0]->category_parent;
		if ( $category_parent_id != 0 ) {
			$category_parent = get_term( $category_parent_id, 'category' );
			$cat_parent = $category_parent->slug;
		}
		
		if ( $cat_parent == 'services') {
			get_template_part( 'template-parts/post-services' );
		} else {
			get_template_part( 'template-parts/post' );
		}


	}
	