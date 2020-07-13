<?php
/**
 * Alert Module
 */

namespace Elementor;
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Rovoko_Fancy_Box_Widget extends Widget_Base {


	public function get_name() {
		return 'rovoko_fancybox';
	}

	public function get_title() {
		return esc_html__( '[Rovoko] Fancy Box', 'rovoko' );
	}

	public function get_icon() {
		return 'rovoko-icon eicon-table-of-contents';
	}

	public function get_categories() {
		return [ 'rovoko-elements' ];
	}

	public function get_script_depends() {
		return [ 'imagesloaded' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'layout_section',
			[
				'label' => esc_html__( 'Layout', 'rovoko' ),
				'tab'   => 'layout',
			]
		);
		$this->add_control(
			'fancy_style',
			[
				'label'   => esc_html__( 'Layout', 'rovoko' ),
				'type'    => 'layoutcontrol',
				'default' => '1',
				'options' => [
					'1' => [
						'label' => esc_html__( 'One', 'rovoko' ),
						'image' => get_template_directory_uri() . '/assets/images/elementor/fancybox-layout.jpg'
					],
					'2' => [
						'label' => esc_html__( 'Two', 'rovoko' ),
						'image' => get_template_directory_uri() . '/assets/images/elementor/fancybox-layout-2.jpg'
					],
					'3' => [
						'label' => esc_html__( 'Three', 'rovoko' ),
						'image' => get_template_directory_uri() . '/assets/images/elementor/fancybox-layout-3.jpg'
					],
					'4' => [
						'label' => esc_html__( 'Four', 'rovoko' ),
						'image' => get_template_directory_uri() . '/assets/images/elementor/fancybox-layout-4.jpg'
					],
					'5' => [
						'label' => esc_html__( 'Five', 'rovoko' ),
						'image' => get_template_directory_uri() . '/assets/images/elementor/fancybox-layout-5.jpg'
					]
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Fancy Box', 'rovoko' ),
				'tab'   => 'content',
			]
		);

		$this->add_control(
			'image',
			[
				'label'     => esc_html__( 'Choose Image', 'rovoko' ),
				'type'      => 'media',
				'condition' => [
					'fancy_style' => [ '1', '4', '5' ],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
				'condition' => [
					'fancy_style' => [ '1', '4', '5' ],
				],
			]
		);
		$this->add_control(
			'icon',
			[
				'label'                  => esc_html__( 'Choose icon', 'rovoko' ),
				'type'                   => 'icons',
				'default'                => [
					'value'   => 'fas fa-star',
					'library' => 'solid',
				],
				'exclude_inline_options' => [ 'icon' ],
				'condition'              => [
					'fancy_style' => [ '3', '4' ],
				],
			]
		);
		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'rovoko' ),
				'type'        => 'text',
				'default'     => esc_html__( 'This is the heading', 'rovoko' ),
				'placeholder' => esc_html__( 'Enter your title', 'rovoko' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'sub_title',
			[
				'label'       => esc_html__( 'Subtitle', 'rovoko' ),
				'type'        => 'text',
				'placeholder' => esc_html__( 'Enter your subtitle', 'rovoko' ),
				'label_block' => true,
				'condition'   => [
					'fancy_style' => [ '1', '5' ],
				],
			]
		);
		$this->add_control(
			'sub_title_sec',
			[
				'label'       => esc_html__( 'Subtitle Second', 'rovoko' ),
				'type'        => 'text',
				'placeholder' => esc_html__( 'Enter your subtitle', 'rovoko' ),
				'label_block' => true,
				'condition'   => [
					'fancy_style' => [ '5' ],
				],
			]
		);
		$this->add_control(
			'description',
			[
				'label'       => esc_html__( 'Description', 'rovoko' ),
				'type'        => 'textarea',
				'default'     => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'rovoko' ),
				'placeholder' => esc_html__( 'Enter your description', 'rovoko' ),
				'rows'        => 10,
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title HTML Tag', 'rovoko' ),
				'type'    => 'select',
				'options' => [
					'h1'   => esc_html__( 'H1', 'rovoko' ),
					'h2'   => esc_html__( 'H2', 'rovoko' ),
					'h3'   => esc_html__( 'H3', 'rovoko' ),
					'h4'   => esc_html__( 'H4', 'rovoko' ),
					'h5'   => esc_html__( 'H5', 'rovoko' ),
					'h6'   => esc_html__( 'H6', 'rovoko' ),
					'div'  => esc_html__( 'div', 'rovoko' ),
					'span' => esc_html__( 'span', 'rovoko' ),
					'p'    => esc_html__( 'p', 'rovoko' ),
				],
				'default' => 'h3',
			]
		);
		$this->add_control(
			'btn_text',
			[
				'label'       => esc_html__( 'Button text', 'rovoko' ),
				'type'        => 'text',
				'default'     => esc_html__( 'More Information', 'rovoko' ),
				'placeholder' => esc_html__( 'Enter button text', 'rovoko' ),
				'condition'   => [
					'fancy_style' => [ '1', '2', '5' ]
				],
				'separator'   => 'before',
			]
		);
		$this->add_control(
			'btn_layout',
			[
				'label'     => esc_html__( 'Type', 'rovoko' ),
				'type'      => 'select',
				'options'   => [
					'fill'    => esc_html__( 'Fill', 'rovoko' ),
					'outline' => esc_html__( 'Outline', 'rovoko' ),
				],
				'condition' => [
					'fancy_style' => [ '1', '2', '5' ]
				],
				'default'   => 'fill',
			]
		);
		$this->add_control(
			'btn_link',
			[
				'label'       => esc_html__( 'Link', 'rovoko' ),
				'type'        => 'url',
				'placeholder' => esc_html__( 'https://your-link.com', 'rovoko' ),
				'default'     => [ 'url' => '#' ],
				'condition'   => [
					'fancy_style' => [ '1', '2', '5' ]
				],
			]
		);

		$this->end_controls_section();
		/*End Fancy Box content*/
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Content', 'rovoko' ),
				'tab'   => 'style',
			]
		);
		$this->add_control(
			'text_align',
			[
				'label'     => esc_html__( 'Alignment', 'rovoko' ),
				'type'      => 'choose',
				'default'   => '',
				'options'   => [
					'left'    => [
						'title' => esc_html__( 'Left', 'rovoko' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => esc_html__( 'Center', 'rovoko' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => esc_html__( 'Right', 'rovoko' ),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'rovoko' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'selectors' => [ '{{WRAPPER}} .fancybox-content' => 'text-align: {{VALUE}};' ],
				'condition' => [ 'fancy_style' => [ '2', '3', '4' ] ]
			]
		);
		/*** Start Tabs Wrap ***/
		$this->start_controls_tabs( 'tabs_align_style', [ 'condition' => [ 'fancy_style' => [ '1', '5' ] ] ] );
		$this->start_controls_tab(
			'align-nomal-tab',
			[
				'label' => esc_html__( 'Normal', 'rovoko' ),
			]
		);
		$this->add_control(
			'nomal_text_align',
			[
				'label'     => esc_html__( 'Alignment', 'rovoko' ),
				'type'      => 'choose',
				'default'   => '',
				'options'   => [
					'left'    => [
						'title' => esc_html__( 'Left', 'rovoko' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => esc_html__( 'Center', 'rovoko' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => esc_html__( 'Right', 'rovoko' ),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'rovoko' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .fancybox-content.fancybox-layout-1 .visible-content' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .fancybox-content.fancybox-layout-5 .visible-content' => 'text-align: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'before-filter',
			[
				'label'     => esc_html__( 'Filter color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .fancybox-content.fancybox-layout-1:before' => ' background-color: {{VALUE}}',
					'{{WRAPPER}} .fancybox-content.fancybox-layout-5:before' => ' background-color: {{VALUE}}'
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'align-hover-tab',
			[
				'label' => esc_html__( 'Hover', 'rovoko' ),
			]
		);
		$this->add_control(
			'hover_text_align',
			[
				'label'     => esc_html__( 'Alignment', 'rovoko' ),
				'type'      => 'choose',
				'default'   => '',
				'options'   => [
					'left'    => [
						'title' => esc_html__( 'Left', 'rovoko' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => esc_html__( 'Center', 'rovoko' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => esc_html__( 'Right', 'rovoko' ),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'rovoko' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .fancybox-content.fancybox-layout-1 .hidden-content' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .fancybox-content.fancybox-layout-5 .hidden-content' => 'text-align: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'before-hover-filter',
			[
				'label'     => esc_html__( 'Filter color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .fancybox-content.fancybox-layout-1:hover:before' => ' background-color: {{VALUE}}',
					'{{WRAPPER}} .fancybox-content.fancybox-layout-5:hover:before' => ' background-color: {{VALUE}}'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		/*** End Tabs Wrap ***/
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'fancybox_bg',
				'label'     => esc_html__( 'Fancybox Background', 'rovoko' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .fancybox-content.fancybox-layout-4 .visible-content:before',
				'condition' => [
					'fancy_style' => [ '4' ],
				],
			]
		);
		/*Icon Style*/
		$this->add_control(
			'icon_style',
			[
				'label'     => esc_html__( 'Icon', 'rovoko' ),
				'type'      => 'heading',
				'condition' => [
					'fancy_style' => [ '3', '4' ],
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'icon-size',
			[
				'label'     => esc_html__( 'Size', 'rovoko' ),
				'type'      => 'slider',
				'range'     => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .fancybox-content .fancybox-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'fancy_style' => [ '3', '4' ],
				],
			]
		);
		$this->add_responsive_control(
			'icon-padding',
			[
				'label'     => esc_html__( 'Padding', 'rovoko' ),
				'type'      => 'slider',
				'selectors' => [
					'{{WRAPPER}} .fancybox-content .fancybox-icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'range'     => [
					'em' => [
						'min' => 0,
						'max' => 5,
					],
				],
				'condition' => [
					'fancy_style' => '3',
				],

			]
		);
		$this->add_control(
			'icon-rotate',
			[
				'label'      => esc_html__( 'Rotate', 'rovoko' ),
				'type'       => 'slider',
				'size_units' => [ 'deg' ],
				'default'    => [
					'size' => 0,
					'unit' => 'deg',
				],
				'selectors'  => [

					'{{WRAPPER}} .fancybox-content .fancybox-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
				'condition'  => [
					'fancy_style' => [ '3', '4' ],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'label'     => esc_html__( 'Border', 'rovoko' ),
				'name'      => 'icon-border',
				'selector'  => '{{WRAPPER}} .fancybox-content .fancybox-icon',
				'condition' => [
					'fancy_style' => [ '3', '4' ],
				],
			]
		);
		$this->add_control(
			'icon-border-radius',
			[
				'label'      => esc_html__( 'Border Radius', 'rovoko' ),
				'type'       => 'slider',
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'size' => 50,
					'unit' => '%',
				],
				'selectors'  => [
					'{{WRAPPER}} .fancybox-content .fancybox-icon' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'fancy_style' => [ '3', '4' ]
				],
			]
		);
		/*** Start Tabs Wrap ***/
		$this->start_controls_tabs( 'tabs_icon_style', [ 'condition' => [ 'fancy_style' => [ '3', '4' ] ] ] );
		$this->start_controls_tab(
			'icon-nomal-tab',
			[
				'label' => esc_html__( 'Normal', 'rovoko' ),
			]
		);
		$this->add_control(
			'icon-bg',
			[
				'label'     => esc_html__( 'Background Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .fancybox-content .fancybox-icon' => 'background-color: {{VALUE}};' ],
			]
		);

		$this->add_control(
			'icon-color',
			[
				'label'     => esc_html__( 'Icon Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .fancybox-content .fancybox-icon i' => 'color: {{VALUE}};' ]
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'icon-hover-tab',
			[
				'label' => esc_html__( 'Hover', 'rovoko' ),
			]
		);
		$this->add_control(
			'icon-hover-bg',
			[
				'label'     => esc_html__( 'Background Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .fancybox-content.fancybox-layout-3:hover .fancybox-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .fancybox-content.fancybox-layout-4 .fancybox-icon:hover' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'icon-color-hover',
			[
				'label'     => esc_html__( 'Icon Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .fancybox-content.fancybox-layout-3:hover .fancybox-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .fancybox-content.fancybox-layout-4 .fancybox-icon:hover i' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'icon-hover-border',
			[
				'label'     => esc_html__( 'Border Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .fancybox-content.fancybox-layout-3:hover .fancybox-icon' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .fancybox-content.fancybox-layout-4 .fancybox-icon:hover' => 'border-color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		/*Title Style*/
		$this->add_control(
			'title_style',
			[
				'label'     => esc_html__( 'Title', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .fancybox-content .heading-title' => 'fill: {{VALUE}}; color: {{VALUE}};' ],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .fancybox-content .heading-title',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			]
		);
		$this->add_control(
			'subtitle_style',
			[
				'label'     => esc_html__( 'Subtitle', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before',
				'condition' => [
					'fancy_style' => [ '1', '5' ],
				],
			]
		);

		$this->add_control(
			'subtitle_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .fancybox-content .subtitle.sub_title' => 'fill: {{VALUE}}; color: {{VALUE}};' ],
				'condition' => [
					'fancy_style' => [ '1', '5' ]
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'subtitle_typography',
				'selector'  => '{{WRAPPER}} .fancybox-content .subtitle.sub_title',
				'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
				'condition' => [
					'fancy_style' => [ '1', '5' ]
				],
			]
		);
		$this->add_control(
			'subtitle_sec_style',
			[
				'label'     => esc_html__( 'Subtitle Second ', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before',
				'condition' => [
					'fancy_style' => [ '5' ],
				],
			]
		);

		$this->add_control(
			'subtitle_sec_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .fancybox-content .subtitle.sub_title_sec' => 'fill: {{VALUE}}; color: {{VALUE}};' ],
				'condition' => [
					'fancy_style' => [ '5' ]
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'subtitle_sec_typography',
				'selector'  => '{{WRAPPER}} .fancybox-content .subtitle.sub_title_sec',
				'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
				'condition' => [
					'fancy_style' => [ '5' ]
				],
			]
		);
		$this->add_control(
			'description_style',
			[
				'label'     => esc_html__( 'Description', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .fancybox-content .des' => 'fill: {{VALUE}}; color: {{VALUE}};' ],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'selector' => '{{WRAPPER}} .fancybox-content .des',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			]
		);
		$this->add_control(
			'btn_hedding',
			[
				'label'     => esc_html__( 'Button', 'rovoko' ),
				'type'      => 'heading',
				'condition' => [
					'fancy_style' => [ '1', '2', '5' ]
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'btn_typography',
				'selector'  => '{{WRAPPER}} .fancybox-content .readmore-btn a',
				'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
				'condition' => [
					'fancy_style' => [ '1', '2', '5' ]
				],
			]
		);
		/*** Start Tabs Wrap ***/
		$this->start_controls_tabs( 'tabs_viewmore_style', [ 'condition' => [ 'fancy_style' => [ '1', '2', '5' ] ] ] );
		$this->start_controls_tab(
			'viewmore-nomal-tab',
			[
				'label' => esc_html__( 'Normal', 'rovoko' ),
			]
		);
		$this->add_control(
			'viewmore-bg',
			[
				'label'     => esc_html__( 'Background Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .fancybox-content .readmore-btn a' => 'background-color: {{VALUE}};' ],
				'condition' => [ 'btn_layout' => 'fill' ]
			]
		);
		$this->add_control(
			'viewmore-border',
			[
				'label'     => esc_html__( 'Border Color', 'rovoko' ),
				'type'      => 'color',
				'selectors' => [ '{{WRAPPER}} .fancybox-content .readmore-btn a.outline' => 'border-color: {{VALUE}};' ],
				'condition' => [ 'btn_layout' => 'outline' ]
			]
		);

		$this->add_control(
			'viewmore-color',
			[
				'label'     => esc_html__( 'Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .fancybox-content .readmore-btn a' => 'color: {{VALUE}};' ]
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'viewmore-hover-tab',
			[
				'label' => esc_html__( 'Hover', 'rovoko' ),
			]
		);
		$this->add_control(
			'viewmore-hover-border',
			[
				'label'     => esc_html__( 'Border Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .fancybox-content .readmore-btn a.outline:hover' => 'border-color: {{VALUE}};' ],
				'condition' => [ 'btn_layout' => 'outline' ]
			]
		);
		$this->add_control(
			'viewmore-hover-bg',
			[
				'label'     => esc_html__( 'Background Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .fancybox-content .readmore-btn a:hover' => 'background-color: {{VALUE}};' ]
			]
		);
		$this->add_control(
			'viewmore-color-hover',
			[
				'label'     => esc_html__( 'Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .fancybox-content .readmore-btn a:hover' => 'color: {{VALUE}};' ]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		/*** End Tabs Wrap ***/
		$this->end_controls_section();
	}

	protected function render() {
		$settings    = $this->get_settings_for_display();
		$fancy_style = isset( $settings['fancy_style'] ) ? $settings['fancy_style'] : '1';
		$this->add_render_attribute( [
			'_wrapper' => [
				'class' => 'layout-' . $fancy_style,
			],
			'wrapper'  => [
				'class' => [ 'fancybox-content', 'fancybox-layout-' . $fancy_style ]
			],
		] );
		?>
        <div <?php echo '' . $this->get_render_attribute_string( 'wrapper' ); ?>>
			<?php
			switch ( $fancy_style ):
				case '1':
					$this->rovoko_fancybox_layout_one( $settings );
					break;
				case '2':
					$this->rovoko_fancybox_layout_two( $settings );
					break;
				case '3':
					$this->rovoko_fancybox_layout_three( $settings );
					break;
				case '4':
					$this->rovoko_fancybox_layout_four( $settings );
					break;
				case '5':
					$this->rovoko_fancybox_layout_five( $settings );
					break;
				default:
					$this->rovoko_fancybox_layout_one( $settings );
			endswitch;
			?>
        </div>
		<?php
	}

	private function rovoko_fancybox_layout_one( $settings = array() ) {
		$html = '';
		$this->rovoko_fancybox_images( $settings );
		$hascontent = ! Utils::is_empty( $settings['title'] ) || ! Utils::is_empty( $settings['sub_title'] ) || ! Utils::is_empty( $settings['description'] ) || ! Utils::is_empty( $settings['button'] );
		if ( $hascontent ) {
			$heading_title = $this->rovoko_fancybox_headding( $settings );
			$sub_title     = $this->rovoko_fancybox_subtitle( $settings, 'sub_title' );
			$html          .= '<div class="box-content">';
			$html          .= '<div class="hidden-content">';
			$html          .= $sub_title;
			$html          .= $heading_title;
			$html          .= $this->rovoko_fancybox_description( $settings );
			$html          .= $this->rovoko_fancybox_load_more_btn( $settings );
			$html          .= '</div>';
			$html          .= '<div class="visible-content">' . $sub_title . $heading_title . '</div>';
			$html          .= '</div>';
		}
		echo rovoko_html( $html );
	}

	private function rovoko_fancybox_images( $settings ) {
		if ( ! empty( $settings['image']['url'] ) ) {
			$this->add_render_attribute( 'box-img', [
				'class' => [ 'box-img' ],
				'style' => [ 'background-image:url(' . $settings['image']['url'] . ')' ]
			] );
			$this->add_render_attribute( 'image', 'src', $settings['image']['url'] );
			$this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['image'] ) );
			$this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $settings['image'] ) );
			$image_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );
			printf( '<figure %1$s>%2$s</figure>', $this->get_render_attribute_string( 'box-img' ), $image_html );
		} else {
			printf( '<figure class="box-img"><img src="%1$s"></figure>', esc_url( Utils::get_placeholder_image_src() ) );
		}
	}

	private function rovoko_fancybox_headding( $settings = array(), $echo = false ) {
		if ( ! Utils::is_empty( $settings['title'] ) ) {
			$this->add_render_attribute( 'title', 'class', 'heading-title' );
			ob_start();
			printf( '<%1$s %2$s>%3$s</%1$s>', $settings['title_tag'], $this->get_render_attribute_string( 'title' ), $settings['title'] );
			if ( $echo ) {
				echo ob_get_clean();
			} else {
				return ob_get_clean();
			}
		}
	}

	private function rovoko_fancybox_subtitle( $settings, $id = '', $echo = false ) {
		if ( ! Utils::is_empty( $settings[ $id ] ) ) {
			$this->add_render_attribute( 'class-' . $id, 'class', [ 'subtitle', $id ] );
			ob_start();
			printf( '<span %1$s>%2$s</span>', $this->get_render_attribute_string( 'class-' . $id ), $settings[ $id ] );
			if ( $echo ) {
				echo ob_get_clean();
			} else {
				return ob_get_clean();
			}
		}
	}

	private function rovoko_fancybox_description( $settings = [], $echo = false ) {
		if ( ! Utils::is_empty( $settings['description'] ) ) {
			$this->add_render_attribute( 'description', 'class', 'des' );
			ob_start();
			printf( '<p %1$s>%2$s</p>', $this->get_render_attribute_string( 'description' ), $settings['description'] );
			if ( $echo ) {
				echo ob_get_clean();
			} else {
				return ob_get_clean();
			}
		}
	}

	private function rovoko_fancybox_load_more_btn( $settings = array(), $echo = false, $color = 'primary' ) {
		$this->add_render_attribute( 'view-more', 'class', [ 'ef5-btn', $color ] );
		if ( ! Utils::is_empty( $settings['btn_layout'] ) ) :
			$this->add_render_attribute( 'view-more', 'class', $settings['btn_layout'] );
		endif;
		if ( ! empty( $settings['btn_link']['url'] ) ) {
			$this->add_link_attributes( 'view-more', $settings['btn_link'] );
		}
		if ( ! Utils::is_empty( $settings['btn_text'] ) ) {
			ob_start();
			printf( '<div class="readmore-btn"><a %1$s>%2$s</a></div>', $this->get_render_attribute_string( 'view-more' ), $settings['btn_text'] );
			if ( $echo ) {
				echo ob_get_clean();
			} else {
				return ob_get_clean();
			}
		}
	}

	private function rovoko_fancybox_layout_two( $settings = array() ) {
		$this->rovoko_fancybox_headding( $settings, true );
		$this->rovoko_fancybox_description( $settings, true );
		$this->rovoko_fancybox_load_more_btn( $settings, true );
	}

	private function rovoko_fancybox_layout_three( $settings = array() ) {
		$this->rovoko_fancybox_get_icon( $settings );
		$this->rovoko_fancybox_headding( $settings, true );
		$this->rovoko_fancybox_description( $settings, true );
	}

	private function rovoko_fancybox_get_icon( $settings ) {
		if ( ! Utils::is_empty( $settings['icon']['value'] ) ):
			$this->add_render_attribute( 'icon', 'class', $settings['icon']['value'] );
			?>
            <div class="fancybox-icon">
				<?php printf( '<i %1$s></i>', $this->get_render_attribute_string( 'icon' ) ); ?>
            </div>
		<?php
		endif;
	}

	private function rovoko_fancybox_layout_four( $settings = array() ) {
		?>
        <div class="visible-content">
			<?php
			$this->rovoko_fancybox_images( $settings );
			if ( ! Utils::is_empty( $settings['icon']['value'] ) || ! Utils::is_empty( $settings['description'] ) ):
				echo '<div class="desandicon">';
				$this->rovoko_fancybox_get_icon( $settings );
				$this->rovoko_fancybox_description( $settings, true );
				echo '</div>';
			endif;
			?>
        </div>
		<?php
		$this->rovoko_fancybox_headding( $settings, true );
	}

	private function rovoko_fancybox_layout_five( $settings ) {
		$this->rovoko_fancybox_images( $settings ); ?>
        <div class="box-content">
            <div class="hidden-content">
				<?php $this->rovoko_fancybox_subtitle( $settings, 'sub_title_sec', true ); ?>
				<?php $this->rovoko_fancybox_description( $settings, true ); ?>
				<?php $this->rovoko_fancybox_load_more_btn( $settings, true, 'accent' ); ?>
            </div>
            <div class="visible-content">
				<?php $this->rovoko_fancybox_headding( $settings, true ); ?>
				<?php $this->rovoko_fancybox_subtitle( $settings, 'sub_title', true ); ?>
            </div>
        </div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Rovoko_Fancy_Box_Widget() );