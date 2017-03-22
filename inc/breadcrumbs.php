<?php

// Breadcrumbs

function uri2016_breadcrumbs() {
	$crumbs = array();
	$prepend = explode( "\n", get_option( 'uri-2016-breadcrumbs', 'The University of Rhode Island (https://www.uri.edu)' ) );
	$prepend = array();
	
	foreach($prepend as $l) {
		$bits = explode( '(', $l );
		$name = trim( $bits[0] );
		$href = rtrim( $bits[1], ')' );
		if( !empty( $name ) && !empty( $href ) ) {
			$crumbs[] = array(
				'name' => $name,
				'href' => $href
			);
		}
	}
	
	$crumbs[] = array(
		'name' => get_bloginfo(),
		'href' => get_site_url()
	);


	$url = uri2016_get_current_path();
	$path_segments = explode( '/', $url );
	
	$path = '';

	foreach($path_segments as $p) {
		if(empty($p)) continue;
		$path = $path . '/' . $p;
		$link = uri2016_breadcrumbs_get_link($path);

		if($link != NULL) {
			$crumbs[] = $link;
		}
	}
	return uri2016_format_breadcrumbs($crumbs);
}


/**
 * WP lets us hunt and peck to see what the URL might be
 */
function uri2016_breadcrumbs_get_link($path) {
	$p = '';
	$post_id = url_to_postid( $path );

// 	echo '<pre style="font-size: 1rem">';
// 	var_dump($path);
// 	echo '</pre>';
	
	if($post_id !== 0) { // it's not a post or a page
		$p = get_page_by_path( $path );	
		$output = array(
			'name' => get_the_title($p->ID),
			'href' => get_site_url() . $path
		);
		return $output;
	}
	
	// is it a category?
	$category = get_category_by_path( $path );
	if ( is_object( $category ) && isset ( $category->term_id ) ) {
		$output = array(
			'name' => $category->name,
			'href' => get_site_url() . '/' . $category->slug
		);
		return $output;
	}

	
}


function uri2016_format_breadcrumbs($crumbs) {
	$output = '<ol class="breadcrumbs">';
	$last = end($crumbs);
	foreach($crumbs as $k => $c) {
		if($c === $last) { // last crumb isn't a hyperlink
			$output .= '<li>' . $c['name'] . '</li>';
		} else {
			$output .= '<li><a href="' . $c['href'] . '">' . $c['name'] . '</a></li>';
		}
	}
	$output .= '</ol>';
	return $output;
}


