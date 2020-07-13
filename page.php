<?php
/**
 * The template for displaying all pages
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
        <div class="row gutter-xl-50">
            <div id="ef5-content-area" class="<?php rovoko_content_css_class();?>">
                <div id="ef5-posts" class="ef5-posts ef5-blogs">
                <?php
					while ( have_posts() ) :
						the_post();
                        rovoko_post_content();
                        rovoko_link_pages();
                        posts_nav_link();
                        rovoko_comment();
					endwhile;
                ?>
                </div>
            </div>
            <?php rovoko_sidebar(); ?>
        </div>
    </div>
<?php
get_footer();