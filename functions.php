<?php 
/**
 * EF5Frame functions and definitions
 *
 * @package EF5 Theme
 * @subpackage EF5Frame
 * @since 1.0.0
 * @author EF5 Team
 *
 */
if ( ! function_exists( 'rovoko_configs' ) ) {
	function rovoko_configs( $value ) {
		$configs = [
			'primary_color'                               => '#f0644c',
			'accent_color'                                => '#333333',
			'darkent_accent_color'                        => '#333333',
			'lightent_accent_color'                       => '#999999',
			'invalid_color'                               => 'red',
			'color_red'                                   => 'red',
			'color_green'                                 => 'green',
			'white'                                       => 'white',
			// Typo
			'google_fonts'                                => 'Arimo:400,400i,700,700i',
			'google_fonts'                                => 'Rubik:300,300i,400,400i,500,500i,700,700i,900,900i',
			'body_bg'                                     => '#fff',
			'body_font'                                   => '\'Arial\', sans-serif',
			'body_font_size'                              => '15px',
			'body_font_size_large'                        => '18px',
			'body_font_size_medium'                       => '16px',
			'body_font_size_small'                        => '14px',
			'body_font_size_xsmall'                       => '13px',
			'body_font_size_xxsmall'                      => '12px',
			'body_font_color'                             => '#666666',
			'body_line_height'                            => '1.6',
			'content_width'                               => 1170,
			'h1_size'                                     => '36px',
			'h2_size'                                     => '30px',
			'h3_size'                                     => '22px',
			'h4_size'                                     => '18px',
			'h5_size'                                     => '16px',
			'h6_size'                                     => '14px',
			'heading_font'                                => '\'Arial\', sans-serif',
			'heading_color'                               => 'var(--darkent-accent-color)',
			'heading_color_hover'                         => 'var(--primary-color)',
			'heading_font_weight'                         => 600,
			'meta_font'                                   => '\'Arial\', sans-serif',
			'meta_color'                                  => 'var(--lightent-accent-color)',
			'meta_color_hover'                            => 'var(--primary-color)',
			'text-grey'                                   => '#cecece',
			// Boder
			'main_border'                                 => '1px solid #DDDDDD',
			'main_border2'                                => '2px solid #DDDDDD',
			'main_border_color'                           => '#DDDDDD',
			// Thumbnail Size
			'large_size_w'                                => 700,
			'large_size_h'                                => 520,
			'medium_size_w'                               => 565,
			//out project 12(archive project), relate post
			'medium_size_h'                               => 348,
			'thumbnail_size_w'                            => 350,
			'thumbnail_size_h'                            => 350,
			'post_thumbnail_size_w'                       => 1170,
			'post_thumbnail_size_h'                       => 570,
			'rovoko_default_post_thumbnail'               => false,
			'rovoko_thumbnail_is_bg'                      => false,
			// Header 
			'logo_width'                                  => '215',
			'logo_height'                                 => '55',
			'logo_units'                                  => 'px',
			'main_menu_height'                            => '100px',
			'header_sidewidth'                            => '320px',
			// Menu Color
			'menu_link_color_regular'                     => 'var(--primary-color)',
			'menu_link_color_hover'                       => 'var(--accent-color)',
			'menu_link_color_active'                      => 'var(--accent-color)',
			// Menu Ontop Color
			'ontop_link_color_regular'                    => 'var(--primary-color)',
			'ontop_link_color_hover'                      => 'var(--accent-color)',
			'ontop_link_color_active'                     => 'var(--accent-color)',
			// Menu Sticky Color
			'sticky_link_color_regular'                   => 'white',
			'sticky_link_color_hover'                     => 'var(--primary-color)',
			'sticky_link_color_active'                    => 'var(--primary-color)',
			// Dropdown
			'dropdown_bg'                                 => 'rgb(0,0,0)',
			'dropdown_regular'                            => 'white',
			'dropdown_hover'                              => 'var(--primary-color)',
			'dropdown_active'                             => 'var(--primary-color)',
			// Comments 
			'cmt_avatar_size'                             => 95,
			'cmt_border'                                  => '1px solid #DDDDDD',
			// WooCommerce,
			'rovoko_product_single_image_w'               => rovoko_get_theme_opt( 'product_single_image_size', [ 'width' => '794' ] )['width'],
			'rovoko_product_single_image_h'               => rovoko_get_theme_opt( 'product_single_image_size', [ 'height' => '808' ] )['height'],
			//'rovoko_product_single_gallery_w' => rovoko_get_theme_opt('product_single_gallery_w',['width' => '397px'])['width'],
			// loop product image size
			'rovoko_product_loop_image_w'                 => rovoko_get_theme_opt( 'product_loop_image_size', [ 'width' => '540' ] )['width'],
			'rovoko_product_loop_image_h'                 => rovoko_get_theme_opt( 'product_loop_image_size', [ 'height' => '540' ] )['height'],
			// product default gallery thumbnail size
			'rovoko_product_gallery_thumbnail_w'          => rovoko_get_theme_opt( 'product_gallery_thumbnail_size', [ 'width' => '97' ] )['width'],
			'rovoko_product_gallery_thumbnail_h'          => rovoko_get_theme_opt( 'product_gallery_thumbnail_size', [ 'height' => '90' ] )['height'],
			// product vertical gallery thumbnail size
			'rovoko_product_gallery_thumbnail_v_w'        => rovoko_get_theme_opt( 'product_gallery_thumbnail_v_size', [ 'width' => '97' ] )['width'],
			'rovoko_product_gallery_thumbnail_v_h'        => rovoko_get_theme_opt( 'product_gallery_thumbnail_v_size', [ 'height' => '90' ] )['height'],
			// product horizontal gallery thumbnail size
			'rovoko_product_gallery_thumbnail_h_w'        => rovoko_get_theme_opt( 'product_gallery_thumbnail_h_size', [ 'width' => '97' ] )['width'],
			'rovoko_product_gallery_thumbnail_h_h'        => rovoko_get_theme_opt( 'product_gallery_thumbnail_h_size', [ 'height' => '90' ] )['height'],
			// product gallery thumbnail space
			'rovoko_product_gallery_thumbnail_space'      => rovoko_get_theme_opt( 'product_gallery_thumbnail_space', [ 'width' => '3' ] )['width'],
			// cart item thumbnail size
			'rovoko_woocommerce_cart_item_thumbnail_size' => rovoko_get_opts( 'product_gallery_thumbnail_h_size', [
				'width'  => '100px',
				'height' => '115px'
			] ),
			// API 
			'google_api_key'                              => apply_filters( 'ef5systems-google-api-key', false )

		];

		return $configs[ $value ];
	}
}
function rovoko_relative_path() {
	if ( is_ssl() ) {
		return 'https://';
	} else {
		return 'http://';
	}
}

