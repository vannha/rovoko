<?php
/**
 * Change cart item thumbnail size
 */
if ( ! function_exists( 'rovoko_woocommerce_cart_item_thumbnail' ) ) {
	add_filter( 'woocommerce_cart_item_thumbnail', 'rovoko_woocommerce_cart_item_thumbnail', 10, 3 );
	function rovoko_woocommerce_cart_item_thumbnail( $thumbnail, $cart_item, $cart_item_key ) {
		$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
		$thumbnail_id = get_post_thumbnail_id( $product_id );
		$thumbnail    = rovoko_image_by_size( [
			'id'   => $thumbnail_id,
			'size' => apply_filters( 'rovoko_woocommerce_cart_item_thumbnail_size', '70x70' ),
			'echo' => false
		] );

		return $thumbnail;
	}
}

/**
 * Change Cart Item Name output
 *
 * Add Product Brand at Top
 * Filter: woocommerce_cart_item_name
 */

if ( ! function_exists( 'rovoko_woocommerce_cart_item_name' ) ) {
	add_filter( 'woocommerce_cart_item_name', 'rovoko_woocommerce_cart_item_name', 10, 3 );
	function rovoko_woocommerce_cart_item_name( $name, $cart_item, $cart_item_key ) {
		$_product          = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
		$product_id        = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
		$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

		$terms = get_the_terms( $product_id, 'pa_brand' );
		if ( ! is_wp_error( $terms ) ) {
			$count = count( $terms );
		} else {
			$count = 0;
		}
		$brand = '';
		if ( is_array( $terms ) && $count > 0 ) {
			$brand = '<div class="cart-item-brand">';
			foreach ( $terms as $term ) {
				$brand .= '<div class="wc-brand ' . strtolower( str_replace( array(
						' ',
						'&',
						'amp;'
					), '-', $term->name ) ) . '">' . $term->name . '</div>';
			}
			$brand .= '</div>';
		}

		$name = '<div class="cart-item-name-wrap">';
		$name .= $brand;

		if ( ! $product_permalink ) {
			$name .= $_product->get_name();
		} else {
			$name .= sprintf( '<a class="cart-item-name" href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() );
		}
		$name .= '</div>';

		return $name;
	}
}

/**
 * Custom Cart Actions Layout
 */
if ( ! function_exists( 'rovoko_woocommerce_cart_actions' ) ) {
	add_filter( 'woocommerce_after_cart_table', 'rovoko_woocommerce_cart_actions', 10 );
	remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
	function rovoko_woocommerce_cart_actions() {
		?>
        <div class="ef5-cart-actions-wrap row gutter-230 mt-50 mt-lg-80">
            <div class="col-lg-6">
				<?php rovoko_woocommerce_calculator(); ?>
            </div>
            <div class="ef5-cart-totals col-lg-6">
				<?php woocommerce_cart_totals(); ?>
            </div>
        </div>

		<?php
	}
}

if ( ! function_exists( 'rovoko_woocommerce_calculator' ) ) {
	function rovoko_woocommerce_calculator() {
		if ( 'no' === get_option( 'woocommerce_enable_shipping_calc' ) || ! WC()->cart->needs_shipping() ) {
			return;
		}
		do_action( 'woocommerce_before_shipping_calculator' ); ?>
        <form class="woocommerce-shipping-calculator" action="<?php echo esc_url( wc_get_cart_url() ); ?>"
              method="post">
			<?php printf( '<h2 class="s">%s</h2>', esc_html__( 'Calculate shipping', 'rovoko' ) ); ?>
            <section class="rovoko-shipping-calculator-form">
				<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_country', true ) ) : ?>
                    <p class="form-row form-row-wide" id="calc_shipping_country_field">
                        <select name="calc_shipping_country" id="calc_shipping_country"
                                class="country_to_state country_select" rel="calc_shipping_state">
                            <option value=""><?php esc_html_e( 'Select a country&hellip;', 'rovoko' ); ?></option>
							<?php
							foreach ( WC()->countries->get_shipping_countries() as $key => $value ) {
								echo '<option value="' . esc_attr( $key ) . '"' . selected( WC()->customer->get_shipping_country(), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
							}
							?>
                        </select>
                    </p>
				<?php endif; ?>
				<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_state', true ) ) : ?>
                    <p class="form-row form-row-wide" id="calc_shipping_state_field">
						<?php
						$current_cc = WC()->customer->get_shipping_country();
						$current_r  = WC()->customer->get_shipping_state();
						$states     = WC()->countries->get_states( $current_cc );
						if ( is_array( $states ) && empty( $states ) ) {
							?>
                            <input type="hidden" name="calc_shipping_state" id="calc_shipping_state"
                                   placeholder="<?php esc_attr_e( 'State / County', 'rovoko' ); ?>"/>
							<?php
						} elseif ( is_array( $states ) ) {
							?>
                            <span>
						<select name="calc_shipping_state" class="state_select" id="calc_shipping_state"
                                data-placeholder="<?php esc_attr_e( 'State / County', 'rovoko' ); ?>">
							<option value=""><?php esc_html_e( 'Select an option&hellip;', 'rovoko' ); ?></option>
							<?php
							foreach ( $states as $ckey => $cvalue ) {
								echo '<option value="' . esc_attr( $ckey ) . '" ' . selected( $current_r, $ckey, false ) . '>' . esc_html( $cvalue ) . '</option>';
							}
							?>
						</select>
					</span>
							<?php
						} else {
							?>
                            <input type="text" class="input-text" value="<?php echo esc_attr( $current_r ); ?>"
                                   placeholder="<?php esc_attr_e( 'State / County', 'rovoko' ); ?>"
                                   name="calc_shipping_state" id="calc_shipping_state"/>
							<?php
						}
						?>
                    </p>
				<?php endif; ?>
				<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_city', true ) ) : ?>
                    <p class="form-row form-row-wide" id="calc_shipping_city_field">
                        <input type="text" class="input-text"
                               value="<?php echo esc_attr( WC()->customer->get_shipping_city() ); ?>"
                               placeholder="<?php esc_attr_e( 'City', 'rovoko' ); ?>" name="calc_shipping_city"
                               id="calc_shipping_city"/>
                    </p>
				<?php endif; ?>
				<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_postcode', true ) ) : ?>
                    <p class="form-row form-row-wide" id="calc_shipping_postcode_field">
                        <input type="text" class="input-text"
                               value="<?php echo esc_attr( WC()->customer->get_shipping_postcode() ); ?>"
                               placeholder="<?php esc_attr_e( 'Postcode / ZIP', 'rovoko' ); ?>"
                               name="calc_shipping_postcode" id="calc_shipping_postcode"/>
                    </p>
				<?php endif; ?>
                <p>
                    <button type="submit" name="calc_shipping" value="1"
                            class="button"><?php esc_html_e( 'Update Totals', 'rovoko' ); ?></button>
                </p>
				<?php wp_nonce_field( 'woocommerce-shipping-calculator', 'woocommerce-shipping-calculator-nonce' ); ?>
            </section>
        </form>
		<?php do_action( 'woocommerce_after_shipping_calculator' );
	}
}
if ( ! function_exists( 'rovoko_woocommerce_after_cart_content' ) ) {
	add_action( 'woocommerce_after_cart_contents', 'rovoko_woocommerce_after_cart_content', 1 );
	function rovoko_woocommerce_after_cart_content() {
		if ( wc_coupons_enabled() ) { ?>
            <tr>
                <td colspan="6" class="rovoko-actions">
                    <div class="d-flex justify-content-between">
                        <div class="ef5-cart-coupon coupon">
                            <input type="text" name="coupon_code" class="input-text" id="coupon_code" value=""
                                   placeholder="<?php esc_attr_e( 'Coupon code', 'rovoko' ); ?>"/>
                            <button type="submit" class="button" name="apply_coupon"
                                    value="<?php esc_attr_e( 'Apply coupon', 'rovoko' ); ?>"><?php esc_attr_e( 'Apply', 'rovoko' ); ?></button>
							<?php do_action( 'woocommerce_cart_coupon' ); ?>
                        </div>
                        <button type="submit" class="ef5-btn fill accent" name="update_cart"
                                value="<?php esc_attr_e( 'Update cart', 'rovoko' ); ?>"><?php esc_html_e( 'Update cart', 'rovoko' ); ?></button>
                    </div>
                </td>
            </tr>
		<?php }
	}
}
function rovoko_add_cate_to_after_cart_title( $cart_item ) {
	echo wc_get_product_category_list( $cart_item['product_id'] );
}

add_action( 'woocommerce_after_cart_item_name', 'rovoko_add_cate_to_after_cart_title', 10, 1 );

// check for empty-cart get param to clear the cart
if ( ! function_exists( 'rovoko_woocommerce_clear_cart_url' ) ) {
	add_action( 'init', 'rovoko_woocommerce_clear_cart_url' );
	function rovoko_woocommerce_clear_cart_url() {
		if ( isset( $_GET['empty-cart'] ) ) {
			WC()->cart->empty_cart();
		}
	}
}
if ( ! function_exists( 'rovoko_woocommerce_clear_cart_button' ) ) {
	add_action( 'rovoko_woocommerce_after_cart_table_left', 'rovoko_woocommerce_clear_cart_button' );
	function rovoko_woocommerce_clear_cart_button() {
		$link = wc_get_cart_url();
		$link = add_query_arg( 'empty-cart', '', $link );
		?>
        <a class="ef5-btn red outline ef5-btn-lg" href="<?php echo esc_url( $link ); ?>"><span class="far fa-times">&nbsp;&nbsp;</span><span><?php esc_html_e( 'Clear Shopping Cart', 'rovoko' ); ?></span></a>
		<?php
	}
}
/**
 * add title before cart table
 *
 */
if ( ! function_exists( 'rovoko_woocommerce_before_cart_table' ) ) {
	add_action( 'woocommerce_before_cart_table', 'rovoko_woocommerce_before_cart_table', 1 );
	function rovoko_woocommerce_before_cart_table() {
		$count = WC()->cart->cart_contents_count;
		printf( _nx( '<div class="h2 font-weight-light pb-lg-60 pb-30">In your shopping cart: <span class="primary">%s product</span></div>', '<div class="h2 font-weight-light pb-lg-60 pb-30">In your shopping cart: <span>%s products</span></div>', $count, 'Cart Content Count', 'rovoko' ), $count );
	}
}
/**
 * Custom Cross Sells Columns and Limit
 *
 */
add_filter( 'woocommerce_cross_sells_columns', function () {
	return apply_filters( 'rovoko_woocommerce_cross_sells_columns', '4' );
} );
add_filter( 'woocommerce_cross_sells_total', function () {
	return apply_filters( 'rovoko_woocommerce_cross_sells_columns', '4' );
} );

/*Remove Shiping calculator in Cart totals */
if ( ! function_exists( 'woocommerce_shipping_calculator' ) ) {
	function woocommerce_shipping_calculator( $show = false ) {
		if ( ! $show || 'no' === get_option( 'woocommerce_enable_shipping_calc' ) || ! WC()->cart->needs_shipping() ) {
			return;
		}
	}
}