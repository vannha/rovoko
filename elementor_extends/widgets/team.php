<?php
/**
 * Alert Module
 */

namespace Elementor;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Rovoko_Team_Widget extends Widget_Base {

	public function get_name() {
		return 'rovoko_team';
	}

	public function get_title() {
		return esc_html__( '[Rovoko] Team', 'rovoko' );
	}

	public function get_icon() {
		return 'rovoko-icon eicon-testimonial-carousel';
	}

	public function get_categories() {
		return [ 'rovoko-elements' ];
	}

	public function get_script_depends() {
		return [ 'imagesloaded', 'owl-carousel', 'rovoko-team' ];
	}

	public function get_style_depends() {
		return [ 'owl-carousel', 'ef5-owl-carousel' ];
	}


	public function get_keywords() {
		return [ 'rovoko', 'team', 'carousel', 'slider' ];
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
			'team_layout',
			[
				'label'   => esc_html__( 'Layout', 'rovoko' ),
				'type'    => 'layoutcontrol',
				'default' => 'layout-2',
				'options' => [
					'layout-1' => [
						'label' => esc_html__( 'Layout 1', 'rovoko' ),
						'image' => get_template_directory_uri() . '/assets/images/elementor/team-layout.jpg'
					],
					'layout-2' => [
						'label' => esc_html__( 'Layout 2', 'rovoko' ),
						'image' => get_template_directory_uri() . '/assets/images/elementor/team-layout-2.jpg'
					]
				],
			]
		);
		$this->end_controls_section();
		/**************** Start Content Control Tab ****************/
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'rovoko' ),
				'tab'   => 'content',
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'rovoko' ),
				'type'  => 'media',
			]
		);
		$repeater->add_control(
			'name',
			[
				'label'       => esc_html__( 'Name', 'rovoko' ),
				'type'        => 'text',
				'placeholder' => esc_html__( 'Enter your name', 'rovoko' ),
			]
		);
		$repeater->add_control(
			'position',
			[
				'label'       => esc_html__( 'Position', 'rovoko' ),
				'type'        => 'text',
				'placeholder' => esc_html__( 'Enter your name', 'rovoko' ),
			]
		);
		/*Social items*/
		$repeater->add_control(
			'social-link',
			[
				'label'     => esc_html__( 'Social Link', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'facebook',
			[
				'label' => esc_html__( 'Facebook', 'rovoko' ),
				'type'  => 'text',
			]
		);
		$repeater->add_control(
			'twitter',
			[
				'label' => esc_html__( 'Twitter', 'rovoko' ),
				'type'  => 'text',
			]
		);
		$repeater->add_control(
			'youtube',
			[
				'label' => esc_html__( 'Youtube', 'rovoko' ),
				'type'  => 'text',
			]
		);
		$repeater->add_control(
			'linkedin',
			[
				'label' => esc_html__( 'Linkedin', 'rovoko' ),
				'type'  => 'text',
			]
		);
		$this->add_control(
			'teams',
			[
				'label'       => esc_html__( 'Teams', 'rovoko' ),
				'type'        => 'repeater',
				'fields'      => $repeater->get_controls(),
				'default'     => $this->get_repeater_defaults(),
				'title_field' => '{{{ name }}}',
			]
		);
		$slides_to_show = range( 1, 10 );
		$slides_to_show = array_combine( $slides_to_show, $slides_to_show );
		$this->add_responsive_control(
			'slides_to_show',
			[
				'label'          => esc_html__( 'Slides to Show', 'rovoko' ),
				'type'           => 'select',
				'options'        => $slides_to_show,
				'default'        => '3',
				'tablet_default' => '3',
				'mobile_default' => '2',
				'separator'      => 'before',
			]
		);
		$this->add_control(
			'loop',
			[
				'label'   => esc_html__( 'Loop', 'rovoko' ),
				'type'    => 'switcher',
				'default' => 'no',
			]
		);
		$this->add_control(
			'nav',
			[
				'label'       => esc_html__( 'Nav', 'rovoko' ),
				'description' => esc_html__( 'Show next/prev buttons.', 'rovoko' ),
				'type'        => 'switcher',
				'default'     => 'no',
			]
		);
		$this->add_control(
			'dots',
			[
				'label'       => esc_html__( 'Dots', 'rovoko' ),
				'type'        => 'switcher',
				'description' => esc_html__( 'Show dots navigation.', 'rovoko' ),
				'default'     => 'no',//.ef5-owl-dots
			]
		);

		$this->add_control(
			'center',
			[
				'label'   => esc_html__( 'Center', 'rovoko' ),
				'type'    => 'switcher',
				'default' => 'no',
			]
		);
		$this->add_control(
			'autoplay',
			[
				'label'   => esc_html__( 'Autoplay', 'rovoko' ),
				'type'    => 'switcher',
				'default' => 'no',
			]
		);
		$this->add_control(
			'autoplay_speed',
			[
				'label'       => esc_html__( 'Autoplay Speed', 'rovoko' ),
				'description' => esc_html__( 'Autoplay interval timeout.', 'rovoko' ),
				'type'        => 'number',
				'default'     => 5000,
				'condition'   => [
					'autoplay' => 'yes',
				],
			]
		);
		$this->add_control(
			'pause_on_hover',
			[
				'label'       => esc_html__( 'Pause on Hover', 'rovoko' ),
				'description' => esc_html__( 'Pause on mouse hover.', 'rovoko' ),
				'type'        => 'switcher',
				'default'     => 'yes',
				'condition'   => [
					'autoplay' => 'yes',
				],
			]
		);
		$this->end_controls_section();

		/**************** Start Style Control Tab ****************/
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Team', 'rovoko' ),
				'tab'   => 'style',
			]
		);
		$this->add_control(
			'text_align',
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
				'selectors' => [ '{{WRAPPER}} .rovoko-team .item' => 'text-align: {{VALUE}};' ],
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'thumbnail',
				'default' => 'full',
			]
		);
		$this->add_control(
			'space',
			[
				'label'       => esc_html__( 'Margin', 'rovoko' ),
				'type'        => 'slider',
				'description' => esc_html__( 'margin-right(px) on item.', 'rovoko' ),
				'range'       => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'     => [
					'size' => 32,
				],
			]
		);
		$this->add_control(
			'name_style',
			[
				'label'     => esc_html__( 'Name', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'name_color',
			[
				'label'     => esc_html__( 'Name Color', 'rovoko' ),
				'type'      => 'color',
				'selectors' => [
					'{{WRAPPER}} .rovoko-team .item h3.name' => 'color: {{VALUE}};',

				],
			]
		);
		$this->add_control(
			'sname_color',
			[
				'label'     => esc_html__( 'Surname', 'rovoko' ),
				'type'      => 'color',
				'selectors' => [
					'{{WRAPPER}} .rovoko-team .item h3.name span' => 'color: {{VALUE}};',
				],
				'condition' => [
					'team_layout' => 'layout-1',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name-topography',
				'selector' => '{{WRAPPER}} .rovoko-team .item h3.name',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
			]
		);
		$this->add_control(
			'position_style',
			[
				'label'     => esc_html__( 'Position', 'rovoko' ),
				'type'      => 'heading',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'positioncolor',
			[
				'label'     => esc_html__( 'Position Color', 'rovoko' ),
				'type'      => 'color',
				'selectors' => [
					'{{WRAPPER}} .rovoko-team .item .position' => 'color: {{VALUE}};',

				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'position-topography',
				'selector' => '{{WRAPPER}} .rovoko-team .item .position',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
			]
		);
		$this->end_controls_section();

	}

	protected function get_repeater_defaults() {
		return [
			[
				'image'    => [ 'url' => Utils::get_placeholder_image_src() ],
				'name'     => esc_html__( 'Scott Spillane', 'rovoko' ),
				'position' => esc_html__( 'Site Supervisor', 'rovoko' ),
			],
			[
				'image'    => [ 'url' => Utils::get_placeholder_image_src() ],
				'name'     => esc_html__( 'Gene Darrough', 'rovoko' ),
				'position' => esc_html__( 'Administration', 'rovoko' ),
				'facebook' => esc_html__( 'facebook.com', 'rovoko' ),
				'twitter'  => esc_html__( 'twitter.com', 'rovoko' ),
				'youtube'  => esc_html__( 'youtube.com', 'rovoko' ),
			],
			[
				'image'    => [ 'url' => Utils::get_placeholder_image_src() ],
				'name'     => esc_html__( 'Aaron Betourney', 'rovoko' ),
				'position' => esc_html__( 'Project Manager', 'rovoko' ),
			],
		];
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		if ( Utils::is_empty( $settings['teams'] ) ) {
			return;
		}
		//var_dump(! Utils::is_empty( $settings['loop'] ) );
		// Data settings
		$carosel_setting = [
			'margin'                => isset( $settings['space']['size'] ) ? $settings['space']['size'] : 32,
			'slides_to_show'        => ! Utils::is_empty( $settings['slides_to_show'] ) ? $settings['slides_to_show'] : 3,
			'slides_to_show_tablet' => ! Utils::is_empty( $settings['slides_to_show_tablet'] ) ? $settings['slides_to_show_tablet'] : 3,
			'slides_to_show_mobile' => ! Utils::is_empty( $settings['slides_to_show_mobile'] ) ? $settings['slides_to_show_mobile'] : 2,
			'loop'                  => ( ! Utils::is_empty( $settings['loop'] ) && $settings['loop'] == 'yes' ) ? true : false,
			'nav'                   => ( ! Utils::is_empty( $settings['nav'] ) ) && $settings['nav'] == 'yes' ? true : false,
			'dots'                  => ( ! Utils::is_empty( $settings['dots'] ) ) && $settings['dots'] == 'yes' ? true : false,
			'center'                => ( ! Utils::is_empty( $settings['center'] ) ) && $settings['center'] == 'yes' ? true : false,
			'autoplay'              => ( ! Utils::is_empty( $settings['autoplay'] ) ) && $settings['autoplay'] == 'yes' ? true : false,
			'autoplay_speed'        => ( ! Utils::is_empty( $settings['autoplay_speed'] ) && $settings['autoplay'] == 'yes' ) ? $settings['autoplay_speed'] : '5000',
			'rtl'                   => is_rtl() ? true : false,
		];
		$this->add_render_attribute( [
			'wrapper'          => [
				'class' => [ 'rovoko-team', $settings['team_layout'] ]
			],
			'carousel-wrapper' => [
				'class'         => [ 'rovoko-carousel', 'owl-carousel', 'owl-theme' ],
				'data-settings' => wp_json_encode( $carosel_setting ),
				'id'            => 'team-' . $this->get_id(),
			],
			'carousel'         => [
				'class' => 'item',
			],
		] );
		?>
        <div <?php echo '' . $this->get_render_attribute_string( 'wrapper' ); ?>>
            <div class="ef5-owl-nav"></div>
            <div <?php echo '' . $this->get_render_attribute_string( 'carousel-wrapper' ); ?>>
				<?php
				foreach ( $settings['teams'] as $team ): ?>
                    <div <?php echo '' . $this->get_render_attribute_string( 'carousel' ); ?>>
						<?php
						if ( ! Utils::is_empty( $team['name'] ) ):?>
                            <div class="team-img">
								<?php
								if ( ! empty( $team['image']['id'] ) ) {
									$image_src = Group_Control_Image_Size::get_attachment_image_src( $team['image']['id'], 'thumbnail', $settings );
									printf( '<figure class="box-img"><img src="%1$s" alt="%2$s" title="%3$s"></figure>', $image_src, esc_attr( Control_Media::get_image_alt( $team['image'] ) ), esc_attr( Control_Media::get_image_title( $team['image'] ) ) );
								} else {
									printf( '<figure class="box-img"><img src="%1$s"></figure>', esc_url( Utils::get_placeholder_image_src() ) );
								}
								$this->rovoko_get_team_social( $team );
								if ( $settings['team_layout'] == 'layout-2' ) {
									echo '<div class="team-meta">';
									$this->rovoko_get_team_meta( $team );
									echo '</div>';
								}
								?>
                            </div>
							<?php
							if ( $settings['team_layout'] == 'layout-1' ) {
								$this->rovoko_get_team_meta( $team );
							}
						endif;
						?>
                    </div>
				<?php
				endforeach;
				?>
            </div>
            <div class="ef5-owl-dots"></div>
        </div>
		<?php
	}

	private function rovoko_get_team_social( $setting ) {
		if ( ! Utils::is_empty( $setting['facebook'] ) || ! Utils::is_empty( $setting['twitter'] ) || ! Utils::is_empty( $setting['youtube'] ) || ! Utils::is_empty( $setting['linkedin'] ) ):?>
            <div class="team-social">
				<?php
				if ( ! Utils::is_empty( $setting['facebook'] ) ) {
					printf( '<a class="facebook" href="%1$s"><i class="fa fa-facebook"></i></a>', $setting['facebook'] );
				}
				if ( ! Utils::is_empty( $setting['twitter'] ) ) {
					printf( '<a class="twitter" href="%1$s"><i class="fa fa-twitter"></i></a>', $setting['twitter'] );
				}
				if ( ! Utils::is_empty( $setting['youtube'] ) ) {
					printf( '<a class="youtube" href="%1$s"><i class="fa fa-youtube"></i></a>', $setting['youtube'] );
				}
				if ( ! Utils::is_empty( $setting['linkedin'] ) ) {
					printf( '<a class="linkedin" href="%1$s"><i class="fa fa-linkedin"></i></a>', $setting['linkedin'] );
				}
				?>
            </div>
		<?php
		endif;
	}

	private function rovoko_get_team_meta( $setting ) {
		if ( ! Utils::is_empty( $setting['name'] ) ) {
			$name           = explode( " ", $setting['name'] );
			$count          = count( $name ) - 1;
			$name[ $count ] = sprintf( '<span>%1$s</span>', $name[ $count ] );
			printf( '<h3 class="name">%1$s</h3>', implode( " ", $name ) );

		}
		if ( ! Utils::is_empty( $setting['position'] ) ) {
			printf( '<p class="position">%1$s</p>', $setting['position'] );
		}

	}
}


Plugin::instance()->widgets_manager->register_widget_type( new Rovoko_Team_Widget() );