if ( ! function_exists( 'rovoko_setup' ) ) {
	function rovoko_setup() {
		// Make theme available for translation.
		load_theme_textdomain( 'rovoko', get_template_directory() . '/languages' );

		// Custom Header
		add_theme_support( "custom-header" );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( rovoko_configs( 'post_thumbnail_size_w' ), rovoko_configs( 'post_thumbnail_size_h' ), 1 );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'ef5-primary'   => esc_html__( 'Primary Menu', 'rovoko' ),
			//'ef5-menu-icon' => esc_html__( 'Menu with Icon', 'rovoko' )
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'rovoko_custom_background_args', array(
			'default-color' => '#ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for core custom logo.
		add_theme_support( 'custom-logo', array(
			'width'       => rovoko_configs( 'logo_width' ),
			'height'      => rovoko_configs( 'logo_height' ),
			'flex-width'  => true,
			'flex-height' => true,
		) );
		add_theme_support( 'post-formats', array(
			'gallery',
			'video',
			'audio',
			'quote',
			'link',
			'image'
		) );

		/* WooCommerce */
		add_theme_support( 'woocommerce' );
		//add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
		/*
		 * Add style for editor
		*/
		rovoko_require_folder( '/inc/editor', get_template_directory() );
		/**
		 * Load custom font icon
		 */
		rovoko_require_folder( '/assets/icon_fonts', get_template_directory() );
	}

	add_action( 'after_setup_theme', 'rovoko_setup' );
}

function rovoko_update() {
	/* Change default image thumbnail sizes in wordpress */
	$thumbnail_size = array(
		'large_size_w'     => rovoko_configs( 'large_size_w' ),
		'large_size_h'     => rovoko_configs( 'large_size_h' ),
		'large_crop'       => 1,
		'medium_size_w'    => rovoko_configs( 'medium_size_w' ),
		'medium_size_h'    => rovoko_configs( 'medium_size_h' ),
		'medium_crop'      => 1,
		'thumbnail_size_w' => rovoko_configs( 'thumbnail_size_w' ),
		'thumbnail_size_h' => rovoko_configs( 'thumbnail_size_h' ),
		'thumbnail_crop'   => 1,
	);
	foreach ( $thumbnail_size as $option => $value ) {
		if ( get_option( $option, '' ) != $value ) {
			update_option( $option, $value );
		}
	}
}

add_action( 'after_switch_theme', 'rovoko_update' );

/* add editor styles */
function rovoko_editor_styles() {
	add_editor_style( 'assets/admin/css/editor.css' );
}

add_action( 'admin_init', 'rovoko_editor_styles' );

/* add admin styles */
function rovoko_admin_style() {
	wp_enqueue_style( 'ef5-frame', get_template_directory_uri() . '/assets/admin/css/admin.css' );
}

add_action( 'admin_enqueue_scripts', 'rovoko_admin_style' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = apply_filters( 'rovoko_content_width', 1170 );
}
function rovoko_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'rovoko_content_width', 1170 );
}

