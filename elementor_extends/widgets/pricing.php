<?php
/**
 * Alert Module
 */

namespace Elementor;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Rovoko_Pricing_Widget extends Widget_Base {

	public function get_name() {
		return 'rovoko_pricing';
	}

	public function get_title() {
		return esc_html__( '[Rovoko] Pricing', 'rovoko' );
	}

	public function get_icon() {
		return 'rovoko-icon eicon-price-table';
	}

	public function get_categories() {
		return [ 'rovoko-elements' ];
	}

	public function get_script_depends() {
		return [ 'imagesloaded' ];
	}

	public function get_keywords() {
		return [ 'rovoko', 'pricing', 'price' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'rovoko' ),
				'tab'   => 'content',
			]
		);
		$this->add_control(
			'is-active',
			[
				'label'   => esc_html__( 'Is Active?', 'rovoko' ),
				'type'    => 'switcher',
				'default' => 'no',
			]
		);
		$this->add_control(
			'title',
			[
				'label'   => esc_html__( 'Title', 'rovoko' ),
				'type'    => 'text',
				'default' => esc_html__( '$150', 'rovoko' ),
			]
		);
		$this->add_control(
			'subtitle',
			[
				'label'   => esc_html__( 'Sub Title', 'rovoko' ),
				'type'    => 'text',
				'default' => esc_html__( 'First Month Free', 'rovoko' ),
			]
		);
		$this->add_control(
			'badges',
			[
				'label'   => esc_html__( 'Badges Text', 'rovoko' ),
				'type'    => 'text',
				'default' => esc_html__( 'Free', 'rovoko' ),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'name',
			[
				'label' => esc_html__( 'Feature Name', 'rovoko' ),
				'type'  => 'text',
			]
		);
		$repeater->add_control(
			'description',
			[
				'label'      => esc_html__( 'Feature Description', 'rovoko' ),
				'type'       => 'textarea',
				'show_label' => true
			]
		);
		$repeater->add_control(
			'featuring',
			[
				'label'     => esc_html__( 'Featuring', 'rovoko' ),
				'type'      => 'switcher',
				'label_on'  => esc_html__( 'Icon ', 'rovoko' ),
				'label_off' => esc_html__( 'Num ', 'rovoko' ),
			]
		);
		$repeater->add_control(
			'featuring-icon',
			[
				'label'     => esc_html__( 'Icon', 'rovoko' ),
				'type'      => 'switcher',
				'default'   => 'yes',
				'condition' => [
					'featuring' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'featuring-num',
			[
				'label'     => esc_html__( 'Number', 'rovoko' ),
				'type'      => 'slider',
				'default'   => [
					'unit' => 'px',
					'size' => 1,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 99,
					],
				],
				'condition' => [
					'featuring!' => 'yes',
				],
			]
		);
		$this->add_control(
			'pricing',
			[
				'label'       => esc_html__( 'Features', 'rovoko' ),
				'type'        => 'repeater',
				'fields'      => $repeater->get_controls(),
				'default'     => $this->get_repeater_defaults(),
				'title_field' => '{{{ name }}}',
				'separator'   => 'before'
			]
		);
		/*--Button--*/
		$this->add_control(
			'btn-heading',
			[
				'label'     => esc_html__( 'Button', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before'
			]
		);
		$this->add_control(
			'btn-text',
			[
				'label'   => esc_html__( 'Button Text', 'rovoko' ),
				'type'    => 'text',
				'default' => esc_html__( 'All Products', 'rovoko' ),
			]
		);
		$this->add_control(
			'btn-link',
			[
				'label' => esc_html__( 'Link', 'rovoko' ),
				'type'  => 'url',
			]
		);
		$this->end_controls_section();
		/**************** Start Style Control Tab ****************/
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Pricing Table Style', 'rovoko' ),
				'tab'   => 'style',
			]
		);
		/*--Table header--*/
		$this->add_control(
			'table-header-style',
			[
				'label' => esc_html__( 'Table Header', 'rovoko' ),
				'type'  => 'heading',
			]
		);
		$this->add_control(
			'table-header-bgcolor',
			[
				'label'     => esc_html__( 'Background Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-pricing .group-heading' => 'background-color: {{VALUE}}; border-color: {{VALUE}};'
				]
			]
		);
		/*--Title--*/
		$this->add_control(
			'table-header-title-color',
			[
				'label'     => esc_html__( 'Title Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-pricing .group-heading .title' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__( 'Title Typography', 'rovoko' ),
				'name'     => 'table-header-title-typography',
				'selector' => '{{WRAPPER}} .rovoko-pricing .group-heading .title',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			]
		);
		/*--Sub Title--*/
		$this->add_control(
			'table-subheader-title-color',
			[
				'label'     => esc_html__( 'Sub Title Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-pricing .group-heading .subtitle' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__( 'Sub Title Typography', 'rovoko' ),
				'name'     => 'table-subheader-title-typography',
				'selector' => '{{WRAPPER}} .rovoko-pricing .group-heading .subtitle',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			]
		);
		/*--Badges--*/
		$this->add_control(
			'table-badges-bgcolor',
			[
				'label'     => esc_html__( 'Badges Background Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-pricing .group-heading .badges' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'table-badges-color',
			[
				'label'     => esc_html__( 'Badges Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-pricing .group-heading .badges' => 'color: {{VALUE}};',
				]
			]
		);
		/*--Table header--*/
		$this->add_control(
			'table-content-style',
			[
				'label'     => esc_html__( 'Table Content', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before'
			]
		);
		$this->add_control(
			'table-content-bgcolor',
			[
				'label'     => esc_html__( 'Background Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-pricing .pricing-content' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'table-border-color',
			[
				'label'     => esc_html__( 'Border Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-pricing .pricing-content' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'is-active' => 'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__( 'Table Content Typography', 'rovoko' ),
				'name'     => 'table-content-typography',
				'selector' => '{{WRAPPER}} .rovoko-pricing .pricing-content .pricing-name',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			]
		);
		$this->add_control(
			'table-icon-bgcolor',
			[
				'label'     => esc_html__( 'Icon Background Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-pricing .pricing-content .pricing-icon' => 'background-color: {{VALUE}}; border-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'table-icon-color',
			[
				'label'     => esc_html__( 'Icon Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-pricing .pricing-content .pricing-icon .text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rovoko-pricing .pricing-content .pricing-icon .icon' => 'color: {{VALUE}};'
				]
			]
		);
		/*-- View All --*/
		$this->add_control(
			'viewall_style',
			[
				'label'     => esc_html__( 'View All Button', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'viewall_typography',
				'selector'  => '{{WRAPPER}} .rovoko-pricing .pricing-content .view-all-btn a',
				'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
			]
		);
		/*** Start Tabs Wrap ***/
		$this->start_controls_tabs( 'tabs_viewall_style' );
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
				'selectors' => [ '{{WRAPPER}} .rovoko-pricing .pricing-content .view-all-btn a' => 'background-color: {{VALUE}};' ],
			]
		);

		$this->add_control(
			'viewall-color',
			[
				'label'     => esc_html__( 'Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .rovoko-pricing .pricing-content .view-all-btn a' => 'color: {{VALUE}};' ]
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
			'viewall-hover-bg',
			[
				'label'     => esc_html__( 'Background Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-pricing .pricing-content .view-all-btn a:hover' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .rovoko-pricing .pricing-content .view-all-btn a:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		/*** End Tabs Wrap ***/
		$this->end_controls_section();
	}

	protected function get_repeater_defaults() {
		return [
			[
				'name'           => esc_html__( 'Feature 01', 'rovoko' ),
				'description'    => esc_html__( 'Feature Feature Description 01', 'rovoko' ),
				'featuring'      => 'yes',
				'featuring-icon' => 'yes'
			],
			[
				'name'           => esc_html__( 'Feature 02', 'rovoko' ),
				'description'    => esc_html__( 'Feature Feature Description 02', 'rovoko' ),
				'featuring'      => 'yes',
				'featuring-icon' => ''

			],
			[
				'name'          => esc_html__( 'Feature 03', 'rovoko' ),
				'description'   => esc_html__( 'Feature Feature Description 03', 'rovoko' ),
				'featuring'     => '',
				'featuring-num' => [
					'unit' => 'px',
					'size' => 01
				]
			],
		];
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute( [
			'wrapper' => [
				'class' => [ 'rovoko-pricing', ! Utils::is_empty( $settings['is-active'] ) ? 'active' : '' ]
			],
			'heading' => [
				'class' => [ 'group-heading' ]
			],
			'pricing' => [
				'class' => [ 'pricing-content' ],
			],
			'item'    => [
				'class' => [ 'item' ],
			],
			'btn'     => [
				'class' => [ 'ef5-btn', 'primary', 'fill' ]
			]
		] );
		$view_all_text = ! Utils::is_empty( $settings['btn-text'] ) ? $settings['btn-text'] : esc_html__( 'All Products', 'rovoko' );
		if ( ! empty( $settings['btn-link']['url'] ) ) :
			$this->add_link_attributes( 'btn', $settings['btn-link'], true );
		endif;
		?>
        <div <?php echo '' . $this->get_render_attribute_string( 'wrapper' ); ?>>
			<?php if ( ! Utils::is_empty( $settings['badges'] ) || ! Utils::is_empty( $settings['title'] ) || ! Utils::is_empty( $settings['subtitle'] ) ): ?>
                <div <?php echo '' . $this->get_render_attribute_string( 'heading' ); ?>>
					<?php
					if ( ! Utils::is_empty( $settings['badges'] ) ) :
						printf( '<div class="badges"><span>%1$s</span></div>', $settings['badges'] );
					endif;
					if ( ! Utils::is_empty( $settings['title'] ) ) :
						$this->add_inline_editing_attributes( 'title', 'none' );
						$this->add_render_attribute( 'title', 'class', 'title' );
						printf( '<div %1$s>%2$s</div>', $this->get_render_attribute_string( 'title' ), esc_html( $settings['title'] ) );
					endif;
					if ( ! Utils::is_empty( $settings['subtitle'] ) ) :
						$this->add_inline_editing_attributes( 'subtitle', 'none' );
						$this->add_render_attribute( 'subtitle', 'class', 'subtitle' );
						printf( '<p %1$s>%2$s</p>', $this->get_render_attribute_string( 'subtitle' ), esc_html( $settings['subtitle'] ) );
					endif;
					?>
                </div>
			<?php endif; ?>
            <ul <?php echo '' . $this->get_render_attribute_string( 'pricing' ); ?>>
				<?php foreach ( $settings['pricing'] as $pricing ): ?>
                    <li><?php $this->rovoko_pricing_items( $pricing ); ?></li>
				<?php endforeach; ?>
                <li class="view-all-btn">
					<?php printf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'btn' ), $view_all_text ); ?>
                </li>
            </ul>
        </div>
		<?php
	}

	private function rovoko_pricing_items( $pricing ) {
		$pricing['description'] = ! Utils::is_empty( $pricing['description'] ) ? $pricing['description'] : '';
		$hint                   = is_rtl() ? ' hint--right' : ' hint--left';
		if ( $pricing['featuring'] == 'yes' ):
			if ( $pricing['featuring-icon'] != 'yes' ):
				printf( '<span class="pricing-icon %1$s" data-hint="%2$s"> <i class="icon fal fa-times"></i></span>', $hint, $pricing['description'] );
			endif;
			if ( $pricing['featuring-icon'] == 'yes' ):
				printf( '<span class="pricing-icon %1$s" data-hint="%2$s"> <i class="icon fal fa-check"></i></span>', $hint, $pricing['description'] );
			endif;
		else:
			if ( isset( $pricing['featuring-num']['size'] ) ):
				printf( '<span class="pricing-icon %1$s" data-hint="%2$s"><span class="text">%3$s</span></span>', $hint, $pricing['description'], $pricing['featuring-num']['size'] );
			endif;
		endif;

		if ( ! Utils::is_empty( $pricing['name'] ) ):
			printf( '<span class="pricing-name">%1$s</span>', rovoko_html( $pricing['name'] ) );
		endif;
	}
}


Plugin::instance()->widgets_manager->register_widget_type( new Rovoko_Pricing_Widget() );