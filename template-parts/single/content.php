<?php
/**
 * Template part for displaying posts in loop
 *
 * @package EF5 Theme
 * @subpackage EF5Frame
 * @since 1.0.0
 * @author EF5 Team
 *
 */
?>

<div <?php post_class('ef5-single clearfix'); ?>>
    <?php
        rovoko_post_content(['class' => 'ef5-single-content']);
        rovoko_link_pages(['class' => 'ef5-single-page-links']);
    ?>
    <div class="ef5-single-footer row justify-content-between align-items-center empty-none"><?php
        do_action('rovoko_single_post_footer');
        rovoko_tagged_in(['class' => 'col-auto']);
        rovoko_post_share(['class' => 'col-auto']);
    ?></div>
</div>