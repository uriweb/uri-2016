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
?>


<div id="region-front" class="region-front widgets front">
	<section id="uri_featured_posts_widget-3" class="widget widget_uri_featured_posts_widget">
		<div class="widget-inner">
			<div class="news">
				<h2 class="region-front">News</h2>	
	
					<div class="primary">
								<?php

									if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
									?>
									<figure>
										<a href="<?php print esc_url( get_permalink() ) ?>">
										<?php
											$width = ( is_single() ) ? 620 : 300 ;
											the_post_thumbnail( array( $width, NULL ) );
										?>
										</a>
										<?php
										$figcaption = uri2016_get_thumbnail_caption($post);
										if ( is_single() && !empty( $figcaption ) ):
										?>
										<figcaption><?php print $figcaption; ?></figcpation>
										<?php endif; ?>
									</figure>

									<?php
									}


									the_title( '<h3><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
									the_excerpt();

								?>

								<p><a class="more-link" href="<?php print esc_url( get_permalink() ) ?>">More …</a></p>

					</div>
				</div>
			</div>
		</section>
	</div>


	<footer class="entry-footer">
		<?php
		if ( 'post' === get_post_type() && is_single() ) : ?>
		<div class="entry-meta">			
			<?php
			get_template_part( 'template-parts/more-links' );
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
