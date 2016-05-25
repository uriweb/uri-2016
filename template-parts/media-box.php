<?php
	$media_contacts = uri2016_get_media_contacts($post);
	$attachment = get_field( 'attachment', $post->ID );
	//echo '<pre>', print_r($attachment, TRUE), '</pre>';
	$extension = explode( '.', $attachment['url'] );
	$extension = $extension[count($extension)-1];
	$title = $attachment['title'] . ' (' . $extension . ')';
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
// 		$galleries = get_post_galleries_images( $post );
// 		echo '<pre>', print_r($galleries, TRUE), '</pre>';

// 	preg_match('/\[gallery.*ids=.(.*).\]/', $post->post_content, $ids);
// 	$images_id = explode(",", $ids[1]);
// 	echo '<pre>', print_r($images_id, TRUE), '</pre>';

		if( ! empty ( $attachment ) ) : 
		?>
		<h2>Attachment:</h2>
		<div class="attachment"><a href="<?php print $attachment['url']; ?>" title="Download <?php print $title; ?>"><?php print $title; ?></a>
		<span class="attachment-description">
		<?php if ( ! empty( $attachment['caption'] ) ): ?>
		<br />
		<strong><?php print $attachment['caption']; ?></strong>
		<?php endif; ?>
		<?php if ( ! empty( $attachment['description'] ) ): ?>
		<br />
		<?php print $attachment['description']; ?>
		<?php endif; ?>
		</span>
		</div>
		
		<?php
		endif;

		$media = get_attached_media( 'image' );
		
		if( ! empty ( $media ) ) : 
	?>
		
	<h2>High Resolution Media:</h2>
	<ul class="media-thumbnails">
	<?php foreach($media as $m): ?>
		<?php
			$original_art = wp_get_attachment_image_src( $m->ID, 'original' );
			if ( ! empty( $original_art[0] ) ) {
				printf( '<li><a href="%1$s" alt="%2$s">%3$s</a></li>', esc_url( $original_art[0] ), '', wp_get_attachment_image($m->ID, array(100, NULL)) );
			}
		?>
	<?php endforeach; ?>
	</ul>
	<?php endif; ?>
	
	<p><?php uri2016_posted_on(); ?></p>
</aside>
