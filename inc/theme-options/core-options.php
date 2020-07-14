<?php
/**
 * Theme Options
 * Site Boxed
 * Add option repeated Boxed theme/ meta option
 */
if ( ! function_exists( 'rovoko_general_opts' ) ) {
	function rovoko_general_opts( $args = [] ) {
		$args                       = wp_parse_args( $args, [
			'default' => false
		] );
		$default_value              = $args['default'] ? '-1' : '0';
		$force_output               = $args['default'] ? true : false;
		$default_dropdown_opts      = $args['default'] ? array( '-1' => esc_html__( 'Default', 'rovoko' ) ) : array();
		$default_page_loading_value = $args['default'] ? '-1' : 'fading-circle';

		if ( $args['default'] === true ) {
			$options_layout = array(
				'-1'       => esc_html__( 'Default', 'rovoko' ),
				'boxed'    => esc_html__( 'Boxed', 'rovoko' ),
				'bordered' => esc_html__( 'Bordered', 'rovoko' ),
			);
			$default_layout = '-1';

			$options_boxed = array(
				'-1' => esc_html__( 'Default', 'rovoko' ),
				'1'  => esc_html__( 'Yes', 'rovoko' ),
				'0'  => esc_html__( 'No', 'rovoko' ),
			);
		} else {
			$options_layout = array(
				'-1'       => esc_html__( 'Default', 'rovoko' ),
				'boxed'    => esc_html__( 'Boxed', 'rovoko' ),
				'bordered' => esc_html__( 'Bordered', 'rovoko' ),
			);
			$default_layout = '-1';

			$options_boxed = array(
				'1' => esc_html__( 'Yes', 'rovoko' ),
				'0' => esc_html__( 'No', 'rovoko' ),
			);
		}

		return array(
			array(
				'id'       => 'body_bg',
				'type'     => 'background',
				'title'    => esc_html__( 'Body Background', 'rovoko' ),
				'subtitle' => esc_html__( 'Choose background style for body', 'rovoko' ),
				'output'   => array( 'body' )
			),
			array(
				'id'       => 'site_layout',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Layout', 'rovoko' ),
				'subtitle' => esc_html__( 'Choose site layout', 'rovoko' ),
				'options'  => $options_layout,
				'default'  => $default_layout,
			),
			array(
				'id'           => 'boxed_content_bg',
				'type'         => 'background',
				'title'        => esc_html__( 'Boxed Content Background', 'rovoko' ),
				'subtitle'     => esc_html__( 'Choose background style for boxed content', 'rovoko' ),
				'required'     => array(
					array( 'site_layout', '=', 'boxed' )
				),
				'output'       => array( '.site-boxed .ef5-page' ),
				'force_output' => $force_output
			),
			array(
				'id'           => 'site_bordered_w',
				'type'         => 'spacing',
				'mode'         => 'padding',
				'all'          => false,
				'title'        => esc_html__( 'Bordered Width', 'rovoko' ),
				'subtitle'     => esc_html__( 'Enter bordered with.', 'rovoko' ),
				'units'        => array( 'px' ),
				'default'      => array(
					'padding-top'    => '50px',
					'padding-right'  => '50px',
					'padding-bottom' => '50px',
					'padding-left'   => '50px',
					'units'          => 'px'
				),
				'required'     => array(
					array( 'site_layout', '=', 'bordered' )
				),
				'force_output' => $force_output,
				//'output'       => array('.site-bordered')
			),
			array(
				'id'           => 'bordered_content_bg',
				'type'         => 'background',
				'title'        => esc_html__( 'Bordered Content Background', 'rovoko' ),
				'subtitle'     => esc_html__( 'Choose background style for bordered content', 'rovoko' ),
				'required'     => array(
					array( 'site_layout', '=', 'bordered' )
				),
				'output'       => array( '.site-bordered .ef5-page' ),
				'force_output' => $force_output
			),
			array(
				'id'       => 'show_page_loading',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Enable Page Loading', 'rovoko' ),
				'subtitle' => esc_html__( 'Enable Page Loading Effect When You Load Site', 'rovoko' ),
				'options'  => $options_boxed,
				'default'  => $default_value,
			),
			array(
				'title'    => esc_html__( 'Page Loadding Style', 'rovoko' ),
				'subtitle' => esc_html__( 'Select Style Page Loadding.', 'rovoko' ),
				'id'       => 'page_loading_style',
				'type'     => 'select',
				'options'  => rovoko_page_loading_styles( $args['default'] ),
				'default'  => $default_page_loading_value,
				'required' => array( 'show_page_loading', '=', '1' )
			),
			array(
				'id'       => 'back_totop_on',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Back to Top Button', 'rovoko' ),
				'subtitle' => esc_html__( 'Show back to top button when scrolled down.', 'rovoko' ),
				'options'  => $options_boxed,
				'default'  => $default_value,
			)
		);
	}
}

/**
 * Theme Options
 * Header Top Area
 * Add option repeated for theme/ meta option
 */
function rovoko_header_top_layout( $default = false ) {
	$layouts = [];
	if ( $default ) {
		$layouts['-1'] = get_template_directory_uri() . '/assets/images/default.png';
	}
	$layouts['none'] = get_template_directory_uri() . '/assets/images/none.png';

	for ( $count = 1; $count <= 3; $count ++ ) {
		$layouts[ 'layout-' . $count ] = get_template_directory_uri() . '/assets/images/header/top-bar-' . $count . '.png';
	}


	return $layouts;
}