add_action( 'after_setup_theme', 'rovoko_content_width', 0 );

/**
 * Incudes file
 *
 */
if ( ! function_exists( 'rovoko_require_folder' ) ) {
	function rovoko_require_folder( $foldername, $path ) {
		$dir = $path . DIRECTORY_SEPARATOR . $foldername;
		if ( ! is_dir( $dir ) ) {
			return;
		}
		$files = array_diff( scandir( $dir ), array( '..', '.' ) );
		foreach ( $files as $file ) {
			$patch = $dir . DIRECTORY_SEPARATOR . $file;
			if ( file_exists( $patch ) && strpos( $file, ".php" ) !== false ) {
				require_once $patch;
			}
		}
	}
}

/**
 * Register widget area.
 */
function rovoko_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Widgets', 'rovoko' ),
		'id'            => 'sidebar-main',
		'description'   => esc_html__( 'Add widgets here to appear below Blog content.', 'rovoko' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="ef5-heading h3 widgettitle">',
		'after_title'   => '</div>',
	) );
	if ( class_exists( 'EF5Systems' ) ) {
		register_sidebars( 4, array(
			'name'          => esc_html__( 'Footer Widgets %d', 'rovoko' ),
			'id'            => 'sidebar-footer',
			'description'   => esc_html__( 'Add widgets here to appear in footer.', 'rovoko' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="ef5-heading h3 widgettitle">',
			'after_title'   => '</div>',
		) );
	}
	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Shop Widgets', 'rovoko' ),
			'id'            => 'sidebar-shop',
			'description'   => esc_html__( 'Add widgets here to appear in widget area of single product', 'rovoko' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="ef5-heading h3 widgettitle">',
			'after_title'   => '</div>',
		) );
	}
}

add_action( 'widgets_init', 'rovoko_widgets_init' );
/**
 * Script Debug
 * Add suffix '.min' to scripts file
 *
 */
if ( ! function_exists( 'rovoko_script_debug' ) ) {
	function rovoko_script_debug() {
		$suffix   = defined( 'WP_DEBUG' ) && WP_DEBUG ? '' : '.min';
		$dev_mode = rovoko_get_opts( 'dev_mode', true );
		if ( ! $dev_mode ) {
			$suffix = '.min';
		}

		return apply_filters( 'rovoko_get_dev_mode', $suffix );
	}
}
/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_footer', 'rovoko_scripts', 0 );
function rovoko_scripts() {
	$min = rovoko_script_debug();
	// Comment
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	// Custom Options
	$filter_reset     = function_exists( 'ef5systems_uri' ) ? ef5systems_uri() : '';
	$rovoko_ajax_opts = array(
		'ajaxurl'               => admin_url( 'admin-ajax.php' ),
		'primary_color'         => rovoko_configs( 'primary_color' ),
		'accent_color'          => rovoko_configs( 'accent_color' ),
		'darkent_accent_color'  => rovoko_configs( 'darkent_accent_color' ),
		'lightent_accent_color' => rovoko_configs( 'lightent_accent_color' ),
		'shop_url'              => function_exists( 'wc_get_page_id' ) ? get_permalink( wc_get_page_id( 'shop' ) ) : '',
		'filter_reset'          => ( strpos( $filter_reset, 'filter_' ) !== false || strpos( $filter_reset, 'min_price' ) !== false || strpos( $filter_reset, 'max_price' ) || strpos( $filter_reset, 'rating_filter' ) ) ? 'true' : 'false',
		'filter_clear_text'     => esc_html__( 'Clear All', 'rovoko' ),
		'is_rtl'                => is_rtl() ? 'true' : 'false'
	);
	// Scripts
	if ( is_singular( 'project' ) ) {
		wp_enqueue_script( 'isotope' );
	}
	wp_enqueue_script( 'ef5-frame', get_template_directory_uri() . '/assets/js/theme' . $min . '.js', array( 'jquery' ), '', true );
	wp_localize_script( 'ef5-frame', 'rovoko_ajax_opts', $rovoko_ajax_opts );

}

