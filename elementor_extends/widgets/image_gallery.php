<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Rovoko_Image_Gallery_Widget extends Widget_Base {

	public function get_name() {
		return 'rovoko_image_gallery';
	}

	public function get_title() {
		return esc_html__( '[Rovoko] Image Gallery', 'rovoko' );
	}

	public function get_icon() {
		return 'rovoko-icon eicon-slider-push';
	}

	public function get_categories() {
		return [ 'rovoko-elements' ];
	}

	public function get_script_depends() {
		return [ 'imagesloaded', 'rovoko-fotorama', 'rovoko-image-gallery' ];
	}

	public function get_style_depends() {
		return [ 'rovoko-image-gallery' ];
	}

	public function get_keywords() {
		return [ 'rovoko', 'image', 'photo', 'carousel', 'slider' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_image_carousel',
			[
				'label' => esc_html__( 'Image Gallery', 'rovoko' ),
			]
		);

		$this->add_control(
			'carousel',
			[
				'label'      => esc_html__( 'Add Images', 'rovoko' ),
				'type'       => 'gallery',
				'default'    => [],
				'show_label' => false,
				'dynamic'    => [
					'active' => true,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'separator' => 'none',
			]
		);
		$this->add_control(
			'shuffle',
			[
				'label'       => esc_html__( 'Shuffle.', 'rovoko' ),
				'description' => esc_html__( 'Shuffles frames at launch.', 'rovoko' ),
				'type'        => 'switcher',
				'default'     => 'no',
			]
		);
		$this->add_control(
			'ratio',
			[
				'label'       => esc_html__( 'Ratio ', 'rovoko' ),
				'description' => esc_html__( 'Width divided by height. ', 'rovoko' ),
				'type'        => 'select',
				'options'     => [
					'none' => esc_html__( 'Auto', 'rovoko' ),
					'16/9' => esc_html__( '16/9', 'rovoko' ),
					'21/9' => esc_html__( '21/9', 'rovoko' ),
					'4/3'  => esc_html__( '4/3', 'rovoko' ),
					'3/2'  => esc_html__( '3/2', 'rovoko' ),
					'1/1'  => esc_html__( '1/1', 'rovoko' ),
					//'custom' => esc_html__( 'Custom', 'rovoko' ),
				],
				'default'     => 'none',
			]
		);
		$this->add_control(
			'nav',
			[
				'label'   => esc_html__( 'Navigation Style', 'rovoko' ),
				'type'    => 'select',
				'options' => [
					'false'  => esc_html__( 'None', 'rovoko' ),
					'thumbs' => esc_html__( 'Thumbs', 'rovoko' ),
					'dots'   => esc_html__( 'Dots', 'rovoko' ),
				],
				'default' => 'thumbs',
			]
		);
		$this->add_control(
			'thumbsize',
			[
				'label'       => esc_html__( 'Tumbnail size.', 'rovoko' ),
				'type'        => 'image_dimensions',
				'description' => esc_html__( 'Tumbnail width x height in pixels.', 'rovoko' ),
				'default'     => [
					'width'  => '',
					'height' => '',
				],
				'condition'   => [
					'nav' => 'thumbs',
				],
			]
		);
		$this->add_control(
			'space',
			[
				'label'       => esc_html__( 'Thumbnail Margin', 'rovoko' ),
				'type'        => 'slider',
				'description' => esc_html__( 'Size of thumbnail margins.', 'rovoko' ),
				'range'       => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'     => [
					'size' => 15,
				],
				'condition'   => [
					'nav' => 'thumbs',
				],
			]
		);
		$this->add_control(
			'thumbborderwidth',
			[
				'label'       => esc_html__( 'Thumbnail Border Width', 'rovoko' ),
				'type'        => 'slider',
				'description' => esc_html__( 'Border width of the active thumbnail.', 'rovoko' ),
				'range'       => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'default'     => [
					'size' => 2,
				],
				'condition'   => [
					'nav' => 'thumbs',
				],
			]
		);
		$this->add_control(
			'navposition',
			[
				'label'     => esc_html__( 'Navigation position', 'rovoko' ),
				'type'      => 'select',
				'options'   => [
					'top'    => esc_html__( 'Top', 'rovoko' ),
					'bottom' => esc_html__( 'Bottom', 'rovoko' ),
				],
				'default'   => 'bottom',
				'condition' => [
					'nav!' => 'false',
				],
			]
		);
		$this->add_control(
			'arrows',
			[
				'label'   => esc_html__( 'Arrows', 'rovoko' ),
				'type'    => 'select',
				'options' => [
					'yes'    => esc_html__( 'Yes', 'rovoko' ),
					'no'     => esc_html__( 'No', 'rovoko' ),
					'always' => esc_html__( 'Always', 'rovoko' ),
				],
				'default' => 'false',
			]
		);
		$this->add_control(
			'loop',
			[
				'label'   => esc_html__( 'Enables loop.', 'rovoko' ),
				'type'    => 'switcher',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'autoplay',
			[
				'label'   => esc_html__( 'Enables slideshow.', 'rovoko' ),
				'type'    => 'switcher',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'autoplay_speed',
			[
				'label'       => esc_html__( 'Autoplay Speed', 'rovoko' ),
				'description' => esc_html__( 'Autoplay interval timeout(Milliseconds).', 'rovoko' ),
				'type'        => 'number',
				'default'     => 5000,
				'condition'   => [
					'autoplay' => 'yes',
				],
			]
		);
		$this->add_control(
			'stopautoplayontouch',
			[
				'label'       => esc_html__( 'Stop Autoplay On Touch .', 'rovoko' ),
				'description' => esc_html__( 'Stops slideshow at any user action.', 'rovoko' ),
				'type'        => 'switcher',
				'default'     => 'yes',
				'condition'   => [
					'autoplay' => 'yes',
				],
			]
		);
		$this->add_control(
			'click',
			[
				'label'       => esc_html__( 'Click.', 'rovoko' ),
				'description' => esc_html__( 'Moving between frames by clicking.', 'rovoko' ),
				'type'        => 'switcher',
				'default'     => 'yes',
			]
		);
		$this->add_control(
			'swipe',
			[
				'label'       => esc_html__( 'Swipe', 'rovoko' ),
				'description' => esc_html__( 'Moving between frames by swiping.', 'rovoko' ),
				'type'        => 'switcher',
				'default'     => 'yes',
			]
		);
		$this->add_control(
			'allowfullscreen',
			[
				'label'   => esc_html__( 'Allows fullscreen.', 'rovoko' ),
				'type'    => 'switcher',
				'default' => 'no',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( empty( $settings['carousel'] ) ) {
			return;
		}
		$autoplay_speed  = ! Utils::is_empty( $settings['autoplay_speed'] ) ? $settings['autoplay_speed'] : true;
		$ratio           = ! Utils::is_empty( $settings['ratio'] ) && $settings['ratio'] != 'none' ? $settings['ratio'] : '';
		$arrows          = ! Utils::is_empty( $settings['arrows'] ) && $settings['arrows'] != 'no' ? $settings['arrows'] : false;
		$carosel_setting = [
			'nav'                 => ! Utils::is_empty( $settings['nav'] ) ? $settings['nav'] : 'thumbs',
			'navposition'         => ! Utils::is_empty( $settings['navposition'] ) ? $settings['navposition'] : 'bottom',
			'thumbborderwidth'    => ! Utils::is_empty( $settings['thumbborderwidth']['size'] ) ? $settings['thumbborderwidth']['size'] : 0,
			'arrows'              => ! Utils::is_empty( $settings['arrows'] ) ? $arrows : false,
			'loop'                => ! Utils::is_empty( $settings['loop'] ) ? true : false,
			'allowfullscreen'     => ! Utils::is_empty( $settings['allowfullscreen'] ) ? true : false,
			'click'               => ! Utils::is_empty( $settings['click'] ) ? true : false,
			'autoplay'            => ! Utils::is_empty( $settings['autoplay'] ) ? $autoplay_speed : false,
			'stopautoplayontouch' => ! Utils::is_empty( $settings['stopautoplayontouch'] ) ? true : false,
			'ratio'               => ! Utils::is_empty( $settings['ratio'] ) ? $ratio : '',
			'swipe'               => ! Utils::is_empty( $settings['swipe'] ) ? true : false,
			'shuffle'             => ! Utils::is_empty( $settings['shuffle'] ) ? true : false,
			'thumbsize'           => isset( $settings['thumbsize']['width'] ) ? $settings['thumbsize'] : '',
			'margin'              => isset( $settings['space']['size'] ) ? $settings['space']['size'] : 5,
			'rtl'                 => is_rtl() ? 'rtl' : 'ltr',
		];
		$this->add_render_attribute( [
			'wrapper'         => [
				'class' => [ 'image-gallery-wrapp' ]
			],
			'gallery-wrapper' => [
				'class'         => [ 'rovoko-image-gallery' ],
				'data-settings' => wp_json_encode( $carosel_setting ),
			],

		] );
		?>
        <div <?php echo '' . $this->get_render_attribute_string( 'wrapper' ); ?>>
            <div <?php echo '' . $this->get_render_attribute_string( 'gallery-wrapper' ); ?>>
				<?php
				foreach ( $settings['carousel'] as $index => $attachment ): ?>
					<?php
					$image_url = Group_Control_Image_Size::get_attachment_image_src( $attachment['id'], 'thumbnail', $settings );
					printf( '<img src="%1$s" alt="%2$s"/>', esc_attr( $image_url ), esc_attr( Control_Media::get_image_alt( $attachment ) ) );
					?>
				<?php
				endforeach;
				?>
            </div>
        </div>

		<?php
	}

	private function get_link_url( $attachment, $instance ) {
		if ( 'none' === $instance['link_to'] ) {
			return false;
		}

		if ( 'custom' === $instance['link_to'] ) {
			if ( empty( $instance['link']['url'] ) ) {
				return false;
			}

			return $instance['link'];
		}

		return [
			'url' => wp_get_attachment_url( $attachment['id'] ),
		];
	}

	private function get_image_caption( $attachment ) {
		$caption_type = $this->get_settings_for_display( 'caption_type' );

		if ( empty( $caption_type ) ) {
			return '';
		}

		$attachment_post = get_post( $attachment['id'] );

		if ( 'caption' === $caption_type ) {
			return $attachment_post->post_excerpt;
		}

		if ( 'title' === $caption_type ) {
			return $attachment_post->post_title;
		}

		return $attachment_post->post_content;
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Rovoko_Image_Gallery_Widget() );