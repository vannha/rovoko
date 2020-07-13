<?php
/**
 * Build Single Product Gallery and Summary layout
 *
 */

if ( ! function_exists( 'rovoko_woocommerce_before_single_product_summary' ) ) {
	add_action( 'woocommerce_before_single_product_summary', 'rovoko_woocommerce_before_single_product_summary', 0 );
	function rovoko_woocommerce_before_single_product_summary() {
		$classes = [ 'ef5-wc-img-summary', rovoko_get_opts( 'product_gallery_layout', 'simple' ) ];
		echo '<div class="' . trim( implode( ' ', $classes ) ) . '">';
	}
}
if ( ! function_exists( 'rovoko_woocommerce_after_single_product_summary' ) ) {
	add_action( 'woocommerce_after_single_product_summary', 'rovoko_woocommerce_after_single_product_summary', 0 );
	function rovoko_woocommerce_after_single_product_summary() {
		echo '</div>';
	}
}

/**
 * Wrap Product Image / Gallery in a Div
 * add new acction to add new content
 * new acction: rovoko_before_single_product_gallery, rovoko_after_single_product_gallery
 */
add_action( 'woocommerce_before_single_product_summary', function () {
	echo '<div class="ef5-product-gallery-wrap"><div class="ef5-product-gallery-inner">';
}, 0 );
add_action( 'woocommerce_before_single_product_summary', function () {
	do_action( 'rovoko_before_single_product_gallery' );
}, 1 );
add_action( 'woocommerce_before_single_product_summary', function () {
	do_action( 'rovoko_after_single_product_gallery' );
}, 999 );
add_action( 'woocommerce_before_single_product_summary', function () {
	echo '</div></div>';
}, 1000 );

/**
 * Wrap gallery in div
 */
if ( ! function_exists( 'rovoko_woocommerce_single_gallery' ) ) {
	/**
	 * Add product attributes to inside gallery
	 *
	 * add product badge: hot, new, sale, ...
	 * Hook: woocommerce_product_thumbnails
	 */
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

	add_action( 'woocommerce_before_single_product_summary', 'rovoko_woocommerce_single_gallery', 1 );
	add_action( 'rovoko_woocommerce_single_gallery', 'woocommerce_show_product_images', 3 );

	function rovoko_woocommerce_single_gallery() {
		$class = rovoko_get_opts( 'product_gallery_thumb_position', 'thumb-right' );
		?>
        <div class="ef5-single-product-gallery-wraps <?php echo esc_attr( $class ); ?>">
            <div class="ef5-single-product-gallery-wraps-inner">
				<?php do_action( 'rovoko_woocommerce_single_gallery' ); ?>
            </div>
        </div>
		<?php
	}
}

/**
 * Add Custom CSS class to Gallery
 */
add_filter( 'woocommerce_single_product_image_gallery_classes', 'rovoko_woocommerce_single_product_image_gallery_classes' );
function rovoko_woocommerce_single_product_image_gallery_classes( $class ) {
	$class[] = 'ef5-' . rovoko_get_opts( 'product_gallery_layout', 'simple' );
	$class[] = rovoko_get_opts( 'product_gallery_thumb_position', 'thumb-right' );

	return $class;
}

/**
 * Single Product
 *
 * Gallery style with thumbnail carousel in bottom
 *
 */
if ( ! function_exists( 'rovoko_wc_single_product_gallery_layout' ) ) {
	add_filter( 'woocommerce_single_product_carousel_options', 'rovoko_wc_single_product_gallery_layout' );
	function rovoko_wc_single_product_gallery_layout( $options ) {
		$gallery_layout = rovoko_get_opts( 'product_gallery_layout', 'simple' );

		$options['prevText'] = '<span class="flex-prev-icon"></span>';
		$options['nextText'] = '<span class="flex-next-icon"></span>';

		switch ( $gallery_layout ) {
			case 'thumbnail_v':
				$options['directionNav'] = true;
				$options['controlNav']   = false;
				$options['sync']         = '.wc-gallery-sync';
				break;

			case 'thumbnail_h':
				$options['directionNav'] = true;
				$options['controlNav']   = false;
				$options['sync']         = '.wc-gallery-sync';
				break;
		}

		return $options;
	}
}

/**
 * Single Product Gallery
 *
 * Add thumbnail product gallery
 *
 */
