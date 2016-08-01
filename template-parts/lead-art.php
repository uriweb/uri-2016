<?php

	// show the lead art
	if ( has_post_thumbnail() && ! get_post_format( $post->ID ) == 'video') { // check if the post has a Post Thumbnail assigned to it.
	?>
		<div class="lead-art inline-media">
			<figure>
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
