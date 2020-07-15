<?php
/**
 * Google Map Module
 */

namespace Elementor;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Rovoko_GoogleMap_Widget extends Widget_Base {

	public function get_name() {
		return 'rovoko_googlemap';
	}

	public function get_title() {
		return esc_html__( '[Rovoko] Google Map', 'rovoko' );
	}

	public function get_icon() {
		return 'rovoko-icon eicon-google-maps';
	}

	public function get_categories() {
		return [ 'rovoko-elements' ];
	}

	public function get_script_depends() {
		return [ 'imagesloaded', 'maps-googleapis', 'rovoko-googlemap' ];
	}

	public function get_keywords() {
		return [ 'rovoko', 'googlemap', 'map', 'google', 'location' ];
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
			'address',
			[
				'label'       => esc_html__( 'Address', 'rovoko' ),
				'type'        => 'text',
				'label_block' => 'true',
				'description' => esc_html__( 'Enter address of Map', 'rovoko' )
			]
		);
		$this->add_control(
			'coordinate',
			[
				'label'       => esc_html__( 'Coordinate', 'rovoko' ),
				'type'        => 'text',
				'default'     => '37.9723128,-122.53077',
				'label_block' => 'true',
				'description' => esc_html__( 'Enter coordinate of Map, format input (latitude, longitude)', 'rovoko' )
			]
		);
		$this->add_control(
			'infoclick',
			[
				'label'       => esc_html__( 'Click Show Info window', 'rovoko' ),
				'type'        => 'switcher',
				'default'     => 'yes',
				'description' => esc_html__( 'Click a marker and show info window (Default Show).', 'rovoko' )
			]
		);

