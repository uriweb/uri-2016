<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package uri2016
 */

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
				if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				?>
					<div class="lead-art inline-media">
						<figure>
						<?php the_post_thumbnail(); ?>
						<?php if ( is_single() ): ?>
						<figcaption><?php uri2016_thumbnail_caption($post); ?></figcpation>
						<?php endif; ?>
						</figure>
					</div>

				<?php
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
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
		if ( 'post' === get_post_type() && is_single() ) : ?>
		<div class="entry-meta">
			<?php uri2016_posted_on(); ?>
			<?php
				$media_contact_ids = get_field( 'media_contact' );
				$media_contacts = array();
				if( is_array( $media_contact_ids ) && !empty( $media_contact_ids ) ) {
					foreach($media_contact_ids as $id) {
						$media_contacts[] = array(
							'name' => get_the_title( $id ),
							'telephone' => get_field( 'last_name', $id ),
							'telephone' => get_field( 'telephone', $id ),
							'email' => get_field( 'email', $id )
						);
					}
					?>
				<div class="media-contact">
					<h4>Media Contact<?php print (count($media_contacts) == 1) ? '' : 's'; ?>:</h4>
					<?php foreach($media_contacts as $c): ?>
						<?php print $c['name']; ?> | 
						<a href="mailto:<?php print $c['email']; ?>"><?php print $c['email']; ?></a> | 
						<?php print $c['telephone']; ?>
					<?php endforeach; ?>
				</div>
				<?php
				}
				?>

			
			
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
		<?php uri2016_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	
</article><!-- #post-## -->
