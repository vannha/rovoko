<?php
/**
 * Template part for displaying project in loop
 *
 * @package EF5 Theme
 * @subpackage EF5Frame
 * @since 1.0.0
 * @author EF5 Team
 *
 */
$classes[] = 'ef5-list';
$classes[] = 'ef5-archive';
$classes[] = 'mb-lg-50';

?>

<div <?php post_class( trim( implode( ' ', $classes ) ) ); ?>>
    <div class="row gutter-50">
		<?php rovoko_post_media( [
			'thumbnail_size' => 'medium',
			'class'          => 'col-12 col-lg-50/41',
			'has_hook'       => false
		] ); ?>
        <div class="ef5-loop-info col-12 col-lg-49/59"><?php
			rovoko_tagged_in( [ 'before_tag' => '' ] );
			rovoko_post_header( [ 'class' => 'loop ef5-loop-header', 'heading_tag' => 'h2' ] );
			rovoko_post_excerpt( [ 'class' => 'mt-lg-25', 'length' => 50 ] );
			?>
            <div class="ef5-loop-readmore mt-xl-50"><?php rovoko_post_read_more( [ 'title' => esc_html__( 'View More', 'rovoko' ), ] ); ?></div>
        </div>
    </div>

</div>