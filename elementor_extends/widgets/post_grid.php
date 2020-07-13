<?php
/**
 * Alert Module
 */

namespace Elementor;
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Rovoko_Post_Grid extends Widget_Base {

	public function get_name() {
		return 'rovoko_post_grid';
	}

	public function get_title() {
		return esc_html__( '[Rovoko] Post Grid', 'rovoko' );
	}

	public function get_icon() {
		return 'rovoko-icon eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'rovoko-elements' ];
	}

	public function get_script_depends() {
		return [ 'imagesloaded', 'rovoko-post-grid' ];
	}

	public function get_keywords() {
		return [ 'rovoko', 'post', 'grid' ];
	}

	protected function _register_controls() {
		/**************** Start Layout Control Tab ****************/
		$this->start_controls_section(
			'layout_section',
			[
				'label' => esc_html__( 'Layout', 'rovoko' ),
				'tab'   => 'layout',
			]
		);
		$this->add_control(
			'post_layout',
			[
				'label'   => esc_html__( 'Layout', 'rovoko' ),
				'type'    => 'layoutcontrol',
				'default' => 'layout-1',
				'options' => [
					'layout-1' => [
						'label' => esc_html__( 'Layout One', 'rovoko' ),
						'image' => get_template_directory_uri() . '/assets/images/elementor/blog-layout.jpg'
					],
					'layout-2' => [
						'label' => esc_html__( 'Layout Two', 'rovoko' ),
						'image' => get_template_directory_uri() . '/assets/images/elementor/blog-layout-2.jpg'
					]
				],
			]
		);
		$this->end_controls_section();
		/**************** Start Content Control Tab ****************/
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Post Grid', 'rovoko' ),
				'tab'   => 'content',
			]
		);
		$this->add_responsive_control(
			'columns',
			[
				'label'          => esc_html__( 'Grid Columns', 'rovoko' ),
				'type'           => 'select',
				'default'        => '3',
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
					'{{WRAPPER}} .rovoko-post-wrapper .post' => 'width: calc(100% / {{VALUE}});',
				],
				'condition'      => [
					'post_layout' => 'layout-1',
				],
				'separator'      => 'after',
			]
		);
		$this->add_control(
			'query',
			[
				'label' => esc_html__( 'Query', 'rovoko' ),
				'type'  => 'heading',
			]
		);
		$this->add_control(
			'count',
			[
				'label'       => esc_html__( 'Posts Per Page', 'rovoko' ),
				'description' => esc_html__( 'You can enter "-1" to display all posts.', 'rovoko' ),
				'type'        => 'text',
				'default'     => '3',
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
				'options'     => $this->rovoko_get_terms_array()
			]
		);
		$this->add_control(
			'exclude_cat',
			[
				'label'       => esc_html__( 'Exclude Categories', 'rovoko' ),
				'type'        => 'select2',
				'label_block' => true,
				'multiple'    => true,
				'options'     => $this->rovoko_get_terms_array()
			]
		);
		$this->add_control(
			'elements',
			[
				'label'     => esc_html__( 'Elements', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'medium',
				'condition' => [
					'post_layout' => [ 'layout-1', 'layout-2' ],
				],
			]
		);
		$this->add_control(
			'title',
			[
				'label'   => esc_html__( 'Display Title', 'rovoko' ),
				'type'    => 'switcher',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label'     => esc_html__( 'HTML Tag', 'rovoko' ),
				'type'      => 'select',
				'default'   => 'h3',
				'options'   => [
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				],
				'condition' => [
					'title' => 'yes',
				],
			]
		);
		/*Author and comment*/
		$this->add_control(
			'author',
			[
				'label'     => esc_html__( 'Author Meta', 'rovoko' ),
				'type'      => 'switcher',
				'default'   => 'yes',
				'condition' => [
					'post_layout' => 'layout-1',
				],
			]
		);
		$this->add_control(
			'comment',
			[
				'label'     => esc_html__( 'Comments Meta', 'rovoko' ),
				'type'      => 'switcher',
				'default'   => 'yes',
				'condition' => [
					'post_layout' => 'layout-1',
				],
			]
		);
		/*Post date*/
		$this->add_control(
			'date',
			[
				'label'     => esc_html__( 'Post Date ', 'rovoko' ),
				'type'      => 'switcher',
				'default'   => 'yes',
				'condition' => [
					'post_layout' => 'layout-2',
				],
			]
		);
		$this->add_control(
			'excerpt',
			[
				'label'   => esc_html__( 'Excerpt', 'rovoko' ),
				'type'    => 'switcher',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'excerpt-length',
			[
				'label'     => esc_html__( 'Excerpt Length', 'rovoko' ),
				'type'      => 'number',
				'default'   => '20',
				'condition' => [
					'excerpt' => 'yes',
				],
			]
		);
		$this->add_control(
			'redmore',
			[
				'label'   => esc_html__( 'Read more button', 'rovoko' ),
				'type'    => 'switcher',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'redmore_text',
			[
				'label'       => esc_html__( 'Readmore text', 'rovoko' ),
				'type'        => 'text',
				'default'     => esc_html__( 'Choose Plan', 'rovoko' ),
				'placeholder' => esc_html__( 'Choose Plan', 'rovoko' ),
				'condition'   => [
					'post_layout' => [ 'layout-2' ],
					'redmore'     => 'yes',
				],
			]
		);
		$this->add_control(
			'view_all',
			[
				'label'     => esc_html__( 'Load More Posts', 'rovoko' ),
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
				'label'       => esc_html__( 'Button text', 'rovoko' ),
				'type'        => 'text',
				'default'     => esc_html__( 'Load More', 'rovoko' ),
				'placeholder' => esc_html__( 'Load More', 'rovoko' ),
				'condition'   => [
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
		$this->add_control(
			'text_align',
			[
				'label'     => esc_html__( 'Content Alignment', 'rovoko' ),
				'type'      => 'choose',
				'default'   => 'left',
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
					'{{WRAPPER}} .rovoko-post-wrapper' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'post_layout' => 'layout-1',
				],
			]
		);
		$this->add_control(
			'odd_text_align',
			[
				'label'     => esc_html__( 'Content Alignment(Odd)', 'rovoko' ),
				'type'      => 'choose',
				'default'   => 'left',
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
					'{{WRAPPER}} .rovoko-post-wrapper.layout-2 .odd' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'post_layout' => 'layout-2',
				],
			]
		);
		$this->add_control(
			'even_text_align',
			[
				'label'     => esc_html__( 'Content Alignment(Even)', 'rovoko' ),
				'type'      => 'choose',
				'default'   => 'right',
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
					'{{WRAPPER}} .rovoko-post-wrapper.layout-2 .even' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'post_layout' => 'layout-2',
				],
			]
		);
		/*--Title--*/
		$this->add_control(
			'title_style',
			[
				'label'     => esc_html__( 'Title', 'rovoko' ),
				'type'      => 'heading',
				'condition' => [
					'title' => 'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'title_typography',
				'selector'  => '{{WRAPPER}} .rovoko-post-wrapper .ef5-heading',
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
					'{{WRAPPER}} .rovoko-post-wrapper .ef5-heading' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .rovoko-post-wrapper .ef5-heading:hover a' => 'color: {{VALUE}};',
				],
				'condition' => [
					'title' => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		/*** End Tabs Wrap ***/
		/*-- Meta --*/
		$this->add_control(
			'meta_style',
			[
				'label'     => esc_html__( 'Meta', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'meta-icon-color',
			[
				'label'     => esc_html__( 'Icon Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-post-wrapper  .post .post-meta .meta-icon' => 'color: {{VALUE}};',
				],
				'condition' => [
					'post_layout' => 'layout-1',
				],
			]
		);
		/*** Start Tabs Wrap ***/
		$this->start_controls_tabs( 'tabs_meta_style' );
		$this->start_controls_tab(
			'meta-nomal-tab',
			[
				'label' => esc_html__( 'Normal', 'rovoko' ),
			]
		);
		$this->add_control(
			'meta-color',
			[
				'label'     => esc_html__( 'Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-post-wrapper .post .post-meta a'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .rovoko-post-wrapper.layout-2 .ef5-date a' => 'color: {{VALUE}};',
				]
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'meta-hover-tab',
			[
				'label' => esc_html__( 'Hover', 'rovoko' ),
			]
		);
		$this->add_control(
			'meta-color-hover',
			[
				'label'     => esc_html__( 'Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-post-wrapper  .post .post-meta a:hover'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .rovoko-post-wrapper.layout-2 .ef5-date:hover a' => 'color: {{VALUE}};',
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		/*** End Tabs Wrap ***/
		/*-- except --*/
		$this->add_control(
			'excerpt_style',
			[
				'label'     => esc_html__( 'Excerpt', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before',
				'condition' => [
					'excerpt' => 'yes',
				],
			]
		);
		$this->add_control(
			'excerpt-color',
			[
				'label'     => esc_html__( 'Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-post-wrapper .post .ef5-excerpt' => 'color: {{VALUE}};',
				],
				'condition' => [
					'excerpt' => 'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'excerpt-typography',
				'selector'  => '{{WRAPPER}} .rovoko-post-wrapper .post .ef5-excerpt',
				'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
				'condition' => [
					'excerpt' => 'yes',
				],
			]
		);
		/*-- Readmore --*/
		$this->add_control(
			'readmore_style',
			[
				'label'     => esc_html__( 'Redmore button', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before',
				'condition' => [
					'redmore' => 'yes',
				],
			]
		);
		/*** Start Tabs Wrap ***/
		$this->start_controls_tabs( 'tabs_readmore_style', [ 'condition' => [ 'redmore' => 'yes' ] ] );
		$this->start_controls_tab(
			'readmore-nomal-tab',
			[
				'label' => esc_html__( 'Normal', 'rovoko' ),
			]
		);
		$this->add_control(
			'redmore-bgcolor',
			[
				'label'     => esc_html__( 'Background Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-post-wrapper .post .ef5-featured .ef5-btn' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .rovoko-post-wrapper.layout-2 .ef5-btn'            => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'redmore-color',
			[
				'label'     => esc_html__( 'Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-post-wrapper .post .ef5-featured .ef5-btn i:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rovoko-post-wrapper.layout-2 .ef5-btn'                     => 'color: {{VALUE}};',
				]
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'readmore-hover-tab',
			[
				'label' => esc_html__( 'Hover', 'rovoko' ),
			]
		);
		$this->add_control(
			'redmore-bgcolor-hover',
			[
				'label'     => esc_html__( 'Background Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-post-wrapper .post .ef5-featured .ef5-btn:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .rovoko-post-wrapper.layout-2 .ef5-btn:hover'            => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'redmore-color-hover',
			[
				'label'     => esc_html__( 'Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-post-wrapper .post .ef5-featured .ef5-btn:hover i:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rovoko-post-wrapper.layout-2 .ef5-btn:hover'                     => 'color: {{VALUE}};',
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
				'label'     => esc_html__( 'Button Alignment', 'rovoko' ),
				'type'      => 'choose',
				'default'   => 'left',
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
					'{{WRAPPER}} .rovoko-post-wrapper .view-all-btn' => 'text-align: {{VALUE}};',
				],

			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'viewall_typography',
				'selector'  => '{{WRAPPER}} .rovoko-post-wrapper .view-all-btn a',
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
				'selectors' => [ '{{WRAPPER}} .rovoko-post-wrapper .view-all-btn a' => 'background-color: {{VALUE}};' ],
				'condition' => [ 'btn_style' => 'fill' ]
			]
		);
		$this->add_control(
			'viewall-border',
			[
				'label'     => esc_html__( 'Border Color', 'rovoko' ),
				'type'      => 'color',
				'selectors' => [ '{{WRAPPER}} .rovoko-post-wrapper .view-all-btn a.outline' => 'border-color: {{VALUE}};' ],
				'condition' => [ 'btn_style' => 'outline' ]
			]
		);

		$this->add_control(
			'viewall-color',
			[
				'label'     => esc_html__( 'Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .rovoko-post-wrapper .view-all-btn a' => 'color: {{VALUE}};' ]
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
					'{{WRAPPER}} .rovoko-post-wrapper .view-all-btn a.outline:hover' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .rovoko-post-wrapper .view-all-btn a:hover' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .rovoko-post-wrapper .view-all-btn a:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		/*** End Tabs Wrap ***/
		$this->end_controls_section();

	}

	protected function rovoko_get_terms_array( $taxo = 'category' ) {
		$array = [];
		$terms = get_terms( array(
			'taxonomy'   => $taxo,
			'hide_empty' => true,
		) );
		if ( ! empty( $terms ) ) {
			foreach ( $terms as $term ) {
				$array[ $term->slug ] = $term->name;
			}
		}

		return $array;
	}

	protected function render() {
		$settings    = $this->get_settings_for_display();
		$post_layout = ! Utils::is_empty( $settings['post_layout'] ) ? $settings['post_layout'] : 'layout-1';
		$this->add_render_attribute( [
			'wrapper' => [
				'class' => [ 'rovoko-post-wrapper', $post_layout ],
				'id'    => [ 'post-' . $post_layout . '-' . $this->get_id() ],
			]
		] );
		global $paged, $wp_query;
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
		$args = array(
			'post_type'      => 'post',
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
					'taxonomy'         => 'category',
					'field'            => 'slug',
					'terms'            => $settings['include_cat'],
					'include_children' => false,
					'operator'         => 'IN'
				);
			}
			if ( ! Utils::is_empty( $settings['exclude_cat'] ) ) {
				$args['tax_query'][] = array(
					'taxonomy'         => 'category',
					'field'            => 'slug',
					'terms'            => $settings['exclude_cat'],
					'include_children' => false,
					'operator'         => 'NOT IN'
				);
			}
		}
		if ( $post_layout == 'layout-1' ) {
			$this->add_render_attribute( [
				'posts-row' => [ 'class' => [ 'articles', 'gutter-lg-60', 'row' ] ],
				'post-col'  => [ 'class' => [ 'post', 'col-auto' ] ]
			] );
		} elseif ( $post_layout == 'layout-2' ) {
			$this->add_render_attribute( [
				'posts-row' => [ 'class' => [ 'articles', 'post-grid' ] ],
			] );
		}
		$posts = $wp_query = new \WP_Query( $args );
		$count = 0;
		if ( $posts->have_posts() ) :?>
            <div <?php echo '' . $this->get_render_attribute_string( 'wrapper' ); ?>>
                <div <?php echo '' . $this->get_render_attribute_string( 'posts-row' ); ?>>
					<?php while ( $posts->have_posts() ) :
						$posts->the_post();
						if ( $post_layout == 'layout-1' ):?>
                            <div <?php echo '' . $this->get_render_attribute_string( 'post-col' ); ?>>
								<?php $this->rovoko_post_layout_one( $settings ); ?>
                            </div>
						<?php elseif ( $post_layout == 'layout-2' ):
							$class = ( $count % 2 == 0 ) ? 'odd' : 'even';
							?>
                            <div class="post row gutter-lg-90 align-items-center <?php echo esc_attr( $class ) ?>">
								<?php $this->rovoko_post_layout_two( $settings ); ?>
                            </div>
						<?php endif;
						$count ++;
					endwhile; ?>
                </div>
				<?php $this->rovoko_view_all_post( $settings ); ?>
            </div>
		<?php endif;
		wp_reset_query(); ?>
		<?php
	}

	private function rovoko_post_layout_one( $setting = [] ) {
		$read_more = ! Utils::is_empty( $setting['redmore'] ) ? '<a class="ef5-btn  primary fill" href="' . esc_url( get_permalink() ) . '" rel="bookmark"><i class="flaticon-next-1"></i></a>' : '';
		rovoko_post_media( [
			'thumbnail_size' => $setting['thumbnail_size'],
			'after'          => $read_more,
			'has_hook'       => false
		] );
		if ( ! Utils::is_empty( $setting['author'] ) || ! Utils::is_empty( $setting['comment'] ) ):?>
            <div class="post-meta">
				<?php if ( ! Utils::is_empty( $setting['author'] ) ) :
					rovoko_posted_by( [ 'hint' => '', 'author_avatar' => false ] );
				endif;
				if ( ! Utils::is_empty( $setting['comment'] ) ) :
					rovoko_comments_popup_link();
				endif; ?>
            </div>
		<?php endif;
		if ( ! Utils::is_empty( $setting['title'] ) && $setting['title'] == 'yes' ) {
			rovoko_post_header( [
				'heading_tag' => $setting['title_tag'],
				'title_link'  => true
			] );
		}
		if ( ! Utils::is_empty( $setting['excerpt'] ) && $setting['excerpt'] == 'yes' ) {
			rovoko_post_excerpt( [
				'length' => ! Utils::is_empty( $setting['excerpt-length'] ) ? $setting['excerpt-length'] : '20',
				'more'   => '.',
			] );
		}
	}

	private function rovoko_post_layout_two( $setting = [] ) {
		?>
        <div class="col-lg-54 col-md-6 col-12">
			<?php
			rovoko_post_media( [
				'thumbnail_size' => $setting['thumbnail_size'],
				'has_hook'       => false
			] );
			?>
        </div>
        <div class="col-lg-46 col-md-6 col-12 item-meta">
            <div class="date-and-title">
				<?php
				if ( ! Utils::is_empty( $setting['date'] ) && $setting['date'] == 'yes' ) :
					rovoko_posted_on( [ 'icon' => '', 'date_format' => '\<\s\p\a\n\>d\<\/\s\p\a\n\> M' ] );
				endif;
				if ( ! Utils::is_empty( $setting['title'] ) && $setting['title'] == 'yes' ) :
					rovoko_post_header( [
						'heading_tag' => $setting['title_tag'],
						'title_link'  => true
					] );
				endif;
				?>
            </div>
			<?php
			if ( ! Utils::is_empty( $setting['excerpt'] ) && $setting['excerpt'] == 'yes' ):
				rovoko_post_excerpt( [
					'length' => ! Utils::is_empty( $setting['excerpt-length'] ) ? $setting['excerpt-length'] : '20',
					'more'   => '.',
				] );
			endif;
			if ( ! Utils::is_empty( $setting['redmore'] ) && $setting['redmore'] == 'yes' ) :
				$redmore_text = ! Utils::is_empty( $setting['redmore_text'] ) ? $setting['redmore_text'] : esc_html__( 'Choose Plan', 'rovoko' );
				printf( '<a class="ef5-btn primary boxshadow fill" href="%1$s" rel="bookmark">%2$s</a>', esc_url( get_permalink() ), esc_html( $redmore_text ) );
			endif;
			?>
        </div>
		<?php
	}

	private function rovoko_view_all_post( $settings = array() ) {
		$this->add_render_attribute( 'view-all', 'class', array( 'ef5-btn', 'primary' ) );
		$this->add_render_attribute( 'btn-wrapper', 'class', array( 'view-all-btn' ) );
		if ( ! Utils::is_empty( $settings['btn-css'] ) ) {
			$this->add_render_attribute( 'btn-wrapper', 'class', trim( $settings['btn-css'] ) );
		}
		if ( ! Utils::is_empty( $settings['view_all_btn'] ) && $settings['view_all_btn'] == 'yes' && ! empty( get_next_posts_link() ) ) :
			$view_all_text = ! Utils::is_empty( $settings['view_all_text'] ) ? $settings['view_all_text'] : esc_html__( 'View More', 'rovoko' );
			if ( ! Utils::is_empty( $settings['btn_style'] ) ) :
				$this->add_render_attribute( 'view-all', 'class', $settings['btn_style'] );
			endif;
			$this->add_render_attribute( 'view-all', 'href', get_next_posts_page_link() ); ?>
            <div <?php echo '' . $this->get_render_attribute_string( 'btn-wrapper' ); ?>>
				<?php printf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'view-all' ), $view_all_text ); ?>
            </div>
		<?php
		endif;
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Rovoko_Post_Grid() );