<?php
/**
 * All function for page title
 */
/**
 * Page title Layout
 */
function rovoko_page_title() {
	$ptitle_layout = rovoko_get_opts( 'ptitle_layout', '1' );
	if ( $ptitle_layout === 'none' || is_404() ) {
		return;
	}
	get_template_part( 'template-parts/page-title/layout', $ptitle_layout );
}

/**
 * Page title inner class
 */
function rovoko_ptitle_inner_class( $args = [] ) {
	$args = wp_parse_args( $args, [
		'class' => '',
		'inner' => true,
		'echo'  => true
	] );
	if ( $args['inner'] ) {
		$classes = [ 'ef5-pagetitle-inner' ];
	}
	$full = rovoko_get_opts( 'ptitle_full_width', '0' );
	if ( $full === '1' ) {
		$classes[] = 'container-fluid';
	} else {
		$classes[] = 'container';
	}

	$classes[] = $args['class'];
	$class     = trim( implode( ' ', $classes ) );
	if ( $args['echo'] ) {
		echo esc_attr( $class );
	} else {
		return esc_attr( $class );
	}
}

/**
 * Prints HTML for breadcrumbs.
 */
function rovoko_breadcrumb( $args = [] ) {
	if ( ! class_exists( 'Rovoko_Breadcrumb' ) ) {
		return;
	}
	$args       = wp_parse_args( $args, [
		'class' => '',
		'separator' => ''
	] );
	$breadcrumb = new Rovoko_Breadcrumb();
	$entries    = $breadcrumb->get_entries();

	if ( empty( $entries ) ) {
		return;
	}
	$separator = apply_filters( 'rovoko_breadcrumb_separator', $args['separator'] );
	ob_start();
	$count = count( $entries );
	$d     = 0;
	foreach ( $entries as $entry ) {
		$d ++;
		$entry = wp_parse_args( $entry, array(
			'label' => '',
			'url'   => ''
		) );

		if ( empty( $entry['label'] ) ) {
			continue;
		}

		if ( ! empty( $entry['url'] ) ) {
			printf(
				'<a class="item link" href="%1$s">%2$s</a>',
				esc_url( $entry['url'] ),
				esc_attr( $entry['label'] )
			);
		} else {
			printf( '<span class="item title" >%s</span>', esc_html( $entry['label'] ) );
		}
		if ( $d < $count ) {
			echo '<span class="separator ">' . $separator . '</span>';
		}
	}

	$output = ob_get_clean();

	if ( $output ) {
		$home_link = '<a href="' . home_url( '/' ) . '" class="breadcrumb-home-icon"><span class="flaticon-internet-1"></span></a>';
		printf( '<div class="' . rovoko_ptitle_inner_class( [
				'class' => 'ef5-breadcrumb',
				'echo'  => false,
				'inner' => false
			] ) . ' "><div class="breadcrumb %1$s">%2$s %3$s</div></div>', $args['class'], $home_link, $output );
	}
}

/**
 * Parallax Image
 * // default background: get_template_directory_uri().'/assets/images/page-title/bg-pagetitle.jpg'
 */
function rovoko_ptitle_parallax_image() {
	$parallax_url = rovoko_get_opts( 'ptitle_parallax', [ 'url' => '' ] );
	if ( empty( $parallax_url['url'] ) ) {
		return;
	}
	$titles = rovoko_get_page_titles();
	echo '<div class="parallax"><img src="' . esc_url( $parallax_url['url'] ) . '" alt="' . esc_attr( $titles['title'] ) . '" /></div>';
}