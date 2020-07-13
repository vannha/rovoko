<?php
// Body Class
add_filter( 'body_class', 'rovoko_body_class' );
function rovoko_body_class( $classes ) {
	$header_ontop  = rovoko_get_opts( 'header_ontop', '0' );
	$header_sticky = rovoko_get_opts( 'header_sticky', '0' );

	$classes[] = 'header-' . rovoko_get_opts( 'header_layout', '1' );
	// Header Ontop / Sticky 
	if ( $header_ontop === '1' || $header_sticky === '1' ) {
		$classes[] = 'side-header-ontop';
	}
	// Boxed
	if ( rovoko_get_opts( 'site_layout', '-1' ) === 'boxed' ) {
		$classes[] = 'site-boxed site-custom-vc-row';
	}
	// Bordered
	if ( rovoko_get_opts( 'site_layout', '-1' ) === 'bordered' ) {
		$classes[] = 'site-bordered';
	}

	return $classes;
}

// Password protected form
add_filter( 'the_password_form', 'rovoko_get_the_password_form' );
function rovoko_get_the_password_form( $post = 0 ) {
	$post   = get_post( $post );
	$label  = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
	$output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">
    <p>' . esc_html__( 'This content is password protected. To view it please enter your password below:', 'rovoko' ) . '</p>
    <div class="ef5-pwbox"><div class="ef5-pwbox-inner"><input name="post_password" id="' . esc_attr( $label ) . '" type="password" size="20" placeholder="' . esc_attr__( 'Enter Password', 'rovoko' ) . '" /><input type="submit" name="Submit" value="' . esc_attr__( 'Enter', 'rovoko' ) . '" /></div></div></form>
    ';

	return $output;
}

/**
 * Widget
 * Expander parent item
 */
if ( ! function_exists( 'rovoko_widget_expander' ) ) {
	add_filter( 'ef5systems_megamenu_expander', 'rovoko_widget_expander' ); // add expander for megamenu
	function rovoko_widget_expander( $args = [] ) {
		$args          = wp_parse_args( $args, [
			'class'       => '',
			'inner_class' => ''
		] );
		$classes       = [ 'ef5-toggle', $args['class'] ];
		$inner_classes = [ 'ef5-toggle-inner', $args['inner_class'] ];

		return '<span class="' . implode( ' ', $classes ) . '"><span class="' . implode( ' ', $inner_classes ) . '"></span></span>';
	}
}

/**
 * Gutenberg
 */
add_filter( 'use_block_editor_for_post', 'rovoko_support_gtb', 100 );
function rovoko_support_gtb() {
	$gutenberg = rovoko_get_opts( 'gutenberg', '0' );
	if ( $gutenberg == '0' ) {
		return false;
	} else {
		return true;
	}
}
 