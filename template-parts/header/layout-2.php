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
					<?php if ( class_exists( 'WooCommerce' ) ) { ?>
                        <form role="search" method="get" class="search-form woocommerce-product-search"
                              action="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <label class="screen-reader-text" for="s"><?php _e( 'Search for:', 'rovoko' ); ?></label>
                            <input type="search" class="search-field"
                                   placeholder="<?php echo esc_attr_x( 'Search for products&hellip;', 'placeholder', 'rovoko' ); ?>"
                                   value="<?php echo get_search_query(); ?>" name="s"
                                   title="<?php echo esc_attr_x( 'Search for:', 'label', 'rovoko' ); ?>"/>
                            <select class="d-none d-md-block" name="product_cat">
                                <option value=""><?php _e( 'All Categories', 'rovoko' ) ?></option>
								<?php
								$categories = get_categories( array(
									'orderby'    => 'name',
									'order'      => 'ASC',
									'hide_empty' => 1,
									'taxonomy'   => 'product_cat'
								) );
								$select     = isset( $_GET["product_cat"] ) ? $_GET["product_cat"] : '';
								foreach ( $categories as $category ) { ?>
                                    <option value="<?php echo esc_attr( $category->slug ); ?>"<?php selected( $category->slug, $select ) ?> ><?php echo esc_html( $category->name ); ?></option>
								<?php } ?>
                            </select>
                            <button type="submit"><span class="flaticon-magnifying-glass"></span></button>
                            <input type="hidden" name="post_type" value="product"/>
                        </form>
						<?php
					} else {
						get_search_form();
					}
					?>
                </div>
            </div>
        </div>
    </div>
    <div id="ef5-headmenu" class="sub-header">
        <div class="<?php rovoko_header_inner_class(); ?>">
            <div class="row justify-content-between align-items-center">
				<?php rovoko_header_menu( [ 'class' => 'col-lg-12 col-xl-auto' ] ); ?>
                <div class="col-12 col-xl-auto">
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

</header>