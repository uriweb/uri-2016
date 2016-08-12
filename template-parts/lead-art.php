<?php
	$link_to_fullsize = FALSE; // initialize as false, set to true later if single

	// show the lead art
	if ( has_post_thumbnail() && ! get_post_format( $post->ID ) == 'video') { // check if the post has a Post Thumbnail assigned to it.
	
		if ( is_single() ) {
			$image_id = get_post_thumbnail_id( $post->ID );
			$image = wp_get_attachment_image_src( $image_id, 'full' );
			$link_to_fullsize = TRUE;
		}
	?>
		<div class="lead-art inline-media">
			<figure>
			<?php if ( $link_to_fullsize ): ?>
			<a href="<?php print $image[0] ?>" rel="lightbox[<?php print $post->ID; ?>]">
			<?php endif; ?>
			<?php
				$width = ( is_single() ) ? 1200 : 300 ;
				the_post_thumbnail( array( $width, NULL ) );
			?>
			<?php
			$figcaption = uri2016_get_thumbnail_caption($post);
			if ( is_single() && !empty( $figcaption ) ):
			?>
			<figcaption><?php print $figcaption; ?></figcpation>
			<?php endif; ?>
			<?php if ( $link_to_fullsize ): ?>
			</a>
			<?php endif; ?>
			</figure>
		</div>

	<?php
	}
	if (get_post_format( $post->ID ) == 'video') { // check if the post is a video
	?>
		<div class="lead-video">
			<figure>
			<?php print uri2016_get_field( 'embed_code', $post->ID ); ?>
			</figure>
		</div>

	<?php
	}
