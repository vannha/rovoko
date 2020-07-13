<?php
/**
 * Project Grid Module
 */

namespace Elementor;
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Rovoko_Product_Grid extends Widget_Base {
	public function get_name() {
		return 'rovoko_product_grid';
	}

	public function get_title() {
		return esc_html__( '[Rovoko] Product Grid', 'rovoko' );
	}

	public function get_icon() {
		return 'rovoko-icon eicon-products';
	}

	public function get_categories() {
		return [ 'rovoko-elements' ];
	}

	public function get_script_depends() {
		return [ 'imagesloaded', 'isotope', 'rovoko-product-grid' ];
	}

	public function get_keywords() {
		return [ 'rovoko', 'product', 'woocommerce', 'masonry', 'grid' ];
	}

	protected function _register_controls() {
		/**************** Start Content Control Tab ****************/
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Product Grid', 'rovoko' ),
				'tab'   => 'content',
			]
		);
		$this->add_responsive_control(
			'columns',
			[
				'label'          => esc_html__( 'Grid Columns', 'rovoko' ),
				'type'           => 'select',
				'default'        => '4',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options'        => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
				'selectors'      => [
					'{{WRAPPER}} .rovoko-product-wrapper .product' => 'flex: 0 0 calc(100% / {{VALUE}});max-width:calc(100% / {{VALUE}});',
				],
			]
		);
		$this->add_control(
			'count',
			[
				'label'       => esc_html__( 'Posts Per Page', 'rovoko' ),
				'description' => esc_html__( 'You can enter "-1" to display all posts.', 'rovoko' ),
				'type'        => 'text',
				'default'     => '8',
			]
		);
		$this->add_control(
			'orderby',
			[
				'label'   => esc_html__( 'Order By', 'rovoko' ),
				'type'    => 'select',
				'default' => 'none',
				'options' => [
					'none'       => esc_html__( 'Default', 'rovoko' ),
					'date'       => esc_html__( 'Date', 'rovoko' ),
					'title'      => esc_html__( 'Title', 'rovoko' ),
					'name'       => esc_html__( 'Slug', 'rovoko' ),
					'modified'   => esc_html__( 'Modified', 'rovoko' ),
					'author'     => esc_html__( 'Author', 'rovoko' ),
					'rand'       => esc_html__( 'Random', 'rovoko' ),
					'ID'         => esc_html__( 'ID', 'rovoko' ),
					'menu_order' => esc_html__( 'Menu Order', 'rovoko' ),
				],
			]
		);
		$this->add_control(
			'order',
			[
				'label'   => esc_html__( 'Order', 'rovoko' ),
				'type'    => 'select',
				'default' => 'ASC',
				'options' => [
					'ASC'  => esc_html__( 'ASC', 'rovoko' ),
					'DESC' => esc_html__( 'DESC', 'rovoko' ),
				],
			]
		);
		$this->add_control(
			'include_cat',
			[
				'label'       => esc_html__( 'Include Categories', 'rovoko' ),
				'type'        => 'select2',
				'label_block' => true,
				'multiple'    => true,
				'options'     => $this->rovoko_get_taxo_array()
			]
		);
		$this->add_control(
			'exclude_cat',
			[
				'label'       => esc_html__( 'Exclude Categories', 'rovoko' ),
				'type'        => 'select2',
				'label_block' => true,
				'multiple'    => true,
				'options'     => $this->rovoko_get_taxo_array()
			]
		);
		$this->add_control(
			'masonry-filters',
			[
				'label'   => esc_html__( 'Filters and view all', 'rovoko' ),
				'type'    => 'switcher',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'all-filter-text',
			[
				'label'     => esc_html__( 'All Products text', 'rovoko' ),
				'type'      => 'text',
				'default'   => esc_html__( 'Onsale', 'rovoko' ),
				'condition' => [
					'masonry-filters' => 'yes',
				],
			]
		);
		$this->add_control(
			'featured-filter-text',
			[
				'label'     => esc_html__( 'Featured text', 'rovoko' ),
				'type'      => 'text',
				'default'   => esc_html__( 'Most Popular', 'rovoko' ),
				'condition' => [
					'masonry-filters' => 'yes',
				],
			]
		);
		$this->add_control(
			'rate-filter-text',
			[
				'label'     => esc_html__( 'Best Rate text', 'rovoko' ),
				'type'      => 'text',
				'default'   => esc_html__( 'Best Rate', 'rovoko' ),
				'condition' => [
					'masonry-filters' => 'yes',
				],
			]
		);
		$this->add_control(
			'new-filter-text',
			[
				'label'     => esc_html__( 'New Products text', 'rovoko' ),
				'type'      => 'text',
				'default'   => esc_html__( 'New Arrivals', 'rovoko' ),
				'condition' => [
					'masonry-filters' => 'yes',
				],
			]
		);
		$this->add_control(
			'view-all-text',
			[
				'label'     => esc_html__( 'View All Products', 'rovoko' ),
				'type'      => 'text',
				'default'   => esc_html__( 'View All Products', 'rovoko' ),
				'separator' => 'before',
				'condition' => [
					'masonry-filters' => 'yes',
				],
			]
		);
		$this->add_control(
			'view_all',
			[
				'label'     => esc_html__( 'Load More ', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'view_all_btn',
			[
				'label'   => esc_html__( 'Display Load More', 'rovoko' ),
				'type'    => 'switcher',
				'default' => 'no',
			]
		);
		$this->add_control(
			'btn_style',
			[
				'label'     => esc_html__( 'Button type', 'rovoko' ),
				'type'      => 'select',
				'options'   => [
					'fill'    => esc_html__( 'Fill', 'rovoko' ),
					'outline' => esc_html__( 'Outline', 'rovoko' ),
				],
				'default'   => 'fill',
				'condition' => [
					'view_all_btn' => 'yes',
				],
			]
		);
		$this->add_control(
			'view_all_text',
			[
				'label'     => esc_html__( 'Button text', 'rovoko' ),
				'type'      => 'text',
				'default'   => esc_html__( 'Load More', 'rovoko' ),
				'condition' => [
					'view_all_btn' => 'yes',
				],
			]
		);
		$this->add_control(
			'btn-css',
			[
				'label'     => esc_html__( 'CSS Classes', 'rovoko' ),
				'type'      => 'text',
				'title'     => esc_html__( 'Add your custom class WITHOUT the dot. e.g: my-class', 'rovoko' ),
				'condition' => [
					'view_all_btn' => 'yes',
				],
			]
		);
		$this->end_controls_section();
		/**************** Start Style Control Tab ****************/
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'rovoko' ),
				'tab'   => 'style',
			]
		);
		/*-- Filters --*/
		$this->add_control(
			'filter_style',
			[
				'label'     => esc_html__( 'Filters', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before',
				'condition' => [
					'masonry-filters' => 'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'filter_typography',
				'selector'  => '{{WRAPPER}} .ef5-filters .filter-item',
				'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
				'condition' => [
					'masonry-filters' => 'yes',
				],
			]
		);
		$this->add_control(
			'filter-color',
			[
				'label'     => esc_html__( 'Item Color', 'rovoko' ),
				'type'      => 'color',
				'selectors' => [
					'{{WRAPPER}} .ef5-filters .filter-item' => 'color: {{VALUE}};',
				],
				'condition' => [
					'masonry-filters' => 'yes',
				],
			]
		);
		$this->add_control(
			'filter-active-color',
			[
				'label'     => esc_html__( 'Active Color', 'rovoko' ),
				'type'      => 'color',
				'selectors' => [
					'{{WRAPPER}} .ef5-filters .filter-item.active' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ef5-filters .filter-item:after'  => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'masonry-filters' => 'yes',
				],
			]
		);
		$this->add_control(
			'view-all-color',
			[
				'label'     => esc_html__( 'View All Color', 'rovoko' ),
				'type'      => 'color',
				'selectors' => [
					'{{WRAPPER}} .ef5-filters .view-all a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ef5-filters .view-all a' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'masonry-filters' => 'yes',
				],
			]
		);
		/*--Title--*/
		$this->add_control(
			'title_style',
			[
				'label'     => esc_html__( 'Title', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before',
				'condition' => [
					'title' => 'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'title_typography',
				'selector'  => '{{WRAPPER}} .rovoko-product-wrapper .ef5-heading',
				'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
				'condition' => [
					'title' => 'yes',
				],
			]
		);
		/*** Start Tabs Wrap ***/
		$this->start_controls_tabs( 'tabs_title_style', [ 'condition' => [ 'title' => 'yes' ] ] );
		$this->start_controls_tab(
			'title-nomal-tab',
			[
				'label' => esc_html__( 'Normal', 'rovoko' ),
			]
		);
		$this->add_control(
			'title-color',
			[
				'label'     => esc_html__( 'Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-product-wrapper .ef5-heading' => 'color: {{VALUE}};',
				],
				'condition' => [
					'title' => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'title-hover-tab',
			[
				'label' => esc_html__( 'Hover', 'rovoko' ),
			]
		);
		$this->add_control(
			'title-color-hover',
			[
				'label'     => esc_html__( 'Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-product-wrapper .ef5-heading:hover a' => 'color: {{VALUE}};',
				],
				'condition' => [
					'title' => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		/*** End Tabs Wrap ***/
		/*-- Tag --*/
		$this->add_control(
			'tag_style',
			[
				'label'     => esc_html__( 'Tag', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before',
				'condition' => [
					'tag' => 'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'tag_typography',
				'selector'  => '{{WRAPPER}} .rovoko-product-wrapper .ef5-tagged-in',
				'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
				'condition' => [
					'tag' => 'yes',
				],
			]
		);
		/*** Start Tabs Wrap ***/
		$this->start_controls_tabs( 'tabs_tag_style', [ 'condition' => [ 'tag' => 'yes' ] ] );
		$this->start_controls_tab(
			'tag-nomal-tab',
			[
				'label' => esc_html__( 'Normal', 'rovoko' ),
			]
		);
		$this->add_control(
			'tag-color',
			[
				'label'     => esc_html__( 'Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-product-wrapper .ef5-tagged-in' => 'color: {{VALUE}};',
				]
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tag-hover-tab',
			[
				'label' => esc_html__( 'Hover', 'rovoko' ),
			]
		);
		$this->add_control(
			'tag-color-hover',
			[
				'label'     => esc_html__( 'Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-product-wrapper .ef5-tagged-in a:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		/*** End Tabs Wrap ***/
		/*-- View All --*/
		$this->add_control(
			'viewall_style',
			[
				'label'     => esc_html__( 'View All Button', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before',
				'condition' => [
					'view_all_btn' => 'yes',
				],
			]
		);
		$this->add_control(
			'viewall_align',
			[
				'label'     => esc_html__( 'Alignment', 'rovoko' ),
				'type'      => 'choose',
				'default'   => 'center',
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'rovoko' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'rovoko' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'rovoko' ),
						'icon'  => 'eicon-text-align-right',
					]
				],
				'condition' => [
					'view_all_btn' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .rovoko-product-wrapper .view-all-btn' => 'text-align: {{VALUE}};',
				],

			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'viewall_typography',
				'selector'  => '{{WRAPPER}} .rovoko-product-wrapper .view-all-btn a',
				'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
				'condition' => [
					'view_all_btn' => 'yes',
				],
			]
		);
		/*** Start Tabs Wrap ***/
		$this->start_controls_tabs( 'tabs_viewall_style', [ 'condition' => [ 'view_all_btn' => 'yes' ] ] );
		$this->start_controls_tab(
			'viewall-nomal-tab',
			[
				'label' => esc_html__( 'Normal', 'rovoko' ),
			]
		);
		$this->add_control(
			'viewall-bg',
			[
				'label'     => esc_html__( 'Background Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .rovoko-product-wrapper .view-all-btn a' => 'background-color: {{VALUE}};' ],
				'condition' => [ 'btn_style' => 'fill' ]
			]
		);
		$this->add_control(
			'viewall-border',
			[
				'label'     => esc_html__( 'Border Color', 'rovoko' ),
				'type'      => 'color',
				'selectors' => [ '{{WRAPPER}} .rovoko-product-wrapper .view-all-btn a.outline' => 'border-color: {{VALUE}};' ],
				'condition' => [ 'btn_style' => 'outline' ]
			]
		);

		$this->add_control(
			'viewall-color',
			[
				'label'     => esc_html__( 'Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .rovoko-product-wrapper .view-all-btn a' => 'color: {{VALUE}};' ]
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'viewall-hover-tab',
			[
				'label' => esc_html__( 'Hover', 'rovoko' ),
			]
		);
		$this->add_control(
			'viewall-hover-border',
			[
				'label'     => esc_html__( 'Border Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-product-wrapper .view-all-btn a.outline:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 'btn_style' => 'outline' ]
			]
		);
		$this->add_control(
			'viewall-hover-bg',
			[
				'label'     => esc_html__( 'Background Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-product-wrapper .view-all-btn a:hover' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'viewall-color-hover',
			[
				'label'     => esc_html__( 'Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-product-wrapper .view-all-btn a:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		/*** End Tabs Wrap ***/
		$this->end_controls_section();

	}

	protected function rovoko_get_taxo_array( $only_slug = false ) {
		$array = $slug = [];
		$terms = get_terms( array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => true,
		) );
		if ( ! empty( $terms ) ) {
			foreach ( $terms as $term ) {
				$array[ $term->slug ] = $term->name;
				$slug[]               = $term->slug;
			}
		}
		if ( $only_slug ) {
			return $slug;
		} else {
			return $array;
		}
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		global $wp_query;
		$args = $this->rovoko_product_query( $settings );
		// Masonry
		$originLeft   = is_rtl() ? 'false' : 'true';
		$masonry_opts = array(
			'itemSelector'    => '.ef5-masonry-item',
			'columnWidth'     => '.ef5-masonry-sizer',
			'gutter'          => '.ef5-masonry-gutter',
			'percentPosition' => true,
			'horizontalOrder' => true,
			'layoutMode'      => 'fitRows'

		);
		$products     = $wp_query = new \WP_Query( $args );
		$this->add_render_attribute( [
			'wrapper'  => [
				'class' => array( 'rovoko-product-wrapper', 'ef5-posts' ),
				'id'    => 'products-' . $this->get_id(),
			],
			'products' => [
				'class'           => [
					'products',
					'columns-' . $settings['columns'],
					'ef5-posts-masonry',
					'ef5-masonry'
				],
				'data-masonry'    => json_encode( $masonry_opts ),
				'data-originleft' => $originLeft
			]
		] );
		if ( $products->have_posts() ) :?>
            <div <?php echo '' . $this->get_render_attribute_string( 'wrapper' ); ?>>
				<?php $this->rovoko_product_masonry_filters( $settings ); ?>
                <div <?php echo '' . $this->get_render_attribute_string( 'products' ); ?>>
                    <div class="ef5-masonry-sizer"></div>
                    <div class="ef5-masonry-gutter"></div>
					<?php while ( $products->have_posts() ) :
						$products->the_post();
						$class = $this->rovoko_product_check_class_item( $settings, get_the_ID() );
						?>
                        <div class="product type-product <?php echo trim( implode( ' ', $class ) ); ?> ">
							<?php
							do_action( 'woocommerce_before_shop_loop_item' );
							do_action( 'woocommerce_before_shop_loop_item_title' );
							do_action( 'woocommerce_shop_loop_item_title' );
							do_action( 'woocommerce_after_shop_loop_item_title' );
							do_action( 'woocommerce_after_shop_loop_item' );
							?>
                        </div>
					<?php
					endwhile;
					?>
                </div>
				<?php
				$this->rovoko_view_all_products( $settings );
				wp_reset_query(); ?>
            </div>
		<?php
		endif;
	}

	private function rovoko_product_query( $settings = [] ) {
		global $paged;
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
		$args = array(
			'post_type'      => 'product',
			'post_status'    => 'publish',
			'posts_per_page' => $settings['count'],
			'order'          => $settings['order'],
			'orderby'        => $settings['orderby'],
			'paged'          => $paged,
		);
		if ( ! Utils::is_empty( $settings['include_cat'] ) || ! Utils::is_empty( $settings['exclude_cat'] ) ) {
			$args['tax_query'] = array( 'relation' => 'AND' );
			if ( ! Utils::is_empty( $settings['include_cat'] ) ) {
				$args['tax_query'][] = array(
					'taxonomy'         => 'product_cat',
					'field'            => 'slug',
					'terms'            => $settings['include_cat'],
					'include_children' => false,
					'operator'         => 'IN'
				);
			}
			if ( ! Utils::is_empty( $settings['exclude_cat'] ) ) {
				$args['tax_query'][] = array(
					'taxonomy'         => 'product_cat',
					'field'            => 'slug',
					'terms'            => $settings['exclude_cat'],
					'include_children' => false,
					'operator'         => 'NOT IN'
				);
			}
		}

		return $args;
	}

	private function rovoko_product_masonry_filters( $settings ) {
		if ( ! Utils::is_empty( $settings['masonry-filters'] ) && $settings['masonry-filters'] == 'yes' ) :
			?>
            <div class="ef5-filters ef5-masonry-filters d-flex justify-content-between mb-xl-45">
                <div class="filters">
                    <div class="filter-item active" data-filter="*">
                        <span><?php echo ! Utils::is_empty( $settings['all-filter-text'] ) ? $settings['all-filter-text'] : esc_html__( 'Onsale', 'rovoko' ); ?></span>
                    </div>
                    <div class="filter-item" data-filter=".fl-featured">
                        <span><?php echo ! Utils::is_empty( $settings['featured-filter-text'] ) ? $settings['featured-filter-text'] : esc_html__( 'Most Popular', 'rovoko' ); ?></span>
                    </div>
                    <div class="filter-item" data-filter=".fl-best-rate">
                        <span><?php echo ! Utils::is_empty( $settings['rate-filter-text'] ) ? $settings['rate-filter-text'] : esc_html__( 'Best Rate', 'rovoko' ); ?></span>
                    </div>
                    <div class="filter-item" data-filter=".fl-new">
                        <span><?php echo ! Utils::is_empty( $settings['new-filter-text'] ) ? $settings['new-filter-text'] : esc_html__( 'New Arrivals', 'rovoko' ); ?></span>
                    </div>
                </div>
                <div class="view-all">
                    <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><?php echo ! Utils::is_empty( $settings['view-all-text'] ) ? $settings['view-all-text'] : esc_html__( 'View All Products', 'rovoko' ); ?></a>
                </div>
            </div>
		<?php endif;
	}

	private function rovoko_product_check_class_item( $settings, $id ) {
		$class = [ 'ef5-masonry-item', 'ef5-grid-item', 'fade-in' ];
		if ( ! Utils::is_empty( $settings['masonry-filters'] ) && $settings['masonry-filters'] == 'yes' ) :
			$featured = wc_get_featured_product_ids();
			$rating   = get_post_meta( $id, '_wc_average_rating', true );
			if ( in_array( $id, $featured ) ) {
				$class[] = 'fl-featured';
			}
			if ( $rating != '0' ) {
				$class[] = 'fl-best-rate';
			}
			$pa_badge = wc_get_product_terms( $id, 'pa_badge' );
			if ( ! is_wp_error( $pa_badge ) && $pa_badge !== false ) {
				$count = count( $pa_badge );
			} else {
				$count = 0;
			}
			if ( is_array( $pa_badge ) && $count > 0 ) {
				foreach ( $pa_badge as $term ) {
					if ( $term->slug == 'new' ) {
						$class[] = 'fl-new';
					}
				}
			}
		endif;

		return $class;
	}

	private function rovoko_view_all_products( $settings = array() ) {
		$this->add_render_attribute( 'view-all', 'class', array( 'ef5-btn', 'primary', 'boxshadow' ) );
		$this->add_render_attribute( 'btn-wrapper', 'class', array( 'view-all-btn' ) );
		if ( ! Utils::is_empty( $settings['btn-css'] ) ) {
			$this->add_render_attribute( 'btn-wrapper', 'class', trim( $settings['btn-css'] ) );
		}
		if ( ! Utils::is_empty( $settings['view_all_btn'] ) && $settings['view_all_btn'] == 'yes' ) :
			$view_all_text = ! Utils::is_empty( $settings['view_all_text'] ) ? $settings['view_all_text'] : esc_html__( 'View All Products', 'rovoko' );
			if ( ! Utils::is_empty( $settings['btn_style'] ) ) :
				$this->add_render_attribute( 'view-all', 'class', $settings['btn_style'] );
			endif;
			$this->add_render_attribute( 'view-all', 'href', get_next_posts_page_link() );
			if ( ! empty( get_next_posts_link() ) ): ?>
                <div <?php echo '' . $this->get_render_attribute_string( 'btn-wrapper' ); ?>>
					<?php printf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'view-all' ), $view_all_text ); ?>
                </div>
			<?php endif;
		endif;
	}
}

if ( class_exists( 'WooCommerce' ) ) {
	Plugin::instance()->widgets_manager->register_widget_type( new Rovoko_Product_Grid() );
}