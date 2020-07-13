<?php
/**
 * The archive project template file
 *
 * @package EF5 Theme
 * @subpackage EF5Frame
 * @since 1.0.0
 * @author EF5 Team
 *
 */
get_header();
?>
    <div class="container">
        <div id="ef5-content-area" class="ef5-content-area archive-project">
            <div id="ef5-posts" class="ef5-posts ef5-project pb-xl-80 mb-xl-15">
				<?php
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						get_template_part( 'template-parts/loop/content', get_post_type() );
					}
					rovoko_loop_pagination( [ 'class' => 'justify-content-center' ] );
				} else {
					get_template_part( 'template-parts/content', 'none' );
				}
				?>
            </div>
        </div>
    </div>
<?php
get_footer();