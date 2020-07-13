<?php
/**
 * Footer Function
 */
if ( ! function_exists( 'rovoko_footer' ) ) {
	function rovoko_footer() {
		$footer_layout = rovoko_get_opts( 'footer_layout', '' );
		if ( ! empty( $footer_layout ) && $footer_layout !== '' ) { ?>
            <footer id="ef5-footer"
                    class="ef5-footer-area ef5-footer-builder footer-layout-<?php echo esc_attr( $footer_layout ); ?>">
				<?php
				get_template_part( 'template-parts/footer/layout', $footer_layout );
				?>
            </footer>
			<?php
		} else {
			rovoko_footer_default();
		}
	}
}

/*
 * Default Footer 
 * 
 * Just show when system plugin not actived
 *
*/
if ( ! function_exists( 'rovoko_footer_default' ) ) {
	function rovoko_footer_default() {
		?>
        <footer id="ef5-footer" class="ef5-footer-area ef5-footer-default">
            <div class="ef5-footer-inner container text-center">
				<?php
				printf( esc_html__( '&copy; %s %s by %s. All Rights Reserved.', 'rovoko' ), date( 'Y' ), get_bloginfo( 'name' ), '<a href="' . esc_url( 'https://themeforest.net/user/SpyroPress' ) . '">' . esc_html__( 'SpyroPress', 'rovoko' ) . '</a>' ); ?>
            </div>
        </footer>
		<?php
	}
}
/**
 * Default Footer
 *
 * Default Copyright text
 *
 */
if ( ! function_exists( 'rovoko_default_copyright_text' ) ) {
	function rovoko_default_copyright_text() {
		printf( esc_html__( '&copy; %s %s by %s. All Rights Reserved.', 'rovoko' ), date( 'Y' ), get_bloginfo( 'name' ), '<a href="' . esc_url( 'https://themeforest.net/user/SpyroPress' ) . '">' . esc_html__( 'SpyroPress', 'rovoko' ) . '</a>' );
	}
}
if ( ! function_exists( 'rovoko_footer_inner_class' ) ) {
	function rovoko_footer_inner_class( $class = '' ) {
		$footer_fullwidth = rovoko_get_opts( 'footer_fullwidth', '0' );
		$classes          = array( 'footer-inner' );
		if ( '1' === $footer_fullwidth ) {
			$classes[] = 'no-container';
		} else {
			$classes[] = 'container';
		}
		if ( ! empty( $class ) ) {
			$classes[] = $class;
		}
		echo trim( implode( ' ', $classes ) );
	}
}
/**
 * Footer Social
 **/
if ( ! function_exists( 'rovoko_footer_social_items' ) ) {
	function rovoko_footer_social_items() {
		$social_icon   = rovoko_get_opts( 'social_icon' );
		$footer_social = rovoko_get_opts( 'footer_social' );
		$items_social  = rovoko_get_list_social_items();
		if ( $social_icon == '1' && rovoko_get_page_opt( 'social_icon' ) == '-1' ) {
			$footer_social = rovoko_get_theme_opt( 'footer_social' );
		}
		if ( $social_icon == '1' && ! empty( $footer_social['Enabled'] ) && ! empty( $items_social ) && count( $footer_social['Enabled'] ) > 1 ) {
			echo '<div class="col-12 social-items">';
			foreach ( $footer_social['Enabled'] as $enabled_key => $enabled_item ) {
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
/**
 * Check Widgets Footer active
 */
function rovoko_footer_layout_one_inner_class() {
	$col = 0;
	for ( $count = 1; $count <= 4; $count ++ ) {
		$sidebar = ( $count == 1 ) ? '' : '-' . $count;
		if ( is_active_sidebar( 'sidebar-footer' . $sidebar ) ) {
			$col += 1;
		}
	}
	if ( $col >= 2 ) {
		$classes[] = 'col-md-6';
	} else {
		$classes[] = 'col-md-12';
	}
	$classes[] = 'col-lg-' . ( 12 / $col );

	//$classes[] = 'col-md-' . ( 12 / $col );

	return trim( implode( ' ', $classes ) );
}

/**
 * Back to Top
 */
function rovoko_backtotop() {
	$show_btt = rovoko_get_opts( 'back_totop_on', '0' );
	if ( $show_btt === '0' ) {
		return;
	}
	?>
    <div class="ef5-backtotop">
        <div id="ef5-btt-btn" class="ef5-btt-btn">
            <div id="ef5-btt-container" class="ef5-btt-container">
                <div id="ef5-btt-border" class="ef5-btt-border">
                    <div id="ef5-btt-circle" class="ef5-btt-circle"><span class="fa fa-long-arrow-up"></span></div>
                </div>
            </div>
        </div>
    </div>
	<?php
}

add_action( 'wp_footer', 'rovoko_backtotop', 99 );

function rovoko_custom_html_tag() {
	$html_tag['a']      = array( 'class' => array(), 'href' => array(), 'title' => array() );
	$html_tag['ul']     = array( 'class' => array() );
	$html_tag['ol']     = array( 'class' => array() );
	$html_tag['li']     = array( 'class' => array() );
	$html_tag['i']      = array( 'class' => array() );
	$html_tag['span']   = array( 'class' => array() );
	$html_tag['em']     = array();
	$html_tag['p']      = array();
	$html_tag['strong'] = array();

	return $html_tag;
}

function rovoko_footer_menu( $menu_option = 'footer_menu', $class ) {
	$footer_menu = rovoko_get_opts( $menu_option, '' );
	if ( ! empty( $footer_menu ) && 'none' != $footer_menu ) {
		$args = array(
			'menu'        => $footer_menu,
			'container'   => '<div>',
			'menu_id'     => 'ef5-footer-menu',
			'menu_class'  => 'footer-menu',
			'link_before' => '<span class="menu-title">',
			'link_after'  => '</span>',
			'items_wrap'  => '<div class="' . $class . '"><ul id="%1$s" class="%2$s">%3$s</ul></div>',
		);
		wp_nav_menu( $args );
	}
}

function rovoko_footer_copyright( $class ) {
	if ( ! empty( rovoko_get_opts( 'footer_copyright' ) ) ) {
		echo '<div class="' . esc_attr( $class ) . ' copyright">' . wp_kses( rovoko_get_opts( 'footer_copyright' ), rovoko_custom_html_tag() ) . '</div>';
	}
}