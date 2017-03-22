<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package uri2016
 */

	$additional_classes = array();
	if( ! is_single() ) {
		$additional_classes[] = 'excerpt';
	}
	
	if( is_single() ) {
		$additional_classes[] = 'service';
		print uri2016_breadcrumbs();
	}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $additional_classes ); ?>>
	<header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php

			// show the lead art
			get_template_part( 'template-parts/lead-art' );

			// show the media contact / journalists' box
			if($show_media_box) {
				get_template_part( 'template-parts/media-box' );
			}


			if( is_single() ) {

				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'uri2016' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'uri2016' ),
					'after'  => '</div>',
				) );

			} else {
					$content = get_the_content();
					$content = strip_tags($content, '<a><strong><em><p><div>');
					$content = preg_replace("/<img[^>]+\>/i", "(image) ", $content); 		
					$content = preg_replace("/<iframe[^>]+\>/i", "(video) ", $content);             
					$content = apply_filters('the_content', $content);
					$content = str_replace(']]>', ']]>', $content);
					echo $content;

			}
		?>
		</div><!-- .entry-content -->

	<footer class="entry-footer">
	</footer><!-- .entry-footer -->
	
</article><!-- #post-## -->
