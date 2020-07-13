<?php
define('REVOKO_ICON_FONT_DIR' , get_template_directory_uri() . '/assets/icon_fonts/');
/**
 * EF5 Systems supported some icon font
 * like: Elegant, ET Line, Flaticon, Linear, Pe7 Stroke, Simple Line
 * use filter: ef5systems_default_extra_icons
 * example: 
 * */
add_filter('ef5systems_default_extra_icons','custom_ef5systems_default_extra_icons');
function custom_ef5systems_default_extra_icons(){
	return [ 'elegant', 'et-line', 'flaticon', 'linear', 'pe-icon-7-stroke', 'simple-line' ];
}


/**
 * Add filter to support your icon font in Mega Menu and VC 
 * user filter: ef5systems_extra_icons
 * @structure add_filter('ef5systems_extra_icons','rovoko_extras_icons');
 * function rovoko_extras_icons(){
	return [
		'fontname' => [
			'title'   => 'Font Name',
			'icon'    => rovoko_iconpicker_fontname_icons(), // icons list
			'css'     => REVOKO_ICON_FONT_DIR . 'fontname/fontname.css',
			'version' => '1.0'
		]
	];
 }
 * NOTE: replace 'ef5-frame', 'Font Name' with your font name
*/
add_filter('ef5systems_extra_icons','rovoko_extras_icons');
function rovoko_extras_icons(){
	return [
		'rovoko' => [
			'title'   => 'Rovoko',
			'icon'    => rovoko_iconpicker_rovoko_icons(), // icons list
			'css'     => REVOKO_ICON_FONT_DIR.'rovoko/rovoko.css',
			'version' => '1.0'
		]
	];
}