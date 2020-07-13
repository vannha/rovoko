<?php
function rovoko_iconpicker_fontname_icons(){
	// add your icon here
	// struct ['icon-class-name' => 'icon name']
	// icon name need in array
	$default_icons = [
		['default' => 'default']
	];
	return array_merge($default_icons, apply_filters('rovoko_iconpicker_fontname_icons', []));
}
//add_filter( 'vc_iconpicker-type-fontname', 'rovoko_vc_iconpicker_type_fontname_icons' );
function rovoko_vc_iconpicker_type_fontname_icons( $icons ) {
	$fontname_icons = rovoko_iconpicker_fontname_icons();
	return array_merge( $icons, $fontname_icons );
}