<?php
/**
 * Template part for displaying posts in single
 *
 * @package EF5 Theme
 * @subpackage EF5Frame
 * @since 1.0.0
 * @author EF5 Team
 *
 */
?>

<div <?php post_class( 'ef5-single clearfix' ); ?>>
	<?php
	rovoko_post_content( [ 'class' => 'ef5-single-content' ] );
	?>
    <div class="project-meta pt-lg-45">
		<?php rovoko_posted_on( [
			'icon'        => '',
			'before_date' => esc_html__( 'Year ', 'rovoko' ),
			'date_format' => 'Y'
		] ); ?>
        <div class="row">
			<?php
			$desc    = get_post_meta( get_the_ID(), 'project_description', true );
			$class[] = 'ef5-project-header';
			$class[] = 'col-12';
			if ( ! empty( $desc ) ) {
				$class[] = 'col-lg-6';
			}
			$move_title = rovoko_get_opts( 'project_single_set_title_is_page_title', '0' );
			if ( $move_title == '0' ) {
				rovoko_post_header( [ 'class' => trim( implode( ' ', $class ) ), 'title_link' => false ] );
				rovoko_project_meta_option( [
					'meta_id' => 'project_description',
					'class'   => 'project-des col-12 col-lg-6'
				] );
			}else{
				rovoko_project_meta_option( [
					'meta_id' => 'project_description',
					'class'   => 'project-des col-12'
				] );
            }
			?>
        </div>
        <div class="row justify-content-between align-items-center">
			<?php rovoko_project_meta_option( [ 'meta_id' => 'project_more_option', 'class' => 'col-auto' ] ); ?>
        </div>
		<?php
		$desc2            = get_post_meta( get_the_ID(), 'project_description_2', true );
		$desc3            = get_post_meta( get_the_ID(), 'project_description_3', true );
		$last_col_class[] = 'project-des';
		$last_col_class[] = 'col-12';
		if ( empty( $desc2 ) || empty( $desc3 ) ) {
			$last_col_class[] = 'col-lg-12';
		} elseif ( ! empty( $desc2 ) && ! empty( $desc3 ) ) {
			$last_col_class[] = 'col-lg-6';
		}
		if ( ! empty( $desc2 ) || ! empty( $desc3 ) ) :

			?>
            <div class="row">
				<?php
				rovoko_project_meta_option( [
					'meta_id' => 'project_description_2',
					'class'   => trim( implode( ' ', $last_col_class ) )
				] ); ?>
				<?php rovoko_project_meta_option( [
					'meta_id' => 'project_description_3',
					'class'   => trim( implode( ' ', $last_col_class ) )
				] ); ?>
            </div>
		<?php endif; ?>
    </div>
</div>