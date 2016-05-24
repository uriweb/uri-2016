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

	} else {

		get_template_part( 'template-parts/post' );

	}
	