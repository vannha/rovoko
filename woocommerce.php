<?php
/**
 * Custom Woocommerce shop page.
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
                    <?php woocommerce_content(); ?>
                </div>
            </div>
            <?php rovoko_sidebar(); ?>
        </div>
    </div>
<?php
get_footer();