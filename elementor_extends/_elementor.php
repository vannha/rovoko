<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Rovoko_Elementor_Widgets {
	//public $theme_infor;
	public function __construct() {
		$this->theme_infor = wp_get_theme();

		// Add new category for Elementor
		add_action( 'elementor/elements/categories_registered', array( $this, 'elementor_init' ) );
		// Add the action here so that the widgets are always visible
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'widgets_registered' ) );
	}

	/**
	 * Add new category for Elementor.
	 */
	public function elementor_init( $elements_manager ) {
		$elements_manager->add_category(
			'rovoko-elements',
			[
				'title' => $this->theme_infor->get( 'Name' ) . ' ' . esc_html__( 'Elements', 'rovoko' ),
				'icon'  => 'fa font',
			]
		);
	}

	public function widgets_registered() {
		// Add the action here so that the widgets are always visible
			rovoko_require_folder( 'elementor_extends/widgets', get_template_directory() );
	}

}

new Rovoko_Elementor_Widgets();