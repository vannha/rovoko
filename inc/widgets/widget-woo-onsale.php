<?php
defined( 'ABSPATH' ) or exit( - 1 );
/**
 * Recent Posts widgets
 *
 * @package EF5 Theme
 * @version 1.0
 */

add_action( 'widgets_init', 'rovoko_woo_onsale' );
function rovoko_woo_onsale() {
	if ( class_exists( 'WooCommerce' ) ) {
		register_ef5_widget( 'Rovoko_Woo_OnSale' );
	}
}

class Rovoko_Woo_OnSale extends WP_Widget {
	function __construct() {
		parent::__construct(
			'rovoko_woo_onsale',
			esc_html__( '[Rovoko] Products On Sale', 'rovoko' ),
			array(
				'description'                 => esc_html__( 'Shows products is on sale.', 'rovoko' ),
				'customize_selective_refresh' => true,
			)
		);
	}

	/**
	 * Outputs the HTML for this widget.
	 *
	 * @param array $args An array of standard parameters for widgets in this theme
	 * @param array $instance An array of settings for this widget instance
	 *
	 * @return void Echoes it's output
	 **/
	function widget( $args, $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'title'        => esc_html__( 'Deal of the Month', 'rovoko' ),
			'post_to_show' => 3,
			'order_by'     => 'date',
			'order'        => 'asc',
		) );

		$title        = empty( $instance['title'] ) ? '' : $instance['title'];
		$title        = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$post_to_show = ! empty( $instance['post_to_show'] ) ? absint( $instance['post_to_show'] ) : 3;
		$orderby      = ! empty( $instance['order_by'] ) ? sanitize_title( $instance['order_by'] ) : 'date';
		$order        = ! empty( $instance['order'] ) ? sanitize_title( $instance['order'] ) : 'asc';
		$query_args   = array(
			'posts_per_page' => $post_to_show,
			'post_status'    => 'publish',
			'post_type'      => 'product',
			'no_found_rows'  => 1,
			'order'          => $order,
			'meta_query'     => array(
				'relation' => 'AND',
				array(
					'key'     => '_sale_price_dates_to',
					'value'   => '0',
					'compare' => '>'
				)
			),
			'post__in'       => wc_get_product_ids_on_sale(),
			'tax_query'      => array(
				'relation' => 'AND',
			),
		);
		switch ( $orderby ) {
			case 'price':
				$query_args['meta_key'] = '_price';
				$query_args['orderby']  = 'meta_value_num';
				break;
			case 'rand':
				$query_args['orderby'] = 'rand';
				break;
			case 'sales':
				$query_args['meta_key'] = 'total_sales';
				$query_args['orderby']  = 'meta_value_num';
				break;
			default:
				$query_args['orderby'] = 'date';
		}
		$gal_id   = 'rovoko-products-onsale';
		$rtl      = is_rtl() ? true : false;
		$products = new WP_Query( $query_args );
		if ( $products && $products->have_posts() ) :
			printf( '%s', $args['before_widget'] );
			printf( '%s', $args['before_title'] . $title . '<div class="ef5-owl-nav"></div>' . $args['after_title'] );
			wp_enqueue_script( 'owl-carousel' );
			wp_enqueue_script( 'ef5-owl-carousel' );
			wp_enqueue_style( 'owl-carousel' );
			wp_enqueue_style( 'ef5-owl-carousel' );
			wp_enqueue_script( 'countdown' );
			wp_enqueue_script( 'ef5-countdown' );
			global $ef5_owl;
			$ef5_owl[ $gal_id ] = [
				'rtl'        => $rtl,
				'margin'     => 0,
				'nav'        => true,
				'navClass'   => [ 'ef5-owl-nav-button ef5-owl-prev', 'ef5-owl-nav-button ef5-owl-next' ],
				'navText'    => [
					'<span class="flaticon-back" data-title="' . esc_attr__( 'Previous', 'rovoko' ) . '"></span>',
					'<span class="flaticon-next" data-title="' . esc_attr__( 'Next', 'rovoko' ) . '"></span>'
				],
				'autoHeight' => true,
				'dots'       => false,
				'items'      => 1,
				'responsive' => array(

					768 => array(
						'items' => 2
					),
					992 => array(
						'items' => 1
					),

				)

			];
			wp_localize_script( 'owl-carousel', 'ef5systems_owl', $ef5_owl );
			echo '<div class="products ef5-owl owl-carousel owl-theme" id="rovoko-products-onsale">';
			while ( $products->have_posts() ) :
				$products->the_post();
				$this->product_item();
			endwhile;
			echo '</div>';
			printf( '%s', $args['after_widget'] );
		endif;
		wp_reset_postdata();
	}

	protected function product_item() {
		global $product;
		?>
        <div class="product">
            <div class="ef5-loop-atts row justify-content-end">
				<?php
				if ( $product->get_type() == 'variable' ) {
					$regular_price = $product->get_variation_regular_price( 'max' );
					$sales_price   = $product->get_variation_sale_price( 'max' );
				} else {
					$regular_price = $product->get_regular_price();
					$sales_price   = $product->get_sale_price();
				}
				if ( isset( $regular_price ) && $regular_price > 0 && isset( $sales_price ) ) :
					$percentage = round( ( ( $regular_price - $sales_price ) / $regular_price ) * 100 );
					printf( '<span class="ef5-badge ef5-corner-ribbon sale bg-accent text-xxsmall">- %s </span>', $percentage . '%' );
				endif;
				?>
            </div>

            <a href="<?php echo esc_url( $product->get_permalink() ); ?>">
				<?php echo rovoko_html( $product->get_image() ); ?>
            </a>
            <div class="product-meta">
				<?php woocommerce_template_loop_product_title(); ?>
				<?php rovoko_woocommerce_template_loop_price(); ?>
				<?php
				$sales_price_to = get_post_meta( $product->get_id(), '_sale_price_dates_to', true );
				$time_format    = '5';
				$time_label     = esc_html__( 'Years, Month, Week, Days, Hours, Mins, Secs', 'rovoko' );
				$gmt_offset     = get_option( 'gmt_offset' );
				?>
                <div class="ef5-countdown">
                    <div class="ef5-countdown-bar ef5-countdown-time"
                         data-count="<?php echo esc_attr( date( 'Y,m,d,H,i,s', $sales_price_to ) ); ?>"
                         data-format="<?php echo esc_attr( $time_format ); ?>"
                         data-label="<?php echo esc_attr( $time_label ); ?>"
                         data-timezone="<?php echo esc_attr( $gmt_offset ); ?>">
                    </div>
                </div>
				<?php if ( $product->managing_stock() ) :
					$quantity = $product->get_stock_quantity();
					$total_sale = $product->get_total_sales();
					if ( $quantity != 0 ) :
						$progress = (int) ( $total_sale * 100 ) / ( $quantity + $total_sale );
						?>
                        <div class="inventory d-flex justify-content-between ml--15 mr--15">
							<?php printf( ' <span class="stock">%1$s<span>%2$s</span></span>', esc_html__( 'Available:', 'rovoko' ), esc_html( $quantity ) ); ?>
							<?php printf( ' <span class="available">%1$s<span>%2$s</span></span>', esc_html__( 'Sold:', 'rovoko' ), esc_html( $total_sale ) ); ?>
                        </div>
                        <div class="progress ml--15 mr--15">
                            <div class="progress-bar" role="progressbar"
                                 style="width:<?php echo esc_attr( $progress ); ?>%"
                                 aria-valuenow="<?php echo esc_attr( $progress ); ?>"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
					<?php endif; ?>
				<?php endif; ?>
				<?php //var_dump(  ); ?>
            </div>
        </div>
		<?php
	}

	/**
	 * Deals with the settings when they are saved by the admin. Here is
	 * where any validation should be dealt with.
	 *
	 * @param array $new_instance An array of new settings as submitted by the admin
	 * @param array $old_instance An array of the previous settings
	 *
	 * @return array The validated and (if necessary) amended settings
	 **/
	function update( $new_instance, $old_instance ) {
		$instance                 = $old_instance;
		$instance['title']        = sanitize_text_field( $new_instance['title'] );
		$instance['post_to_show'] = absint( $new_instance['post_to_show'] );
		$instance['order_by']     = sanitize_text_field( $new_instance['order_by'] );
		$instance['order']        = sanitize_text_field( $new_instance['order'] );

		return $instance;
	}

	/**
	 * Displays the form for this widget on the Widgets page of the WP Admin area.
	 *
	 * @param array $instance An array of the current settings for this widget
	 *
	 * @return void Echoes it's output
	 **/
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'title'        => esc_html__( 'Deal of the Month', 'rovoko' ),
			'post_to_show' => 3,
			'order_by'     => 'date',
			'order'        => 'asc',
		) );

		$title        = $instance['title'] ? esc_attr( $instance['title'] ) : '';
		$post_to_show = absint( $instance['post_to_show'] );
		$order_by     = $instance['order_by'] ? esc_attr( $instance['order_by'] ) : '';
		$order        = $instance['order'] ? esc_attr( $instance['order'] ) : '';

		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'rovoko' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
                   value="<?php echo esc_attr( $title ); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'post_to_show' ) ); ?>"><?php esc_html_e( 'Number of product to show:', 'rovoko' ); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'post_to_show' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'post_to_show' ) ); ?>" type="number" step="1"
                   min="1"
                   value="<?php echo esc_attr( $post_to_show ); ?>" size="3"/>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>"><?php esc_html_e( 'Order by', 'rovoko' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>"
                    name="<?php echo esc_attr( $this->get_field_name( 'order_by' ) ); ?>">
                <option value="date" <?php selected( $order_by, 'date' ) ?>><?php esc_html_e( 'Date', 'rovoko' ) ?></option>
                <option value="price" <?php selected( $order_by, 'price' ) ?>><?php esc_html_e( 'Price', 'rovoko' ) ?></option>
                <option value="rand" <?php selected( $order_by, 'rand' ) ?>><?php esc_html_e( 'Random', 'rovoko' ) ?></option>
                <option value="sales" <?php selected( $order_by, 'sales' ) ?>><?php esc_html_e( 'Sales', 'rovoko' ) ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Order', 'rovoko' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"
                    name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>">
                <option value="asc" <?php selected( $order, 'asc', true ) ?>><?php esc_html_e( 'ASC', 'rovoko' ) ?></option>
                <option value="desc" <?php selected( $order, 'desc', true ) ?>><?php esc_html_e( 'DESC', 'rovoko' ) ?></option>
            </select>
        </p>

		<?php
	}
}