if ( ! function_exists( 'rovoko_product_gallery_thumbnail_sync' ) ) {
	add_action( 'rovoko_after_single_product_gallery', 'rovoko_product_gallery_thumbnail_sync' );
	function rovoko_product_gallery_thumbnail_sync( $args = [] ) {
		global $product;
		$gallery_layout                 = rovoko_get_opts( 'product_gallery_layout', 'simple' );
		$product_gallery_thumb_position = rovoko_get_opts( 'product_gallery_thumb_position', 'thumb-right' );
		$args                           = wp_parse_args( $args, [
			'gallery_layout' => $gallery_layout
		] );
		$post_thumbnail_id              = $product->get_image_id();
		$attachment_ids                 = array_merge( (array) $post_thumbnail_id, $product->get_gallery_image_ids() );

		if ( 'simple' === $args['gallery_layout'] || empty( $attachment_ids[0] ) ) {
			return;
		}
		$flex_class = '';

		$thumb_v_w = rovoko_configs( 'rovoko_product_gallery_thumbnail_v_w' );
		$thumb_v_h = rovoko_configs( 'rovoko_product_gallery_thumbnail_v_h' );

		$thumb_h_w    = str_replace( 'px', '', rovoko_configs( 'rovoko_product_gallery_thumbnail_h_w' ) );
		$thumb_h_h    = rovoko_configs( 'rovoko_product_gallery_thumbnail_h_h' );
		$thumb_margin = str_replace( 'px', '', rovoko_configs( 'rovoko_product_gallery_thumbnail_space' ) );

		switch ( $args['gallery_layout'] ) {
			case 'thumbnail_v':
				$thumbnail_size = $thumb_v_w . 'x' . $thumb_v_h;
				$thumb_w        = $thumb_v_w;
				$thumb_h        = $thumb_v_h;
				$flex_class     = 'flex-vertical';
				break;

			case 'thumbnail_h':
				$thumbnail_size = $thumb_h_w . 'x' . $thumb_h_h;
				$thumb_w        = $thumb_h_w;
				$thumb_h        = $thumb_h_h;
				$flex_class     = 'flex-horizontal';
				break;

		}
		$gallery_css_class = [ 'wc-gallery-sync', $gallery_layout, $product_gallery_thumb_position ];
		?>
        <div class="<?php echo trim( implode( ' ', $gallery_css_class ) ); ?>"
             data-thumb-w="<?php echo esc_attr( $thumb_w ); ?>" data-thumb-h="<?php echo esc_attr( $thumb_h ); ?>"
             data-thumb-margin="<?php echo esc_attr( $thumb_margin ); ?>">
            <div class="wc-gallery-sync-slides flexslider <?php echo esc_attr( $flex_class ); ?>">
				<?php foreach ( $attachment_ids as $attachment_id ) { ?>
                    <div class="wc-gallery-sync-slide flex-control-thumb"><?php rovoko_image_by_size( [
							'id'   => $attachment_id,
							'size' => $thumbnail_size
						] ); ?></div>
				<?php } ?>
            </div>
        </div>
		<?php
	}
}

/*
 * Single Product title
*/
if ( ! function_exists( 'woocommerce_template_single_title' ) ) {

	/**
	 * Output the product title.
	 */
	function woocommerce_template_single_title() {
		$move_title = rovoko_get_opts( 'product_single_set_title_is_page_title', '0' );
		if ( $move_title == '1' ) {
			return;
		}
		the_title( '<div class="product-single-title ef5-heading h2">', '</div>' );
	}
}
/**
 * Single Product Price
 **/
if ( ! function_exists( 'woocommerce_template_single_price' ) ) {
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 4 );
	/**
	 * Output the product price.
	 */
	function woocommerce_template_single_price() {
		global $product;
		echo rovoko_html( $product->get_price_html() );
	}
}
/**
 * Single Product Rating
 **/
if ( ! function_exists( 'rovoko_wooc_template_single_rating' ) ) {
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
	add_action( 'woocommerce_single_product_summary', 'rovoko_wooc_template_single_rating', 10 );
	/**
	 * Output the product price.
	 */
	function rovoko_wooc_template_single_rating() {
		global $product;
		if ( 'no' === get_option( 'woocommerce_enable_review_rating' ) ) {
			return;
		}
		$rating_count = $product->get_rating_count();
		$review_count = $product->get_review_count();
		$average      = $product->get_average_rating();
		if ( $rating_count > 0 ) : ?>
            <div class="woocommerce-product-rating">
				<?php echo wc_get_rating_html( $average, $rating_count ); ?>
				<?php if ( comments_open() ) : ?><a href="#reviews" class="woocommerce-review-link" rel="nofollow">
                    (<span class="count"><?php echo esc_html( $review_count ) ?></span>)</a><?php endif ?>
            </div>
		<?php endif;
	}
}
/**
 * Single Product Quantity Form
 */
