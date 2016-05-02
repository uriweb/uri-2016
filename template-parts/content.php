<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package uri2016
 */


	$show_media_box = TRUE;

	$media_contacts = uri2016_get_media_contacts($post);

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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

			if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
			?>
				<div class="lead-art inline-media">
					<figure>
					<?php the_post_thumbnail(array(1200, NULL)); ?>
					<?php if ( is_single() ): ?>
					<figcaption><?php uri2016_thumbnail_caption($post); ?></figcpation>
					<?php endif; ?>
					</figure>
				</div>

			<?php
			}


			// show the media contact / journalists' box
			if($show_media_box):
			?>
			
			<aside class="media-contact">
				<h1>Media</h1>
				<?php if(is_array($media_contacts)): ?>
					<h2>Media Contact<?php print (count($media_contacts) == 1) ? '' : 's'; ?>:</h2>
					<?php foreach($media_contacts as $c): ?>
						<span class="media-name"><a href="mailto:<?php print $c['email']; ?>"><?php print $c['name']; ?></a></span><br />
						<?php print $c['telephone']; ?>
					<?php endforeach; ?>
				<?php endif; ?>
				
				
				<?php
					$thumbnail = get_post_thumbnail_id();
					if( ! empty ( $thumbnail ) ) : 
				?>
					
				<h2>High Resolution Media:</h2>
				<p><?php
					$original_art = wp_get_attachment_image_src( $thumbnail, 'original' );
					if ( ! empty( $original_art[0] ) ) {
						printf( '<a href="%1$s" alt="%2$s">%3$s</a>', esc_url( $original_art[0] ), '', get_the_post_thumbnail($post, array(100, NULL)) );
					}
				?></p>
				
				<?php endif; ?>
				
				<p><?php uri2016_posted_on(); ?></p>
			</aside>
			
			<?php
			endif; // end if show media box



			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'uri2016' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'uri2016' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
		if ( 'post' === get_post_type() && is_single() ) : ?>
		<div class="entry-meta">			
			<div class="end-of-article-call">
				<h4>Next:</h4>
				<p><?php previous_post_link( '<div class="previous">%link</div>', '%title', true ); ?></p>
				<p><a href="https://securelb.imodules.com/s/1638/03-Foundation/interior-hybrid.aspx?sid=1638&gid=3&pgid=770&cid=2270">Support the University of Rhode Island</a>.</p>
			</div>

			<?php
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