		$markerlist = new Repeater();
		$markerlist->add_control(
			'markercoordinate',
			[
				'label'       => esc_html__( 'Marker Coordinate', 'rovoko' ),
				'type'        => 'text',
				'default'     => '',
				'label_block' => 'true',
				'description' => esc_html__( 'Enter marker coordinate of Map, format input (latitude, longitude).', 'rovoko' )
			]
		);
		$markerlist->add_control(
			'markertitle',
			[
				'label'       => esc_html__( 'Marker Title', 'rovoko' ),
				'type'        => 'text',
				'default'     => '',
				'description' => esc_html__( 'Enter Title Info windows for marker.', 'rovoko' )
			]
		);
		$markerlist->add_control(
			'markerdesc',
			[
				'label'       => esc_html__( 'Marker Description', 'rovoko' ),
				'type'        => 'textarea',
				'default'     => '',
				'description' => esc_html__( 'Enter Description Info windows for marker.', 'rovoko' )
			]
		);
		$markerlist->add_control(
			'markericon',
			[
				'label' => esc_html__( 'Marker Icon', 'rovoko' ),
				'type'  => 'media',
			]
		);
		$this->add_control(
			'markerlists',
			[
				'label'       => esc_html__( 'Marker List', 'rovoko' ),
				'type'        => 'repeater',
				'fields'      => $markerlist->get_controls(),
				'default'     => [
					[
						'markercoordinate' => '37.9723128,-122.53077',
						'markertitle'      => esc_html__( 'Construction Center', 'rovoko' ),
						'markerdesc'       => '',
						'markericon'       => ''
					]
				],
				'title_field' => '{{{ markertitle }}}',
			]
		);
		$this->add_control(
			'infowidth',
			[
				'label'       => esc_html__( 'Info Window Max Width', 'rovoko' ),
				'type'        => 'slider',
				'range'       => [
					'px' => [
						'min' => 1,
						'max' => 500,
					]
				],
				'default'     => [
					'unit' => 'px',
					'size' => '250',
				],
				'placeholder' => esc_html__( 'Set max width for info window', 'rovoko' ),
			]
		);
		$this->add_control(
			'type',
			[
				'label'       => esc_html__( 'Map Type', 'rovoko' ),
				'type'        => 'select',
				'options'     => [
					'ROADMAP'   => esc_html__( 'ROADMAP', 'rovoko' ),
					'HYBRID'    => esc_html__( 'HYBRID', 'rovoko' ),
					'SATELLITE' => esc_html__( 'SATELLITE', 'rovoko' ),
					'TERRAIN'   => esc_html__( 'TERRAIN', 'rovoko' ),
				],
				'default'     => 'ROADMAP',
				'description' => esc_html__( 'Select the map type.', 'rovoko' )
			]
		);
		$this->add_control(
			'style',
			[
				'label'       => esc_html__( 'Style Template', 'rovoko' ),
				'type'        => 'select',
				'options'     => [
					'default'            => esc_html__( 'Default', 'rovoko' ),
					'custom'             => esc_html__( 'Custom', 'rovoko' ),
					'light-monochrome'   => esc_html__( 'Light Monochrome', 'rovoko' ),
					'blue-water'         => esc_html__( 'Blue water', 'rovoko' ),
					'midnight-commander' => esc_html__( 'Midnight Commander', 'rovoko' ),
					'paper'              => esc_html__( 'Paper', 'rovoko' ),
					'red-hues'           => esc_html__( 'Red Hues', 'rovoko' ),
					'hot-pink'           => esc_html__( 'Hot Pink', 'rovoko' ),
				],
				'default'     => 'default',
				'description' => esc_html__( 'Select your heading size for title.', 'rovoko' ),
			]
		);
		$this->add_control(
			'content',
			[
				'label'       => esc_html__( 'Custom Template', 'rovoko' ),
				'type'        => 'textarea',
				'default'     => '',
				'description' => esc_html__( 'Get template from http://snazzymaps.com', 'rovoko' ),
				'condition'   => [
					'style' => 'custom',
				],
			]
		);
		$this->add_control(
			'zoom',
			[
				'label'       => esc_html__( 'Zoom', 'rovoko' ),
				'type'        => 'slider',
				'range'       => [
					'px' => [
						'min'  => 1,
						'max'  => 21,
						'step' => 1
					],
				],
				'default'     => [
					'unit' => 'px',
					'size' => '13',
				],
				'placeholder' => esc_html__( 'zoom level of map, default is 13', 'rovoko' ),
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label'       => esc_html__( 'Height', 'rovoko' ),
				'type'        => 'slider',
				'range'       => [
					'px' => [
						'min'  => 50,
						'max'  => 1440,
						'step' => 10
					],
				],
				'default'     => [
					'unit' => 'px',
					'size' => '350',
				],
				'selectors'   => [
					'{{WRAPPER}} .rovoko-googlemap-wrapper .map-render' => 'height: {{SIZE}}{{UNIT}};',
				],
				'description' => esc_html__( 'Height of map without pixel.', 'rovoko' )
			]
		);
		$this->add_control(
			'scrollwheel',
			[
				'label'       => esc_html__( 'Scroll Wheel', 'rovoko' ),
				'type'        => 'switcher',
				'default'     => 'yes',
				'description' => esc_html__( 'If false, disables scrollwheel zooming on the map. The scrollwheel is disable by default.', 'rovoko' )
			]
		);
		$this->add_control(
			'pancontrol',
			[
				'label'       => esc_html__( 'Pan Control', 'rovoko' ),
				'type'        => 'switcher',
				'default'     => 'yes',
				'description' => esc_html__( 'Show or hide Pan control.', 'rovoko' )
			]
		);
		$this->add_control(
			'zoomcontrol',
			[
				'label'       => esc_html__( 'Zoom Control', 'rovoko' ),
				'type'        => 'switcher',
				'default'     => 'yes',
				'description' => esc_html__( 'Show or hide Zoom Control.', 'rovoko' )
			]
		);
		$this->add_control(
			'scalecontrol',
			[
				'label'       => esc_html__( 'Scale Control', 'rovoko' ),
				'type'        => 'switcher',
				'default'     => 'yes',
				'description' => esc_html__( 'Show or hide Scale Control.', 'rovoko' )
			]
		);
		$this->add_control(
			'maptypecontrol',
			[
				'label'       => esc_html__( 'Map Type Control', 'rovoko' ),
				'type'        => 'switcher',
				'default'     => 'yes',
				'description' => esc_html__( 'Show or hide Map Type Control.', 'rovoko' )
			]
		);
		$this->add_control(
			'streetviewcontrol',
			[
				'label'       => esc_html__( 'Street View Control', 'rovoko' ),
				'type'        => 'switcher',
				'default'     => 'yes',
				'description' => esc_html__( 'Show or hide Street View Control.', 'rovoko' )
			]
		);
		$this->add_control(
			'overviewmapcontrol',
			[
				'label'       => esc_html__( 'Over View Map Control', 'rovoko' ),
				'type'        => 'switcher',
				'default'     => 'yes',
				'description' => esc_html__( 'Show or hide Over View Map Control.', 'rovoko' )
			]
		);
		$this->add_control(
			'embedhtml',
			[
				'label'       => esc_html__( 'Embed HTML', 'revoko' ),
				'type'        => 'textarea',
				'default'     => '',
				'description' => esc_html__( 'Enter the embed code html', 'revoko' )
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_map_style',
			[
				'label' => esc_html__( 'Map', 'rovoko' ),
				'tab'   => 'style',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name-topography',
				'selector' => '.rovoko-googlemap-wrapper .map-render > div .info-content h5',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
			]
		);
		$this->add_control(
			'css_title',
			[
				'label'     => esc_html__( 'Marker Title Color', 'rovoko' ),
				'type'      => 'color',
				'selectors' => [
					'{{WRAPPER}} .rovoko-googlemap-wrapper .map-render > div .info-content h5' => 'color: {{VALUE}};',
				],
			]
		);
		$this->start_controls_tabs( 'map_filter' );

		$this->start_controls_tab( 'normal',
			[
				'label' => esc_html__( 'Normal', 'rovoko' ),
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'css_filters',
				'selector' => '{{WRAPPER}} .rovoko-googlemap-wrapper .map-render > div',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => esc_html__( 'Hover', 'rovoko' ),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'css_filters_hover',
				'selector' => '{{WRAPPER}} .rovoko-googlemap-wrapper .map-render:hover > div',
			]
		);

		$this->add_control(
			'hover_transition',
			[
				'label'     => esc_html__( 'Transition Duration', 'rovoko' ),
				'type'      => 'slider',
				'range'     => [
					'px' => [
						'max'  => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rovoko-googlemap-wrapper .map-render > div' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		/* style defualt */
		$map_styles = array(
			'light-monochrome'   => '[{"featureType":"water","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":-78},{"lightness":67},{"visibility":"simplified"}]},{"featureType":"landscape","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"simplified"}]},{"featureType":"road","elementType":"geometry","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"simplified"}]},{"featureType":"poi","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"hue":"#e9ebed"},{"saturation":-90},{"lightness":-8},{"visibility":"simplified"}]},{"featureType":"transit","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":10},{"lightness":69},{"visibility":"on"}]},{"featureType":"administrative.locality","elementType":"all","stylers":[{"hue":"#2c2e33"},{"saturation":7},{"lightness":19},{"visibility":"on"}]},{"featureType":"road","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":-2},{"visibility":"simplified"}]}]',
			'blue-water'         => '[{"featureType":"water","stylers":[{"color":"#46bcec"},{"visibility":"on"}]},{"featureType":"landscape","stylers":[{"color":"#f2f2f2"}]},{"featureType":"road","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]}]',
			'midnight-commander' => '[{"featureType":"water","stylers":[{"color":"#021019"}]},{"featureType":"landscape","stylers":[{"color":"#08304b"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#0c4152"},{"lightness":5}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#0b434f"},{"lightness":25}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#0b3d51"},{"lightness":16}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#000000"},{"lightness":13}]},{"featureType":"transit","stylers":[{"color":"#146474"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#144b53"},{"lightness":14},{"weight":1.4}]}]',
			'paper'              => '[{"featureType":"administrative","stylers":[{"visibility":"off"}]},{"featureType":"poi","stylers":[{"visibility":"simplified"}]},{"featureType":"road","stylers":[{"visibility":"simplified"}]},{"featureType":"water","stylers":[{"visibility":"simplified"}]},{"featureType":"transit","stylers":[{"visibility":"simplified"}]},{"featureType":"landscape","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"visibility":"off"}]},{"featureType":"road.local","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"road.arterial","stylers":[{"visibility":"off"}]},{"featureType":"water","stylers":[{"color":"#5f94ff"},{"lightness":26},{"gamma":5.86}]},{},{"featureType":"road.highway","stylers":[{"weight":0.6},{"saturation":-85},{"lightness":61}]},{"featureType":"road"},{},{"featureType":"landscape","stylers":[{"hue":"#0066ff"},{"saturation":74},{"lightness":100}]}]',
			'red-hues'           => '[{"stylers":[{"hue":"#dd0d0d"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":100},{"visibility":"simplified"}]}]',
			'hot-pink'           => '[{"stylers":[{"hue":"#ff61a6"},{"visibility":"on"},{"invert_lightness":true},{"saturation":40},{"lightness":10}]}]',
		);
		/* Select Template */
		$map_template = '';
		switch ( $settings['style'] ) {
			case 'default':
				break;
			case 'custom':
				if ( ! Utils::is_empty( $settings['content'] ) ) {
					$map_template = rawurlencode( $settings['content'] );
				}
				break;
			default:
				$map_template = rawurlencode( $map_styles[ $settings['style'] ] );
				break;
		}
		$marker = new \stdClass();

		if ( ! Utils::is_empty( $settings['markerlists'] ) ) {
			$marker->markerlist = $settings['markerlists'];
		}
		/* control render */
		$controls = new \stdClass();

		if ( ! Utils::is_empty( $settings['scrollwheel'] ) && $settings['scrollwheel'] == 'yes' ) {
			$controls->scrollwheel = 1;
		} else {
			$controls->scrollwheel = 0;
		}
		if ( ! Utils::is_empty( $settings['pancontrol'] ) && $settings['pancontrol'] == 'yes' ) {
			$controls->pancontrol = true;
		} else {
			$controls->pancontrol = false;
		}
		if ( ! Utils::is_empty( $settings['zoomcontrol'] ) && $settings['zoomcontrol'] == 'yes' ) {
			$controls->zoomcontrol = true;
		} else {
			$controls->zoomcontrol = false;
		}
		if ( ! Utils::is_empty( $settings['scalecontrol'] ) && $settings['scalecontrol'] == 'yes' ) {
			$controls->scalecontrol = true;
		} else {
			$controls->scalecontrol = false;
		}
		if ( ! Utils::is_empty( $settings['maptypecontrol'] ) && $settings['maptypecontrol'] == 'yes' ) {
			$controls->maptypecontrol = true;
		} else {
			$controls->maptypecontrol = false;
		}
		if ( ! Utils::is_empty( $settings['streetviewcontrol'] ) && $settings['streetviewcontrol'] == 'yes' ) {
			$controls->streetviewcontrol = true;
		} else {
			$controls->streetviewcontrol = false;
		}
		if ( ! Utils::is_empty( $settings['overviewmapcontrol'] ) && $settings['overviewmapcontrol'] == 'yes' ) {
			$controls->overviewmapcontrol = true;
		} else {
			$controls->overviewmapcontrol = false;
		}
		if ( ! Utils::is_empty( $settings['infoclick'] ) && $settings['infoclick'] == 'yes' ) {
			$controls->infoclick = true;
		} else {
			$controls->infoclick = false;
		}
		if ( is_array( $settings['infowidth'] ) && ! empty( $settings['infowidth'] ) ) {
			$controls->infowidth = $settings['infowidth']['size'];
		}
		if ( ! Utils::is_empty( $settings['style'] ) ) {
			$controls->style = $settings['style'];
		}
		//var_dump(rawurlencode( json_encode( $marker ) ));
		/* data render */
		$this->add_render_attribute( [
			'wrapper' => [
				'class' => array( 'rovoko-googlemap-wrapper' ),
				'id'    => 'map-' . $this->get_id(),
			],
			'map'     => [
				'class'           => [ 'map-render' ],
				'data-address'    => $settings['address'],
				'data-marker'     => rawurlencode( json_encode( $marker ) ),
				'data-coordinate' => $settings['coordinate'],
				'data-type'       => $settings['type'],
				'data-zoom'       => $settings['zoom']['size'],
				'data-template'   => $map_template,
				'data-controls'   => rawurlencode( json_encode( $controls ) )
			]
		] );
		if(!empty($settings['embedhtml'])){
			echo ''.$settings['embedhtml'];
		}else{
		?>
	        <div <?php echo '' . $this->get_render_attribute_string( 'wrapper' ); ?>>
	            <div <?php echo '' . $this->get_render_attribute_string( 'map' ); ?>></div>
	        </div>
			<?php
		}
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Rovoko_GoogleMap_Widget() );