if ( ! function_exists( 'rovoko_woocommerce_quantity_input_args' ) ) {
	add_filter( 'woocommerce_quantity_input_args', 'rovoko_woocommerce_quantity_input_args' );
	function rovoko_woocommerce_quantity_input_args( $args ) {
		$args['product_name'] = '';

		return $args;
	}
}
/**
 * Single Product Meta
 */
if ( ! function_exists( 'woocommerce_template_single_meta' ) ) {

	/**
	 * Output the product meta.
	 */
	function woocommerce_template_single_meta() {
		global $product;
		?>
        <div class="ef5-product-meta">
			<?php do_action( 'woocommerce_product_meta_start' ); ?>

			<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

                <span class="ef5-sku-wrapper meta-item">
				<span class="ef5-heading font-style-700"><?php esc_html_e( 'Sku:', 'rovoko' ); ?></span> <span
                            class="sku"><?php if ( $sku = $product->get_sku() ) {
							echo esc_html( $sku );
						} else {
							echo esc_html__( 'N/A', 'rovoko' );
						} ?></span>
			</span>

			<?php endif; ?>

			<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted-in meta-item"><span class="ef5-heading font-style-700">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'rovoko' ) . '</span> ', '</span>' ); ?>

			<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged-as meta-item"><span class="ef5-heading font-style-700">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'rovoko' ) . '</span> ', '</span>' ); ?>

			<?php do_action( 'woocommerce_product_meta_end' ); ?>

        </div>
		<?php
	}
}
// Product meta share
if ( ! function_exists( 'rovoko_woocommerce_product_meta_end' ) ) {
	add_action( 'woocommerce_product_meta_end', 'rovoko_woocommerce_product_meta_end', 0 );
	function rovoko_woocommerce_product_meta_end() {
		$show_share = rovoko_get_theme_opt( 'product_share_on', '0' );
		if ( ! $show_share ) {
			return;
		}
		wp_enqueue_script( 'sharethis' );
		global $product;
		$url   = get_the_permalink();
		$image = get_the_post_thumbnail_url( $product->get_id() );
		$title = get_the_title();
		?>
        <div class="share-product">
			<span class="meta-share">
                <a data-hint="<?php esc_attr_e( 'Share this post to Facebook', 'rovoko' ); ?>" data-toggle="tooltip"
                   href="javascript:void(0);" data-network="facebook" data-url="<?php echo esc_url( $url ); ?>"
                   data-short-url="<?php echo esc_url( $url ); ?>" data-title="<?php echo esc_attr( $title ); ?>"
                   data-image="<?php echo esc_url( $image ); ?>" data-description="<?php echo get_the_excerpt(); ?>"
                   data-username="" data-message="<?php echo bloginfo(); ?>"
                   class="hint--top hint--bounce facebook st-custom-button"><span class="fab fa-facebook-f"></span></a>
                <a data-hint="<?php esc_attr_e( 'Share this post to Twitter', 'rovoko' ); ?>" data-toggle="tooltip"
                   href="javascript:void(0);" data-network="twitter" data-url="<?php echo esc_url( $url ); ?>"
                   data-short-url="<?php echo esc_url( $url ); ?>" data-title="<?php echo esc_attr( $title ); ?>"
                   data-image="<?php echo esc_url( $image ); ?>" data-description="<?php echo get_the_excerpt(); ?>"
                   data-username="" data-message="<?php echo bloginfo(); ?>"
                   class="hint--top hint--bounce twitter st-custom-button"><span class="fab fa-twitter"></span></a>
                <a data-hint="<?php esc_attr_e( 'Share this post to Google Plus', 'rovoko' ); ?>" data-toggle="tooltip"
                   href="javascript:void(0);" data-network="googleplus" data-url="<?php echo esc_url( $url ); ?>"
                   data-short-url="<?php echo esc_url( $url ); ?>" data-title="<?php echo esc_attr( $title ); ?>"
                   data-image="<?php echo esc_url( $image ); ?>" data-description="<?php echo get_the_excerpt(); ?>"
                   data-username="" data-message="<?php echo bloginfo(); ?>"
                   class="hint--top hint--bounce googleplus st-custom-button"><span
                            class="fab fa-google-plus"></span></a>
                <a data-hint="<?php esc_attr_e( 'Share this post to Pinterest', 'rovoko' ); ?>" data-toggle="tooltip"
                   href="javascript:void(0);" data-network="pinterest" data-url="<?php echo esc_url( $url ); ?>"
                   data-short-url="<?php echo esc_url( $url ); ?>" data-title="<?php echo esc_attr( $title ); ?>"
                   data-image="<?php echo esc_url( $image ); ?>" data-description="<?php echo get_the_excerpt(); ?>"
                   data-username="" data-message="<?php echo bloginfo(); ?>"
                   class="hint--top hint--bounce pinterest st-custom-button"><span class="fab fa-pinterest"></span></a>
                <a data-hint="<?php esc_attr_e( 'Share this post to', 'rovoko' ); ?>" data-toggle="tooltip"
                   href="javascript:void(0);" data-network="sharethis" data-url="<?php echo esc_url( $url ); ?>"
                   data-short-url="<?php echo esc_url( $url ); ?>" data-title="<?php echo esc_attr( $title ); ?>"
                   data-image="<?php echo esc_url( $image ); ?>" data-description="<?php echo get_the_excerpt(); ?>"
                   data-username="" data-message="<?php echo bloginfo(); ?>"
                   class="hint--top hint--bounce sharethis st-custom-button"><span class="fa fa-share-alt"></span></a>
			</span>
        </div>
		<?php
	}
}

