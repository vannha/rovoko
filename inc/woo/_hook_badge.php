<?php
/**
 * Add new product Badge
 * Like: Hot, New, Sale, ...
 * Use: Product Attributes
 */
if ( ! function_exists( 'rovoko_woocommerce_loop_attributes' ) ) {
	add_action( 'rovoko_woocommerce_single_gallery', 'rovoko_woocommerce_loop_attributes', 2 );
	add_action( 'rovoko_woocommerce_before_shop_loop_products_inner', 'rovoko_woocommerce_loop_attributes', 0 );
	function rovoko_woocommerce_loop_attributes() {
		?>
        <div class="ef5-loop-atts row justify-content-between">
			<?php do_action( 'rovoko_woocommerce_loop_attributes' ); ?>
        </div>
		<?php
	}
}
/**
 * Loop Loop product sale
 */
if ( ! function_exists( 'rovoko_woocommerce_sale' ) ) {
	add_action( 'rovoko_woocommerce_loop_attributes', 'rovoko_woocommerce_sale', 0 );
	function rovoko_woocommerce_sale() {
		global $product;
		if ( ! $product->is_on_sale() ) {
			return;
		}
		if ( $product->get_type() == 'variable' ) {
			$regular_price = $product->get_variation_regular_price( 'max' );
			$sales_price   = $product->get_variation_sale_price( 'max' );
		} else {
			$regular_price = $product->get_regular_price();
			$sales_price   = $product->get_sale_price();
		}
		if ( isset( $regular_price ) && $regular_price > 0 && isset( $sales_price ) ) {
			$percentage = round( ( ( $regular_price - $sales_price ) / $regular_price ) * 100 ); ?>
            <span class="ef5-badge ef5-corner-ribbon sale bg-accent text-xxsmall">
            <?php /*printf( '- %s', $percentage . '%' )*/ ?>
            <?php esc_html_e( 'Sale', 'rovoko' ); ?>
        </span>
			<?php
		}
	}
}
/* Loop Product Badge hot(Featured) */
if ( ! function_exists( 'rovoko_woocommerce_product_featured' ) ) {
	add_action( 'rovoko_woocommerce_loop_attributes', 'rovoko_woocommerce_product_featured', 1 );
	function rovoko_woocommerce_product_featured() {
		global $product;
		$badge_class = 'ef5-badge ef5-corner-ribbon hot text-xxsmall';
		if ( $product->is_featured() ) {
			echo '<span class="' . esc_attr( $badge_class ) . '">' . esc_html__( 'Hot', 'rovoko' ) . '</span>';
		}
	}
}
/* Loop Product Badge Attributes */
if ( ! function_exists( 'rovoko_woocommerce_show_product_loop_badges' ) ) {
	add_action( 'rovoko_woocommerce_loop_attributes', 'rovoko_woocommerce_show_product_loop_badges', 1 );
	function rovoko_woocommerce_show_product_loop_badges() {
		global $product;
		$terms       = get_the_terms( $product->get_id(), 'pa_badge' );
		$badge_class = 'ef5-badge ef5-corner-ribbon text-xxsmall';
		if ( ! is_wp_error( $terms ) && $terms !== false ) {
			$count = count( $terms );
		} else {
			$count = 0;
		}
		if ( is_array( $terms ) && $count > 0 ) {
			foreach ( $terms as $term ) {
				echo '<span class="' . esc_attr( $badge_class ) . ' ' . strtolower( $term->name ) . '">' . $term->name . '</span>';
			}
		}
	}
}