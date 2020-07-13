<?php
function rovoko_iconpicker_rovoko_icons() {
	// add your icon here
	// struct ['icon-class-name' => 'icon name']
	$default_icons = [
		[ 'flaticon-user' => esc_html__( 'Flaticon user', 'rovoko' ) ],
		[ 'flaticon-call-answer' => esc_html__( 'Flaticon call-answer', 'rovoko' ) ],
		[ 'flaticon-magnifying-glass' => esc_html__( 'Flaticon magnifying glass', 'rovoko' ) ],
		[ 'flaticon-dollar-sign' => esc_html__( 'Flaticon dollar sign', 'rovoko' ) ],
		[ 'flaticon-internet' => esc_html__( 'Flaticon internet', 'rovoko' ) ],
		[ 'flaticon-internet-1' => esc_html__( 'Flaticon internet 1', 'rovoko' ) ],
		[ 'flaticon-place' => esc_html__( 'Flaticon place', 'rovoko' ) ],
		[ 'flaticon-logout' => esc_html__( 'Flaticon logout', 'rovoko' ) ],
		[ 'flaticon-delivery' => esc_html__( 'Flaticon delivery', 'rovoko' ) ],
		[ 'flaticon-buy' => esc_html__( 'Flaticon buy', 'rovoko' ) ],
		[ 'flaticon-heart' => esc_html__( 'Flaticon heart', 'rovoko' ) ],
		[ 'flaticon-information' => esc_html__( 'Flaticon information', 'rovoko' ) ],
		[ 'flaticon-login' => esc_html__( 'Flaticon login', 'rovoko' ) ],
		[ 'flaticon-message' => esc_html__( 'Flaticon message', 'rovoko' ) ],
		[ 'flaticon-download' => esc_html__( 'Flaticon download', 'rovoko' ) ],
		[ 'flaticon-next' => esc_html__( 'Flaticon next', 'rovoko' ) ],
		[ 'flaticon-back' => esc_html__( 'Flaticon back', 'rovoko' ) ],
		[ 'flaticon-upload' => esc_html__( 'Flaticon upload', 'rovoko' ) ],
		[ 'flaticon-comment' => esc_html__( 'Flaticon comment', 'rovoko' ) ],
		[ 'flaticon-comment-1' => esc_html__( 'Flaticon comment 1', 'rovoko' ) ],
		[ 'flaticon-like' => esc_html__( 'Flaticon like', 'rovoko' ) ],
		[ 'flaticon-user-1' => esc_html__( 'Flaticon user-1', 'rovoko' ) ],
		[ 'flaticon-next-1' => esc_html__( 'Flaticon next-1', 'rovoko' ) ],
		[ 'flaticon-return' => esc_html__( 'Flaticon return', 'rovoko' ) ],
		[ 'flaticon-edit' => esc_html__( 'Flaticon edit', 'rovoko' ) ],
		[ 'flaticon-phone' => esc_html__( 'Flaticon phone', 'rovoko' ) ],
		[ 'flaticon-mail' => esc_html__( 'Flaticon mail', 'rovoko' ) ],
		[ 'flaticon-mail-1' => esc_html__( 'Flaticon mail 1', 'rovoko' ) ],
		[ 'flaticon-add' => esc_html__( 'Flaticon add', 'rovoko' ) ],
		[ 'flaticon-star' => esc_html__( 'Flaticon star', 'rovoko' ) ],
		[ 'flaticon-famous' => esc_html__( 'Flaticon famous', 'rovoko' ) ],
		[ 'flaticon-recycle' => esc_html__( 'Flaticon recycle', 'rovoko' ) ],
		[ 'flaticon-tag' => esc_html__( 'Flaticon tag', 'rovoko' ) ],
		[ 'flaticon-positive-vote' => esc_html__( 'Flaticon positive vote', 'rovoko' ) ],
		[ 'flaticon-truck' => esc_html__( 'Flaticon truck', 'rovoko' ) ],
		[ 'flaticon-close' => esc_html__( 'Flaticon close', 'rovoko' ) ],
		[ 'flaticon-testimonial' => esc_html__( 'Flaticon testimonial', 'rovoko' ) ],
		[ 'flaticon-payment-icon' => esc_html__( 'Flaticon payment icon', 'rovoko' ) ],
		[ 'flaticon-options' => esc_html__( 'Flaticon options', 'rovoko' ) ],
		[ 'flaticon-success' => esc_html__( 'Flaticon success', 'rovoko' ) ],
		[ 'flaticon-mission' => esc_html__( 'Flaticon mission', 'rovoko' ) ],
		[ 'flaticon-renovation' => esc_html__( 'Flaticon renovation', 'rovoko' ) ],
		[ 'flaticon-attraction' => esc_html__( 'Flaticon attraction', 'rovoko' ) ],
		[ 'flaticon-gear' => esc_html__( 'Flaticon gear', 'rovoko' ) ],
		[ 'flaticon-decision' => esc_html__( 'Flaticon decision', 'rovoko' ) ],
		[ 'flaticon-settings' => esc_html__( 'Flaticon settings', 'rovoko' ) ],
		[ 'flaticon-price' => esc_html__( 'Flaticon price', 'rovoko' ) ],
		[ 'flaticon-audio' => esc_html__( 'Flaticon audio', 'rovoko' ) ],
		[ 'flaticon-calendar' => esc_html__( 'Flaticon calendar', 'rovoko' ) ],
		[ 'flaticon-like-1' => esc_html__( 'Flaticon like 1', 'rovoko' ) ],
		[ 'flaticon-calendar-1' => esc_html__( 'Flaticon calendar 1', 'rovoko' ) ],
	];

	return array_merge( $default_icons, apply_filters( 'rovoko_iconpicker_rovoko_icons', [] ) );
}

add_filter( 'vc_iconpicker-type-rovoko', 'rovoko_vc_iconpicker_type_rovoko_icons' );
function rovoko_vc_iconpicker_type_rovoko_icons( $icons ) {
	$rovoko_icons = rovoko_iconpicker_rovoko_icons();

	return array_merge( $icons, $rovoko_icons );
}