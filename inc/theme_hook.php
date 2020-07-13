<?php
/**
 * Primary Color 
 * use filter: 'rovoko_primary_color';
 * @return string
 * @example add_filter('rovoko_primary_color', function(){ return '#000000';});
*/
/**
 * Accent Color 
 * use filter : rovoko_accent_color
 * @return string
 * @example add_filter('rovoko_accent_color', function(){ return '#25d6a2';});
*/

/**
 * Page CSS Class
 * use filter: rovoko_page_css_class
 * @return array
 * @example add_filter('rovoko_page_css_class', function($cls) { $cls[] = 'yout-css-class';  return $cls;});
*/

/**
 * Header link color, 
 * use filter: rovoko_header_link_color
 * 
 * @return array('regular' => '', 'hover' => '', 'active' => '')
 * @example add_filter('rovoko_header_link_color', function(){ return ['regular' => 'black', 'hover' => 'red', 'active' => 'violet'];})
*/
/**
 * Header OnTop link color, 
 * use filter: rovoko_ontop_link_color
 * 
 * @return array('regular' => '', 'hover' => '', 'active' => '')
 * @example add_filter('rovoko_ontop_link_color', function(){ return ['regular' => 'black', 'hover' => 'red', 'active' => 'violet'];})
*/

/**
 * Header Sticky link color, 
 * use filter: rovoko_sticky_link_color
 * 
 * @return array('regular' => '', 'hover' => '', 'active' => '')
 * @example add_filter('rovoko_sticky_link_color', function(){ return ['regular' => 'black', 'hover' => 'red', 'active' => 'violet'];})
*/

/**
 * Dropdown Background color, 
 * use filter: rovoko_dropdown_bg
 * 
 * @return string
 * @example add_filter('rovoko_dropdown_bg', function(){ return 'rgba(#000000, 1)';})
*/

/**
 * Dropdown link color, 
 * use filter: rovoko_dropdown_link_colors
 * 
 * @return array('regular' => '', 'hover' => '', 'active' => '')
 * @example add_filter('rovoko_dropdown_link_colors', function(){ return ['regular' => 'white', 'hover' => 'red', 'active' => 'violet'];})
*/

/**
 * Logo Size
 * use filter: rovoko_logo_size
 * @return array(width, height, units)
 * @example add_filter('rovoko_logo_size', function() { return ['width' => '130', 'height' => '51', 'units' => 'px'];});
*/

/**
 * Show Default Post thumbnail
 * use filter : rovoko_default_post_thumbnail
 * @return bool
 * @default false
 * @example add_filter('rovoko_default_post_thumbnail', function(){ return false;});
*/
add_filter('rovoko_default_post_thumbnail', function(){ return rovoko_configs('rovoko_default_post_thumbnail');});

/**
 * Default sidebar position 
 * use filter: rovoko_archive_sidebar_position
 * @return string left / right / none
 * @example add_filter('rovoko_archive_sidebar_position', function(){ return 'right';});
*/
add_filter('rovoko_archive_sidebar_position', function(){ return 'right';});
/**
 * Default Archive grid columns
 * use filter : rovoko_archive_grid_col
 * @return string 1 - 12
 * @example add_filter('rovoko_archive_grid_col', function(){ return '8';});
*/

/**
 * Default Archive Pagination
 * use filter: rovoko_loop_pagination
 * @return string 1 - 5
 * @example: add_filter('rovoko_loop_pagination', function(){ return '3';});
*/

/**
 * Default Archive Pagination Prev Text
 * use filter: rovoko_loop_pagination_prev_text
 * @return string 
 * @example: add_filter('rovoko_loop_pagination_prev_text', function(){ return esc_html__('Previous','rovoko');});
*/

/**
 * Default Archive Pagination Next Text
 * use filter: rovoko_loop_pagination_next_text
 * @return string 
 * @example: add_filter('rovoko_loop_pagination_next_text', function(){ return esc_html__('Next','rovoko');});
*/

/**
 * Default Archive Pagination Sep Text
 * use filter: rovoko_loop_pagination_sep_text
 * @return string 
 * @example: add_filter('rovoko_loop_pagination_sep_text', function(){ return '<span class="d-none"></span>';});
*/

