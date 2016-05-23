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
	
	if( ! empty( get_field( 'show_the_media_box', $post->ID ) ) && is_single() ) {
		$show_media_box = TRUE;
	}
	
	$is_expert = ( in_array( 'category-experts', get_post_class($post->ID) ) );

	$media_contacts = uri2016_get_media_contacts($post);

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
			if ( has_post_thumbnail() && ! get_post_format( $post->ID ) == 'video') { // check if the post has a Post Thumbnail assigned to it.
			?>
				<div class="lead-art inline-media">
					<figure>
					<?php
						$width = ( is_single() ) ? 1200 : 400 ;
						the_post_thumbnail(array($width, NULL));
					?>
					<?php
					$figcaption = uri2016_get_thumbnail_caption($post);
					if ( is_single() && !empty( $figcaption ) ):
					?>
					<figcaption><?php print $figcaption; ?></figcpation>
					<?php endif; ?>
					</figure>
				</div>

			<?php
			}
			if (get_post_format( $post->ID ) == 'video') { // check if the post is a video
			?>
				<div class="lead-video">
					<figure>
					<?php print get_field( 'embed_code', $post->ID ); ?>
					</figure>
				</div>

			<?php
			}


			// show the media contact / journalists' box
			if($show_media_box) {
				get_template_part( 'template-parts/media-box' );
			}


			if( $is_expert && is_single() ) {
				$position = get_field( 'position', $post->ID );
				$telephone = get_field( 'telephone', $post->ID );
				$email = get_field( 'email', $post->ID );
				$links = get_field( 'links', $post->ID );
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
			if( $is_expert ) {
				$tags = get_the_tags();
				$tags_output = array();
				if ($tags) {
					foreach($tags as $tag) {
						$tags_output[] = $tag->name;
					}
					print '<div class="expertise">Areas of expertise: ' . implode( ', ', $tags_output) . '</div>';
				}
			}
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
		if ( 'post' === get_post_type() && is_single() ) : ?>
		<div class="entry-meta">			
			<div class="end-of-article-call" id="uri-next">
				<h4>Next:</h4>
				<p><?php previous_post_link( '<div class="previous">%link</div>', '%title', true ); ?></p>
				<p><a href="https://securelb.imodules.com/s/1638/03-Foundation/interior-hybrid.aspx?sid=1638&gid=3&pgid=770&cid=2270">Support the University of Rhode Island</a>.</p>
			</div>

			<?php

			// show the media contact in the footer... should this be conditional?
			if( ! $show_media_box && is_array( $media_contacts ) ):
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
