<?php
/*Project meta data in project detail*/
if ( ! function_exists( 'rovoko_project_meta_data' ) ) {
	function rovoko_project_meta_option( $args = [] ) {
		$args          = wp_parse_args( $args, [
			'meta_id' => '',
			'class'   => ''
		] );
		$classes       = [ 'project-single-meta', $args['class'], 'mt-10', 'mb-15' ];
		$meta          = get_post_meta( get_the_ID(), $args['meta_id'], true );
		if ( empty( $meta ) ) {
			return;
		}

		if ( is_array( $meta ) ):
			$classes[] = 'd-flex';
			$classes[] = 'align-items-center';
			$classes[] = 'mt-lg-15';
			$classes[] = 'mb-lg-20';
			foreach ( $meta as $values ):
				$value = explode( '||', $values );
				if ( count( $value ) < 3 ) {
					continue;
				}
				?>
                <div class="<?php echo trim( implode( ' ', $classes ) ); ?>">
                    <div class="meta-icon">
                        <span class="<?php echo esc_attr( $value[0] ) ?>"></span>
                    </div>
                    <div class="meta-text">
                        <div class="h4 meta-title"><?php echo esc_html( $value[1] ); ?></div>
                        <div class="meta-des"><?php echo esc_html( $value[2] ); ?></div>
                    </div>
                </div>
			<?php
			endforeach; ?>
		<?php else:
			$classes[] = 'mt-lg-25';
			$classes[] = 'mb-lg-25';
			?>
            <div class="<?php echo trim( implode( ' ', $classes ) ); ?>">
				<?php echo apply_filters( 'the_content', $meta ) ?>
            </div>
		<?php endif;
	}
}
