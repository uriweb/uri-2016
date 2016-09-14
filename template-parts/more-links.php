<?php
	$more_text = uri2016_get_field( 'more_text', $post->ID );
	if ( empty( $more_text ) ) {
		$more_text = '<a href="https://securelb.imodules.com/s/1638/03-Foundation/interior-hybrid.aspx?sid=1638&gid=3&pgid=770&cid=2270">Support the University of Rhode Island</a>.';
	}

	$previous_image = '';
	$previous_post = get_previous_post(true);
	if($previous_post) {
		$previous_image = get_the_post_thumbnail($previous_post->ID, array(100, 100) );
		$previous_image = str_replace( 'style="width:100px" class="', 'class="', $previous_image );
	}


?>
<div class="end-of-article-call" id="uri-next">
	<h4>Next:</h4>
	<div class="previous">
	<?php
		previous_post_link( '%link', $previous_image . '%title', true );
	?>
	</div><br />
	<?php print nl2br( trim ( $more_text ) ); ?>
	
</div>

<?php
?>