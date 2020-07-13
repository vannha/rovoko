<?php
/**
 * Google Map Module
 */

namespace Elementor;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Rovoko_Progress_Widget extends Widget_Base {

	public function get_name() {
		return 'rovoko_progress';
	}

	public function get_title() {
		return esc_html__( '[Rovoko] Progress', 'rovoko' );
	}

	public function get_icon() {
		return 'rovoko-icon eicon-skill-bar';
	}

	public function get_categories() {
		return [ 'rovoko-elements' ];
	}

	public function get_script_depends() {
		return [ 'imagesloaded', 'elementor-waypoints', 'rovoko-progress' ];
	}

	public function get_keywords() {
		return [ 'rovoko', 'progress', 'bar' ];
	}

	protected function _register_controls() {
		/**************** Start Content Control Tab ****************/
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Progress', 'rovoko' ),
				'tab'   => 'content',
			]
		);
		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'rovoko' ),
				'type'        => 'text',
				'placeholder' => esc_html__( 'Enter your title', 'rovoko' ),
				'default'     => esc_html__( 'My Skill', 'rovoko' ),
				'label_block' => true,
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
				'default' => 'div',
			]
		);
		$this->add_control(
			'percent',
			[
				'label'   => esc_html__( 'Percentage', 'rovoko' ),
				'type'    => 'slider',
				'default' => [
					'size' => 50,
					'unit' => '%',
				]
			]
		);
		$this->add_control( 'display_percentage', [
			'label'   => esc_html__( 'Display Percentage', 'rovoko' ),
			'type'    => 'switcher',
			'default' => 'yes',
		] );
		$this->end_controls_section();

		$this->start_controls_section(
			'section_progress_style',
			[
				'label' => esc_html__( 'Progress Bar', 'rovoko' ),
				'tab'   => 'style',
			]
		);
		$this->add_control(
			'bar_color',
			[
				'label'     => esc_html__( 'Color', 'rovoko' ),
				'type'      => 'color',
				'selectors' => [
					'{{WRAPPER}} .rovoko-progress-wrapper .rovoko-progress-bar' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'circle_color',
			[
				'label'     => esc_html__( 'Circle color', 'rovoko' ),
				'type'      => 'color',
				'selectors' => [
					'{{WRAPPER}} .rovoko-progress-wrapper .rovoko-progress-bar .progress-point' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'bar_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'rovoko' ),
				'type'      => 'color',
				'selectors' => [
					'{{WRAPPER}} .rovoko-progress-wrapper .progress-content' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'bar_height',
			[
				'label'     => esc_html__( 'Height', 'rovoko' ),
				'type'      => 'slider',
				'range'     => [
					'px' => [
						'min' => 1,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rovoko-progress-wrapper .rovoko-progress-bar'                 => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rovoko-progress-wrapper .rovoko-progress-bar .progress-point' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'bar_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'rovoko' ),
				'type'       => 'slider',
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rovoko-progress-wrapper .progress-content'                      => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rovoko-progress-wrapper .progress-content .rovoko-progress-bar' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_heading',
			[
				'label'     => esc_html__( 'Title', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_align',
			[
				'label'     => esc_html__( 'Alignment', 'rovoko' ),
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
					'{{WRAPPER}} .rovoko-progress-wrapper .rovoko-progress-title' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Text Color', 'rovoko' ),
				'type'      => 'color',
				'selectors' => [
					'{{WRAPPER}} .rovoko-progress-wrapper .rovoko-progress-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'selector' => '{{WRAPPER}} .rovoko-progress-wrapper .rovoko-progress-title',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
			]
		);
		$this->add_control(
			'percentage_heading',
			[
				'label'     => esc_html__( 'Inner Text', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'percentage_color',
			[
				'label'     => esc_html__( 'Color', 'rovoko' ),
				'type'      => 'color',
				'selectors' => [
					'{{WRAPPER}} .rovoko-progress-wrapper .rovoko-progress-percentage' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'percentage_typography',
				'selector' => '{{WRAPPER}} .rovoko-progress-wrapper .rovoko-progress-percentage',
				'exclude'  => [
					'line_height',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$progress_percentage = is_numeric( $settings['percent']['size'] ) ? $settings['percent']['size'] : '0';
		if ( 100 < $progress_percentage ) {
			$progress_percentage = 100;
		}

		$this->add_render_attribute( 'title', [
			'class' => 'rovoko-progress-title',
		] );

		$this->add_inline_editing_attributes( 'title' );

		$this->add_render_attribute( 'wrapper', [
			'class' => 'rovoko-progress-wrapper',
		] );
		$this->add_render_attribute( 'content', [
			'class'         => 'progress-content',
			'role'          => 'progressbar',
			'aria-valuemin' => '0',
			'aria-valuemax' => '100',
			'aria-valuenow' => $progress_percentage,
		] );
		if ( ! empty( $settings['progress_type'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'progress-' . $settings['progress_type'] );
		}

		$this->add_render_attribute( 'progress-bar', [
			'class'    => [ 'rovoko-progress-bar', 'd-flex' ],
			'data-max' => $progress_percentage,
			//'style'    => 'width:' . $progress_percentage . '%',
		] );

		?>
        <div <?php echo '' . $this->get_render_attribute_string( 'wrapper' ); ?>>
			<?php if ( ! Utils::is_empty( $settings['title'] ) ):
				printf( '<%1$s %2$s>%3$s</%1$s>', $settings['title_tag'], $this->get_render_attribute_string( 'title' ), $settings['title'] );
			endif; ?>
            <div class="d-flex flex-wrap align-items-center">
                <div <?php echo '' . $this->get_render_attribute_string( 'content' ); ?>>
                    <div <?php echo '' . $this->get_render_attribute_string( 'progress-bar' ); ?>>
                        <span class="progress-point"></span>
                    </div>
                </div>
				<?php if ( 'yes' == $settings['display_percentage'] ) { ?>
					<?php printf( '<span class="rovoko-progress-percentage">%1$s %2$s</span>', $progress_percentage, '%' ) ?>
				<?php } ?>
            </div>
        </div>
		<?php
	}
}


Plugin::instance()->widgets_manager->register_widget_type( new Rovoko_Progress_Widget() );