/**
 * Product Tabs
 *
 * remove description/additional info heading
 */
add_filter( 'woocommerce_product_description_heading', function () {
	return false;
} );
add_filter( 'woocommerce_product_additional_information_heading', function () {
	return false;
} );


/*
 * Change column of related product
 * https://docs.woocommerce.com/document/change-number-of-related-products-output/
*/
if ( ! function_exists( 'rovoko_woocommerce_output_related_products_args' ) ) {
	add_filter( 'woocommerce_output_related_products_args', 'rovoko_woocommerce_output_related_products_args', 20 );
	function rovoko_woocommerce_output_related_products_args( $args ) {
		$args['posts_per_page'] = rovoko_loop_shop_columns() * 2; // 4 related products
		$args['columns']        = rovoko_loop_shop_columns(); // arranged in rovoko_loop_shop_columns columns

		return $args;
	}
}
// Add carousel to related
if ( ! function_exists( 'rovoko_single_product_scripts' ) ) {
	add_action( 'wp_enqueue_scripts', 'rovoko_single_product_scripts', 0 );
	function rovoko_single_product_scripts() {
		if ( ! is_singular( 'product' ) ) {
			return;
		}
		wp_enqueue_script( 'owl-carousel' );
		wp_enqueue_script( 'ef5-owl-carousel' );
		wp_enqueue_style( 'owl-carousel' );
		wp_enqueue_style( 'ef5-owl-carousel' );
	}
}

/*Add attributes type in admin*/
if ( ! function_exists( 'rovoko_add_attributes_type_selector' ) ) {
	if ( isset( $_GET['page'] ) && $_GET['page'] == 'product_attributes' ) {
		add_filter( 'product_attributes_type_selector', 'rovoko_add_attributes_type_selector' );
	}
	function rovoko_add_attributes_type_selector( $array ) {
		$array['technical'] = esc_html__( 'Technical Specs', 'rovoko' );

		return $array;
	}
}


/*Change tab name 'Additional information' to 'Specification'*/
add_filter( 'woocommerce_product_tabs', 'rovoko_customize_additional_information_tab', 89 );
function rovoko_customize_additional_information_tab( $tabs ) {
	global $product;
	if ( $product && ( $product->has_attributes() || apply_filters( 'wc_product_enable_dimensions_display', $product->has_weight() || $product->has_dimensions() ) ) ) {
		$tabs['additional_information']['title'] = esc_html__( 'Specification', 'rovoko' );
	}

	return $tabs;
}

