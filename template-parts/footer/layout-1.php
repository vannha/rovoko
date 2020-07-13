<?php
/**
 * Footer layout two
 *
 */
?>
<div class="pt-40 pt-md-80"></div>
<div class="<?php rovoko_footer_inner_class(); ?>">
    <div class="row">
		<?php
		for ( $count = 1; $count <= 4; $count ++ ) {
			$sidebar = ( $count == 1 ) ? '' : '-' . $count;
			if ( is_active_sidebar( 'sidebar-footer' . $sidebar ) ) {
				?>
                <div class="<?php echo esc_attr( rovoko_footer_layout_one_inner_class() ) ?>">
					<?php
					dynamic_sidebar( 'sidebar-footer' . $sidebar );
					if ( $count == 1 ) {
						echo '<div class="row">';
						rovoko_footer_social_items();
						echo '</div>';
					}
					?>
                </div>
				<?php
			}
		}
		?>
    </div>
</div>
<div class="pt-xs-20 pt-md-50"></div>
<div class="footer-bottom">
    <div class="<?php rovoko_footer_inner_class(); ?>">
        <div class="row justify-content-between align-items-center">
            <?php rovoko_footer_copyright( 'col-lg-6 col-md-12' ); ?>
            <?php rovoko_footer_menu( 'footer_bottom_menu','col-lg-6 col-md-12 mt-15 mt-lg-0' ); ?>
        </div>
    </div>
</div>
	