add_action( 'wp_enqueue_scripts', 'rovoko_styles', 0 );
function rovoko_styles() {
	$min = rovoko_script_debug();

	// Theme Style
	wp_enqueue_style( 'ef5-frame', get_template_directory_uri() . '/assets/css/theme' . $min . '.css', array(), wp_get_theme()->get( 'Version' ) );
	// add CSS Variations
	$rovoko_inline_styles = rovoko_inline_styles();
	wp_add_inline_style( 'ef5-frame', $rovoko_inline_styles );

}

add_action( 'wp_footer', 'rovoko_ef5systems_styles' );
function rovoko_ef5systems_styles() {
	if ( wp_script_is( 'font-awesome5' ) ) {
		// Call libs css
		wp_enqueue_style( 'font-awesome5' );
		wp_enqueue_style( 'font-awesome5-shim' );
		wp_enqueue_style( 'hint' );
	} else {
		wp_enqueue_style( 'font-awesome5', get_template_directory_uri() . '/assets/icon_fonts/awesome5/css/all.css', array(), wp_get_theme()->get( 'Version' ) );
		wp_enqueue_style( 'font-awesome5-shim', get_template_directory_uri() . '/assets/icon_fonts/awesome5/css/v4-shims.min.css', array( 'font-awesome5' ), wp_get_theme()->get( 'Version' ) );
		wp_enqueue_style( 'font-rovoko', get_template_directory_uri() . '/assets/icon_fonts/rovoko/rovoko.css', array(), wp_get_theme()->get( 'Version' ) );
	}
	//do_action('elementor/editer/after_enqueue_styles');
}

