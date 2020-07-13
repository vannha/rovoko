<?php
/**
 * Page title class for the theme.
 *
 * @package EF5 Theme
 * @subpackage EF5Frame
 * @since 1.0.0
 * @author EF5 Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/**
 * Get page title and description.
 *
 * @return array Contains 'title' and 'desc'
 */
function rovoko_get_page_titles() {
	$title = '';
	$desc  = get_bloginfo( 'description' );
	// Default titles
	if ( ! is_archive() ) {
		// Posts / page view
		if ( is_home() ) {
			$page_for_posts = get_option( 'page_for_posts' );
			// Only available if posts page is set.
			if ( ! is_front_page() && $page_for_posts ) {
				$title = get_the_title( $page_for_posts );
				$desc  = ! empty( get_post_meta( $page_for_posts, 'custom_desc', true ) ) ? get_post_meta( $page_for_posts, 'custom_desc', true ) : $desc;
			} else {
				$title = get_bloginfo( 'name' );
			}
		} // Single page view
		elseif ( is_singular() ) {
			if ( is_singular( 'post' ) ) {
				$move_title = rovoko_get_opts( 'post_single_set_title_is_page_title', '0' );
				if ( $move_title == '1' ) {
					$title = get_the_title();
				} else {
					if ( ! empty( rovoko_get_opts( 'custom_post_single_title', '' ) ) ) {
						$title = rovoko_get_opts( 'custom_post_single_title', '' );
					} else {
						$title = esc_html__( 'Blog Detail', 'rovoko' );
					}
				}
			} elseif ( is_singular( 'project' ) ) {
				$postID = get_queried_object_id();
				$move_title = rovoko_get_opts( 'project_single_set_title_is_page_title', '0' );
				if ( $move_title == '1' ) {
					$title = get_the_title();
				} else {
					if ( ! empty( rovoko_get_opts( 'custom_project_single_title', '' ) ) ) {
						$title = rovoko_get_opts( 'custom_project_single_title', '' );
					} else {
						$title  = esc_html__( 'Our Projects', 'rovoko' );
					}
				}
			} elseif ( is_singular( 'product' ) ) {
				$move_title = rovoko_get_opts( 'product_single_set_title_is_page_title', '0' );
				if ( $move_title == '1' ) {
					$title = get_the_title();
				} else {
					if ( ! empty( rovoko_get_opts( 'custom_product_single_title', '' ) ) ) {
						$title = rovoko_get_opts( 'custom_product_single_title', '' );
					} else {
						$title = esc_html__( 'Product Detail', 'rovoko' );
					}
				}
			} else {
				$title = get_post_meta( get_the_ID(), 'custom_title', true );
				if ( ! $title ) {
					if ( ! is_page() ) {
						$title = esc_html__( 'Blog Detail', 'rovoko' );
					} else {
						$title = get_the_title();
					}
				}
				$isdesc = get_post_meta( get_the_ID(), 'custom_desc', true );
				$desc   = ! empty( $isdesc ) ? $isdesc : $desc;
			}
		} // 404
		elseif ( is_404() ) {
			$title = rovoko_get_opts( 'ptitle_404_title', esc_html__( 'Error 404', 'rovoko' ) );
		} // Search result
		elseif ( is_search() ) {
			$title = esc_html__( 'Search results', 'rovoko' );
			$desc  = esc_html__( 'You searched for:', 'rovoko' ) . ' "' . get_search_query() . '" ';
		} // Anything else
		else {
			$title = get_the_title();
		}
	} elseif ( function_exists( 'is_shop' ) && is_shop() ) {
		$title  = get_the_title( get_option( 'woocommerce_shop_page_id' ) );
		$isdesc = get_post_meta( get_the_ID(), 'custom_desc', true );
		$desc   = ! empty( $isdesc ) ? $isdesc : $desc;
	} else {
		if ( get_post_type() == 'project' ) {
			$title = esc_html__( 'Our Projects', 'rovoko' );
		} else {
			$title  = get_the_archive_title();
			$isdesc = get_the_archive_description();
			$desc   = ! empty( $isdesc ) ? $isdesc : $desc;
		}
	}


	return array(
		'title' => $title,
		'desc'  => $desc
	);
}