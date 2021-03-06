<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package EF5 Theme
 * @subpackage EF5Frame
 * @since 1.0.0
 * @author EF5 Team
 *
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
*/
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="<?php echo comments_open() ? 'comments-area' : 'comments-area comments-closed'; ?> clearfix">
	<?php if ( have_comments() ) : ?>
		<div class="commentlist-wrap">
			<div class="comments-title h3"><?php
				$comments_number = get_comments_number();
				printf(
					_nx(
						'%1$s (%3$s)',
						'%2$s (%3$s)',
						$comments_number,
						'comments title',
						'rovoko'
					),
					esc_html__('Comment','rovoko'),
					esc_html__('Comments','rovoko'),
					number_format_i18n( $comments_number )
				);
			?></div>
			<ol class="commentlist">
				<?php
					wp_list_comments(
						rovoko_wp_list_comments_args()
					);
				?>
			</ol>
			<?php
				rovoko_comment_pagination_loadmore();
			?>
		</div>
	<?php
	endif;  
	// Show comment form at bottom if showing newest comments at the bottom.
	if ( comments_open() ) :
		?>
		<div class="row ef5-comment-form-flex">
            <div class="col-lg-10">
			<?php rovoko_comment_form(); ?>
            </div>
		</div>
		<?php
	endif;	
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() ) :
		?>
		<div class="ef5-no-comments required">
			<?php esc_html_e( 'Comments are closed.','rovoko' ); ?>
		</div>
		<?php
	endif; 
	?>
</div>