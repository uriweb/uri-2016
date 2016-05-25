<?php
	$more_text = get_field( 'more_text', $post->ID );
	if ( empty( $more_text ) ) {
		$more_text = '<a href="https://securelb.imodules.com/s/1638/03-Foundation/interior-hybrid.aspx?sid=1638&gid=3&pgid=770&cid=2270">Support the University of Rhode Island</a>.';
	}
?>
<div class="end-of-article-call" id="uri-next">
	<h4>Next:</h4>
	<?php previous_post_link( '<div class="previous">%link</div>', '%title', true ); ?><br />
	<?php print nl2br( trim ( $more_text ) ); ?>
</div>
