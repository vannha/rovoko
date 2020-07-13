<?php
/**
 * Rovoko Alert Module
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Reoko_Widget_Alert extends Widget_Base {

	public function get_name() {
		return 'rovoko_alert';
	}

	public function get_title() {
		return esc_html__( '[Rovoko] Alert', 'rovoko' );
	}

	public function get_icon() {
		return 'rovoko-icon eicon-alert';
	}

	public function get_categories() {
		return [ 'rovoko-elements' ];
	}

	public function get_script_depends() {
		return [ 'imagesloaded' ];
	}

	public function get_keywords() {
		return [ 'rovoko', 'alert', 'notice', 'message' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_alert',
			[
				'label' => esc_html__( 'Alert', 'rovoko' ),
			]
		);
		$this->add_control(
			'alert-circle',
			[
				'label'   => esc_html__( 'Alert icon', 'rovoko' ),
				'type'    => 'select',
				'options' => [
					''    => esc_html__( 'None', 'rovoko' ),
					'yes' => esc_html__( 'Text', 'rovoko' ),
					'no'  => esc_html__( 'Icon', 'rovoko' ),
				],
				'default' => 'no',
			]
		);
		$this->add_control(
			'number',
			[
				'label'     => esc_html__( 'Text', 'rovoko' ),
				'type'      => 'text',
				'condition' => [
					'alert-circle' => 'yes',
				],
			]
		);
		$this->add_control(
			'icon',
			[
				'label'     => esc_html__( 'Choose icon', 'rovoko' ),
				'type'      => 'icons',
				'default'   => [
					'value'   => 'fal fa-check',
					'library' => 'light',
				],
				'condition' => [
					'alert-circle' => 'no',
				],
			]
		);
		$this->add_control(
			'alert_title',
			[
				'label'       => esc_html__( 'Title & Description', 'rovoko' ),
				'type'        => 'text',
				'placeholder' => esc_html__( 'Enter your title', 'rovoko' ),
				'default'     => esc_html__( 'This is an Alert', 'rovoko' ),
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'alert_description',
			[
				'label'       => esc_html__( 'Content', 'rovoko' ),
				'type'        => 'textarea',
				'placeholder' => esc_html__( 'Enter your description', 'rovoko' ),
				'default'     => esc_html__( 'I am a description. Click the edit button to change this text.', 'rovoko' ),
				'separator'   => 'none',
				'show_label'  => false,
				'dynamic'     => [
					'active' => true,
				],
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
				'default' => 'h4',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_type',
			[
				'label' => esc_html__( 'Alert', 'rovoko' ),
				'tab'   => 'style',
			]
		);
		/*Icon Style*/
		$this->add_control(
			'icon_style',
			[
				'label'     => esc_html__( 'Icon', 'rovoko' ),
				'type'      => 'heading',
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
					'{{WRAPPER}} .reovko-alert .alert-icon .icon' => 'font-size: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'icon-padding',
			[
				'label'     => esc_html__( 'Padding', 'rovoko' ),
				'type'      => 'slider',
				'selectors' => [
					'{{WRAPPER}} .reovko-alert .alert-icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'range'     => [
					'em' => [
						'min' => 0,
						'max' => 5,
					],
				]

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
					'{{WRAPPER}} .reovko-alert .alert-icon .icon' => 'transform: rotate({{SIZE}}{{UNIT}});',
				]
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
					'{{WRAPPER}} .reovko-alert .alert-icon' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		/*** Start Tabs Wrap ***/
		$this->start_controls_tabs( 'tabs_icon_style' );
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
				'selectors' => [ '{{WRAPPER}} .reovko-alert .alert-icon' => 'background-color: {{VALUE}};' ],
			]
		);

		$this->add_control(
			'icon-color',
			[
				'label'     => esc_html__( 'Icon Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .reovko-alert .alert-icon .icon' => 'color: {{VALUE}};' ]
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
				'selectors' => [ '{{WRAPPER}} .reovko-alert:hover .alert-icon' => 'background-color: {{VALUE}};' ]
			]
		);
		$this->add_control(
			'icon-color-hover',
			[
				'label'     => esc_html__( 'Icon Color', 'rovoko' ),
				'type'      => 'color',
				'default'   => '',
				'selectors' => [ '{{WRAPPER}} .reovko-alert:hover .alert-icon .icon' => 'color: {{VALUE}};' ]
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
		$this->add_responsive_control(
			'title_spacing',
			[
				'label'      => esc_html__( 'Spacing', 'rovoko' ),
				'type'       => 'slider',
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .reovko-alert .alert-conetnt' => 'margin-left:calc({{SIZE}}{{UNIT}} / 2);',
					'{{WRAPPER}} .reovko-alert .alert-icon'    => 'margin-right:calc({{SIZE}}{{UNIT}} / 2);',
				]
			]
		);
		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Text Color', 'rovoko' ),
				'type'      => 'color',
				'selectors' => [
					'{{WRAPPER}} .reovko-alert-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'alert_title',
				'selector' => '{{WRAPPER}} .reovko-alert-title',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			]
		);
		/*Description Style*/
		$this->add_control(
			'description_style',
			[
				'label'     => esc_html__( 'Description', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'description_color',
			[
				'label'     => esc_html__( 'Text Color', 'rovoko' ),
				'type'      => 'color',
				'selectors' => [
					'{{WRAPPER}} .reovko-alert-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'alert_description',
				'selector' => '{{WRAPPER}} .reovko-alert-description',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( Utils::is_empty( $settings['alert_title'] ) && Utils::is_empty( $settings['alert_description'] ) ) {
			return;
		}
		$this->add_render_attribute( 'wrapper', 'class', 'reovko-alert' );
		$this->add_render_attribute( 'wrapper', [ 'role' => 'alert', 'class' => 'd-flex' ] );
		$this->add_render_attribute( 'alert_title', 'class', 'reovko-alert-title' );
		$this->add_render_attribute( 'alert-circle', 'class', 'icon' );

		$this->add_inline_editing_attributes( 'alert_title', 'none' );
		?>
        <div <?php echo '' . $this->get_render_attribute_string( 'wrapper' ); ?>>
			<?php
			if ( ! Utils::is_empty( $settings['alert-circle'] ) ):
				if ( $settings['alert-circle'] == 'no' && ! empty( $settings['icon']['value'] ) ) :
					$this->add_render_attribute( 'alert-circle', 'class', [ $settings['icon']['value'] ] );
					printf( '<div class="alert-icon"><i %1$s></i></div>', $this->get_render_attribute_string( 'alert-circle' ) );
                elseif ( $settings['alert-circle'] == 'yes' && ! Utils::is_empty( $settings['number'] ) ):
					$this->add_render_attribute( 'alert-circle', 'class', 'text' );
					printf( '<div class="alert-icon"><span %1$s>%2$s</span></div>', $this->get_render_attribute_string( 'alert-circle' ), $settings['number'] );
				endif;
			endif; ?>

            <div class="alert-conetnt">
				<?php if ( ! Utils::is_empty( $settings['alert_title'] ) ) :
					printf( '<%1$s %2$s>%3$s</%1$s>', $settings['title_tag'], $this->get_render_attribute_string( 'alert_title' ), esc_html( $settings['alert_title'] ) );
				endif; ?>
				<?php
				if ( ! Utils::is_empty( $settings['alert_description'] ) ) :
					$this->add_render_attribute( 'alert_description', 'class', 'reovko-alert-description' );
					$this->add_inline_editing_attributes( 'alert_description' );
					printf( '<p %1$s>%2$s</p>', $this->get_render_attribute_string( 'alert_description' ), esc_textarea( $settings['alert_description'] ) );
					?>
				<?php endif; ?>
            </div>
        </div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Reoko_Widget_Alert() );