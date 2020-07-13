<?php

/**
 * Remove all default WC css
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Loop Products
 * Remove Shop Title
 *
 */
add_filter( 'woocommerce_show_page_title', function () {
	return false;
} );

/**
 * Archive product
 * Wrap Result Count and Catalog Ordering
 * Hook: woocommerce_before_shop_loop.
 *
 * @hooked woocommerce_result_count - 20
 * @hooked woocommerce_catalog_ordering - 30
 */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action( 'woocommerce_before_shop_loop', 'rovoko_woocommerce_count_ordering', 11 );
add_action( 'rovoko_woocommerce_count_ordering', 'woocommerce_result_count', 20 );
add_action( 'rovoko_woocommerce_count_ordering', 'woocommerce_catalog_ordering', 30 );
function rovoko_woocommerce_count_ordering() {
	?>
    <div class="ef5-woo-count-order mb-xl-45 d-flex justify-content-between align-items-center">
		<?php do_action( 'rovoko_woocommerce_count_ordering' ); ?>
    </div>
	<?php
}


/**
 * Add an action to call all EF5Frame function
 * before shop loop
 *
 */
if ( ! function_exists( 'rovoko_woocommerce_before_shop_loop' ) ) {
	add_action( 'woocommerce_before_shop_loop', 'rovoko_woocommerce_before_shop_loop', 12 );
	function rovoko_woocommerce_before_shop_loop() {
		do_action( 'rovoko_woocommerce_before_shop_loop' );
	}
}


/**
 * Change number of column that are displayed per page (shop page)
 * Return column number
 */
add_filter( 'loop_shop_columns', 'rovoko_loop_shop_columns', 20 );
function rovoko_loop_shop_columns() {
	$columns          = rovoko_get_opts( 'products_columns', 4 );
	$sidebar_position = rovoko_sidebar_position();
	if ( is_active_sidebar( 'sidebar-shop' ) && ( $sidebar_position == 'left' || $sidebar_position == 'center'|| $sidebar_position == 'right' ) ) {
		$columns = $columns - 1;
	}

	return $columns;
}

/**
 * Change number of products that are displayed per page (shop page)
 * $limit contains the current number of products per page based on the value stored on Options -> Reading
 * Return the number of products you wanna show per page.
 *
 */
add_filter( 'loop_shop_per_page', 'rovoko_loop_shop_per_page', 20 );
function rovoko_loop_shop_per_page( $limit ) {
	$limit = rovoko_get_opts( 'products_per_page', 12 );

	return $limit;
}

/**
 * Paginate
 */
add_filter( 'woocommerce_pagination_args', 'rovoko_woocommerce_pagination_args' );
function rovoko_woocommerce_pagination_args( $args ) {
	$custom = [
		'type'      => 'plain',
		'prev_text' => '<span class="prev hint--top" data-hint="' . apply_filters( 'rovoko_loop_pagination_prev_text', esc_html__( 'Previous', 'rovoko' ) ) . '"><span class="flaticon-return"></span></span>',
		'next_text' => '<span class="next hint--top" data-hint="' . apply_filters( 'rovoko_loop_pagination_next_text', esc_html__( 'Next', 'rovoko' ) ) . '"><span  class="flaticon-next-1"></span></span>'
	];
	$args   = array_merge( $args, $custom );

	return $args;
}

if ( ! function_exists( 'woocommerce_pagination' ) ) {
	/**
	 * Output the pagination.
	 */
	function woocommerce_pagination() {
		if ( ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) {
			return;
		}

		$args = array(
			'total'   => wc_get_loop_prop( 'total_pages' ),
			'current' => wc_get_loop_prop( 'current_page' ),
			'base'    => esc_url_raw( add_query_arg( 'product-page', '%#%', false ) ),
			'format'  => '?product-page=%#%',
		);

		if ( ! wc_get_loop_prop( 'is_shortcode' ) ) {
			$args['format'] = '';
			$args['base']   = esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
		}
		$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
		$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
		$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
		$format  = isset( $format ) ? $format : '';

		if ( $total <= 1 ) {
			return;
		}
		?>
        <div class="ef5-loop-pagination">
            <div class="nav-links">
				<?php
				echo paginate_links( apply_filters( 'woocommerce_pagination_args', array( // WPCS: XSS ok.
					'base'      => $base,
					'format'    => $format,
					'add_args'  => false,
					'current'   => max( 1, $current ),
					'total'     => $total,
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
					'end_size'  => 3,
					'mid_size'  => 3,
				) ) );
				?>
            </div>
        </div>
		<?php
	}
}