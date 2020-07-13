<?php
/*Add flast icon to elementor_extends*/
add_filter( 'elementor/icons_manager/additional_tabs', 'rovoko_add_flast_icon' );
function rovoko_add_flast_icon() {
	$args = array(
		'rovoko-icon' => [
			'name'          => 'rovoko-icon',
			'label'         => esc_html__( 'Rovoko icons', 'rovoko' ),
			'url'           => get_template_directory_uri() . '/assets/icon_fonts/rovoko/rovoko.css',
			'enqueue'       => [ get_template_directory_uri() . '/assets/icon_fonts/rovoko/rovoko.css' ],
			'prefix'        => '',
			'displayPrefix' => '',
			'labelIcon'     => 'flaticon-internet-1',
			'ver'           => '5.1.0',
			'fetchJson'     => get_template_directory_uri() . '/assets/icon_fonts/rovoko/rovoko.js',
			'native'        => true,
		]
	);

	return $args;
}