/*remove wc_display_product_attributes and add new content*/
remove_action( 'woocommerce_product_additional_information', 'wc_display_product_attributes', 10 );
if ( ! function_exists( 'rovoko_display_product_attributes' ) ) {
	add_action( 'woocommerce_product_additional_information', 'rovoko_display_product_attributes', 12 );
	function rovoko_display_product_attributes() {
		global $product;
		$technical = array_filter( $product->get_attributes(), 'rovoko_technical_attributes_array_filter_visible' );
		$general   = array_filter( $product->get_attributes(), 'rovoko_general_attributes_array_filter_visible' ); ?>
		<?php if ( ! empty( $technical ) ) : ?>
            <h4 class="attribute-heading"><?php esc_html_e( 'Technical Specs', 'rovoko' ) ?></h4>
            <ul>
				<?php foreach ( $technical as $attribute ): ?>
                    <li>
                        <strong><?php echo wc_attribute_label( $attribute->get_name() ); ?></strong>
						<?php
						if ( $attribute->is_taxonomy() ) :
							$attribute_taxonomy = $attribute->get_taxonomy_object();
							$attribute_values   = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );

							foreach ( $attribute_values as $attribute_value ) {
								$value_name = esc_html( $attribute_value->name );

								if ( $attribute_taxonomy->attribute_public ) {
									$values[] = '<a href="' . esc_url( get_term_link( $attribute_value->term_id, $attribute->get_name() ) ) . '" rel="tag">' . $value_name . '</a>';
								} else {
									$values[] = $value_name;
								}
							}
						endif;

						echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );
						?>
                    </li>
				<?php endforeach; ?>
            </ul>
            <div class="pb-30 pb-xl-60"></div>
		<?php endif;
		if ( $product->has_weight() || $product->has_dimensions() || ! empty( $general ) ):?>
            <h4 class="attribute-heading"><?php esc_html_e( 'General', 'rovoko' ) ?></h4>
            <ul>
				<?php if ( $product->has_weight() ) : ?>
                    <li>
                        <strong><?php _e( 'Weight', 'rovoko' ) ?></strong>
                        <span class="product_weight"><?php echo esc_html( wc_format_weight( $product->get_weight() ) ); ?></span>
                    </li>
				<?php endif; ?>

				<?php if ( $product->has_dimensions() ) : ?>
                    <li>
                        <strong><?php _e( 'Dimensions', 'rovoko' ) ?></strong>
                        <span class="product_dimensions"><?php echo esc_html( wc_format_dimensions( $product->get_dimensions( false ) ) ); ?></span>
                    </li>
				<?php endif;

				if ( ! empty( $general ) ) : ?>
					<?php foreach ( $general as $attribute ): ?>
                        <li>
                            <strong><?php echo wc_attribute_label( $attribute->get_name() ); ?></strong>
							<?php
							$values = array();
							if ( $attribute->is_taxonomy() ) :
								$attribute_taxonomy = $attribute->get_taxonomy_object();
								$attribute_values   = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );

								foreach ( $attribute_values as $attribute_value ) {
									$value_name = esc_html( $attribute_value->name );

									if ( $attribute_taxonomy->attribute_public ) {
										$values[] = '<a href="' . esc_url( get_term_link( $attribute_value->term_id, $attribute->get_name() ) ) . '" rel="tag">' . $value_name . '</a>';
									} else {
										$values[] = $value_name;
									}
								}
							else:
								$values = $attribute->get_options();
								foreach ( $values as &$value ) {
									$value = make_clickable( esc_html( $value ) );
								}
							endif;

							echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );
							?>
                        </li>
					<?php endforeach; ?>
				<?php endif; ?>
            </ul>
		<?php endif;
	}
}

if ( ! function_exists( 'rovoko_technical_attributes_array_filter_visible' ) ) {
	function rovoko_technical_attributes_array_filter_visible( $attribute ) {
		$type = wc_get_attribute( $attribute->get_id() );

		return $attribute && is_a( $attribute, 'WC_Product_Attribute' ) && $attribute->get_visible() && ( ! $attribute->is_taxonomy() || taxonomy_exists( $attribute->get_name() ) ) && ( ! empty( $type->type ) && $type->type == 'technical' );
	}
}
if ( ! function_exists( 'rovoko_general_attributes_array_filter_visible' ) ) {
	function rovoko_general_attributes_array_filter_visible( $attribute ) {
		$type = wc_get_attribute( $attribute->get_id() );

		return $attribute && is_a( $attribute, 'WC_Product_Attribute' ) && $attribute->get_visible() && ( ! $attribute->is_taxonomy() || taxonomy_exists( $attribute->get_name() ) ) && ( empty( $type->type ) || ( ! empty( $type->type ) && $type->type !== 'technical' ) );
	}
}
