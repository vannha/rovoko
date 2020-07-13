<?php
/**
 * Footer layout two
 *
 */
?>
<div class="<?php rovoko_footer_inner_class(); ?>">
    <div class="row justify-content-center align-items-center">
		<?php
		if ( ! empty( rovoko_get_opts( 'footer_custom_html' ) ) ):
			echo '<div class="col-12 custom-html">';
			echo wp_kses( rovoko_get_opts( 'footer_custom_html' ), rovoko_custom_html_tag() );
			echo '</div>';
		endif;
		rovoko_footer_menu( 'footer_menu', 'col-12' );
		if ( class_exists( 'Newsletter' ) && ! empty( rovoko_get_opts( 'footer_newsletter' ) ) && rovoko_get_opts( 'footer_newsletter' ) == '1' ) {
			echo '<div class="col-12 footer-newletter">';
			echo do_shortcode( '[newsletter_form type="minimal" class="custtom-newletter" button="' . esc_attr__( 'Subscribe', 'rovoko' ) . '" placeholder="' . esc_attr__( 'Enter Email for the Latest Updates', 'rovoko' ) . '"][/newsletter_form]' );
			echo '</div>';
		}
		rovoko_footer_social_items();
		rovoko_footer_copyright( 'col-12' );
		?>
    </div>
</div>