if ( ! function_exists( 'rovoko_header_top_opts' ) ) {
	function rovoko_header_top_opts( $args = [] ) {
		$args          = wp_parse_args( $args, [
			'default' => false
		] );
		$default_value = $args['default'] ? '-1' : '';
		if ( $args['default'] === true ) {
			$options_width = array(
				'-1' => esc_html__( 'Default', 'rovoko' ),
				'1'  => esc_html__( 'Yes', 'rovoko' ),
				'0'  => esc_html__( 'No', 'rovoko' ),
			);

		} else {
			$options_width = array(
				'1' => esc_html__( 'Yes', 'rovoko' ),
				'0' => esc_html__( 'No', 'rovoko' ),
			);
		}
		$allowed_html = array(
			'a'      => array( 'href' => array(), 'title' => array() ),
			'i'      => array( 'class' => array() ),
			'span'   => array( 'class' => array() ),
			'em'     => array(),
			'p'      => array(),
			'strong' => array(),
		);

		return array(
			'title'  => esc_html__( 'Header Top', 'rovoko' ),
			'icon'   => 'el el-website',
			'fields' => array(
				array(
					'id'       => 'header_top_layout',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Layout', 'rovoko' ),
					'subtitle' => esc_html__( 'Select a layout for upper header top area.', 'rovoko' ),
					'options'  => rovoko_header_top_layout( $args['default'] ),
					'default'  => $default_value,
				),
				array(
					'id'       => 'header_top_bg',
					'type'     => 'background',
					'title'    => esc_html__( 'Background', 'rovoko' ),
					'output'   => array( '.ef5-header-top .topbar,.header-ontop .ef5-header-top .header-inner, .ef5-header-top .topbar.topbar-layout-3 .right-content .woocs-style-1-dropdown-menu' ),
					'required' => array( 'header_top_layout', '!=', 'none' ),
				),
				array(
					'id'       => 'header_top_text_color',
					'type'     => 'color_rgba',
					'title'    => esc_html__( 'Text Color', 'rovoko' ),
					'output'   => array( '.topbar' ),
					'required' => array( 'header_top_layout', '!=', 'none' ),
				),
				array(
					'id'       => 'header_top_border',
					'type'     => 'border',
					'all'      => false,
					'color'    => false,
					'title'    => esc_html__( 'Border Style', 'rovoko' ),
					'subtitle' => esc_html__( 'Add your custom border design', 'rovoko' ),
					'output'   => array( '.ef5-header-top .topbar' ),
					'required' => array( 'header_top_layout', '!=', 'none' ),
				),
				array(
					'id'       => 'header_top_border_color',
					'type'     => 'color_rgba',
					'title'    => esc_html__( 'Border Color', 'rovoko' ),
					'subtitle' => esc_html__( 'Add your custom border color', 'rovoko' ),
					'output'   => array(
						'border-color' => '.ef5-header-top .topbar'
					),
					'required' => array( 'header_top_layout', '!=', 'none' ),
				),
				array(
					'id'       => 'header_top_social_icon',
					'type'     => 'button_set',
					'title'    => esc_html__( 'Header top socials', 'rovoko' ),
					'subtitle' => esc_html__( 'Show/Hide social icon', 'rovoko' ),
					'options'  => $options_width,
					'default'  => $default_value,
					'required' => array(
						array( 'header_top_layout', '=', array( 'layout-2' ) )
					),
				),
				array(
					'id'       => 'header_top_social',
					'type'     => 'sorter',
					'title'    => esc_html__( 'Social Icon', 'rovoko' ),
					'options'  => array(
						'Enabled'  => array(
							'social_facebook_url'  => esc_html__( 'Facebook', 'rovoko' ),
							'social_twitter_url'   => esc_html__( 'Twitter', 'rovoko' ),
							'social_pinterest_url' => esc_html__( 'Pinterest', 'rovoko' ),
							'social_dribbble_url'  => esc_html__( 'Dribbble', 'rovoko' ),
						),
						'Disabled' => array(
							'social_inkedin_url'     => esc_html__( 'Inkedin', 'rovoko' ),
							'social_rss_url'         => esc_html__( 'rss', 'rovoko' ),
							'social_instagram_url'   => esc_html__( 'Instagram', 'rovoko' ),
							'social_google_url'      => esc_html__( 'Google', 'rovoko' ),
							'social_skype_url'       => esc_html__( 'Skype', 'rovoko' ),
							'social_vimeo_url'       => esc_html__( 'Vimeo', 'rovoko' ),
							'social_youtube_url'     => esc_html__( 'Youtube', 'rovoko' ),
							'social_yelp_url'        => esc_html__( 'Yelp', 'rovoko' ),
							'social_tumblr_url'      => esc_html__( 'Tumblr', 'rovoko' ),
							'social_tripadvisor_url' => esc_html__( 'Tripadvisor', 'rovoko' ),
						)
					),
					'required' => array(
						array( 'header_top_layout', '=', array( 'layout-2' ) ),
						array( 'header_top_social_icon', '=', array( '1' ) ),
					),
				),
				array(
					'id'       => 'header_top_html',
					'title'    => esc_html__( 'Custom HMTL', 'rovoko' ),
					'subtitle' => esc_html__( 'Show Custom HMTL or not', 'rovoko' ),
					'type'     => 'button_set',
					'options'  => $options_width,
					'default'  => $default_value,
					'required' => array( 'header_top_layout', '!=', 'none' ),
				),
				array(
					'title'        => esc_html__( 'Custom HTML', 'rovoko' ),
					'id'           => 'header_top_custom_html_1',
					'type'         => 'textarea',
					'rows'         => 3,
					'validate'     => 'html_custom',
					'allowed_html' => $allowed_html,
					'default'      => '',
					//__( '<a href="mailto:admin@domain.com"><i class="fas fa-envelope"></i>admin@domain.com</a>', 'rovoko' ),
					'required'     => array( 'header_top_html', '=', '1' ),
				),
				array(
					'title'        => esc_html__( 'Custom HTML 2', 'rovoko' ),
					'id'           => 'header_top_custom_html_2',
					'type'         => 'textarea',
					'rows'         => 3,
					'validate'     => 'html_custom',
					'allowed_html' => $allowed_html,
					'default'      => '',
					//__( '<a href="tel:080.0444.333"><span class="flaticon-call-answer"></span>080.0444.333</a>', 'rovoko' ),
					'required'     => array( 'header_top_html', '=', '1' ),
				),
				array(
					'title'        => esc_html__( 'Custom HTML 3', 'rovoko' ),
					'id'           => 'header_top_custom_html_3',
					'type'         => 'textarea',
					'default'      => '',
					// __( '<i class="flaticon-place"></i><a href="#">Store Locator</a>', 'rovoko' ),
					'rows'         => 3,
					'validate'     => 'html_custom',
					'allowed_html' => $allowed_html,
					'required'     => array(
						array( 'header_top_layout', '=', array( 'layout-3' ) ),
						array( 'header_top_html', '=', '1' ),
					)
				),
				array(
					'id'       => 'header_top_button',
					'title'    => esc_html__( 'Show Button', 'rovoko' ),
					'subtitle' => esc_html__( 'Show Button or not', 'rovoko' ),
					'type'     => 'button_set',
					'options'  => $options_width,
					'default'  => $default_value,
					'required' => array( 'header_top_layout', '=', array( 'layout-1', 'layout-2' ) ),
				),
				array(
					'title'    => esc_html__( 'Button text', 'rovoko' ),
					'id'       => 'header_top_button_text',
					'type'     => 'text',
					'default'  => esc_html__( 'we\'re hiring - Join Us', 'rovoko' ),
					'required' => array(
						array( 'header_top_layout', '=', array( 'layout-1', 'layout-2' ) ),
						array( 'header_top_button', '=', '1' ),
					)
				),
				array(
					'title'    => esc_html__( 'Button URL', 'rovoko' ),
					'id'       => 'header_top_button_url',
					'type'     => 'text',
					'default'  => esc_html__( '#', 'rovoko' ),
					'required' => array(
						array( 'header_top_layout', '=', array( 'layout-1', 'layout-2' ) ),
						array( 'header_top_button', '=', '1' ),
					)
				),

				array(
					'id'       => 'header_top_currency',
					'title'    => esc_html__( 'Currency', 'rovoko' ),
					'subtitle' => esc_html__( 'Show Currency or not', 'rovoko' ),
					'type'     => 'button_set',
					'options'  => $options_width,
					'default'  => $default_value,
					'required' => array( 'header_top_layout', '=', array( 'layout-3' ) ),
				),
				array(
					'id'       => 'header_top_register',
					'title'    => esc_html__( 'Register and Login', 'rovoko' ),
					'subtitle' => esc_html__( 'Show Register and Login or not', 'rovoko' ),
					'type'     => 'button_set',
					'options'  => $options_width,
					'default'  => $default_value,
					'required' => array( 'header_top_layout', '=', array( 'layout-3' ) ),
				),
			)
		);
	}
}

/**
 * Theme Options
 * Add option repeated for theme/ meta option
 */
if ( ! function_exists( 'rovoko_header_layout' ) ) {
	function rovoko_header_layout( $default = false ) {
		$layouts = [];
		if ( $default ) {
			$layouts['-1']   = get_template_directory_uri() . '/assets/images/default.png';
			$layouts['none'] = get_template_directory_uri() . '/assets/images/none.png';
		}
		$layouts['1'] = get_template_directory_uri() . '/assets/images/header/header-1.png';
		$layouts['2'] = get_template_directory_uri() . '/assets/images/header/header-2.png';

		return $layouts;
	}
}

if ( ! function_exists( 'rovoko_header_opts' ) ) {
	function rovoko_header_opts( $args = [] ) {
		$args          = wp_parse_args( $args, [
			'default' => false
		] );
		$default_value = '1';
		$default_menu  = '0';
		if ( $args['default'] === true ) {
			$options_width = array(
				'-1' => esc_html__( 'Default', 'rovoko' ),
				'1'  => esc_html__( 'Yes', 'rovoko' ),
				'0'  => esc_html__( 'No', 'rovoko' ),
			);

			$default_value = $default_menu = $default_width_value = '-1';
		} else {
			$options_width       = array(
				'1' => esc_html__( 'Yes', 'rovoko' ),
				'0' => esc_html__( 'No', 'rovoko' ),
			);
			$default_width_value = '0';
		}

		return array(
			array(
				'id'       => 'header_layout',
				'type'     => 'image_select',
				'title'    => esc_html__( 'Layout', 'rovoko' ),
				'subtitle' => esc_html__( 'Select a layout for header.', 'rovoko' ),
				'options'  => rovoko_header_layout( $args['default'] ),
				'default'  => $default_value
			),
			array(
				'id'       => 'header_menu',
				'type'     => 'select',
				'options'  => rovoko_get_nav_menu( [ 'default' => $args['default'], 'none' => true ] ),
				'default'  => $default_menu,
				'title'    => esc_html__( 'Header Menu', 'rovoko' ),
				'subtitle' => esc_html__( 'Choose a menu to show', 'rovoko' ),
			),
			array(
				'id'       => 'header_design',
				'type'     => 'info',
				'style'    => 'success',
				'title'    => esc_html__( 'Header Design', 'rovoko' ),
				'subtitle' => esc_html__( 'Custom header style like: background, text color, link color, border style, ...', 'rovoko' ),
			),
			array(
				'title'    => esc_html__( 'Header Width', 'rovoko' ),
				'subtitle' => esc_html__( 'Make header content full width or not', 'rovoko' ),
				'id'       => 'header_fullwidth',
				'type'     => 'button_set',
				'options'  => $options_width,
				'default'  => $default_width_value,
				'required' => array(
					array( 'header_layout', '!=', '3' )
				)
			),
			array(
				'id'     => 'header_bg',
				'type'   => 'background',
				'title'  => esc_html__( 'Header Background', 'rovoko' ),
				'output' => array( '.header-default, .topbar.topbar-layout-2 .topbar-content:after ' )
			),
			array(
				'title'        => esc_html__( 'Header Width', 'rovoko' ),
				'subtitle'     => esc_html__( 'Enter the width for side navigation header', 'rovoko' ),
				'id'           => 'header_sidewidth',
				'type'         => 'dimensions',
				'height'       => false,
				'units'        => array( 'px' ),
				'force_output' => true,
				'required'     => array(
					array( 'header_layout', '=', '3' )
				),
			),

			array(
				'id'      => 'header_text_color',
				'type'    => 'color_rgba',
				'title'   => esc_html__( 'Text Color', 'rovoko' ),
				'default' => '',
				'output'  => array( '.header-default' )
			),
			array(
				'id'    => 'header_link_colors',
				'type'  => 'link_color',
				'title' => esc_html__( 'Link colors', 'rovoko' ),
			),
			array(
				'id'       => 'header_border',
				'type'     => 'border',
				'all'      => false,
				'color'    => false,
				'title'    => esc_html__( 'Border Style', 'rovoko' ),
				'subtitle' => esc_html__( 'Add your custom border design', 'rovoko' ),
				'output'   => array( '.header-default' )
			),
			array(
				'id'       => 'header_border_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Border Color', 'rovoko' ),
				'subtitle' => esc_html__( 'Add your custom border color', 'rovoko' ),
				'output'   => array(
					'border-color' => '.header-default'
				)
			),
			array(
				'title'        => esc_html__( 'Menu Height', 'rovoko' ),
				'subtitle'     => esc_html__( 'Enter the height for Menu', 'rovoko' ),
				'id'           => 'main_menu_height',
				'type'         => 'dimensions',
				'width'        => false,
				'units'        => array( 'px' ),
				'default'      => array(),
				'required'     => array(
					array( 'header_layout', '!=', '3' )
				),
				'force_output' => true
			),
			array(
				'id'           => 'header_layout_2bg',
				'type'         => 'color_rgba',
				'title'        => esc_html__( 'Menu Background Color', 'rovoko' ),
				'output'       => array(
					'background-color' => '.header-default .sub-header'
				),
				'required'     => array( 'header_layout', '=', '2' ),
				'force_output' => true
			),
		);
	}
}

