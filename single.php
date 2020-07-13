<?php
/**
 * The template for displaying single post
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
        <div class="before-single-content-post">
			<?php do_action( 'rovoko_before_single_content_post' ); ?>
        </div>
        <div class="row gutter-xl-50">
            <div id="ef5-content-area" class="<?php rovoko_content_css_class(); ?>">
                <div class="ef5-blogs">
					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/single/content', get_post_format() );
						// Post Navigation
						//rovoko_post_navigation();
						// About Author
						rovoko_post_author();
						// Related
						rovoko_post_related( [ 'carousel' => true ] );
					endwhile; // End of the loop.
					?>
                </div>
            </div>
	        <?php rovoko_sidebar(); ?>
        </div>
	    <?php
	    // Comment
	    rovoko_comment();
	    ?>
    </div>
<?php
get_footer();