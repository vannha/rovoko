<?php
/**
 * Project Masonry Module
 */

namespace Elementor;
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Rovoko_Project_Masonry extends Widget_Base {
	public function get_name() {
		return 'rovoko_project_masonry';
	}

	public function get_title() {
		return esc_html__( '[Rovoko] Project Masonry', 'rovoko' );
	}

	public function get_icon() {
		return 'rovoko-icon eicon-posts-masonry';
	}

	public function get_categories() {
		return [ 'rovoko-elements' ];
	}

	public function get_script_depends() {
		return [ 'imagesloaded', 'isotope', 'rovoko-projetc-masonry' ];
	}

	public function get_keywords() {
		return [ 'rovoko', 'project', 'masonry' ];
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
			'project_layout',
			[
				'label'   => esc_html__( 'Layout', 'rovoko' ),
				'type'    => 'layoutcontrol',
				'default' => 'masonry',
				'options' => [
					'masonry'   => [
						'label' => esc_html__( 'Masonry', 'rovoko' ),
						'image' => get_template_directory_uri() . '/assets/images/elementor/project-layout-2.jpg'
					],
					'masonry-2' => [
						'label' => esc_html__( 'Masonry 02', 'rovoko' ),
						'image' => get_template_directory_uri() . '/assets/images/elementor/project-layout-3.jpg'
					],
					'masonry-3' => [
						'label' => esc_html__( 'Masonry 03', 'rovoko' ),
						'image' => get_template_directory_uri() . '/assets/images/elementor/project-layout-4.jpg'
					]
				],
			]
		);
		$this->end_controls_section();
		/**************** Start Content Control Tab ****************/
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Project Masonry', 'rovoko' ),
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
					'{{WRAPPER}} .rovoko-project-wrapper.layout-masonry .project'   => 'width: calc(100% / {{VALUE}});',
					'{{WRAPPER}} .rovoko-project-wrapper.layout-masonry-3 .project' => 'width: calc(100% / {{VALUE}});',
				],
				'condition'      => [
					'project_layout' => [ 'masonry', 'masonry-3' ],
				],
			]
		);
		$this->add_control(
			'count',
			[
				'label'       => esc_html__( 'Posts Per Page', 'rovoko' ),
				'description' => esc_html__( 'You can enter "-1" to display all posts.', 'rovoko' ),
				'type'        => 'text',
				'default'     => '4',
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
				'label'   => esc_html__( 'Filters', 'rovoko' ),
				'type'    => 'switcher',
				'default' => 'no',
			]
		);
		$this->add_control(
			'all_categories',
			[
				'label'     => esc_html__( 'Show all items', 'rovoko' ),
				'type'      => 'text',
				'default'   => '',
				'condition' => [
					'masonry-filters' => 'yes',
				],
			]
		);
		$this->add_control(
			'filters-type',
			[
				'label'     => esc_html__( 'Filters Type', 'rovoko' ),
				'type'      => 'select',
				'default'   => 'default',
				'options'   => [
					'default' => esc_html__( 'Default', 'rovoko' ),
					'type-2'  => esc_html__( 'Type 02', 'rovoko' ),
				],
				'condition' => [
					'masonry-filters' => 'yes',
				],
			]
		);
		$this->add_control(
			'project_meta',
			[
				'label'     => esc_html__( 'Project Meta', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'custom-images',
			[
				'label'   => esc_html__( 'Custom images size', 'rovoko' ),
				'type'    => 'switcher',
				'default' => 'no',
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
				'exclude'   => [ 'custom' ],
				'condition' => [
					'custom-images' => 'yes'
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
				'default'   => 'h4',
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
		$this->add_control(
			'readmore',
			[
				'label'   => esc_html__( 'Display Read More', 'rovoko' ),
				'type'    => 'switcher',
				'default' => 'no',
			]
		);
		$this->add_control(
			'readmore_type',
			[
				'label'     => esc_html__( 'Button Type', 'rovoko' ),
				'type'      => 'select',
				'options'   => [
					'fill'    => esc_html__( 'Fill', 'rovoko' ),
					'outline' => esc_html__( 'Outline', 'rovoko' ),
				],
				'default'   => 'fill',
				'condition' => [
					'readmore'       => 'yes',
					'project_layout' => [ 'masonry-2' ],
				],
			]
		);
		$this->add_control(
			'tag',
			[
				'label'   => esc_html__( 'Display Tag', 'rovoko' ),
				'type'    => 'switcher',
				'default' => 'no',
			]
		);
		$this->add_control(
			'excerpt',
			[
				'label'     => esc_html__( 'Display Excerpt', 'rovoko' ),
				'type'      => 'switcher',
				'default'   => 'no',
				'condition' => [
					'project_layout' => [ 'masonry-2' ],
				],
			]
		);
		$this->add_control(
			'excerpt_length',
			[
				'label'     => esc_html__( 'Excerpt Length', 'rovoko' ),
				'type'      => 'number',
				'default'   => '50',
				'condition' => [
					'excerpt'        => 'yes',
					'project_layout' => [ 'masonry-2' ],
				],
			]
		);
		$this->add_control(
			'view_all',
			[
				'label'     => esc_html__( 'Load More Projects', 'rovoko' ),
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
				'label'     => esc_html__( 'Button Type', 'rovoko' ),
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
				'label'       => esc_html__( 'Button Text', 'rovoko' ),
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
					'{{WRAPPER}} .rovoko-project-wrapper' => 'text-align: {{VALUE}};',
				],

			]
		);
		$this->add_control(
			'project-border-radius',
			[
				'label'      => esc_html__( 'Border Radius', 'rovoko' ),
				'type'       => 'slider',
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rovoko-project-wrapper.layout-masonry-3 .project .ef5-featured' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'project_layout' => [ 'masonry-3' ],
				],
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
		$this->add_control(
			'filter_align',
			[
				'label'     => esc_html__( 'Alignment', 'rovoko' ),
				'type'      => 'choose',
				'default'   => 'center',
				'options'   => [
					'start'   => [
						'title' => esc_html__( 'Left', 'rovoko' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => esc_html__( 'Center', 'rovoko' ),
						'icon'  => 'eicon-text-align-center',
					],
					'end'     => [
						'title' => esc_html__( 'Right', 'rovoko' ),
						'icon'  => 'eicon-text-align-right',
					],
					'between' => [
						'title' => esc_html__( 'Justified', 'rovoko' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
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
					'{{WRAPPER}} .ef5-filters .filter-item'                     => 'color: {{VALUE}};',
					'{{WRAPPER}} .ef5-filters.filter-type-2 .filter-item:after' => 'color: {{VALUE}};',
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
				'selector'  => '{{WRAPPER}} .rovoko-project-wrapper .project .ef5-heading',
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
					'{{WRAPPER}} .rovoko-project-wrapper .ef5-heading' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .rovoko-project-wrapper .ef5-heading:hover a' => 'color: {{VALUE}};',
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
				'selector'  => '{{WRAPPER}} .rovoko-project-wrapper .ef5-tagged-in',
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
					'{{WRAPPER}} .rovoko-project-wrapper .ef5-tagged-in' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .rovoko-project-wrapper .ef5-tagged-in a:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		/*** End Tabs Wrap ***/
		/*-- Excerpt --*/
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
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'excerpt_typography',
				'selector'  => '{{WRAPPER}} .rovoko-project-wrapper .ef5-excerpt',
				'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
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
				'selectors' => [ '{{WRAPPER}} .rovoko-project-wrapper .ef5-excerpt' => 'color: {{VALUE}};' ],
				'condition' => [
					'excerpt' => 'yes',
				],
			]
		);
		/*-- Readmore --*/
		$this->add_control(
			'readmore_style',
			[
				'label'     => esc_html__( 'Read More', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before',
				'condition' => [
					'readmore'       => 'yes',
					'project_layout' => [ 'masonry-2' ]
				],
			]
		);
		/*** Start Tabs Wrap ***/
		$this->start_controls_tabs( 'tabs_readmore_style', [
			'condition' => [
				'readmore'       => 'yes',
				'project_layout' => [ 'masonry-2' ]
			]
		] );
		$this->start_controls_tab(
			'readmore-nomal-tab',
			[
				'label' => esc_html__( 'Normal', 'rovoko' ),
			]
		);
		$this->add_control(
			'readmore-bg',
			[
				'label'     => esc_html__( 'Background Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .rovoko-project-wrapper .readmore a' => 'background-color: {{VALUE}};' ],
				'condition' => [ 'readmore_type' => 'fill' ]
			]
		);
		$this->add_control(
			'readmore-border',
			[
				'label'     => esc_html__( 'Border Color', 'rovoko' ),
				'type'      => 'color',
				'selectors' => [ '{{WRAPPER}} .rovoko-project-wrapper .readmore a.outline' => 'border-color: {{VALUE}};' ],
				'condition' => [ 'readmore_type' => 'outline' ]
			]
		);

		$this->add_control(
			'readmore-color',
			[
				'label'     => esc_html__( 'Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .rovoko-project-wrapper .readmore a' => 'color: {{VALUE}};' ]
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
			'readmore-hover-border',
			[
				'label'     => esc_html__( 'Border Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-project-wrapper .readmore a.outline:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 'readmore_type' => 'outline' ]
			]
		);
		$this->add_control(
			'readmore-hover-bg',
			[
				'label'     => esc_html__( 'Background Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-project-wrapper .readmore a:hover' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'readmore-color-hover',
			[
				'label'     => esc_html__( 'Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-project-wrapper .readmore a:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		/*** End Tabs Wrap ***/
		/*-- Readmore  icon --*/
		$this->add_control(
			'readmore-icon_style',
			[
				'label'     => esc_html__( 'Read More Icon', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before',
				'condition' => [
					'readmore'       => 'yes',
					'project_layout' => [ 'masonry-3' ]
				],
			]
		);
		/*** Start Tabs Wrap ***/
		$this->start_controls_tabs( 'tabs_readmore-icon_style', [
			'condition' => [
				'readmore'       => 'yes',
				'project_layout' => [ 'masonry-3' ]
			]
		] );
		$this->start_controls_tab(
			'readmore-icon-nomal-tab',
			[
				'label' => esc_html__( 'Normal', 'rovoko' ),
			]
		);
		$this->add_control(
			'readmore-icon-bg',
			[
				'label'     => esc_html__( 'Background Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .rovoko-project-wrapper .readmore-icon-2' => 'background-color: {{VALUE}};' ],
			]
		);

		$this->add_control(
			'readmore-icon-color',
			[
				'label'     => esc_html__( 'Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .rovoko-project-wrapper .readmore-icon-2' => 'color: {{VALUE}};' ]
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'readmore-icon-hover-tab',
			[
				'label' => esc_html__( 'Hover', 'rovoko' ),
			]
		);
		$this->add_control(
			'readmore-icon-hover-bg',
			[
				'label'     => esc_html__( 'Background Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-project-wrapper .readmore-icon-2:hover' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'readmore-icon-color-hover',
			[
				'label'     => esc_html__( 'Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rovoko-project-wrapper .readmore-icon-2:hover' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .rovoko-project-wrapper .view-all-btn' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'viewall_typography',
				'selector'  => '{{WRAPPER}} .rovoko-project-wrapper .view-all-btn a',
				'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
				'condition' => [
					'view_all_btn' => 'yes',
				],
			]
		);
		/*** Start Tabs Wrap ***/
		$this->start_controls_tabs( 'tabs_viewall_style', [
			'condition' => [
				'view_all_btn' => 'yes',
			]
		] );
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
				'selectors' => [ '{{WRAPPER}} .rovoko-project-wrapper .view-all-btn a' => 'background-color: {{VALUE}};' ],
				'condition' => [ 'btn_style' => 'fill' ]
			]
		);
		$this->add_control(
			'viewall-border',
			[
				'label'     => esc_html__( 'Border Color', 'rovoko' ),
				'type'      => 'color',
				'selectors' => [ '{{WRAPPER}} .rovoko-project-wrapper .view-all-btn a.outline' => 'border-color: {{VALUE}};' ],
				'condition' => [ 'btn_style' => 'outline' ]
			]
		);

		$this->add_control(
			'viewall-color',
			[
				'label'     => esc_html__( 'Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .rovoko-project-wrapper .view-all-btn a' => 'color: {{VALUE}};' ]
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
					'{{WRAPPER}} .rovoko-project-wrapper .view-all-btn a.outline:hover' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .rovoko-project-wrapper .view-all-btn a:hover' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .rovoko-project-wrapper .view-all-btn a:hover' => 'color: {{VALUE}};',
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
			'taxonomy'   => 'project_cat',
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
		$args           = $this->rovoko_project_query( $settings );
		$projects       = $wp_query = new \WP_Query( $args );
		$project_layout = ! Utils::is_empty( $settings['project_layout'] ) ? $settings['project_layout'] : 'masonry';
		$this->add_render_attribute( 'wrapper', [
			'class' => array( 'rovoko-project-wrapper', 'ef5-posts', 'archive-project', 'layout-' . $project_layout ),
			'id'    => 'project-' . $project_layout . '-' . $this->get_id(),
		] );
		// Masonry
		$originLeft   = is_rtl() ? 'false' : 'true';
		$masonry_opts = array(
			'itemSelector'    => '.ef5-masonry-item',
			'columnWidth'     => '.ef5-masonry-sizer',
			'gutter'          => '.ef5-masonry-gutter',
			'percentPosition' => true,
			'horizontalOrder' => true,
		);
		$this->add_render_attribute( 'projects-row', [
			'class'           => [ 'projects', 'row', 'ef5-posts-masonry', 'ef5-masonry' ],
			'data-masonry'    => json_encode( $masonry_opts ),
			'data-originleft' => $originLeft
		] );
		$this->add_render_attribute( 'project-filters', 'class', array( 'ef5-filters', 'ef5-masonry-filters' ) );
		// Filters
		$this->rovoko_project_masonry_filters( $settings );
		if ( $projects->have_posts() ) :?>
            <div <?php echo '' . $this->get_render_attribute_string( 'wrapper' ); ?>>
                <div <?php echo '' . $this->get_render_attribute_string( 'projects-row' ); ?>>
					<?php if ( $settings['project_layout'] == 'masonry' || $settings['project_layout'] == 'masonry-2' || $settings['project_layout'] == 'masonry-3' ) : ?>
                        <div class="ef5-masonry-sizer"></div>
                        <div class="ef5-masonry-gutter"></div>
					<?php endif; ?>
					<?php while ( $projects->have_posts() ) :
						$projects->the_post();
						$filter_class = rovoko_get_taxo_slug_as_css_class( [ 'taxo' => 'project_cat' ] );
						if ( $settings['project_layout'] == 'masonry' ):?>
                            <div class="project masonry ef5-masonry-item col-auto ef5-grid-item ef5-hover-wrap hoverdir-wrap fade-in <?php echo esc_attr( $filter_class ); ?> ">
								<?php $this->rovoko_project_masonry_first_layout( $settings ); ?>
                            </div>
						<?php elseif ( $settings['project_layout'] == 'masonry-2' ): ?>
                            <div class="col-12 project masonry-2 ef5-masonry-item ef5-grid-item ef5-hover-wrap hoverdir-wrap zoom-in ef5-list ef5-archive mb-lg-50 <?php echo esc_attr( $filter_class ); ?> ">
								<?php $this->rovoko_project_masonry_second_layout( $settings ); ?>
                            </div>
						<?php elseif ( $settings['project_layout'] == 'masonry-3' ): ?>
                            <div class="project masonry-3 ef5-masonry-item col-auto ef5-grid-item ef5-hover-wrap hoverdir-wrap fade-in <?php echo esc_attr( $filter_class ); ?> ">
								<?php $this->rovoko_project_masonry_three_layout( $settings ); ?>
                            </div>
						<?php
						endif;
					endwhile; ?>
                </div>
				<?php $this->rovoko_view_all_project( $settings );
				wp_reset_query(); ?>
            </div>
		<?php endif;
	}

	private function rovoko_project_query( $settings = [] ) {
		global $paged;
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
		$args = array(
			'post_type'      => 'project',
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
					'taxonomy'         => 'project_cat',
					'field'            => 'slug',
					'terms'            => $settings['include_cat'],
					'include_children' => false,
					'operator'         => 'IN'
				);
			}
			if ( ! Utils::is_empty( $settings['exclude_cat'] ) ) {
				$args['tax_query'][] = array(
					'taxonomy'         => 'project_cat',
					'field'            => 'slug',
					'terms'            => $settings['exclude_cat'],
					'include_children' => false,
					'operator'         => 'NOT IN'
				);
			}
		}

		return $args;
	}

	private function rovoko_project_masonry_filters( $settings ) {
		if ( ! Utils::is_empty( $settings['masonry-filters'] ) && $settings['masonry-filters'] == 'yes' ) :
			$filters = $this->rovoko_get_taxo_array( true );
			if ( ! Utils::is_empty( $settings['include_cat'] ) ):
				$filters = $settings['include_cat'];
			endif;
			if ( ! Utils::is_empty( $settings['exclude_cat'] ) ):
				$filters = array_diff( $filters, $settings['exclude_cat'] );
			endif;
			if ( ! empty( $filters ) ):
				$filter_align = ! Utils::is_empty( $settings['filter_align'] ) ? $settings['filter_align'] : 'center';
				$allitem      = ! Utils::is_empty( $settings['all_categories'] ) ? $settings['all_categories'] : esc_html__( 'All Categories', 'rovoko' );
				printf( '<div class="ef5-filters ef5-masonry-filters d-flex justify-content-%1$s filter-%2$s">', $filter_align, $settings['filters-type'] );
				printf( '<div class="filter-item active" data-filter="*"> <span>%1$s</span></div>', $allitem );
				foreach ( $filters as $filter ) {
					$term = get_term_by( 'slug', $filter, 'project_cat', ARRAY_A );
					printf( '<div class="filter-item" data-filter=".%1$s"> <span>%2$s</span></div>', $term['slug'], $term['name'] );
				}
				printf( '</div>' );
			endif;
		endif;
	}

	private function rovoko_project_masonry_first_layout( $settings, $img_size = '324x456' ) {
		$before_image = '';
		if ( ! Utils::is_empty( $settings['thumbnail_size'] ) && $settings['custom-images'] == 'yes' ) {
			$img_size = $settings['thumbnail_size'];
		}
		if ( ! Utils::is_empty( $settings['readmore'] ) && $settings['readmore'] == 'yes' ) {
			$before_image = sprintf( '<div class="readmore-icon"><span class="berore-icon"></span><a href="' . esc_url( get_permalink() ) . '"></a><span class="after-icon"></span></div>' );
		}
		rovoko_post_media( [
			'thumbnail_size' => $img_size,
			'has_hook'       => false,
			'before'         => $before_image
		] );
		if ( ! Utils::is_empty( $settings['title'] ) && $settings['title'] == 'yes' ) {
			rovoko_post_header( [
				'heading_tag' => $settings['title_tag'],
				'title_link'  => true
			] );
		}
		if ( ! Utils::is_empty( $settings['tag'] ) && $settings['tag'] == 'yes' ) {
			rovoko_tagged_in( [ 'before_tag' => '' ] );
		}
	}

	private function rovoko_project_masonry_second_layout( $settings, $img_size = 'medium' ) {
		?>
        <div class="row gutter-50">
			<?php
			if ( ! Utils::is_empty( $settings['thumbnail_size'] ) && $settings['custom-images'] == 'yes' ) {
				$img_size = $settings['thumbnail_size'];
			}
			rovoko_post_media( [
				'thumbnail_size' => $img_size,
				'class'          => 'col-12 col-lg-50/41',
				'has_hook'       => false
			] );
			?>
            <div class="ef5-loop-info col-12 col-lg-49/59"><?php
				if ( ! Utils::is_empty( $settings['tag'] ) && $settings['tag'] == 'yes' ) {
					rovoko_tagged_in( [ 'before_tag' => '' ] );
				}
				if ( ! Utils::is_empty( $settings['title'] ) && $settings['title'] == 'yes' ) {
					rovoko_post_header( [
						'class'       => 'loop ef5-loop-header',
						'heading_tag' => $settings['title_tag'],
						'title_link'  => true
					] );
				}
				if ( ! Utils::is_empty( $settings['excerpt'] ) && $settings['excerpt'] == 'yes' && ! empty( get_the_excerpt() ) ) {
					rovoko_post_excerpt( [
						'class'  => 'mt-lg-25',
						'length' => ! empty( $settings['excerpt_length'] ) ? $settings['excerpt_length'] : 50
					] );
				}
				if ( ! Utils::is_empty( $settings['readmore'] ) && $settings['readmore'] == 'yes' ) {
					printf( '<div class="readmore mt-xl-50"><a href="%1$s" class="ef5-btn primary boxshadow %2$s">%3$s</a></div>', esc_url( get_permalink() ), $settings['readmore_type'], esc_html__( 'View More', 'rovoko' ) );
				}
				?>
            </div>
        </div>
		<?php
	}

	private function rovoko_project_masonry_three_layout( $settings, $img_size = '384x409' ) {
		$projetc_meta = '';
		if ( $settings['title'] == 'yes' || $settings['readmore'] == 'yes' || $settings['tag'] == 'yes' ) {
			$projetc_meta .= '<div class="project-meta">';
			if ( ! Utils::is_empty( $settings['tag'] ) && $settings['tag'] == 'yes' ) {
				$projetc_meta .= rovoko_tagged_in( [
					'before_tag' => '',
					'sep'        => '<span> / </span>',
					'echo'       => false
				] );
			}
			if ( ! Utils::is_empty( $settings['title'] ) && $settings['title'] == 'yes' ) {
				$projetc_meta .= sprintf( '<div class="ef5-post-header"><div class="ef5-heading %1$s"><a href="%2$s" rel="bookmark">%3$s</a></div></div>', $settings['title_tag'], esc_url( get_permalink() ), get_the_title() );
			}
			if ( ! Utils::is_empty( $settings['readmore'] ) && $settings['readmore'] == 'yes' ) {
				$projetc_meta .= sprintf( '<a href="%1$s"  class="readmore-icon-2 ef5-btn primary fill"><i class="flaticon-add"></i></a>', esc_url( get_permalink() ) );
			}
			$projetc_meta .= '</div>';
		}
		if ( ! Utils::is_empty( $settings['thumbnail_size'] ) && $settings['custom-images'] == 'yes' ) {
			$img_size = $settings['thumbnail_size'];
		}
		rovoko_post_media( [
			'thumbnail_size' => $img_size,
			'has_hook'       => false,
			'after'          => $projetc_meta
		] );
	}

	private function rovoko_view_all_project( $settings = array() ) {
		$this->add_render_attribute( 'view-all', 'class', array( 'ef5-btn', 'primary', 'boxshadow' ) );
		$this->add_render_attribute( 'btn-wrapper', 'class', array( 'view-all-btn' ) );
		if ( ! Utils::is_empty( $settings['btn-css'] ) ) {
			$this->add_render_attribute( 'btn-wrapper', 'class', trim( $settings['btn-css'] ) );
		}
		if ( ! Utils::is_empty( $settings['view_all_btn'] ) && $settings['view_all_btn'] == 'yes' && ! empty( get_next_posts_link() ) ) :
			$view_all_text = ! Utils::is_empty( $settings['view_all_text'] ) ? $settings['view_all_text'] : esc_html__( 'Load More', 'rovoko' );
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

Plugin::instance()->widgets_manager->register_widget_type( new Rovoko_Project_Masonry() );