/**
 * Theme Option:
 * Header Attributes
 *
 */
if ( ! function_exists( 'rovoko_header_atts' ) ) {
	function rovoko_header_atts( $default = false ) {
		$header_mobile_nav_icon_type = array(
			'icon' => esc_html__( 'Icon', 'rovoko' ),
			'text' => esc_html__( 'Text', 'rovoko' ),
		);
		if ( $default ) {
			$options       = array(
				'-1' => esc_html__( 'Default', 'rovoko' ),
				'1'  => esc_html__( 'Yes', 'rovoko' ),
				'0'  => esc_html__( 'No', 'rovoko' ),
			);
			$default_value = $header_mobile_nav_icon_type_value = '-1';

			$header_mobile_nav_icon_type['-1'] = esc_html__( 'Default', 'rovoko' );
			$header_side_nav_icon_type['-1']   = esc_html__( 'Default', 'rovoko' );
		} else {
			$options                           = array(
				'1' => esc_html__( 'Yes', 'rovoko' ),
				'0' => esc_html__( 'No', 'rovoko' ),
			);
			$default_value                     = '0';
			$header_mobile_nav_icon_type_value = 'icon';
		}

		return array_merge(
			array(
				array(
					'id'       => 'header_attr',
					'type'     => 'info',
					'style'    => 'success',
					'title'    => esc_html__( 'Header Attributes', 'rovoko' ),
					'subtitle' => esc_html__( 'Choose header attributes to show', 'rovoko' ),
				),
				array(
					'title'    => esc_html__( 'Mobile Menu Icon Style', 'rovoko' ),
					'subtitle' => esc_html__( 'Choose style of mobile menu icon', 'rovoko' ),
					'id'       => 'header_mobile_nav_icon_type',
					'type'     => 'select',
					'options'  => $header_mobile_nav_icon_type,
					'default'  => $header_mobile_nav_icon_type_value,
				),
				array(
					'title'    => esc_html__( 'Social Menu', 'rovoko' ),
					'subtitle' => esc_html__( 'Show/Hide social menu', 'rovoko' ),
					'id'       => 'header_social_menu_items',
					'type'     => 'button_set',
					'options'  => $options,
					'default'  => $default_value,
					'required' => array( 'header_layout', '=', array( '1' ) ),
				),
				array(
					'id'       => 'social_menu_items',
					'type'     => 'sorter',
					'title'    => esc_html__( 'Social menu items', 'rovoko' ),
					'options'  => array(
						'Enabled'  => array(
							'social_facebook_url'  => esc_html__( 'Facebook', 'rovoko' ),
							'social_twitter_url'   => esc_html__( 'Twitter', 'rovoko' ),
							'social_pinterest_url' => esc_html__( 'Pinterest', 'rovoko' ),
							'social_dribbble_url'  => esc_html__( 'Dribbble', 'rovoko' ),
						),
						'Disabled' => array(
							'social_inkedin_url'     => esc_html__( 'Inkedin', 'rovoko' ),
							'social_rss_url'         => esc_html__( 'rss', 'rovoko' ),
							'social_instagram_url'   => esc_html__( 'Instagram', 'rovoko' ),
							'social_google_url'      => esc_html__( 'Google', 'rovoko' ),
							'social_skype_url'       => esc_html__( 'Skype', 'rovoko' ),
							'social_vimeo_url'       => esc_html__( 'Vimeo', 'rovoko' ),
							'social_youtube_url'     => esc_html__( 'Youtube', 'rovoko' ),
							'social_yelp_url'        => esc_html__( 'Yelp', 'rovoko' ),
							'social_tumblr_url'      => esc_html__( 'Tumblr', 'rovoko' ),
							'social_tripadvisor_url' => esc_html__( 'Tripadvisor', 'rovoko' ),
						)
					),
					'required' => array( 'header_social_menu_items', '=', array( '1' ) ),
				),
				array(
					'title'    => esc_html__( 'Custom HTML', 'rovoko' ),
					'subtitle' => esc_html__( 'Show/Hide Custom HTML', 'rovoko' ),
					'id'       => 'header_custom_html',
					'type'     => 'button_set',
					'options'  => $options,
					'default'  => $default_value,
					'required' => array( 'header_layout', '=', array( '1' ) ),
				),
				array(
					'title'        => esc_html__( 'Custom HTML', 'rovoko' ),
					'id'           => 'header_custom_text',
					'type'         => 'textarea',
					'default'      => '', //<a href="#"><strong>Sign in or Create Account</strong></a>
					'rows'         => 3,
					'validate'     => 'html_custom',
					'allowed_html' => array(
						'a'      => array( 'href' => array(), 'title' => array() ),
						'i'      => array( 'class' => array() ),
						'span'   => array(),
						'em'     => array(),
						'p'      => array(),
						'strong' => array(),
					),
					'required'     => array(
						array( 'header_layout', '=', array( '1' ) ),
						array( 'header_custom_html', '=', array( '1' ) ),
					)
				),
				array(
					'title'    => esc_html__( 'Show Search', 'rovoko' ),
					'subtitle' => esc_html__( 'Show/Hide search icon', 'rovoko' ),
					'id'       => 'header_search',
					'type'     => 'button_set',
					'options'  => $options,
					'default'  => $default_value,
					'required' => array( 'header_layout', '!=', 'none' ),
				),
				array(
					'id'           => 'header_search_color',
					'type'         => 'color_rgba',
					'title'        => esc_html__( 'Background Color', 'rovoko' ),
					'default'      => '#f9f9f9',
					'output'       => array(
						'background-color' => '.ef5-header-search-icon'
					),
					'required'     => array( 'header_search', '!=', '0' ),
					'force_output' => true
				),
			),
			rovoko_header_wc_attrs( $options, $default_value ),
			rovoko_header_donate( [ 'default' => $default ] ),
			array(
				array(
					'id'       => 'header_side_copyright',
					'type'     => 'textarea',
					'default'  => sprintf( '&copy; EF5Frame. by <a href="%s">SpyroPress</a>', esc_url( 'spyropress.com' ) ),
					'required' => array( 'header_layout', '=', '3' ),
					'title'    => esc_html__( 'Copyright Text', 'rovoko' ),
					'subtitle' => esc_html__( 'Enter your copyright text', 'rovoko' ),
				)
			)

		);
	}
}

/**
 * Theme Options
 * Show cart, wishlist, ... icon
 * Require WooCommerce, WooCommerce Smash Wishlist, and more to work
 *
 */
