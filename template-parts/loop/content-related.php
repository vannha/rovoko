<?php
/**
 * Template part for displaying posts in loop
 *
 * @package EF5 Theme
 * @subpackage EF5Frame
 */
?>

<div <?php post_class( 'related-item' ); ?>>
	<?php
	$show_like = class_exists( 'EF5Systems' ) ? '1' : '0';
	rovoko_post_media( [ 'thumbnail_size' => 'medium', 'has_hook' => false ] );
	rovoko_post_header( [ 'heading_tag' => 'h3' ] );
	rovoko_post_meta( [
		'show_author' => '0',
		'show_date'   => '1',
		'show_cat'    => '0',
		'show_cmt'    => '1',
		'cmt_icon'    => 'flaticon-comment-1',
		'cmt_text'    => '',
		'show_view'   => '0',
		'show_like'   => $show_like
	] );
	rovoko_post_excerpt( [ 'length' => 15, 'more' => '' ] );
	?>
</div>