function rovoko_inline_styles() {
	ob_start();
	$preset_primary_color  = $primary_color = rovoko_get_opts( 'primary_color', apply_filters( 'rovoko_primary_color', rovoko_configs( 'primary_color' ) ) );
	$preset_accent_color   = $accent_color = rovoko_get_opts( 'accent_color', apply_filters( 'rovoko_accent_color', rovoko_configs( 'accent_color' ) ) );
	$darkent_accent_color  = rovoko_get_opts( 'darkent_accent_color', apply_filters( 'rovoko_darkent_accent_color', rovoko_configs( 'darkent_accent_color' ) ) );
	$lightent_accent_color = rovoko_get_opts( 'lightent_accent_color', apply_filters( 'rovoko_lightent_accent_color', rovoko_configs( 'lightent_accent_color' ) ) );
	$main_menu_height      = rovoko_get_opts( 'main_menu_height', [ 'height' => rovoko_configs( 'main_menu_height' ) ] );
	// CSS Variable
	printf( ':root{
        --primary-color:%s;
        --accent-color:%s;
        --accent-color-05:%s;
        --accent-color-03:%s;
        --darkent-accent-color:%s;
        --lightent-accent-color:%s;
   
        }',
		$preset_primary_color,
		$preset_accent_color,
		rovoko_hex2rgba( $preset_accent_color, 0.5 ),
		rovoko_hex2rgba( $preset_accent_color, 0.3 ),
		$darkent_accent_color,
		$lightent_accent_color
	);
	// Header Variable
	$header_bg              = rovoko_get_opts( 'header_bg', [
		'background-color'      => '#fff',
		'background-image'      => 'inherit',
		'background-size'       => 'inherit',
		'background-repeat'     => 'inherit',
		'background-attachment' => 'inherit',
		'background-position'   => 'inherit'
	] );
	$header_text_color      = rovoko_get_opts( 'header_text_color', [
		'color' => '',
		'alpha' => '',
		'rgba'  => 'inherit'
	] );
	$header_ontop_top_space = rovoko_get_opts( 'header_ontop_top_space', [ 'height' => '' ] );
	printf(
		':root{
            --main-menu-height:%s;
            --header-text-color: %s;
            --header-bg-color: %s;
            --header-bg-image: %s;
            --header-bg-size: %s;
            --header-bg-repeat: %s;
            --header-bg-attachment: %s;
            --header-bg-position: %s;
            --header_ontop_top_space: %s;
        }',
		$main_menu_height['height'],
		$header_text_color['rgba'],
		$header_bg['background-color'],
		$header_bg['background-image'],
		$header_bg['background-size'],
		$header_bg['background-repeat'],
		$header_bg['background-attachment'],
		$header_bg['background-position'],
		$header_ontop_top_space['height']
	);
	/* Default Header Color */
	$header_link_color = rovoko_get_opts( 'header_link_colors', apply_filters( 'rovoko_header_link_color', [
		'regular' => $accent_color,
		'hover'   => $primary_color,
		'active'  => $primary_color
	] ) );
	printf( ':root{
            --header_regular: %1$s;
            --header_hover: %2$s;
            --header_active: %3$s;
        }',
		$header_link_color['regular'],
		$header_link_color['hover'],
		$header_link_color['active']
	);
	/* Ontop Header Color */
	$ontop_link_color = rovoko_get_opts( 'ontop_link_colors', apply_filters( 'rovoko_ontop_link_color', [
		'regular' => $primary_color,
		'hover'   => $accent_color,
		'active'  => $accent_color
	] ) );
	printf( ':root{
            --ontop_regular: %1$s;
            --ontop_hover: %2$s;
            --ontop_active: %3$s;
        }',
		$ontop_link_color['regular'],
		$ontop_link_color['hover'],
		$ontop_link_color['active']
	);
	/* Sticky Header Color */
	$sticky_link_color = rovoko_get_opts( 'sticky_link_colors', apply_filters( 'rovoko_sticky_link_color', [
		'regular' => rovoko_configs('sticky_link_color_regular'),
		'hover'   => rovoko_configs('sticky_link_color_hover'),
		'active'  => rovoko_configs('sticky_link_color_active')
	] ) );
	printf( ':root{
            --sticky_regular: %1$s;
            --sticky_hover: %2$s;
            --sticky_active: %3$s;
        }',
		$sticky_link_color['regular'],
		$sticky_link_color['hover'],
		$sticky_link_color['active']
	);
	/* Dropdown && Mobile */
	$dropdown_bg_opt = rovoko_get_opts( 'dropdown_bg', [ 'rgba' => apply_filters( 'rovoko_dropdown_bg', rovoko_configs( 'dropdown_bg' ) ) ] );

	$dropdown_link_colors = rovoko_get_opts( 'dropdown_link_colors', apply_filters( 'rovoko_dropdown_link_colors', [
		'regular' => rovoko_configs( 'dropdown_regular' ),
		'hover'   => rovoko_configs( 'dropdown_hover' ),
		'active'  => rovoko_configs( 'dropdown_active' )
	] ) );
	printf( ':root{
            --dropdown_regular: %1$s;
            --dropdown_hover: %2$s;
            --dropdown_active: %3$s;
            --dropdown_bg: %4$s;
        }',
		$dropdown_link_colors['regular'],
		$dropdown_link_colors['hover'],
		$dropdown_link_colors['active'],
		$dropdown_bg_opt['rgba']
	);

	/* Ontop Header Color */
	$footer_link_color = rovoko_get_opts( 'footer_link_colors', apply_filters( 'rovoko_header_link_color', [
		'regular' => $primary_color,
		'hover'   => $accent_color,
		'active'  => $accent_color
	] ) );
	printf( ':root{
            --footer_regular: %1$s;
            --footer_hover: %2$s;
            --footer_active: %3$s;
        }',
		$footer_link_color['regular'],
		$footer_link_color['hover'],
		$footer_link_color['active']
	);

	return ob_get_clean();
}

/**
 * Remove all Font Awesome from 3rd extension
 * to use only font-awesome latest from our theme
 * //'font-awesome',
 * //'gglcptch',
 */
add_filter( 'ef5_remove_styles', 'rovoko_remove_styles' );
function rovoko_remove_styles( $styles ) {
	$_styles = [
		'newsletter'
	];
	$styles  = array_merge( $styles, $_styles );

	return $styles;
}


/**
 * Register Google Fonts
 *
 * https://gist.github.com/kailoon/e2dc2a04a8bd5034682c
 * https://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
 *
 */
function rovoko_fonts_url() {
	$font_url = add_query_arg(
		'family',
		urlencode( rovoko_configs( 'google_fonts' ) ),
		"//fonts.googleapis.com/css"
	);

	return $font_url;
}

function rovoko_font_scripts() {
	wp_enqueue_style( 'ef5-fonts', rovoko_fonts_url() );
}

add_action( 'wp_enqueue_scripts', 'rovoko_font_scripts' );