function rovoko_header_wc_attrs( $options, $default_value ) {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return array();
	}
	$opts = [
		array(
			'title'    => esc_html__( 'Show Cart', 'rovoko' ),
			'subtitle' => esc_html__( 'Show/Hide cart icon', 'rovoko' ),
			'id'       => 'header_cart',
			'type'     => 'button_set',
			'options'  => $options,
			'default'  => $default_value,
		),
		array(
			'title'    => esc_html__( 'Subtotal', 'rovoko' ),
			'subtitle' => esc_html__( 'Show/Hide subtotal', 'rovoko' ),
			'id'       => 'header_cart_subtotal',
			'type'     => 'button_set',
			'options'  => $options,
			'default'  => $default_value,
			'required' => array( 'header_cart', '=', '1' ),
		)
	];
	if ( class_exists( 'WPcleverWoosw' ) ) {
		$opts[] = array(
			'title'    => esc_html__( 'Show Wishlist', 'rovoko' ),
			'subtitle' => esc_html__( 'Show/Hide Wishlist icon', 'rovoko' ),
			'id'       => 'header_wishlist',
			'type'     => 'button_set',
			'options'  => $options,
			'default'  => $default_value,
		);
	}
	if ( class_exists( 'WPcleverWooscp' ) ) {
		$opts[] = array(
			'title'    => esc_html__( 'Show Compare', 'rovoko' ),
			'subtitle' => esc_html__( 'Show/Hide Compare icon', 'rovoko' ),
			'id'       => 'header_compare',
			'type'     => 'button_set',
			'options'  => $options,
			'default'  => $default_value,
		);
	}

	return $opts;
}


/**
 * Theme Options
 * Show SingIn / SingUp button
 * Require CSH Login Plugin
 *
 */
if ( ! function_exists( 'rovoko_header_signin_signup_opts' ) ) {
	function rovoko_header_signin_signup_opts( $args = [] ) {
		if ( ! function_exists( 'cshlg_add_login_form' ) ) {
			return array();
		}
		$args = wp_parse_args( $args, [
			'default' => false
		] );
		if ( $args['default'] ) {
			$options       = array(
				'-1' => esc_html__( 'Default', 'rovoko' ),
				'1'  => esc_html__( 'Yes', 'rovoko' ),
				'0'  => esc_html__( 'No', 'rovoko' ),
			);
			$default_value = '-1';
		} else {
			$options       = array(
				'1' => esc_html__( 'Yes', 'rovoko' ),
				'0' => esc_html__( 'No', 'rovoko' ),
			);
			$default_value = '0';
		}

		return array(
			array(
				'title'    => esc_html__( 'Show SignIn', 'rovoko' ),
				'subtitle' => esc_html__( 'Show/Hide SignIn Button', 'rovoko' ),
				'id'       => 'header_signin',
				'type'     => 'button_set',
				'options'  => $options,
				'default'  => $default_value,
			),
			array(
				'title'    => esc_html__( 'SignIn Label', 'rovoko' ),
				'id'       => 'header_signin_label',
				'type'     => 'text',
				'default'  => esc_html__( 'Sign In', 'rovoko' ),
				'required' => array( 'header_signin', '!=', '0' )
			),
			array(
				'title'    => esc_html__( 'Show SignUp', 'rovoko' ),
				'subtitle' => esc_html__( 'Show/Hide SignUp Button', 'rovoko' ),
				'id'       => 'header_signup',
				'type'     => 'button_set',
				'options'  => $options,
				'default'  => $default_value,
			),
			array(
				'title'    => esc_html__( 'SignUp Label', 'rovoko' ),
				'id'       => 'header_signup_label',
				'type'     => 'text',
				'default'  => esc_html__( 'Sign Up', 'rovoko' ),
				'required' => array( 'header_signup', '!=', '0' )
			)
		);
	}
}

/**
 * Theme Options
 * Show SingIn / SingUp button
 * Require CSH Login Plugin
 *
 */
if ( ! function_exists( 'rovoko_header_donate' ) ) {
	function rovoko_header_donate( $args = [] ) {
		if ( ! class_exists( 'EF5Payments' ) ) {
			return array();
		}
		$args = wp_parse_args( $args, [
			'default' => false
		] );
		if ( $args['default'] ) {
			$options       = array(
				'-1' => esc_html__( 'Default', 'rovoko' ),
				'1'  => esc_html__( 'Yes', 'rovoko' ),
				'0'  => esc_html__( 'No', 'rovoko' ),
			);
			$default_value = '-1';
		} else {
			$options       = array(
				'1' => esc_html__( 'Yes', 'rovoko' ),
				'0' => esc_html__( 'No', 'rovoko' ),
			);
			$default_value = '0';
		}

		return array(
			array(
				'title'    => esc_html__( 'Show Donate', 'rovoko' ),
				'subtitle' => esc_html__( 'Show/Hide Donate Button', 'rovoko' ),
				'id'       => 'header_donate',
				'type'     => 'button_set',
				'options'  => $options,
				'default'  => $default_value,
			),
			array(
				'title'    => esc_html__( 'Button Label', 'rovoko' ),
				'id'       => 'header_donate_label',
				'type'     => 'text',
				'default'  => esc_html__( 'Donate Now', 'rovoko' ),
				'required' => array( 'header_donate', '!=', '0' )
			),
			array(
				'title'    => esc_html__( 'Donate for?', 'rovoko' ),
				'subtitle' => esc_html__( 'Choose default item for donate, if not, the first item will choose', 'rovoko' ),
				'id'       => 'header_donate_item',
				'type'     => 'select',
				'options'  => rovoko_list_post( 'ef5_donation' ),
				'default'  => '',
				'required' => array( 'header_donate', '!=', '0' )
			)
		);
	}
}

/**
 * Main Logo
 */
if ( ! function_exists( 'rovoko_header_main_logo' ) ) {
	function rovoko_header_main_logo( $args = [] ) {
		$args = wp_parse_args( $args, [
			'subsection' => true
		] );

		return array(
			'title'      => esc_html__( 'Logo', 'rovoko' ),
			'icon'       => 'el-icon-picture',
			'subsection' => $args['subsection'],
			'fields'     => array(
				array(
					'id'             => 'logo',
					'type'           => 'media',
					'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'svg' ),
					'title'          => esc_html__( 'Logo', 'rovoko' ),
					'subtitle'       => esc_html__( 'Choose your logo. If not set, default Logo will be used', 'rovoko' )
				),
				array(
					'id'       => 'logo_size',
					'type'     => 'dimensions',
					'title'    => esc_html__( 'Logo Size', 'rovoko' ),
					'subtitle' => esc_html__( 'Enter size (width x height) for your logo, just in case the logo is too large. If not set, default size will be used', 'rovoko' ),
					'units'    => array( 'px' ),
					'default'  => array(),
				),
			)
		);
	}
}

/**
 * Main Logo
 */
if ( ! function_exists( 'rovoko_header_page_logo' ) ) {
	function rovoko_header_page_logo( $args = [] ) {
		$args = wp_parse_args( $args, [
			'subsection' => true
		] );

		return array(
			'title'      => esc_html__( 'Logo', 'rovoko' ),
			'icon'       => 'el-icon-picture',
			'subsection' => $args['subsection'],
			'fields'     => array(
				array(
					'id'             => 'logo',
					'type'           => 'media',
					'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'svg' ),
					'title'          => esc_html__( 'Main Logo', 'rovoko' ),
					'subtitle'       => esc_html__( 'Choose your logo. If not set, default Logo will be used', 'rovoko' )
				),
				array(
					'id'             => 'sticky_logo',
					'type'           => 'media',
					'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'svg' ),
					'title'          => esc_html__( 'Sticky Logo', 'rovoko' ),
					'subtitle'       => esc_html__( 'Choose your sticky logo. If not set, default Logo will be used', 'rovoko' )
				),
				array(
					'id'       => 'logo_size',
					'type'     => 'dimensions',
					'title'    => esc_html__( 'Logo Size', 'rovoko' ),
					'subtitle' => esc_html__( 'Enter size (width x height) for your logo, just in case the logo is too large. If not set, default size will be used', 'rovoko' ),
					'units'    => array( 'px' ),
					'default'  => array(),
				),
			)
		);
	}
}

/**
 * Ontop Header
 */
