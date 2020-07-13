<?php
/**
 * The template for displaying Current Discussion on posts
 */

/* Get data from current discussion on post. */
$discussion    = rovoko_get_discussion_data();
$has_responses = $discussion->responses > 0;

if ( $has_responses ) {
	/* translators: %1(X comments)$s */
	$meta_label = sprintf( _n( '%d Comment', '%d Comments', $discussion->responses,'rovoko' ), $discussion->responses );
} else {
	$meta_label = esc_html__( 'No comments','rovoko' );
}

?>

<div class="discussion-meta">
	<h4 class="discussion-meta-info">
		<span><?php echo esc_html( $meta_label ); ?></span>
	</h4>
</div><!-- .discussion-meta -->
