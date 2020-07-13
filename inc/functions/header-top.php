<?php
/**
 * Header Top
 *
 */
if ( ! function_exists( 'rovoko_header_top' ) ) {
	function rovoko_header_top( $class = '' ) {
		$header_top_layout = rovoko_get_opts( 'header_top_layout', '' );
		if ( empty( $header_top_layout ) || 'none' === $header_top_layout ) {
			return;
		}
		?>
        <div id="ef5-header-top" class="ef5-header-top">
            <div class="topbar d-none d-md-block topbar-<?php echo esc_attr( $header_top_layout ) ?>">
				<?php get_template_part( 'template-parts/header/header-top', $header_top_layout ); ?>
            </div>
        </div>
		<?php
	}
}
if ( ! function_exists( 'rovoko_get_list_social_items' ) ) {
	function rovoko_get_list_social_items() {
		$items_social = array();
		if ( ! empty( rovoko_get_opts( 'social_facebook_url' ) ) || ! empty( rovoko_get_opts( 'social_twitter_url' ) ) || ! empty( rovoko_get_opts( 'social_inkedin_url' ) ) || ! empty( rovoko_get_opts( 'social_instagram_url' ) ) || ! empty( rovoko_get_opts( 'social_google_url' ) ) || ! empty( rovoko_get_opts( 'social_pinterest_url' ) ) || ! empty( rovoko_get_opts( 'social_skype_url' ) ) || ! empty( rovoko_get_opts( 'social_vimeo_url' ) ) || ! empty( rovoko_get_opts( 'social_youtube_url' ) ) || ! empty( rovoko_get_opts( 'social_yelp_url' ) ) || ! empty( rovoko_get_opts( 'social_tumblr_url' ) ) || ! empty( rovoko_get_opts( 'social_tripadvisor_url' ) ) ) :
			if ( ! empty( rovoko_get_opts( 'social_facebook_url' ) ) ) {
				$items_social['social_facebook_url'] = '<a class="header-icon hint--bottom hint--bounce facebook" data-hint="' . esc_attr__( 'Follow us on: Facebook', 'rovoko' ) . '" href="' . esc_url( rovoko_get_opts( 'social_facebook_url' ) ) . '" target="_blank"><i class="fa fa-facebook"></i></a>';
			}
			if ( ! empty( rovoko_get_opts( 'social_twitter_url' ) ) ) {
				$items_social['social_twitter_url'] = '<a class="header-icon hint--bottom hint--bounce twitter" data-hint="' . esc_attr__( 'Follow us on: Twitter', 'rovoko' ) . '" href="' . esc_url( rovoko_get_opts( 'social_twitter_url' ) ) . '" target="_blank"><i class="fab fa-twitter"></i></a>';
			}
			if ( ! empty( rovoko_get_opts( 'social_pinterest_url' ) ) ) {
				$items_social['social_pinterest_url'] = '<a class="header-icon hint--bottom hint--bounce pinterest" data-hint="' . esc_attr__( 'Follow us on: Pinterest', 'rovoko' ) . '" href="' . esc_url( rovoko_get_opts( 'social_pinterest_url' ) ) . '" target="_blank"><i class="fab fa-pinterest"></i></a>';
			}
			if ( ! empty( rovoko_get_opts( 'social_dribbble_url' ) ) ) {
				$items_social['social_dribbble_url'] = ' <a class="header-icon hint--bottom hint--bounce dribbble" data-hint="' . esc_attr__( 'Follow us on: Dribbble', 'rovoko' ) . '" href="' . esc_url( rovoko_get_opts( 'social_dribbble_url' ) ) . '" target="_blank"><i class="fab fa-dribbble"></i></a>';
			}
			if ( ! empty( rovoko_get_opts( 'social_inkedin_url' ) ) ) {
				$items_social['social_inkedin_url'] = ' <a class="header-icon hint--bottom hint--bounce inkedin" data-hint="' . esc_attr__( 'Follow us on: Linkedin', 'rovoko' ) . '" href="' . esc_url( rovoko_get_opts( 'social_inkedin_url' ) ) . '" target="_blank"><i class="fab fa-linkedin"></i></a>';
			}
			if ( ! empty( rovoko_get_opts( 'social_instagram_url' ) ) ) {
				$items_social['social_instagram_url'] = '<a class="header-icon hint--bottom hint--bounce instagram" data-hint="' . esc_attr__( 'Follow us on: Instagram', 'rovoko' ) . '" href="' . esc_url( rovoko_get_opts( 'social_instagram_url' ) ) . '" target="_blank"><i class="fab fa-instagram"></i></a>';
			}
			if ( ! empty( rovoko_get_opts( 'social_google_url' ) ) ) {
				$items_social['social_google_url'] = '<a class="header-icon hint--bottom hint--bounce google" data-hint="' . esc_attr__( 'Follow us on: Google plus', 'rovoko' ) . '" href="' . esc_url( rovoko_get_opts( 'social_google_url' ) ) . '" target="_blank"><i class="fab fa-google-plus"></i></a>';
			}
			if ( ! empty( rovoko_get_opts( 'social_skype_url' ) ) ) {
				$items_social['social_skype_url'] = '<a class="header-icon hint--bottom hint--bounce skype" data-hint="' . esc_attr__( 'Follow us on: Skype', 'rovoko' ) . '" href="' . esc_url( rovoko_get_opts( 'social_skype_url' ) ) . '" target="_blank"><i class="fab fa-skype"></i></a>';
			}
			if ( ! empty( rovoko_get_opts( 'social_vimeo_url' ) ) ) {
				$items_social['social_vimeo_url'] = ' <a class="header-icon hint--bottom hint--bounce vimeo" data-hint="' . esc_attr__( 'Follow us on: Vimeo', 'rovoko' ) . '" href="' . esc_url( rovoko_get_opts( 'social_vimeo_url' ) ) . '" target="_blank"><i class="fab fa-vimeo-v"></i></a>';
			}
			if ( ! empty( rovoko_get_opts( 'social_youtube_url' ) ) ) {
				$items_social['social_youtube_url'] = ' <a class="header-icon hint--bottom hint--bounce youtube" data-hint="' . esc_attr__( 'Follow us on: Youtube', 'rovoko' ) . '" href="' . esc_url( rovoko_get_opts( 'social_youtube_url' ) ) . '" target="_blank"><i class="fab fa-youtube"></i></a>';
			}
			if ( ! empty( rovoko_get_opts( 'social_yelp_url' ) ) ) {
				$items_social['social_yelp_url'] = ' <a class="header-icon hint--bottom hint--bounce yelp" data-hint="' . esc_attr__( 'Follow us on: Yelp', 'rovoko' ) . '" href="' . esc_url( rovoko_get_opts( 'social_yelp_url' ) ) . '" target="_blank"><i class="fab fa-yelp"></i></a>';
			}
			if ( ! empty( rovoko_get_opts( 'social_tumblr_url' ) ) ) {
				$items_social['social_tumblr_url'] = ' <a class="header-icon hint--bottom hint--bounce tumblr" data-hint="' . esc_attr__( 'Follow us on: Tumblr', 'rovoko' ) . '" href="' . esc_url( rovoko_get_opts( 'social_tumblr_url' ) ) . '" target="_blank"><i class="fab fa-tumblr"></i></a>';
			}
			if ( ! empty( rovoko_get_opts( 'social_tripadvisor_url' ) ) ) {
				$items_social['social_tripadvisor_url'] = ' <a class="header-icon hint--bottom hint--bounce tripadvisor" data-hint="' . esc_attr__( 'Follow us on: Tripadvisor', 'rovoko' ) . '" href="' . esc_url( rovoko_get_opts( 'social_tripadvisor_url' ) ) . '" target="_blank"><i class="fab fa-tripadvisor"></i>';
			}

		endif;

		return $items_social;
	}
}
if ( ! function_exists( 'rovoko_top_bar_social_items' ) ) {
	function rovoko_top_bar_social_items() {
		$header_top_social_icon = rovoko_get_opts( 'header_top_social_icon' );
		$header_top_social      = rovoko_get_opts( 'header_top_social' );
		if ( $header_top_social_icon == '1' && rovoko_get_page_opt( 'header_top_social_icon' ) == '-1' ) {
			$header_top_social = rovoko_get_theme_opt( 'header_top_social' );
		}
		$items_social = rovoko_get_list_social_items();
		if ( $header_top_social_icon == '1' && ! empty( $header_top_social['Enabled'] ) && ! empty( $items_social ) && count( $header_top_social['Enabled'] ) > 1 ) {
			echo '<div class="col-auto social-items">';
			foreach ( $header_top_social['Enabled'] as $enabled_key => $enabled_item ) {
				foreach ( $items_social as $key => $item ) {
					if ( $enabled_key == $key ) {
						echo rovoko_html( $item );
					}
				}
			}
			echo '</div>';
		}
	}
}
if ( ! function_exists( 'rovoko_header_login_and_register' ) ) {
	function rovoko_header_login_and_register( $icon_login = 'flaticon-user', $icon_logout = 'flaticon-logout' ) {
		if ( is_user_logged_in() ) :
			echo '<li><i class="' . esc_attr( $icon_logout ) . '"></i><a href="' . wp_logout_url() . '">' . esc_html( "Logout", "rovoko" ) . '</a></li>';
		else:
			if ( class_exists( 'WooCommerce' ) ) {
				echo '<li><i class="' . esc_attr( $icon_login ) . '"></i><a href="' . esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ) . '">' . esc_html( 'Sign in', 'rovoko' ) . '</a></li>';
			} else {
				echo '<li><i class="' . esc_attr( $icon_login ) . '"></i><a href="' . esc_url( admin_url() ) . '">' . esc_html__( "Sign in", "rovoko" ) . '</a></li>';
			}
		endif;
	}
}
if ( ! function_exists( 'rovoko_header_top_custom_html' ) ) {
	function rovoko_header_top_custom_html( $ul = true, $col = false, $start = 1, $end = 2 ) {
		$allowed_html = array(
			'a'      => array( 'href' => array(), 'title' => array() ),
			'i'      => array( 'class' => array() ),
			'span'   => array( 'class' => array() ),
			'em'     => array(),
			'p'      => array(),
			'strong' => array(),
		);
		if ( ! empty( rovoko_get_opts( 'header_top_html' ) ) && rovoko_get_opts( 'header_top_html' ) == '1' ) :
			if ( $ul == true ) {
				$classes = array( 'custom-html' );
				if ( $col != false ) {
					$classes[] = 'col';
				}
				echo '<ul class="' . trim( implode( ' ', $classes ) ) . '">';
			}
			for ( $items = $start; $items <= $end; $items ++ ) {
				if ( ! empty( rovoko_get_opts( 'header_top_custom_html_' . $items ) ) ) :
					echo ' <li>' . wp_kses( rovoko_get_opts( 'header_top_custom_html_' . $items ), $allowed_html ) . ' </li>';
				endif;
			}
			if ( $ul == true ) {
				echo '</ul>';
			}
		endif;
	}
}
if ( ! function_exists( 'rovoko_header_top_currency' ) ) {
	function rovoko_header_top_currency() {
		if ( class_exists( 'WOOCS' ) && ! empty( rovoko_get_opts( 'header_top_currency' ) ) && rovoko_get_opts( 'header_top_currency' ) ) {
			echo '<li class="currency"><i class="flaticon-dollar-sign"></i>' . do_shortcode( '[woocs show_flags=0 style=1]' ) . '</li>';
		}
	}
}