if ( ! function_exists( 'rovoko_ontop_header_opts' ) ) {
	function rovoko_ontop_header_opts( $args = [] ) {
		$args         = wp_parse_args( $args, [
			'default'    => false,
			'subsection' => true
		] );
		$force_output = $args['default'] ? true : false;
		if ( $args['default'] ) {
			$options       = array(
				'-1' => esc_html__( 'Default', 'rovoko' ),
				'1'  => esc_html__( 'Yes', 'rovoko' ),
				'0'  => esc_html__( 'No', 'rovoko' ),
			);
			$default_value = '-1';
		} else {
			$options       = array(
				'1' => esc_html__( 'Yes', 'rovoko' ),
				'0' => esc_html__( 'No', 'rovoko' ),
			);
			$default_value = '0';
		}

		return array(
			'title'      => esc_html__( 'On Top Header', 'rovoko' ),
			'icon'       => 'el-icon-credit-card ',
			'subsection' => $args['subsection'],
			'fields'     => array(
				array(
					'id'       => 'header_ontop',
					'type'     => 'button_set',
					'title'    => esc_html__( 'Header On top', 'rovoko' ),
					'subtitle' => esc_html__( 'Header will be on top when applicable.', 'rovoko' ),
					'options'  => $options,
					'default'  => $default_value
				),
				array(
					'id'       => 'header_ontop_top_space',
					'type'     => 'dimensions',
					'title'    => esc_html__( 'Top Space', 'rovoko' ),
					'subtitle' => esc_html__( 'Add a space from top to header', 'rovoko' ),
					'units'    => array( 'px' ),
					'width'    => false,
					'default'  => array(),
					'required' => array( 'header_ontop', '=', '1' )
				),
				array(
					'id'       => 'ontop_logo_design',
					'type'     => 'info',
					'style'    => 'success',
					'title'    => esc_html__( 'On top Logo', 'rovoko' ),
					'subtitle' => esc_html__( 'Custon Logo', 'rovoko' ),
					'required' => array( 'header_ontop', '=', '1' )
				),
				array(
					'id'       => 'ontop_logo',
					'type'     => 'media',
					'title'    => esc_html__( 'On top Logo', 'rovoko' ),
					'subtitle' => esc_html__( 'If not set, default logo will be used.', 'rovoko' ),
					'required' => array( 'header_ontop', '=', '1' )
				),
				array(
					'id'       => 'ontop_logo_maxh',
					'type'     => 'dimensions',
					'title'    => esc_html__( 'Logo Size', 'rovoko' ),
					'subtitle' => esc_html__( 'Enter size for your logo in on top header, just in case the logo is too large. If not set, default size will be used', 'rovoko' ),
					'units'    => array( 'px' ),
					'default'  => array(),
					'required' => array( 'header_ontop', '=', '1' )
				),
				array(
					'id'       => 'ontop_header_design',
					'type'     => 'info',
					'style'    => 'success',
					'title'    => esc_html__( 'Header Design', 'rovoko' ),
					'subtitle' => esc_html__( 'Custom on top header style like: background, color, space, ...', 'rovoko' ),
					'required' => array( 'header_ontop', '=', '1' )
				),
				array(
					'id'           => 'ontop_header_bg',
					'type'         => 'color_rgba',
					'title'        => esc_html__( 'Background', 'rovoko' ),
					'output'       => array(
						'background-color' => '.header-ontop .main-header .header-inner'
					),
					'force_output' => $force_output,
					'required'     => array( 'header_ontop', '=', '1' )
				),
				array(
					'id'           => 'ontop_header_text_color',
					'type'         => 'color_rgba',
					'title'        => esc_html__( 'Text Color', 'rovoko' ),
					'default'      => '',
					'output'       => array(
						'color' => '.header-ontop'
					),
					'force_output' => $force_output,
					'required'     => array( 'header_ontop', '=', '1' )
				),
				array(
					'id'       => 'ontop_link_colors',
					'type'     => 'link_color',
					'title'    => esc_html__( 'Link colors', 'rovoko' ),
					'required' => array( 'header_ontop', '=', '1' )
				),
				array(
					'id'           => 'header_ontop_border',
					'type'         => 'border',
					'all'          => false,
					'color'        => false,
					'title'        => esc_html__( 'Border Style', 'rovoko' ),
					'subtitle'     => esc_html__( 'Add your custom border design', 'rovoko' ),
					'output'       => array( '.header-ontop' ),
					'force_output' => $force_output,
					'required'     => array( 'header_ontop', '=', '1' )
				),
				array(
					'id'           => 'header_ontop_border_color',
					'type'         => 'color_rgba',
					'title'        => esc_html__( 'Border Color', 'rovoko' ),
					'subtitle'     => esc_html__( 'Add your custom border color', 'rovoko' ),
					'output'       => array(
						'border-color' => '.header-ontop'
					),
					'force_output' => $force_output,
					'required'     => array( 'header_ontop', '=', '1' )
				)
			)
		);
	}
}

/**
 * Header Sticky Options
 */
if ( ! function_exists( 'rovoko_sticky_header_opts' ) ) {
	function rovoko_sticky_header_opts( $args = [] ) {
		$args = wp_parse_args( $args, [
			'default'    => false,
			'subsection' => true
		] );
		if ( $args['default'] ) {
			$options       = array(
				'-1' => esc_html__( 'Default', 'rovoko' ),
				'1'  => esc_html__( 'Yes', 'rovoko' ),
				'0'  => esc_html__( 'No', 'rovoko' ),
			);
			$default_value = '-1';
		} else {
			$options       = array(
				'1' => esc_html__( 'Yes', 'rovoko' ),
				'0' => esc_html__( 'No', 'rovoko' ),
			);
			$default_value = '0';
		}

		return array(
			'title'      => esc_html__( 'Sticky Header', 'rovoko' ),
			'icon'       => 'el-icon-credit-card ',
			'subsection' => $args['subsection'],
			'fields'     => array(
				array(
					'id'       => 'header_sticky',
					'type'     => 'button_set',
					'title'    => esc_html__( 'Sticky Header', 'rovoko' ),
					'subtitle' => esc_html__( 'Header will be sticked when applicable.', 'rovoko' ),
					'options'  => $options,
					'default'  => $default_value
				),
				array(
					'id'       => 'sticky_logo_design',
					'type'     => 'info',
					'style'    => 'success',
					'title'    => esc_html__( 'Sticky Logo', 'rovoko' ),
					'subtitle' => esc_html__( 'Custon Logo', 'rovoko' ),
					'required' => array( 'header_sticky', '=', '1' )
				),
				array(
					'id'       => 'sticky_logo',
					'type'     => 'media',
					'title'    => esc_html__( 'Sticky Header Logo', 'rovoko' ),
					'subtitle' => esc_html__( 'If not set, default logo will be used.', 'rovoko' ),
					'required' => array( 'header_sticky', '=', '1' )
				),
				array(
					'id'       => 'sticky_logo_maxh',
					'type'     => 'dimensions',
					'title'    => esc_html__( 'Logo Size', 'rovoko' ),
					'subtitle' => esc_html__( 'Enter size for your logo on sticky header, just in case the logo is too large.', 'rovoko' ),
					'units'    => array( 'px' ),
					'default'  => array(),
					'required' => array( 'header_sticky', '=', '1' )
				),
				array(
					'id'       => 'sticky_header_design',
					'type'     => 'info',
					'style'    => 'success',
					'title'    => esc_html__( 'Sticky Header Design', 'rovoko' ),
					'subtitle' => esc_html__( 'Custom sticky header style like: background, color, space, ...', 'rovoko' ),
					'required' => array( 'header_sticky', '=', '1' )
				),
				array(
					'id'       => 'sticky_header_bg',
					'type'     => 'color_rgba',
					'title'    => esc_html__( 'Background', 'rovoko' ),
					'output'   => array(
						'background-color' => '.sticky-on.header-sticky'
					),
					'required' => array( 'header_sticky', '=', '1' )
				),
				array(
					'id'       => 'sticky_header_text_color',
					'type'     => 'color_rgba',
					'title'    => esc_html__( 'Text Color', 'rovoko' ),
					'default'  => '',
					'output'   => array( '.header-sticky' ),
					'required' => array( 'header_sticky', '=', '1' )
				),
				array(
					'id'       => 'sticky_link_colors',
					'type'     => 'link_color',
					'title'    => esc_html__( 'Link colors', 'rovoko' ),
					'output'   => array(
						'color' => '.header-sticky a'
					),
					'required' => array( 'header_sticky', '=', '1' )
				),
				array(
					'id'       => 'header_sticky_border',
					'type'     => 'border',
					'all'      => false,
					'color'    => false,
					'title'    => esc_html__( 'Border Style', 'rovoko' ),
					'subtitle' => esc_html__( 'Add your custom border design', 'rovoko' ),
					'output'   => array( '.header-sticky' ),
					'required' => array( 'header_sticky', '=', '1' )
				),
				array(
					'id'       => 'header_sticky_border_color',
					'type'     => 'color_rgba',
					'title'    => esc_html__( 'Border Color', 'rovoko' ),
					'subtitle' => esc_html__( 'Add your custom border color', 'rovoko' ),
					'output'   => array(
						'border-color' => '.header-sticky'
					),
					'required' => array( 'header_sticky', '=', '1' )
				)
			)
		);
	}
}
/**
 * Theme Options
 * Page title options
 */
