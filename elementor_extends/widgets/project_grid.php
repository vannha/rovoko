<?php
/**
 * Project Grid Module
 */

namespace Elementor;
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Rovoko_Project_Grid extends Widget_Base {
	public function get_name() {
		return 'rovoko_project_grid';
	}

	public function get_title() {
		return esc_html__( '[Rovoko] Project Grid', 'rovoko' );
	}

	public function get_icon() {
		return 'rovoko-icon eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'rovoko-elements' ];
	}

	public function get_script_depends() {
		return [ 'imagesloaded', 'rovoko-projetc-grid' ];
	}

	public function get_keywords() {
		return [ 'rovoko', 'project', 'grid' ];
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
				'default' => 'grid',
				'options' => [
					'grid'   => [
						'label' => esc_html__( 'Grid', 'rovoko' ),
						'image' => get_template_directory_uri() . '/assets/images/elementor/project-layout.jpg'
					],
					'grid-2' => [
						'label' => esc_html__( 'Grid 02', 'rovoko' ),
						'image' => get_template_directory_uri() . '/assets/images/elementor/project-layout-5.jpg'
					],
					'grid-3' => [
						'label' => esc_html__( 'Grid 03', 'rovoko' ),
						'image' => get_template_directory_uri() . '/assets/images/elementor/project-layout-6.jpg'
					]
				],
			]
		);
		$this->end_controls_section();
		/**************** Start Content Control Tab ****************/
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Project Grid', 'rovoko' ),
				'tab'   => 'content',
			]
		);
		$this->add_control(
			'count',
			[
				'label'       => esc_html__( 'Posts Per Page', 'rovoko' ),
				'description' => esc_html__( 'You can enter "-1" to display all posts.', 'rovoko' ),
				'type'        => 'text',
				'default'     => '7',
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
			'project_meta',
			[
				'label'     => esc_html__( 'Project Meta', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before',
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
			'tag',
			[
				'label'   => esc_html__( 'Display Tag', 'rovoko' ),
				'type'    => 'switcher',
				'default' => 'no',
			]
		);

		$this->add_control(
			'view_all',
			[
				'label'     => esc_html__( 'View more projects', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'view_all_btn',
			[
				'label'   => esc_html__( 'Display view more', 'rovoko' ),
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
					'view_all_btn' => 'yes'
				],
			]
		);
		$this->add_control(
			'view_all_text',
			[
				'label'       => esc_html__( 'Button text', 'rovoko' ),
				'type'        => 'text',
				'default'     => esc_html__( 'View More', 'rovoko' ),
				'placeholder' => esc_html__( 'View More', 'rovoko' ),
				'condition'   => [
					'view_all_btn' => 'yes'
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
		/*-- Readmore icon --*/
		$this->add_control(
			'readmore-icon_style',
			[
				'label'     => esc_html__( 'Read More Icon', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before',
				'condition' => [
					'readmore'       => 'yes',
					'project_layout' => [ 'grid-2' ]
				],
			]
		);
		/*** Start Tabs Wrap ***/
		$this->start_controls_tabs( 'tabs_readmore-icon_style', [
			'condition' => [
				'readmore'       => 'yes',
				'project_layout' => [ 'grid-2' ]
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
					'view_all_btn' => 'yes'
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
					'view_all_btn' => 'yes'
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
					'view_all_btn' => 'yes'
				],
			]
		);
		/*** Start Tabs Wrap ***/
		$this->start_controls_tabs( 'tabs_viewall_style', [
			'condition' => [
				'view_all_btn' => 'yes'
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
		$vars     = array(
			'count'      => 1,
			'grid_01_2n' => 2,
			'grid_01_3n' => 3,
			'grid_03_2n' => 2,
			'grid_03_3n' => 3,
			'grid_03_4n' => 4,
			'grid_03_5n' => 5
		);
		global $wp_query;
		$args           = $this->rovoko_project_query( $settings );
		$projects       = $wp_query = new \WP_Query( $args );
		$project_layout = ! Utils::is_empty( $settings['project_layout'] ) ? $settings['project_layout'] : 'grid';
		$this->add_render_attribute( [
			'wrapper'        => [
				'class' => [ 'rovoko-project-wrapper', 'ef5-posts', 'archive-project', 'layout-' . $project_layout ],
				'id'    => 'project-' . $project_layout . '-' . $this->get_id(),
			],
			'projects-row'   => [ 'class' => [ 'projects', 'row' ] ],
			'projects-col'   => [ 'class' => [ 'project', $project_layout ] ],
			'projects-colx2' => [ 'class' => [ 'project', $project_layout ] ]
		] );

		if ( $settings['project_layout'] == 'grid' ) :
			$this->add_render_attribute( [
				'projects-row'   => [ 'class' => 'gutter-lg-60' ],
				'projects-col'   => [ 'class' => [ 'col-12', 'col-md-4' ] ],
				'projects-colx2' => [ 'class' => [ 'col-12', 'col-md-8' ] ],
			] );
        elseif ( $settings['project_layout'] == 'grid-2' ) :
			$this->add_render_attribute( [
				'projects-col' => [ 'class' => 'col-12' ]
			] );
        elseif ( $settings['project_layout'] == 'grid-3' ) :
			$this->add_render_attribute( [
				'projects-row' => [ 'class' => 'gutter-lg-40' ],
				'projects-col' => [ 'class' => [ 'col-12', 'col-md-6' ] ],
			] );
		endif;
		if ( $projects->have_posts() ) :
			$last_item = ( $settings['count'] < $projects->found_posts ) ? $settings['count'] : $projects->found_posts;
			?>
            <div <?php echo '' . $this->get_render_attribute_string( 'wrapper' ); ?>>
                <div <?php echo '' . $this->get_render_attribute_string( 'projects-row' ); ?>>
					<?php while ( $projects->have_posts() ) :
						$projects->the_post();
						if ( $settings['project_layout'] == 'grid' ):
							// Grid
							if ( $vars['count'] == 2 || $vars['count'] - $vars['grid_01_2n'] == 7 ):
								$vars['grid_01_2n'] = $vars['count']; ?>
                                <div <?php echo '' . $this->get_render_attribute_string( 'projects-colx2' ); ?>>
									<?php $this->rovoko_project_grid_first_layout( $settings, '760x460' ); ?>
                                </div>
							<?php elseif ( $vars['count'] == 3 || $vars['count'] - $vars['grid_01_3n'] == 7 ):
								$vars['grid_01_3n'] = $vars['count']; ?>
                                <div <?php echo '' . $this->get_render_attribute_string( 'projects-colx2' ); ?>>
									<?php $this->rovoko_project_grid_first_layout( $settings, '760x460' ); ?>
                                </div>
							<?php else: ?>
                                <div <?php echo '' . $this->get_render_attribute_string( 'projects-col' ); ?>>
									<?php $this->rovoko_project_grid_first_layout( $settings, '350x460' ); ?>
                                </div>
							<?php
							endif;
                        elseif ( $settings['project_layout'] == 'grid-2' ): ?>
                            <div <?php echo '' . $this->get_render_attribute_string( 'projects-col' ); ?>>
								<?php $this->rovoko_project_grid_second_layout( $settings ); ?>
                            </div>
						<?php
                        elseif ( $settings['project_layout'] == 'grid-3' ):
							if ( $vars['count'] == 2 || $vars['count'] == 3 || $vars['count'] == 4 || $vars['count'] == 5 || $vars['count'] - $vars['grid_03_2n'] == 7 || $vars['count'] - $vars['grid_03_3n'] == 7 || $vars['count'] - $vars['grid_03_4n'] == 7 || $vars['count'] - $vars['grid_03_5n'] == 7 ): ?>
								<?php if ( $vars['count'] == 2 || $vars['count'] - $vars['grid_03_2n'] == 7 ) : ?>
                                    <div <?php echo '' . $this->get_render_attribute_string( 'projects-col' ); ?>>
                                    <!--Start small row-->
                                    <div class="row gutter-lg-40 col-project-small">
								<?php endif; ?>
                                <div <?php echo '' . $this->get_render_attribute_string( 'projects-col' ); ?>>
									<?php $this->rovoko_project_grid_three_layout( $settings ); ?>
                                </div>
								<?php
								if ( $vars['count'] == 5 || $vars['count'] - $vars['grid_03_5n'] == 7 || $last_item == $vars['count'] ) : ?>
                                    </div>
                                    <!--End small row-->
                                    </div>
								<?php endif; ?>
								<?php
								if ( $vars['count'] - $vars['grid_03_2n'] == 7 ) {
									$vars['grid_03_2n'] = $vars['count'];
								}
								if ( $vars['count'] - $vars['grid_03_3n'] == 7 ) {
									$vars['grid_03_3n'] = $vars['count'];
								}
								if ( $vars['count'] - $vars['grid_03_4n'] == 7 ) {
									$vars['grid_03_4n'] = $vars['count'];
								}
								if ( $vars['count'] - $vars['grid_03_5n'] == 7 ) {
									$vars['grid_03_5n'] = $vars['count'];
								}
								?>
							<?php else: ?>
                                <div <?php echo '' . $this->get_render_attribute_string( 'projects-col' ); ?>>
									<?php $this->rovoko_project_grid_three_layout( $settings ); ?>
                                </div>
							<?php endif; ?>
						<?php
						endif;
						$vars['count'] ++;
					endwhile;
					?>
                </div>
				<?php $this->rovoko_view_all_project( $settings );
				wp_reset_query();
				?>
            </div>
		<?php else:
			sprintf( '<p>%1$s</p>', esc_html__( 'Sorry, no posts matched your criteria.', 'rovoko' ) );
		endif;
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

	private function rovoko_project_grid_first_layout( $settings, $img_size = 'full' ) {
		$before_image = '';
		if ( ! Utils::is_empty( $settings['readmore'] ) && $settings['readmore'] == 'yes' ) {
			$before_image = sprintf( '<div class="readmore-icon"><span class="berore-icon"></span><a href="' . esc_url( get_permalink() ) . '"></a><span class="after-icon"></span></div>' );
		}
		rovoko_post_media( [ 'thumbnail_size' => $img_size, 'has_hook' => false, 'before' => $before_image ] );
		if ( ! Utils::is_empty( $settings['title'] ) && $settings['title'] == 'yes' ) {
			rovoko_post_header( [
				'heading_tag' => $settings['title_tag'],
				'title_link'  => true
			] );
		}
		if ( ! Utils::is_empty( $settings['tag'] ) && $settings['tag'] == 'yes' ) {
			rovoko_tagged_in( [ 'before_tag' => '', 'hint' => '' ] );
		}
	}

	private function rovoko_project_grid_second_layout( $settings ) {
		$projetc_meta = $class = '';
		if ( $settings['title'] == 'yes' || $settings['readmore'] == 'yes' || $settings['tag'] == 'yes' ) {
			if ( $settings['readmore'] == 'yes' ) {
				$class = 'meta-has-readmore';
			}
			$projetc_meta .= '<div class="project-meta ' . esc_attr( $class ) . '">';
			$projetc_meta .= '<div class="container">';
			$projetc_meta .= '<div class="row">';
			$projetc_meta .= '<div class="col-12 col-lg-6">';
			if ( ! Utils::is_empty( $settings['tag'] ) && $settings['tag'] == 'yes' ) {
				$projetc_meta .= rovoko_tagged_in( [
					'before_tag' => '',
					'hint'       => '',
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
			$projetc_meta .= '</div>';
			$projetc_meta .= '</div>';
			$projetc_meta .= '</div>';
		}
		rovoko_post_media( [
			'thumbnail_size' => 'full',
			'has_hook'       => false,
			'after'          => $projetc_meta
		] );
	}

	private function rovoko_project_grid_three_layout( $settings, $image_size = '650x650') { 
		$projetc_meta = '';
		if ( $settings['title'] == 'yes' || $settings['readmore'] == 'yes' || $settings['tag'] == 'yes' ) {

			$projetc_meta .= '<div class="project-meta">';
			if ( ! Utils::is_empty( $settings['tag'] ) && $settings['tag'] == 'yes' ) {
				$projetc_meta .= rovoko_tagged_in( [
					'before_tag' => '',
					'hint'       => '',
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
		rovoko_post_media( [
			'thumbnail_size' => $image_size,//395x395
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

Plugin::instance()->widgets_manager->register_widget_type( new Rovoko_Project_Grid() );