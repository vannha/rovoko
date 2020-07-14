<?php
/**
 * The header for our theme.
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package EF5 Theme
 * @subpackage EF5Frame
 * @since 1.0.0
 * @author EF5 Team
 *
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>> 
    <?php 
    if ( function_exists( 'wp_body_open' ) ) {
        wp_body_open();
    } else {
        do_action( 'wp_body_open' );
    }
    ?>
    <?php rovoko_page_loading(); ?>
    <div id="ef5-page" class="<?php rovoko_page_css_class();?>">
    <div id="ef5-header-wrap">
        <?php
            rovoko_header_main(); 
            rovoko_page_title();
        ?>
    </div>
    <div id="ef5-main" class="ef5-main">