if ( ! function_exists( 'rovoko_page_title_opts' ) ) {
	function rovoko_page_title_opts( $args = [] ) {
		$args                      = wp_parse_args( $args, [
			'default' => false
		] );
		$force_output              = $args['default'] ? true : false;
		$default_value             = '1';
		$default_ptitle_full_width = '0';
		$custom_title              = $custom_desc = '';

		$ptitle_layout      = [
			'1' => get_template_directory_uri() . '/assets/images/page-title/01.png',
		];
		$ptitle_full_width  = array(
			'1' => esc_html__( 'Yes', 'rovoko' ),
			'0' => esc_html__( 'No', 'rovoko' ),
		);
		$breadcrumb_on_opts = array(
			'1' => esc_html__( 'Show', 'rovoko' ),
			'0' => esc_html__( 'Hide', 'rovoko' ),
		);
		if ( $args['default'] ) {
			$default_value = $default_ptitle_full_width = '-1';

			$ptitle_layout = [
				                 '-1'   => get_template_directory_uri() . '/assets/images/default.png',
				                 'none' => get_template_directory_uri() . '/assets/images/none.png'
			                 ] + $ptitle_layout;

			$custom_title = array(
				'id'       => 'custom_title',
				'type'     => 'text',
				'title'    => esc_html__( 'Custom Title', 'rovoko' ),
				'subtitle' => esc_html__( 'Use custom title for this page. The default title will be used on document title.', 'rovoko' )
			);

			$custom_desc = array(
				'id'       => 'custom_desc',
				'type'     => 'textarea',
				'title'    => esc_html__( 'Custom description', 'rovoko' ),
				'subtitle' => esc_html__( 'Show custom page description under page title', 'rovoko' )
			);

			$breadcrumb_on_opts = [
				                      '-1' => esc_html__( 'Default', 'rovoko' )
			                      ] + $breadcrumb_on_opts;
			$ptitle_full_width  = [
				                      '-1' => esc_html__( 'Default', 'rovoko' )
			                      ] + $ptitle_full_width;
		}

		return array(
			array(
				'id'       => 'ptitle_layout',
				'type'     => 'image_select',
				'title'    => esc_html__( 'Layout', 'rovoko' ),
				'subtitle' => esc_html__( 'Select a layout for page title.', 'rovoko' ),
				'options'  => $ptitle_layout,
				'default'  => $default_value
			),
			$custom_title,
			$custom_desc,
			array(
				'id'           => 'ptitle_color',
				'type'         => 'color_rgba',
				'title'        => esc_html__( 'Title Color', 'rovoko' ),
				'subtitle'     => esc_html__( 'Page title color.', 'rovoko' ),
				'output'       => array(
					'color' => '.ef5-pagetitle .page-title'
				),
				'force_output' => $force_output,
				'default'      => ''
			),
			array(
				'id'       => 'ptitle_parallax',
				'type'     => 'media',
				'title'    => esc_html__( 'Parallax Image', 'rovoko' ),
				'subtitle' => esc_html__( 'Choose your image', 'rovoko' ),
			),
			array(
				'id'           => 'ptitle_parallax_overlay',
				'type'         => 'color_rgba',
				'title'        => esc_html__( 'Parallax Overlay Color', 'rovoko' ),
				'subtitle'     => esc_html__( 'Add parallax overlay color.', 'rovoko' ),
				'output'       => array(
					'background-color' => '.ef5-pagetitle .parallax:before'
				),
				'force_output' => $force_output,
				'default'      => ''
			),
			array(
				'id'      => 'ptitle_full_width',
				'type'    => 'button_set',
				'options' => $ptitle_full_width,
				'title'   => esc_html__( 'Full Width', 'rovoko' ),
				'default' => $default_ptitle_full_width
			),
			array(
				'id'           => 'ptitle_paddings',
				'type'         => 'spacing',
				'title'        => esc_html__( 'Paddings', 'rovoko' ),
				'subtitle'     => esc_html__( 'Enter inner space.', 'rovoko' ),
				'mode'         => 'padding',
				'units'        => array( 'px' ),
				'output'       => array( '#ef5-page .ef5-pagetitle' ),
				'force_output' => $force_output,
				'default'      => array()
			),
			array(
				'id'           => 'ptitle_margins',
				'type'         => 'spacing',
				'title'        => esc_html__( 'Margin', 'rovoko' ),
				'subtitle'     => esc_html__( 'Enter outer space.', 'rovoko' ),
				'mode'         => 'margin',
				'units'        => array( 'px' ),
				'force_output' => $force_output,
				'output'       => array( '#ef5-page .ef5-pagetitle-wrap' ),
				'default'      => array()
			),
			array(
				'id'       => 'breadcrumb',
				'type'     => 'info',
				'style'    => 'success',
				'title'    => esc_html__( 'Breadcrumb', 'rovoko' ),
				'subtitle' => esc_html__( 'Breadcrumb design', 'rovoko' ),
			),
			array(
				'id'      => 'breadcrumb_on',
				'type'    => 'button_set',
				'options' => $breadcrumb_on_opts,
				'title'   => esc_html__( 'Breadcrumb', 'rovoko' ),
				'default' => $default_value
			),
			array(
				'id'           => 'breadcrumb_bg',
				'type'         => 'color_rgba',
				'title'        => esc_html__( 'Breadcrumb Background Color', 'rovoko' ),
				'output'       => array(
					'background-color' => '.ef5-pagetitle .ef5-breadcrumb .breadcrumb'
				),
				'force_output' => $force_output,
				'required'     => array( 'breadcrumb_on', '=', true )
			),
			array(
				'id'           => 'breadcrumb_color',
				'type'         => 'color',
				'title'        => esc_html__( 'Breadcrumb Text Color', 'rovoko' ),
				'subtitle'     => esc_html__( 'Select text color for breadcrumb', 'rovoko' ),
				'transparent'  => false,
				'output'       => array( '.ef5-pagetitle-wrap .breadcrumb,.ef5-pagetitle-wrap .breadcrumb .separator:empty:before' ),
				'force_output' => $force_output,
				'required'     => array( 'breadcrumb_on', '=', true )
			),
			array(
				'id'           => 'breadcrumb_link_colors',
				'type'         => 'link_color',
				'title'        => esc_html__( 'Breadcrumb Link Colors', 'rovoko' ),
				'subtitle'     => esc_html__( 'Select link colors for breadcrumb', 'rovoko' ),
				'output'       => array( '.ef5-pagetitle-wrap .breadcrumb a, .ef5-pagetitle-wrap .breadcrumb a span:before' ),
				'force_output' => $force_output,
				'default'      => array(),
				'required'     => array( 'breadcrumb_on', '=', true )
			),
			array(
				'id'           => 'breadcrumb_paddings',
				'type'         => 'spacing',
				'title'        => esc_html__( 'Paddings', 'rovoko' ),
				'subtitle'     => esc_html__( 'Enter inner space.', 'rovoko' ),
				'mode'         => 'padding',
				'units'        => array( 'px' ),
				'output'       => array(
					'.ef5-pagetitle .ef5-breadcrumb .breadcrumb',
					'.ef5-pagetitle .ef5-breadcrumb .breadcrumb .breadcrumb-home-icon',
					'.ef5-pagetitle .ef5-breadcrumb .breadcrumb a:nth-child(2).item',
					'.ef5-pagetitle .ef5-breadcrumb .breadcrumb .breadcrumb-home-icon + span.item.title',
				),
				'force_output' => $force_output,
				'default'      => array(),
				'required'     => array( 'breadcrumb_on', '=', true )
			),
		);
	}
}
/**
 * Widget Options
 * sidebar position
 */
function rovoko_sidebar_position_opts( $default = false ) {
	$options_default = array( '-1' => esc_html__( 'Default', 'rovoko' ) );
	$options         = array(
		'none'   => esc_html__( 'No Widget', 'rovoko' ),
		'center' => esc_html__( 'No Widget - Content Center', 'rovoko' ),
		'left'   => esc_html__( 'Left', 'rovoko' ),
		'right'  => esc_html__( 'Right', 'rovoko' ),
		'bottom' => esc_html__( 'Below Content', 'rovoko' )
	);
	if ( $default ) {
		return $options_default + $options;
	} else {
		return $options;
	}
}

/* Page Options */
if ( ! function_exists( 'rovoko_page_opts' ) ) {
	function rovoko_page_opts( $default = false ) {
		$default_value = rovoko_page_sidebar_position();
		if ( $default ) {
			$default_value = '-1';
		}

		return array(
			array(
				'id'       => 'page_sidebar_pos',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Layouts', 'rovoko' ),
				'subtitle' => esc_html__( 'select a layout for single...', 'rovoko' ),
				'options'  => rovoko_sidebar_position_opts( $default ),
				'default'  => $default_value
			)
		);
	}
}

/**
 * WooCommerce Options
 */