/**
 * Show post related by taxonomy
 * use filter: rovoko_post_related_by
 * @return string
 * @default cat
 * @example add_filter('rovoko_post_related_by', function(){return 'cat';});
*/

/**
 * Remove Supported post type for VC Element 
 * use filter : rovoko_vc_post_type_list 
 * @return array
 * @example add_filter('rovoko_vc_post_type_list', function($post_type){ $post_type[] = 'ef5_header_top'; return $post_type;});
*/

// Support Portfolio or Not
add_filter('rovoko_cpts_portfolio',function(){ return true;});
// Support header Top
add_filter('rovoko_cpts_header_top', function(){ return true;});
// Support Footer Top
add_filter('rovoko_cpts_footer', function(){ return true;});

/**
 * Custom WooCommerce
 * Custom single images, loop images, gallery thumbnail, cart thumbnail size
 * 
*/
/**
 * WooCommerce loop thumbnail size
 * use filter: 
 * width: rovoko_product_loop_image_w
 * height: rovoko_product_loop_image_h
 * @return string
 * @example 
 * widht : apply_filters('rovoko_product_loop_image_w', funtion(){ return '400';});
 * height : apply_filters('rovoko_product_loop_image_h', funtion(){ return '400';});
*/

/**
 * WooCommerce single thumbnail size
 * use filter: 
 * width: rovoko_product_single_image_w
 * height: rovoko_product_single_image_h
 * @return string
 * @example 
 * widht : apply_filters('rovoko_product_single_image_w', funtion(){ return '600';});
 * height : apply_filters('rovoko_product_single_image_h', funtion(){ return '600';});
*/

/**
 * WooCommerce gallery thumbnail size
 * use filter: 
 * width: rovoko_product_gallery_thumbnail_w
 * height: rovoko_product_gallery_thumbnail_h
 * @return string
 * @example 
 * widht : apply_filters('rovoko_product_gallery_thumbnail_w', funtion(){ return '100';});
 * height : apply_filters('rovoko_product_gallery_thumbnail_h', funtion(){ return '100';});
*/

/**
 * WooCommerce cart thumbnail size
 * use filter: 
 * size: rovoko_woocommerce_cart_item_thumbnail_size
 * @return string
 * @example 
 * size : apply_filters('rovoko_woocommerce_cart_item_thumbnail_size', funtion(){ return '100x100';});
 * 
*/

/**
 * Add your theme spacing
*/
add_filter('ef5systems_spacings','rovoko_spacings');
function rovoko_spacings(){
	return [
		'custom1' => ['EF5Frame Space 01', 'Top 8px - Bottom 8px'],
	];
}

/**
 * Add your theme Gutter
*/
add_filter('ef5systems_gutters','rovoko_gutters');
function rovoko_gutters(){
	return [
		'20' => [
			'title' => 'EF5Frame Gutter 20', 
			'desc'  => '',
			'key'   => '20',
			'value' => '20px'
		]
	];
}

/**
 * Add your theme Color
*/
add_filter('ef5systems_colors','rovoko_colors');
function rovoko_colors(){
	return [
		'inherit' => ['Inherit', 'inherit'],
		'white'   => ['White', '#fff'],
		'overlay' => ['Overlay Background', 'rgba(0,0,0,0.5)'],
	];
}
/**
 * Custom OWL Nav Style
*/
add_filter('ef5systems_carousel_custom_nav_style', 'rovoko_owl_custom_nav_style');
function rovoko_owl_custom_nav_style(){
	return [
		esc_html__('EF5Frame Style 01','rovoko') => 'ef5frame-1'
	];
}
/**
 * Custom OWL Dots Style
*/
add_filter('ef5systems_carousel_custom_dots_style', 'rovoko_owl_custom_dots_style');
function rovoko_owl_custom_dots_style(){
	return [
		esc_html__('Custom 01','rovoko') => 'custom1'
	];
}
add_filter('ef5systems_carousel_custom_dot_color', 'rovoko_owl_custom_dot_color');
function rovoko_owl_custom_dot_color(){
	return [
		esc_html__('Custom 01','rovoko') => 'custom1',
	];
}
/**
 * Add 
 */
//add_filter('ef5_iconpicker_fonts','rovoko_user_fonts_icon', 10, 1);
function rovoko_user_fonts_icon($args = []){
	$args[] = 'fontawesome';
	return $args;
}