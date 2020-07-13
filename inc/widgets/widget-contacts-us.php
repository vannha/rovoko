<?php
defined( 'ABSPATH' ) or exit( - 1 );
/**
 * Contacts Us Widget
 *
 * @package EF5 Theme
 * @version 1.0
 *
 */
add_action( 'widgets_init', 'Rovoko_ContactUs_Widget' );
function Rovoko_ContactUs_Widget() {
	register_ef5_widget( 'Rovoko_ContactUs_Widget' );
}

class Rovoko_ContactUs_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'rovoko_contact_us',
			esc_html__( '[Rovoko] Contact Us', 'rovoko' ),
			array(
				'description'                 => esc_html__( 'Shows your contact info.', 'rovoko' ),
				'customize_selective_refresh' => true,
			)
		);
	}

	/**
	 * Outputs the HTML for this widget.
	 *
	 * @param array $args An array of standard parameters for widgets in this theme
	 * @param array $instance An array of settings for this widget instance
	 *
	 * @return void Echoes it's output
	 **/
	function widget( $args, $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'title'           => esc_html__( 'Contact Us', 'rovoko' ),
			'layout'          => '1',
			'desc'            => '',
			'button_txt'      => '',
			'link'            => '#',
			'address_text'    => esc_html__( 'Address:', 'rovoko' ),
			'address'         => '',
			'phone_text'      => esc_html__( 'Phone:', 'rovoko' ),
			'phone'           => '',
			'email_text'      => esc_html__( 'Email:', 'rovoko' ),
			'email'           => '',
			'payment_text'    => esc_html__( 'Payment Accepted', 'rovoko' ),
			'payment_visa'    => true,
			'payment_master'  => true,
			'payment_maestro' => true,
			'payment_paypal'  => true,
		) );

		$title        = empty( $instance['title'] ) ? '' : $instance['title'];
		$layout       = empty( $instance['layout'] ) ? '' : $instance['layout'];
		$desc         = empty( $instance['desc'] ) ? '' : $instance['desc'];
		$button_txt   = empty( $instance['button_txt'] ) ? '' : $instance['button_txt'];
		$link         = empty( $instance['link'] ) ? '' : $instance['link'];
		$address_text = empty( $instance['address_text'] ) ? esc_html__( 'Address:', 'rovoko' ) : $instance['address_text'];
		$phone_text   = empty( $instance['phone_text'] ) ? esc_html__( 'Phone:', 'rovoko' ) : $instance['phone_text'];
		$email_text   = empty( $instance['email_text'] ) ? esc_html__( 'Email:', 'rovoko' ) : $instance['email_text'];
		$payment_text = empty( $instance['payment_text'] ) ? esc_html__( 'Payment Accepted', 'rovoko' ) : $instance['payment_text'];
		$title        = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		printf( '%s', $args['before_widget'] );
		printf( '%s', $args['before_title'] . $title . $args['after_title'] );
		?>

        <div class="rovoko-contactus">
            <ul class="contact-layout-<?php echo esc_attr( $layout ); ?>">
				<?php if ( ! empty( $instance['desc'] ) || ! empty( $instance['button_txt'] ) ) : ?>
                    <li class="desc">
						<?php
						if ( ! empty( $instance['desc'] ) ) {
							echo esc_html( $instance['desc'] );
						}
						if ( ! empty( $instance['button_txt'] ) ) {
							?>
                            <a href="<?php echo esc_url( $link ); ?>" class="ef5-btn primary">
								<?php echo esc_html( $button_txt ); ?>
                            </a>
						<?php } ?>
                    </li>
				<?php endif; ?>
				<?php if ( $layout == 1 ) : ?>
                    <!--Layout 1-->
					<?php if ( ! empty( $instance['address'] ) ) : ?>
                        <li>
                            <strong><?php echo esc_html( $address_text ) ?></strong>
                            <span><?php echo esc_html( $instance['address'] ) ?></span>
                        </li>
					<?php endif; ?>
					<?php if ( ! empty( $instance['email'] ) ) : ?>
                        <li>
                            <strong><?php echo esc_html( $email_text ) ?></strong>
                            <span><?php echo esc_html( $instance['email'] ) ?></span>
                        </li>
					<?php endif; ?>
					<?php if ( ! empty( $instance['phone'] ) ) : ?>
                        <li>
                            <strong><?php echo esc_html( $phone_text ) ?></strong>
                            <span><?php echo esc_html( $instance['phone'] ) ?></span>
                        </li>
					<?php endif; ?>

                    <!--Layout 2-->
				<?php else: ?>

					<?php if ( ! empty( $instance['phone'] ) ) : ?>
                        <li class="phone">
                            <span class="flaticon-phone"></span>
							<?php echo wpautop( $instance['phone'] ) ?>
                            <small><?php echo esc_html( $phone_text ) ?></small>
                        </li>
					<?php endif; ?>
					<?php if ( ! empty( $instance['email'] ) ) : ?>
                        <li class="email">
                            <span class="flaticon-mail-1"></span>
							<?php echo wpautop( $instance['email'] ) ?>
                            <small><?php echo esc_html( $email_text ) ?></small>
                        </li>
					<?php endif; ?>
					<?php if ( ! empty( $instance['address'] ) ) : ?>
                        <li class="address">
                            <span class="flaticon-place"></span>
							<?php echo wpautop( $instance['address'] ) ?>
                            <small><?php echo esc_html( $address_text ) ?></small>
                        </li>
					<?php endif; ?>
				<?php endif; ?>
				<?php if ( $instance['payment_visa'] == true || $instance['payment_master'] == true || $instance['payment_maestro'] == true || $instance['payment_paypal'] == true ) : ?>
                    <li>
                        <strong><?php echo esc_html( $payment_text ) ?></strong>
                    </li>
                    <li class="payment-method">
						<?php if ( $instance['payment_visa'] == true ) : ?>
                            <span class="payment_visa"></span>
						<?php endif; ?>
						<?php if ( $instance['payment_master'] == true ) : ?>
                            <span class="payment_master"></span>
						<?php endif; ?>
						<?php if ( $instance['payment_maestro'] == true ) : ?>
                            <span class="payment_maestro"></span>
						<?php endif; ?>
						<?php if ( $instance['payment_paypal'] == true ) : ?>
                            <span class="payment_paypal"></span>
						<?php endif; ?>
                    </li>
				<?php endif; ?>
            </ul>

        </div>
		<?php
		printf( '%s', $args['after_widget'] );
	}

	/**
	 * Deals with the settings when they are saved by the admin. Here is
	 * where any validation should be dealt with.
	 *
	 * @param array $new_instance An array of new settings as submitted by the admin
	 * @param array $old_instance An array of the previous settings
	 *
	 * @return array The validated and (if necessary) amended settings
	 **/
	function update( $new_instance, $old_instance ) {
		$instance                    = $old_instance;
		$instance['title']           = sanitize_text_field( $new_instance['title'] );
		$instance['layout']          = sanitize_text_field( $new_instance['layout'] );
		$instance['desc']            = sanitize_text_field( $new_instance['desc'] );
		$instance['button_txt']      = sanitize_text_field( $new_instance['button_txt'] );
		$instance['link']            = sanitize_text_field( $new_instance['link'] );
		$instance['address_text']    = sanitize_text_field( $new_instance['address_text'] );
		$instance['address']         = sanitize_text_field( $new_instance['address'] );
		$instance['phone_text']      = sanitize_text_field( $new_instance['phone_text'] );
		$instance['phone']           = sanitize_text_field( $new_instance['phone'] );
		$instance['email_text']      = sanitize_text_field( $new_instance['email_text'] );
		$instance['email']           = sanitize_text_field( $new_instance['email'] );
		$instance['payment_text']    = sanitize_text_field( $new_instance['payment_text'] );
		$instance['payment_visa']    = (bool) $new_instance['payment_visa'];
		$instance['payment_master']  = (bool) $new_instance['payment_master'];
		$instance['payment_maestro'] = (bool) $new_instance['payment_maestro'];
		$instance['payment_paypal']  = (bool) $new_instance['payment_paypal'];

		return $instance;
	}

	/**
	 * Displays the form for this widget on the Widgets page of the WP Admin area.
	 *
	 * @param array $instance An array of the current settings for this widget
	 *
	 * @return void Echoes it's output
	 **/
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'title'           => esc_html__( 'Contact Us', 'rovoko' ),
			'layout'          => '1',
			'desc'            => '',
			'button_txt'      => '',
			'link'            => '#',
			'address_text'    => esc_html__( 'Address:', 'rovoko' ),
			'address'         => '',
			'phone_text'      => esc_html__( 'Phone:', 'rovoko' ),
			'phone'           => '',
			'email_text'      => esc_html__( 'Email:', 'rovoko' ),
			'email'           => '',
			'payment_text'    => esc_html__( 'Payment Accepted', 'rovoko' ),
			'payment_visa'    => true,
			'payment_master'  => true,
			'payment_maestro' => true,
			'payment_paypal'  => true,
		) );

		$title           = $instance['title'] ? esc_attr( $instance['title'] ) : '';
		$layout          = $instance['layout'] ? esc_attr( $instance['layout'] ) : '1';
		$desc            = $instance['desc'] ? esc_attr( $instance['desc'] ) : '';
		$button_txt      = $instance['button_txt'] ? esc_attr( $instance['button_txt'] ) : '';
		$link            = $instance['link'] ? esc_attr( $instance['link'] ) : '#';
		$address_text    = $instance['address_text'] ? esc_attr( $instance['address_text'] ) : '';
		$address         = $instance['address'] ? esc_attr( $instance['address'] ) : '';
		$phone_text      = $instance['phone_text'] ? esc_attr( $instance['phone_text'] ) : '';
		$phone           = $instance['phone'] ? esc_attr( $instance['phone'] ) : '';
		$email_text      = $instance['email_text'] ? esc_attr( $instance['email_text'] ) : '';
		$email           = $instance['email'] ? esc_attr( $instance['email'] ) : '';
		$payment_text    = $instance['payment_text'] ? esc_attr( $instance['payment_text'] ) : '';
		$payment_visa    = (bool) $instance['payment_visa'];
		$payment_master  = (bool) $instance['payment_master'];
		$payment_maestro = (bool) $instance['payment_maestro'];
		$payment_paypal  = (bool) $instance['payment_paypal'];

		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'rovoko' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
                   value="<?php echo esc_attr( $title ); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"><?php esc_html_e( 'Layout', 'rovoko' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"
                    name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>">
                <option value="1" <?php if ( $layout == '1' ) {
					echo 'selected="selected"';
				} ?>><?php esc_html_e( 'Layout 1', 'rovoko' ); ?></option>
                <option value="2" <?php if ( $layout == '2' ) {
					echo 'selected="selected"';
				} ?>><?php esc_html_e( 'Layout 2', 'rovoko' ); ?></option>
            </select>
        </p>
        <div class="rovoko-widget-info">
            <h2><?php esc_html_e( 'Description:', 'rovoko' ); ?></h2>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>"><?php esc_html_e( 'Description', 'rovoko' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'desc' ) ); ?>" type="text"
                       value="<?php echo esc_attr( $desc ); ?>"/>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'button_txt' ) ); ?>"><?php esc_html_e( 'Button text', 'rovoko' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_txt' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'button_txt' ) ); ?>" type="text"
                       value="<?php echo esc_attr( $button_txt ); ?>"/>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php esc_html_e( 'Button link', 'rovoko' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" type="text"
                       value="<?php echo esc_attr( $link ); ?>"/>
            </p>
        </div>
        <div class="rovoko-widget-info">
            <h2><?php esc_html_e( 'Address:', 'rovoko' ); ?></h2>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'address_text' ) ); ?>"><?php esc_html_e( 'Title', 'rovoko' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'address_text' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'address_text' ) ); ?>" type="text"
                       value="<?php echo esc_attr( $address_text ); ?>"/>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php esc_html_e( 'Content', 'rovoko' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>" type="text"
                       value="<?php echo esc_attr( $address ); ?>"/>
            </p>
        </div>
        <div class="rovoko-widget-info">
            <h2><?php esc_html_e( 'Email:', 'rovoko' ); ?></h2>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'email_text' ) ); ?>"><?php esc_html_e( 'Title', 'rovoko' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email_text' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'email_text' ) ); ?>" type="text"
                       value="<?php echo esc_attr( $phone_text ); ?>"/>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php esc_html_e( 'Content', 'rovoko' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" type="text"
                       value="<?php echo esc_attr( $phone ); ?>"/>
            </p>
        </div>
        <div class="rovoko-widget-info">
            <h2><?php esc_html_e( 'Phone:', 'rovoko' ); ?></h2>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'phone_text' ) ); ?>"><?php esc_html_e( 'Title', 'rovoko' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone_text' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'phone_text' ) ); ?>" type="text"
                       value="<?php echo esc_attr( $email_text ); ?>"/>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php esc_html_e( 'Content', 'rovoko' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>" type="text"
                       value="<?php echo esc_attr( $email ); ?>"/>
            </p>
        </div>
        <div class="rovoko-widget-info">
            <h2><?php esc_html_e( 'Payment  Accepted:', 'rovoko' ); ?></h2>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'payment_text' ) ); ?>"><?php esc_html_e( 'Title', 'rovoko' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'payment_text' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'payment_text' ) ); ?>" type="text"
                       value="<?php echo esc_attr( $payment_text ); ?>"/>
            </p>
            <p>
                <input type="hidden" name="<?php echo esc_attr( $this->get_field_name( 'payment_visa' ) ); ?>"
                       value="0">
                <input class="checkbox" type="checkbox"<?php checked( $payment_visa ); ?>
                       id="<?php echo esc_attr( $this->get_field_id( 'payment_visa' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'payment_visa' ) ); ?>" value="1"/>
                <label for="<?php echo esc_attr( $this->get_field_id( 'payment_visa' ) ); ?>"><?php esc_html_e( 'Visa', 'rovoko' ); ?></label>
            </p>

            <p>
                <input type="hidden" name="<?php echo esc_attr( $this->get_field_name( 'payment_master' ) ); ?>"
                       value="0">
                <input class="checkbox" type="checkbox"<?php checked( $payment_master ); ?>
                       id="<?php echo esc_attr( $this->get_field_id( 'payment_master' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'payment_master' ) ); ?>" value="1"/>
                <label for="<?php echo esc_attr( $this->get_field_id( 'payment_master' ) ); ?>"><?php esc_html_e( 'Master Card', 'rovoko' ); ?></label>
            </p>
            <p>
                <input type="hidden" name="<?php echo esc_attr( $this->get_field_name( 'payment_maestro' ) ); ?>"
                       value="0">
                <input class="checkbox" type="checkbox"<?php checked( $payment_maestro ); ?>
                       id="<?php echo esc_attr( $this->get_field_id( 'payment_maestro' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'payment_maestro' ) ); ?>" value="1"/>
                <label for="<?php echo esc_attr( $this->get_field_id( 'payment_maestro' ) ); ?>"><?php esc_html_e( 'Maestro', 'rovoko' ); ?></label>
            </p>
            <p>
                <input type="hidden" name="<?php echo esc_attr( $this->get_field_name( 'payment_paypal' ) ); ?>"
                       value="0">
                <input class="checkbox" type="checkbox"<?php checked( $payment_paypal ); ?>
                       id="<?php echo esc_attr( $this->get_field_id( 'payment_paypal' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'payment_paypal' ) ); ?>" value="1"/>
                <label for="<?php echo esc_attr( $this->get_field_id( 'payment_paypal' ) ); ?>"><?php esc_html_e( 'Paypal', 'rovoko' ); ?></label>
            </p>
        </div>
		<?php
	}
}