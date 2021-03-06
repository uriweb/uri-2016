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

	$publication_name = uri2016_get_field( 'publication_name', $post->ID );
	$url = uri2016_get_field( 'url', $post->ID );
	$date = uri2016_get_field( 'date', $post->ID );
	$date = date( 'M j, Y', strtotime( $date ) );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $additional_classes ); ?>>

	<header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . $url . '" rel="bookmark">', '</a></h2>' );
			}
		?>
		<?php print $publication_name; ?> on <?php print $date; ?></p>
	</header><!-- .entry-header -->


	<?php if ( is_single() ) : ?>
		<div class="entry-content">
			<div class="uri-in-the-news-details">
				<p>
					<a href="<?php echo $url; ?>"><?php the_title( ); ?></a><br />
					<?php
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
			</div>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<div class="entry-meta">			
				<?php
					get_template_part( 'template-parts/more-links' );
					uri2016_posted_on();
				?>
			</div><!-- .entry-meta -->
		</footer><!-- .entry-footer -->
	<?php endif; ?>
	
</article><!-- #post-## -->