function rovoko_default_value( $param, $default ) {
	return ! empty( $param ) ? $param : $default;
}

/**
 * All Theme Function
 */
rovoko_require_folder( 'inc', get_template_directory() );
rovoko_require_folder( 'inc/extends', get_template_directory() );
rovoko_require_folder( 'inc/classes', get_template_directory() );
rovoko_require_folder( 'inc/walker', get_template_directory() );
rovoko_require_folder( 'inc/core', get_template_directory() );
rovoko_require_folder( 'inc/functions', get_template_directory() );
rovoko_require_folder( 'inc/theme-options', get_template_directory() );
rovoko_require_folder( 'inc/custom-post', get_template_directory() );
rovoko_require_folder( 'inc/icons', get_template_directory() );

if ( class_exists( 'EF5Systems_MegaMenu_Walker' ) ) {
	rovoko_require_folder( 'inc/mega-menu', get_template_directory() );
}

if ( function_exists( 'register_ef5_widget' ) ) {
	rovoko_require_folder( 'inc/widgets', get_template_directory() );
}

if ( class_exists( 'VC_Manager' ) && class_exists( 'EF5Systems' ) ) {
	rovoko_require_folder( 'vc_extends', get_template_directory() );
	add_action( 'vc_after_init', 'rovoko_vc_after_init' );
	function rovoko_vc_after_init() {
		rovoko_require_folder( 'vc_elements', get_template_directory() );
	}
}

if ( class_exists( 'WooCommerce' ) ) {
	rovoko_require_folder( 'inc/woo', get_template_directory() );
}
/**
 * Custom Extensions
 * Custom some extension used in theme
 *
 */
rovoko_require_folder( 'inc/extensions', get_template_directory() );

/*Elementor */
if ( did_action( 'elementor/loaded' ) && class_exists( 'EF5Systems' ) ) {
	rovoko_require_folder( 'elementor_extends', get_template_directory() );
	add_action( 'elementor/frontend/after_register_scripts', 'rovoko_register_el_scripts' );
	add_action( 'elementor/frontend/after_register_styles', 'rovoko_register_el_styles' );
}
if ( ! function_exists( 'rovoko_register_el_scripts' ) ) {
	function rovoko_register_el_scripts() {
		wp_register_script( 'rovoko-team', get_template_directory_uri() . '/assets/js/elementor/team.js', [ 'jquery' ], false, true );
		wp_register_script( 'rovoko-progress', get_template_directory_uri() . '/assets/js/elementor/progress.js', [ 'jquery' ], false, true );
		wp_register_script( 'rovoko-product-grid', get_template_directory_uri() . '/assets/js/elementor/product-grid.js', [ 'jquery' ], false, true );
		wp_register_script( 'rovoko-post-grid', get_template_directory_uri() . '/assets/js/elementor/post-grid.js', [ 'jquery' ], false, true );
		wp_register_script( 'rovoko-projetc-grid', get_template_directory_uri() . '/assets/js/elementor/project-grid.js', [ 'jquery' ], false, true );
		wp_register_script( 'rovoko-projetc-masonry', get_template_directory_uri() . '/assets/js/elementor/project-masonry.js', [ 'jquery' ], false, true );
		wp_register_script( 'rovoko-fotorama', get_template_directory_uri() . '/assets/js/elementor/fotorama.js', [ 'jquery' ], false, true );
		wp_register_script( 'rovoko-image-gallery', get_template_directory_uri() . '/assets/js/elementor/image-gallery.js', [
			'jquery',
			'rovoko-fotorama'
		], false, true );
		$api = rovoko_get_theme_opt( 'google_api_key' );
		/* load scripts. */
		if ( ! empty( $api ) ) {
			$api_js = "https://maps.googleapis.com/maps/api/js?key=" . $api . "&sensor=false";
		} else {
			$api_js = "https://maps.googleapis.com/maps/api/js?sensor=false";
		}
		wp_enqueue_script( 'maps-googleapis', $api_js, array(), '3.0.0', true );
		wp_register_script( 'rovoko-googlemap', get_template_directory_uri() . '/assets/js/elementor/googlemap.js', [
			'jquery',
			'maps-googleapis'
		], '3.0.0', true );
	}
}
if ( ! function_exists( 'rovoko_register_el_styles' ) ) {
	function rovoko_register_el_styles() {
		wp_register_style( 'rovoko-image-gallery', get_template_directory_uri() . '/assets/css/fotorama.css', array(), wp_get_theme()->get( 'Version' ) );
	}
}
