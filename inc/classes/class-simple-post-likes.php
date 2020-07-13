<?php defined( 'ABSPATH' ) or exit();

/**
 * Simple post like system for Wordpress
 *
 * @version 1.0
 * @package Rovoko
 * @since   Rovoko 1.0
 */
class Rovoko_Simple_Post_Like {
	function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_ajax_nopriv_process_simple_like', array( $this, 'process_simple_like' ) );
		add_action( 'wp_ajax_process_simple_like', array( $this, 'process_simple_like' ) );
	}

	/**
	 * Enqueue required scripts
	 * @return void
	 */
	static function enqueue_scripts() {
		wp_enqueue_script( 'rovoko-simple-like', get_template_directory_uri() . '/assets/js/simple.likes.js', array( 'jquery' ), '1.0', true );
		wp_localize_script( 'rovoko-simple-like', 'RovokoSimpleLike', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'like'    => esc_html__( 'Like', 'rovoko' ),
			'unlike'  => esc_html__( 'Unlike', 'rovoko' )
		) );
	}

	/**
	 * Process simple like AJAX
	 * @return void
	 */
	static function process_simple_like() {
		// Security check
		$nonce = isset( $_REQUEST['nonce'] ) ? sanitize_text_field( $_REQUEST['nonce'] ) : 0;

		if ( ! wp_verify_nonce( $nonce, 'simple-likes-nonce' ) ) {
			exit( esc_html__( 'Not permitted', 'rovoko' ) );
		}

		// Base variables
		$post_id    = ( isset( $_REQUEST['post_id'] ) && is_numeric( $_REQUEST['post_id'] ) ) ? $_REQUEST['post_id'] : '';
		$result     = array();
		$post_users = null;
		$like_count = 0;

		if ( $post_id != '' ) {
			$count = get_post_meta( $post_id, "_post_like_count", true ); // like count
			$count = ( isset( $count ) && is_numeric( $count ) ) ? $count : 0;

			if ( ! self::already_liked( $post_id ) ) {
				// Like the post
				if ( is_user_logged_in() ) {
					// user is logged in
					$user_id    = get_current_user_id();
					$post_users = self::post_user_likes( $user_id, $post_id );

					// Update User & Post
					$user_like_count = get_user_option( "_user_like_count", $user_id );
					$user_like_count = ( isset( $user_like_count ) && is_numeric( $user_like_count ) ) ? $user_like_count : 0;
					update_user_option( $user_id, "_user_like_count", ++ $user_like_count );

					if ( $post_users ) {
						update_post_meta( $post_id, "_user_liked", $post_users );
					}
				} else {
					// user is anonymous
					$user_ip    = self::get_user_ip();
					$post_users = self::post_ip_likes( $user_ip, $post_id );

					// Update Post
					if ( $post_users ) {
						update_post_meta( $post_id, "_user_IP", $post_users );
					}
				}
				$like_count         = ++ $count;
				$response['status'] = "liked";
			} else {
				// Unlike the post
				if ( is_user_logged_in() ) {
					// user is logged in
					$user_id    = get_current_user_id();
					$post_users = self::post_user_likes( $user_id, $post_id );

					// Update User
					$user_like_count = get_user_option( "_user_like_count", $user_id );
					$user_like_count = ( isset( $user_like_count ) && is_numeric( $user_like_count ) ) ? $user_like_count : 0;

					if ( $user_like_count > 0 ) {
						update_user_option( $user_id, '_user_like_count', -- $user_like_count );
					}

					// Update Post
					if ( $post_users ) {
						$uid_key = array_search( $user_id, $post_users );
						unset( $post_users[ $uid_key ] );
						update_post_meta( $post_id, "_user_liked", $post_users );
					}
				} else {
					// user is anonymous
					$user_ip    = self::get_user_ip();
					$post_users = self::post_ip_likes( $user_ip, $post_id );

					// Update Post
					if ( $post_users ) {
						$uip_key = array_search( $user_ip, $post_users );
						unset( $post_users[ $uip_key ] );
						update_post_meta( $post_id, "_user_IP", $post_users );
					}
				}

				$like_count         = ( $count > 0 ) ? -- $count : 0; // Prevent negative number
				$response['status'] = "unliked";
			}

			update_post_meta( $post_id, "_post_like_count", $like_count );
			update_post_meta( $post_id, "_post_like_modified", date( 'Y-m-d H:i:s' ) );

			$response['count'] = self::get_like_count_markup( $like_count );

			wp_send_json( $response );
		}

		exit();
	}


	/**
	 * Check if given post is already liked
	 * @since 1.0
	 */
	static function already_liked( $post_id ) {
		$post_users = null;
		$user_id    = null;

		if ( is_user_logged_in() ) {
			// user is logged in
			$user_id         = get_current_user_id();
			$post_meta_users = get_post_meta( $post_id, "_user_liked" );

			if ( count( $post_meta_users ) != 0 ) {
				$post_users = $post_meta_users[0];
			}
		} else {
			// user is anonymous
			$user_id         = self::get_user_ip();
			$post_meta_users = get_post_meta( $post_id, "_user_IP" );

			if ( count( $post_meta_users ) != 0 ) {
				// meta exists, set up values
				$post_users = $post_meta_users[0];
			}
		}

		if ( is_array( $post_users ) && in_array( $user_id, $post_users ) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Retrieve current user IP
	 * @return string IP address
	 */
	static function get_user_ip() {
		$ip = '0.0.0.0';
		if ( function_exists( 'ef5systems_get_user_ip' ) ) {
			$ip = ef5systems_get_user_ip();
		}

		return $ip;
	}

	/**
	 * Get post meta user likes (saved as array).
	 * Adds new user id to retrieved array if user doesnt liked this post before.
	 *
	 * @param int $user_id
	 * @param int $post_id
	 *
	 * @return array        Array of user ids with desired format
	 * @since 1.0
	 */
	static function post_user_likes( $user_id, $post_id ) {
		$post_users      = '';
		$post_meta_users = get_post_meta( $post_id, "_user_liked" );

		if ( count( $post_meta_users ) != 0 ) {
			$post_users = $post_meta_users[0];
		}
		if ( ! is_array( $post_users ) ) {
			$post_users = array();
		}
		if ( ! in_array( $user_id, $post_users ) ) {
			$post_users[ 'user-' . $user_id ] = $user_id;
		}

		return $post_users;
	}

	/**
	 * Get post meta ip likes (saved as array),
	 * Adds new ip to retrieved array if user doesnt liked this post before.
	 *
	 * @param int $user_ip
	 * @param int $post_id
	 *
	 * @return array        Array of ips with desired format
	 * @since 1.0
	 */
	static function post_ip_likes( $user_ip, $post_id ) {
		$post_users      = '';
		$post_meta_users = get_post_meta( $post_id, "_user_IP" );

		if ( count( $post_meta_users ) != 0 ) {
			$post_users = $post_meta_users[0];
		}
		if ( ! is_array( $post_users ) ) {
			$post_users = array();
		}
		if ( ! in_array( $user_ip, $post_users ) ) {
			$post_users[ 'ip-' . $user_ip ] = $user_ip;
		}

		return $post_users;
	}

	/**
	 * Get like count html markup
	 *
	 * @param int $like_count
	 *
	 * @return string
	 */
	static function get_like_count_markup( $like_count ) {
		if ( is_numeric( $like_count ) && $like_count > 0 ) {
			$number = self::likes_number_format( $like_count );
		} else {
			$number = 0;
		}
		$count = sprintf( '<span class="meta-icon flaticon-like"></span> %1$s', $number );

		return $count;
	}


	/**
	 * Number format
	 *
	 * @param int $number
	 *
	 * @return string
	 */
	static function likes_number_format( $number ) {
		$precision = 2;

		if ( $number >= 1000 && $number < 1000000 ) {
			$formatted = number_format( $number / 1000, $precision ) . 'K';
		} else if ( $number >= 1000000 && $number < 1000000000 ) {
			$formatted = number_format( $number / 1000000, $precision ) . 'M';
		} else if ( $number >= 1000000000 ) {
			$formatted = number_format( $number / 1000000000, $precision ) . 'B';
		} else {
			$formatted = $number; // Number is less than 1000
		}

		$formatted = str_replace( '.00', '', $formatted );

		return $formatted;
	}
}

new Rovoko_Simple_Post_Like();