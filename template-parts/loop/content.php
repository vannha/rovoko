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
$classes = ['ef5-list'];
if(is_archive() || is_home() || is_front_page() || is_search()) $classes[] = 'ef5-archive';
?>

<div <?php post_class(trim(implode(' ', $classes))); ?>>
    <?php rovoko_post_media(['thumbnail_size' => 'large']); ?>
    <div class="ef5-loop-info"><?php
            rovoko_post_header(['class' => 'loop ef5-loop-header']);
            rovoko_post_excerpt();
            rovoko_link_pages();
        ?>
        <div class="ef5-loop-footer row justify-content-between align-items-center empty-none"><?php 
            do_action('rovoko_loop_footer'); 
            rovoko_tagged_in(['before' => '<div class="col-auto">','after'=>'</div>']);
            rovoko_post_share(['class' => 'col-auto']); 
        ?></div>
        <div class="ef5-loop-readmore"><?php rovoko_post_read_more(); ?></div>
    </div>
</div>