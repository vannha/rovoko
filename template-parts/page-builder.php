<?php
/**
 * Template Name: Page Buider
 *
 * This is the template that displays page content with VC.
 *
 * @package EF5 Theme
 * @subpackage EF5Frame
 * @since 1.0.0
 * @author EF5 Team
 */

get_header();
?>
    <div class="row gutter-xl-50">
        <div id="ef5-content-area" class="<?php rovoko_content_css_class();?>">
            <?php
                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();
                    the_content();
                endwhile; // End of the loop.
            ?>
        </div>
        <?php rovoko_sidebar(); ?>
    </div>
<?php
get_footer();