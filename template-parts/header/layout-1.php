<?php
/**
 * Template part for displaying default header layout
 */
$header_menu = rovoko_get_opts( 'header_menu', '' );
$show_search = rovoko_get_opts( 'header_search', '0' );
$show_cart   = rovoko_get_opts( 'header_cart', '0' );

$nav_extra_class = [
	'nav-extra',
	rovoko_get_opts( 'header_atts_icon_style', 'icon' )
];
if ( $header_menu === 'none' ) {
	$nav_extra_class[] = 'no-menu';
}
if ( $show_search == '0' && $show_cart === '0' ) {
	$nav_extra_class[] = 'no-icon';
}
?>
<header id="ef5-header" <?php rovoko_header_class(); ?>>
	<?php rovoko_header_top(); ?>
    <div id="ef5-headroom" class="main-header">
        <div class="<?php rovoko_header_inner_class(); ?>">
            <div class="row justify-content-between align-items-center">
                <div class="ef5-logo col-auto">
					<?php get_template_part( 'template-parts/header/header-logo' ); ?>
                </div>
                <div class="ef5-navigation-wrap col">
					<?php rovoko_header_social_menu(); ?>
                    <div class="row align-items-center justify-content-end">
						<?php rovoko_header_menu( [ 'class' => 'col-lg-12 col-xl-auto' ] ); ?>
                        <div class="col-auto">
                            <div class="<?php echo trim( implode( ' ', $nav_extra_class ) ); ?>">
								<?php
								rovoko_header_search( [ 'type' => 'popup' ] );
								rovoko_header_cart();
								rovoko_header_wishlist();
								rovoko_header_compare();
								
								rovoko_header_donate_button();
								rovoko_header_mobile_menu_icon();
								?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>