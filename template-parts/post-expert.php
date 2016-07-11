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


			if( is_single() ) {
				$position = uri2016_get_field( 'position', $post->ID );
				$telephone = uri2016_get_field( 'telephone', $post->ID );
				$email = uri2016_get_field( 'email', $post->ID );
				$links = uri2016_get_field( 'links', $post->ID );
				
				?>
					<dl class="experts-details">

						<dt>Title</dt>
						<dd><?php print $position; ?></dd>

						<dt>Telephone</dt>
						<dd><?php print $telephone; ?></dd>

						<dt>Email</dt>
						<dd><a href="mailto:<?php print $email; ?>"><?php print $email; ?></a></dd>

						<dt>Links</dt>
						<dd><?php
							$links = preg_split('/\s+/', strip_tags($links)); 
							foreach( $links as $l ) {
								$url = trim($l);
								print '<a href="' . $url . '">' . url_shorten($url, 60) . '</a><br />';
							}
						?>
						</dd>

					</dl>
				<?php
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
		<?php
			$tags = get_the_tags();
			$tags_output = array();
			if ($tags) {
				foreach($tags as $tag) {
					$tags_output[] = $tag->name;
				}
				print '<div class="expertise">Areas of expertise: ' . implode( ', ', $tags_output) . '</div>';
			}
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php if ( 'post' === get_post_type() && is_single() ) : ?>

		<div class="entry-meta">			
			<?php
				get_template_part( 'template-parts/more-links' );
				uri2016_posted_on();
			?>
		</div><!-- .entry-meta -->
		
		<?php endif; ?>

	</footer><!-- .entry-footer -->
	
</article><!-- #post-## -->
