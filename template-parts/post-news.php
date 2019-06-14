<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package uri2016
 */

	$additional_classes = array();
	$show_media_box = FALSE;
	if( ! is_single() ) {
		$additional_classes[] = 'excerpt';
	}
	
	$smbv = uri2016_get_field( 'show_the_media_box', $post->ID );
	if( ! empty( $smbv ) && is_single() ) {
		$show_media_box = TRUE;
	}

	$media_contacts = uri2016_get_media_contacts($post);
	
	// get the deck; empty it if it's just a copy of the title.
	$deck = uri2016_get_field( 'deck', $post->ID );
	if( $deck == get_the_title() ) {
		$deck = '';
	}


?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $additional_classes ); ?>>
	<header class="entry-header">
		<?php
			if ( is_single() ) {
				print '<hgroup>';
				the_title( '<h1 class="entry-title">', '</h1>' );
				if( ! empty( $deck ) ) {
					print '<h2 class="deck">' . $deck . '</h2>';
				}
				print '</hgroup>';
			} else {
				//print '<hgroup>';
				// show the lead art
				get_template_part( 'template-parts/lead-art' );

				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				//if( ! empty( $deck ) ) {
				//	print '<h3 class="deck">' . $deck . '</h2>';
				//}
				//print '</hgroup>';
			}
			echo '<div class="posted-by">';

			if( is_array( $media_contacts ) ):
			?>
			
					<span class="media-contact">Media Contact<?php print (count($media_contacts) == 1) ? '' : 's'; ?>:</span>
					<?php foreach($media_contacts as $c): ?>
						<span class="media-name"><a href="mailto:<?php print $c['email']; ?>"><?php print $c['name']; ?></a></span>,
						<span class="media-tel"><?php print $c['telephone']; ?></span>
						<span class="divider">|</span>
					<?php endforeach; ?>
				<?php 
			endif;


			?>			

			<span class="share-label">Share:</span>
			<a href="http://twitter.com/share?text=<?php the_title() ?>
				&amp;url=<?php esc_url( the_permalink() ) ?>" title="Share on Twitter" class="share-twitter" target="_blank" rel="nofollow noopener">Twitter</a>
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php esc_url( the_permalink() ) ?>" title="Share on Facebook" class="share-facebook" target="_blank" rel="nofollow noopener">Facebook</a>
						
		<?php
			echo '</div>';
		?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php

			if( is_single() ) {

				// show the lead art
				get_template_part( 'template-parts/lead-art' );


				// show the media contact / journalists' box
				if($show_media_box) {
					get_template_part( 'template-parts/media-box' );
				}


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
// 					$content = get_the_content();
// 					$content = strip_tags($content, '<a><strong><em><p><div>');
// 					$content = preg_replace("/<img[^>]+\>/i", "(image) ", $content); 		
// 					$content = preg_replace("/<iframe[^>]+\>/i", "(video) ", $content);             
// 					$content = apply_filters('the_content', $content);
// 					$content = str_replace(']]>', ']]>', $content);
// 					echo $content;

			}
		?>


	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
		if ( 'post' === get_post_type() && is_single() ) : ?>
		<div class="entry-meta">			
			<?php

			get_template_part( 'template-parts/more-links' );

			// show the media contact in the footer... should this be conditional?
			if( is_array( $media_contacts ) ):
			?>
			
					<h2>Media Contact<?php print (count($media_contacts) == 1) ? '' : 's'; ?>:</h2>
					<?php foreach($media_contacts as $c): ?>
						<span class="media-name"><a href="mailto:<?php print $c['email']; ?>"><?php print $c['name']; ?></a></span><br />
						<?php print $c['telephone']; ?><br />
					<?php endforeach; ?>
				<?php 
					endif;
					uri2016_posted_on();
				?>
			
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
		<?php
			//uri2016_entry_footer();
		?>
	</footer><!-- .entry-footer -->
	
</article><!-- #post-## -->