if ( ! function_exists( 'rovoko_woocommerce_theme_opts' ) ) {
	function rovoko_woocommerce_theme_opts( $default = false ) {
		$gallery_layout                 = $gallery_thumb_position = array();
		$default_value                  = 'none';
		$default_gallery_layout         = 'simple';
		$default_gallery_thumb_position = 'thumb-right';
		if ( $default ) {
			$gallery_layout['-1']           = esc_html__( 'Default', 'rovoko' );
			$gallery_thumb_position['-1']   = esc_html__( 'Default', 'rovoko' );
			$default_value                  = '-1';
			$default_gallery_layout         = '-1';
			$default_gallery_thumb_position = '-1';
		}
		$gallery_layout['simple']      = esc_html__( 'Simple', 'rovoko' );
		$gallery_layout['thumbnail_v'] = esc_html__( 'Thumbnail Vertical', 'rovoko' );
		$gallery_layout['thumbnail_h'] = esc_html__( 'Thumbnail Horizontal', 'rovoko' );

		$gallery_thumb_position['thumb-left']  = esc_html__( 'Left', 'rovoko' );
		$gallery_thumb_position['thumb-right'] = esc_html__( 'Right', 'rovoko' );

		return array(
			'title'      => esc_html__( 'WooCommerce', 'rovoko' ),
			'icon'       => 'el el-shopping-cart',
			'subsection' => false,
			'fields'     => array(
				array(
					'id'       => 'loop_product_image',
					'type'     => 'info',
					'style'    => 'success',
					'title'    => esc_html__( 'Products Images', 'rovoko' ),
					'subtitle' => esc_html__( 'Custom products image size, ...', 'rovoko' ),
				),
				array(
					'title'    => esc_html__( 'Main Images', 'rovoko' ),
					'subtitle' => esc_html__( 'Enter the Main image size', 'rovoko' ),
					'id'       => 'product_single_image_size',
					'type'     => 'dimensions',
					'units'    => array( 'px' ),
					'default'  => array(),
				),
				array(
					'title'    => esc_html__( 'Loop Images', 'rovoko' ),
					'subtitle' => esc_html__( 'Enter the Loop image size', 'rovoko' ),
					'id'       => 'product_loop_image_size',
					'type'     => 'dimensions',
					'units'    => array( 'px' ),
					'default'  => array(),
				),
				array(
					'id'       => 'loop_product_design',
					'type'     => 'info',
					'style'    => 'success',
					'title'    => esc_html__( 'Loop Products Design', 'rovoko' ),
					'subtitle' => esc_html__( 'Custom products design, ...', 'rovoko' ),
				),
				array(
					'id'            => 'products_per_page',
					'type'          => 'slider',
					'title'         => esc_html__( 'Number Products', 'rovoko' ),
					'subtitle'      => esc_html__( 'Choose number products to show on archive page, ...', 'rovoko' ),
					'default'       => 12,
					'min'           => 1,
					'step'          => 1,
					'max'           => 50,
					'display_value' => 'label'
				),
				array(
					'id'            => 'products_columns',
					'type'          => 'slider',
					'title'         => esc_html__( 'Products Columns', 'rovoko' ),
					'subtitle'      => esc_html__( 'Choose products columns show on archive page, ...', 'rovoko' ),
					'default'       => 4,
					'min'           => 1,
					'step'          => 1,
					'max'           => 4,
					'display_value' => 'label'
				),
				array(
					'id'       => 'shop_sidebar_pos',
					'type'     => 'button_set',
					'title'    => esc_html__( 'Layouts', 'rovoko' ),
					'subtitle' => esc_html__( 'select a layout for products page', 'rovoko' ),
					'options'  => array(
						'none'   => esc_html__( 'No Widget', 'rovoko' ),
						'left'   => esc_html__( 'Left', 'rovoko' ),
						'right'  => esc_html__( 'Right', 'rovoko' ),
						'bottom' => esc_html__( 'Below Content', 'rovoko' )
					),
					'default'  => rovoko_shop_sidebar_position()
				),
				array(
					'id'       => 'single_product_design',
					'type'     => 'info',
					'style'    => 'success',
					'title'    => esc_html__( 'Single Product Design', 'rovoko' ),
					'subtitle' => esc_html__( 'Custom single product design, ...', 'rovoko' ),
				),
				array(
					'id'      => 'product_single_set_title_is_page_title',
					'title'   => esc_html__( 'Move single product title to page title section', 'rovoko' ),
					'type'    => 'switch',
					'default' => true,
				),
				array(
					'id'          => 'custom_product_single_title',
					'title'       => esc_html__( 'Custom the single product title text', 'rovoko' ),
					'type'        => 'text',
					'default'     => '',
					'placeholder' => esc_html__( 'Product Detail', 'rovoko' ),
					'required'    => array( 'product_single_set_title_is_page_title', '=', false )
				),
				array(
					'id'       => 'product_sidebar_pos',
					'type'     => 'button_set',
					'title'    => esc_html__( 'Layouts', 'rovoko' ),
					'subtitle' => esc_html__( 'select a layout for single product page', 'rovoko' ),
					'options'  => rovoko_sidebar_position_opts(),
					'default'  => rovoko_product_sidebar_position()
				),
				array(
					'id'       => 'product_gallery_layout',
					'type'     => 'button_set',
					'title'    => esc_html__( 'Layouts', 'rovoko' ),
					'subtitle' => esc_html__( 'select a layout for single...', 'rovoko' ),
					'options'  => $gallery_layout,
					'default'  => $default_gallery_layout
				),
				array(
					'id'       => 'product_gallery_thumb_position',
					'type'     => 'button_set',
					'title'    => esc_html__( 'Thumbnail Position', 'rovoko' ),
					'subtitle' => esc_html__( 'select a position for gallery thumbnail', 'rovoko' ),
					'options'  => $gallery_thumb_position,
					'default'  => $default_gallery_thumb_position,
					'required' => array(
						array( 'product_gallery_layout', '=', 'thumbnail_v' )
					)
				),
				array(
					'title'    => esc_html__( 'Gallery Images Size', 'rovoko' ),
					'subtitle' => esc_html__( 'Enter the gallery image size (regenerate-thumbnails after change)', 'rovoko' ),
					'id'       => 'product_gallery_thumbnail_size',
					'type'     => 'dimensions',
					'units'    => array( 'px' ),
					'default'  => array(),
					'required' => array(
						array( 'product_gallery_layout', '=', 'simple' )
					)
				),
				array(
					'title'    => esc_html__( 'Gallery Images Size', 'rovoko' ),
					'subtitle' => esc_html__( 'Enter the gallery image size', 'rovoko' ),
					'id'       => 'product_gallery_thumbnail_v_size',
					'type'     => 'dimensions',
					'units'    => array( 'px' ),
					'default'  => array(),
					'required' => array(
						array( 'product_gallery_layout', '=', 'thumbnail_v' )
					)
				),
				array(
					'title'    => esc_html__( 'Gallery Images Size', 'rovoko' ),
					'subtitle' => esc_html__( 'Enter the gallery image size', 'rovoko' ),
					'id'       => 'product_gallery_thumbnail_h_size',
					'type'     => 'dimensions',
					'units'    => array( 'px' ),
					'default'  => array(),
					'required' => array(
						array( 'product_gallery_layout', '=', 'thumbnail_h' )
					)
				),
				array(
					'title'    => esc_html__( 'Gallery Images Space', 'rovoko' ),
					'subtitle' => esc_html__( 'Enter space between each image', 'rovoko' ),
					'id'       => 'product_gallery_thumbnail_space',
					'type'     => 'dimensions',
					'height'   => false,
					'units'    => array( 'px' ),
					'default'  => array()
				),
				array(
					'id'       => 'product_share_on',
					'title'    => esc_html__( 'Share', 'rovoko' ),
					'subtitle' => esc_html__( 'Show share product to some socials network on each post.', 'rovoko' ),
					'type'     => 'switch',
					'default'  => '0',
				),
				// cart page
				array(
					'title'    => esc_html__( 'Cart item thumbnail size', 'rovoko' ),
					'subtitle' => esc_html__( 'Enter the image size', 'rovoko' ),
					'id'       => 'woocommerce_cart_item_thumbnail_size',
					'type'     => 'dimensions',
					'units'    => array( 'px' ),
					'default'  => array(),
				),
			)
		);
	}
}

/**
 * Theme Options
 * Footer Area
 * Add option repeated for theme/ meta option
 */

