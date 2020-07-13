<?php
/**
 * Header Top layout two
 *
 */
?>
<div class="<?php rovoko_header_inner_class(); ?>">
    <div class="row justify-content-between align-items-center topbar-content">
		<?php
		rovoko_top_bar_social_items();
		rovoko_header_top_custom_html( true, true, 1, 2 );
		if ( ! empty( rovoko_get_opts( 'header_top_button' ) ) && rovoko_get_opts( 'header_top_button' ) == '1' && ! empty( rovoko_get_opts( 'header_top_button_text' ) ) ) : ?>
            <div class="col-auto action-button">
                <a href="<?php echo esc_attr( rovoko_get_opts( 'header_top_button_url', '#' ) ); ?>"
                   class="ef5-btn primary fill button"><?php echo esc_html( rovoko_get_opts( 'header_top_button_text' ) ); ?></a>
            </div>
		<?php endif; ?>
    </div>
</div>
