<?php
/**
 * Header Top layout three
 * Need add custom post type: header_top
 *
 */
?>
<div class="<?php rovoko_header_inner_class(); ?>">
    <div class="topbar-content">
        <div class="left-content">
			<?php
			rovoko_header_top_custom_html( true, false, 1, 1 );
			?>
        </div>
        <div class="right-content">
            <ul class="list_items">
				<?php
				rovoko_header_top_custom_html( false, false, 2, 3 );

				rovoko_header_top_currency();

				if ( ! empty( rovoko_get_opts( 'header_top_register' ) ) && rovoko_get_opts( 'header_top_register' ) == true ) :
					rovoko_header_login_and_register();
				endif;
				?>
            </ul>
        </div>
    </div>
</div>