if ( ! function_exists( 'rovoko_footer_layout' ) ) {
	function rovoko_footer_layout( $default = false ) {
		$layouts = [];
		if ( $default ) {
			$layouts['-1']   = get_template_directory_uri() . '/assets/images/default.png';
			$layouts['none'] = get_template_directory_uri() . '/assets/images/none.png';
		}
		$layouts['1'] = get_template_directory_uri() . '/assets/images/footer/footer-1.png';
		$layouts['2'] = get_template_directory_uri() . '/assets/images/footer/footer-2.png';

		return $layouts;
	}
}
if ( ! function_exists( 'rovoko_footer_opts' ) ) {
	function rovoko_footer_opts( $args = [] ) {
		$args = wp_parse_args( $args, [
			'default' => false
		] );
		if ( $args['default'] === true ) {
			$button_options     = array(
				'-1' => esc_html__( 'Default', 'rovoko' ),
				'1'  => esc_html__( 'Yes', 'rovoko' ),
				'0'  => esc_html__( 'No', 'rovoko' ),
			);
			$footer_custom_html = $footer_copyright = '';

		} else {
			$button_options     = array(
				'1' => esc_html__( 'Yes', 'rovoko' ),
				'0' => esc_html__( 'No', 'rovoko' ),
			);
			$footer_custom_html = __( '<ul class="footer-custtom-html"><li><a href="#rovoko-search-popup" class="ef5-header-popup"><span class="flaticon-magnifying-glass"></span><p>SEARCH</p></a></li><li><a href="#" class="ef5-header-popup"><span class="flaticon-message"></span><p>CONTACT</p></a></li><li><a href="#" class="ef5-header-popup"><span class="flaticon-information"></span><p>REQUEST INFO</p></a></li><li><a href="#" class="ef5-header-popup"><span class="flaticon-login"></span><p>LOGIN</p></a></li></ul>', 'rovoko' );
			$footer_copyright   = __( '<p><strong>&copy; Copyright <a href="#rovoko">Rovoko</a> 2019. All Right Reserved.<strong></strong></strong></p>', 'rovoko' );
		}
		$default_value = $default_menu = $args['default'] ? '-1' : '';
		$force_output  = $args['default'] ? true : false;
		$allowed_html  = array(
			'a'      => array( 'class' => array(), 'href' => array(), 'title' => array() ),
			'ul'     => array( 'class' => array() ),
			'ol'     => array( 'class' => array() ),
			'li'     => array( 'class' => array() ),
			'i'      => array( 'class' => array() ),
			'span'   => array( 'class' => array() ),
			'em'     => array(),
			'p'      => array(),
			'strong' => array(),
		);

		return array(
			'title'  => esc_html__( 'Footer', 'rovoko' ),
			'icon'   => 'el el-website',
			'fields' => array(
				array(
					'id'          => 'footer_layout',
					'type'        => 'image_select',
					'title'       => esc_html__( 'Layout', 'rovoko' ),
					'subtitle'    => esc_html__( 'Select a layout for upper footer area.', 'rovoko' ),
					'placeholder' => esc_html__( 'Default', 'rovoko' ),
					'options'     => rovoko_footer_layout( $args['default'] ),
					'default'     => $default_value
				),
				array(
					'title'    => esc_html__( 'Footer Width', 'rovoko' ),
					'subtitle' => esc_html__( 'Make footer content full width or not', 'rovoko' ),
					'id'       => 'footer_fullwidth',
					'type'     => 'button_set',
					'options'  => $button_options,
					'default'  => $default_value,
					'required' => array()
				),
				array(
					'id'      => 'footer_bg',
					'type'    => 'background',
					'title'   => esc_html__( 'Footer Background', 'rovoko' ),
					'default' => array( 'background-color' => '#01071e' ),
					'output'  => array( '.ef5-footer-area' ),
				),
				array(
					'id'      => 'footer_text_color',
					'type'    => 'color_rgba',
					'title'   => esc_html__( 'Text Color', 'rovoko' ),
					'default' => array( 'color' => '#999999' ),
					'output'  => array( '.ef5-footer-builder, .footer-layout-1 .widget .widgettitle, .footer-layout-1 .social-items a' )
				),
				array(
					'id'    => 'footer_link_colors',
					'type'  => 'link_color',
					'title' => esc_html__( 'Link colors', 'rovoko' ),
				),
				array(
					'id'             => 'footer_margin',
					'type'           => 'spacing',
					'mode'           => 'margin',
					'units'          => array( 'px' ),
					'units_extended' => 'false',
					'title'          => esc_html__( 'Footer margin', 'rovoko' ),
					'subtitle'       => esc_html__( 'Enter outer space', 'rovoko' ),
					'force_output'   => $force_output,
					'output'         => array(
						'#ef5-footer'
					)
				),
				array(
					'title'        => esc_html__( 'Custom HTML', 'rovoko' ),
					'id'           => 'footer_custom_html',
					'type'         => 'textarea',
					'default'      => $footer_custom_html,
					'rows'         => 7,
					'validate'     => 'html_custom',
					'allowed_html' => $allowed_html,
					'required'     => array(
						array( 'footer_layout', '=', '2' )
					)
				),

				array(
					'id'       => 'footer_menu',
					'type'     => 'select',
					'options'  => rovoko_get_nav_menu( [ 'default' => $args['default'], 'none' => true ] ),
					'default'  => $default_menu,
					'title'    => esc_html__( 'Footer Menu', 'rovoko' ),
					'subtitle' => esc_html__( 'Choose a menu to show', 'rovoko' ),
					'required' => array(
						array( 'footer_layout', '=', '2' )
					)
				),
				rovoko_footer_newletter( $button_options, $default_value ),
				array(
					'id'       => 'social_icon',
					'type'     => 'button_set',
					'title'    => esc_html__( 'Social', 'rovoko' ),
					'subtitle' => esc_html__( 'Show/Hide social icon', 'rovoko' ),
					'options'  => $button_options,
					'default'  => $default_value,
				),
				array(
					'id'       => 'footer_social',
					'type'     => 'sorter',
					'title'    => esc_html__( 'Socials icon', 'rovoko' ),
					'options'  => array(
						'Enabled'  => array(
							'social_facebook_url'  => esc_html__( 'Facebook', 'rovoko' ),
							'social_twitter_url'   => esc_html__( 'Twitter', 'rovoko' ),
							'social_pinterest_url' => esc_html__( 'Pinterest', 'rovoko' ),
							'social_dribbble_url'  => esc_html__( 'Dribbble', 'rovoko' ),
						),
						'Disabled' => array(
							'social_inkedin_url'     => esc_html__( 'Inkedin', 'rovoko' ),
							'social_rss_url'         => esc_html__( 'rss', 'rovoko' ),
							'social_instagram_url'   => esc_html__( 'Instagram', 'rovoko' ),
							'social_google_url'      => esc_html__( 'Google', 'rovoko' ),
							'social_skype_url'       => esc_html__( 'Skype', 'rovoko' ),
							'social_vimeo_url'       => esc_html__( 'Vimeo', 'rovoko' ),
							'social_youtube_url'     => esc_html__( 'Youtube', 'rovoko' ),
							'social_yelp_url'        => esc_html__( 'Yelp', 'rovoko' ),
							'social_tumblr_url'      => esc_html__( 'Tumblr', 'rovoko' ),
							'social_tripadvisor_url' => esc_html__( 'Tripadvisor', 'rovoko' ),
						)
					),
					'required' => array(
						array( 'social_icon', '=', '1' )
					)
				),
				array(
					'id'       => 'footer_bottom',
					'type'     => 'color_rgba',
					'title'    => esc_html__( 'Footer bottom background Color', 'rovoko' ),
					'output'   => array(
						'background-color' => '.footer-bottom'
					),
					'default'  => '#1a1a1a',
					'required' => array( 'footer_layout', '=', '1' ),
				),
				array(
					'title'        => esc_html__( 'Footer Copyright', 'rovoko' ),
					'id'           => 'footer_copyright',
					'type'         => 'textarea',
					'default'      => $footer_copyright,
					'rows'         => 3,
					'validate'     => 'html_custom',
					'allowed_html' => $allowed_html,
				),
				array(
					'id'       => 'footer_bottom_menu',
					'type'     => 'select',
					'options'  => rovoko_get_nav_menu( [ 'default' => $args['default'], 'none' => true ] ),
					'default'  => $default_menu,
					'title'    => esc_html__( 'Footer Bottom Menu', 'rovoko' ),
					'subtitle' => esc_html__( 'Choose a menu to show', 'rovoko' ),
					'required' => array(
						array( 'footer_layout', '=', '1' )
					)
				),
			)
		);
	}
}
function rovoko_footer_newletter( $options, $default_value ) {
	if ( ! class_exists( 'Newsletter' ) ) {
		return array();
	}

	return array(
		'title'    => esc_html__( 'Newsletter', 'rovoko' ),
		'subtitle' => esc_html__( 'Show/Hide Newsletter', 'rovoko' ),
		'id'       => 'footer_newsletter',
		'type'     => 'button_set',
		'options'  => $options,
		'default'  => $default_value,
		'required' => array(
			array( 'footer_layout', '=', '2' )
		)

	);
}
