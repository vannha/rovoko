<?php
if ( ! function_exists( 'rovoko_header_social_menu' ) ) {
	function rovoko_header_social_menu() {
		$header_social_menu  = rovoko_get_opts( 'header_social_menu_items' );
		$header_social_items = rovoko_get_opts( 'social_menu_items' );
		$items_social        = rovoko_get_list_social_items();
		echo '<div class="social-menu-items d-flex justify-content-end align-items-center">';
		if ( ! empty( $header_social_menu ) && $header_social_menu == '1' && ! empty( $header_social_items['Enabled'] ) && ! empty( $items_social ) && count( $header_social_items['Enabled'] ) > 1 ) {
			foreach ( $header_social_items['Enabled'] as $enabled_key => $enabled_item ) {
				foreach ( $items_social as $key => $item ) {
					if ( $enabled_key == $key ) {
						echo rovoko_html( $item );
					}
				}
			}
		}
		rovoko_header_custom_text();
		echo '</div>';
	}
}
function rovoko_header_custom_text() {
	$header_custom_html = rovoko_get_opts( 'header_custom_html' );
	$header_custom_text = rovoko_get_opts( 'header_custom_text' );
	if ( ! empty( $header_custom_text ) && ! empty( $header_custom_html ) && $header_custom_html == '1' ) {
		echo '<div class="custom-text">' . rovoko_html( $header_custom_text ) . '</div>';
	}
}