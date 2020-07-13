<?php
add_action( 'tgmpa_register', 'rovoko_required_redux_plugins' );
function rovoko_required_redux_plugins() {
    $config = array(
        'default_path' => rovoko_relative_path().'spyropress.com/plugins/',
        'is_automatic' => true
    );
    $plugins = array(
        array(
            'name'               => esc_html__('Redux Framework','rovoko'),
            'slug'               => 'redux-framework',
            'required'           => true,
        ),
    );
    tgmpa( $plugins, $config );
}
if(class_exists('ReduxFrameworkPlugin')){
    add_action( 'tgmpa_register', 'rovoko_required_theme_plugins' );
    function rovoko_required_theme_plugins() {
        $config = array(
            'default_path' => rovoko_relative_path().'spyropress.com/plugins/',
        );
        $plugins = array(
            array(
                'name'               => esc_html__('EF5 Systems','rovoko'),
                'slug'               => 'ef5-systems',
                'source'             => 'ef5-systems.zip',
                'required'           => true,
            ),
            array(
                'name'               => esc_html__('EF5 Import & Export','rovoko'),
                'slug'               => 'ef5-import-export',
                'source'             => 'ef5-import-export.zip',
                'required'           => true,
            ),
            array(
                'name'               => esc_html__('Elementor Page Builder','rovoko'),
                'slug'               => 'elementor',
                'required'           => true,
            ),
	        array(
		        'name'               => esc_html__('WooCommerce Currency Switcher','rovoko'),
		        'slug'               => 'woocommerce-currency-switcher',
		        'required'           => false,
	        ),
            array(
                'name'               => esc_html__('WooCommerce','rovoko'),
                'slug'               => 'woocommerce',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('WPC Smart Compare for WooCommerce','rovoko'),
                'slug'               => 'woo-smart-compare',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('WPC Smart Wishlist for WooCommerce','rovoko'),
                'slug'               => 'woo-smart-quick-view',
                'required'           => false,
            ),
	        array(
		        'name'               => esc_html__('Slider Revolution','rovoko'),
		        'slug'               => 'revslider',
		        'source'             => 'revslider.zip',
		        'required'           => true,
	        ),
            array(
                'name'               => esc_html__('WPC Smart Quick View for WooCommerce','rovoko'),
                'slug'               => 'woo-smart-wishlist',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('Contact Form 7','rovoko'),
                'slug'               => 'contact-form-7',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('Newsletter','rovoko'),
                'slug'               => 'newsletter',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('WP User Avatars','rovoko'),
                'slug'               => 'wp-user-avatars',
                'required'           => false,
            ),
        );
        tgmpa( $plugins, $config );
    }
}
if(class_exists('VC_Manager')){
    add_action( 'tgmpa_register', 'rovoko_required_vc_plugins' );
    function rovoko_required_vc_plugins(){
        $config = array(
            'default_path' => rovoko_relative_path().'spyropress.com/plugins/',
        );
        $plugins = array(
            array(
                'name'               => esc_html__('WPBakery Templatera','rovoko'),
                'slug'               => 'templatera',
                'source'             => 'templatera.zip',
                'required'           => true,
            ),
        );
        tgmpa( $plugins, $config );
    }
}