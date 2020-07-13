<?php
/**
 * EF5Frame
 */
$header_social = rovoko_get_opts( 'header_social', '0' );

//if($header_social === '0') return;

$header_layout = rovoko_get_opts('header_layout', '1');
$classes = ['header-socials col-auto'];

if(!empty(rovoko_get_theme_opt('social_facebook_url')) || !empty(rovoko_get_theme_opt('social_twitter_url')) || !empty(rovoko_get_theme_opt('social_inkedin_url')) || !empty(rovoko_get_theme_opt('social_instagram_url')) || !empty(rovoko_get_theme_opt('social_google_url')) || !empty(rovoko_get_theme_opt('social_pinterest_url')) || !empty(rovoko_get_theme_opt('social_skype_url')) || !empty(rovoko_get_theme_opt('social_vimeo_url')) || !empty(rovoko_get_theme_opt('social_youtube_url')) || !empty(rovoko_get_theme_opt('social_yelp_url')) || !empty(rovoko_get_theme_opt('social_tumblr_url')) || !empty(rovoko_get_theme_opt('social_tripadvisor_url')) ) :
?>
    <?php
    if(!empty(rovoko_get_theme_opt('social_facebook_url'))) { ?>
        <a class="header-icon hint--bottom hint--bounce" data-hint="<?php esc_attr_e('Follow us on: Facebook','rovoko');?>" href="<?php echo esc_url(rovoko_get_theme_opt('social_facebook_url')); ?>" target="_blank">
            <i class="fab fa-facebook"></i>
        </a>
    <?php }
    if(!empty(rovoko_get_theme_opt('social_twitter_url'))) { ?>
        <a class="header-icon hint--bottom hint--bounce" data-hint="<?php esc_attr_e('Follow us on: Twitter','rovoko');?>" href="<?php echo esc_url(rovoko_get_theme_opt('social_twitter_url')); ?>" target="_blank">
            <i class="fab fa-twitter"></i>
        </a>
    <?php }
    if(!empty(rovoko_get_theme_opt('social_pinterest_url'))) { ?>
        <a class="header-icon hint--bottom hint--bounce" data-hint="<?php esc_attr_e('Follow us on: Pinterest','rovoko');?>" href="<?php echo esc_url(rovoko_get_theme_opt('social_pinterest_url')); ?>" target="_blank">
            <i class="fab fa-pinterest"></i>
        </a>
    <?php }
    if(!empty(rovoko_get_theme_opt('social_dribbble_url'))) { ?>
        <a class="header-icon hint--bottom hint--bounce" data-hint="<?php esc_attr_e('Follow us on: Dribbble','rovoko');?>" href="<?php echo esc_url(rovoko_get_theme_opt('social_dribbble_url')); ?>" target="_blank">
            <i class="fab fa-dribbble"></i>
        </a>
    <?php }
    if(!empty(rovoko_get_theme_opt('social_inkedin_url'))) { ?>
        <a class="header-icon hint--bottom hint--bounce" data-hint="<?php esc_attr_e('Follow us on: Linkedin','rovoko');?>" href="<?php echo esc_url(rovoko_get_theme_opt('social_inkedin_url')); ?>" target="_blank">
            <i class="fab fa-linkedin"></i>
        </a>
    <?php }
    if(!empty(rovoko_get_theme_opt('social_instagram_url'))) { ?>
        <a class="header-icon hint--bottom hint--bounce" data-hint="<?php esc_attr_e('Follow us on: Instagram','rovoko');?>" href="<?php echo esc_url(rovoko_get_theme_opt('social_instagram_url')); ?>" target="_blank">
            <i class="fab fa-instagram"></i>
        </a>
    <?php }
    if(!empty(rovoko_get_theme_opt('social_google_url'))) { ?>
        <a class="header-icon hint--bottom hint--bounce" data-hint="<?php esc_attr_e('Follow us on: Google plus','rovoko');?>" href="<?php echo esc_url(rovoko_get_theme_opt('social_google_url')); ?>" target="_blank">
            <i class="fab fa-google-plus"></i>
        </a>
    <?php }
    if(!empty(rovoko_get_theme_opt('social_skype_url'))) { ?>
        <a class="header-icon hint--bottom hint--bounce" data-hint="<?php esc_attr_e('Follow us on: Skype','rovoko');?>" href="<?php echo esc_url(rovoko_get_theme_opt('social_skype_url')); ?>" target="_blank">
            <i class="fab fa-heart"></i>
        </a>
    <?php }
    if(!empty(rovoko_get_theme_opt('social_vimeo_url'))) { ?>
        <a class="header-icon hint--bottom hint--bounce" data-hint="<?php esc_attr_e('Follow us on: Vimeo','rovoko');?>" href="http://<?php echo esc_url(rovoko_get_theme_opt('social_vimeo_url')); ?>" target="_blank">
            <i class="fab fa-tumblr"></i>
        </a>
    <?php }
    if(!empty(rovoko_get_theme_opt('social_youtube_url'))) { ?>
        <a class="header-icon hint--bottom hint--bounce" data-hint="<?php esc_attr_e('Follow us on: Youtube','rovoko');?>" href="<?php echo esc_url(rovoko_get_theme_opt('social_youtube_url')); ?>" target="_blank">
            <i class="fab fa-youtube"></i>
        </a>
    <?php }
    if(!empty(rovoko_get_theme_opt('social_yelp_url'))) { ?>
        <a class="header-icon hint--bottom hint--bounce" data-hint="<?php esc_attr_e('Follow us on: Yelp','rovoko');?>" href="<?php echo esc_url(rovoko_get_theme_opt('social_yelp_url')); ?>" target="_blank">
            <i class="fab fa-yelp"></i>
        </a>
    <?php }
    if(!empty(rovoko_get_theme_opt('social_tumblr_url'))) { ?>
        <a class="header-icon hint--bottom hint--bounce" data-hint="<?php esc_attr_e('Follow us on: Tumblr','rovoko');?>" href="<?php echo esc_url(rovoko_get_theme_opt('social_tumblr_url')); ?>" target="_blank">
            <i class="fab fa-tumblr"></i>
        </a>
    <?php }
    if(!empty(rovoko_get_theme_opt('social_tripadvisor_url'))) { ?>
        <a class="header-icon hint--bottom hint--bounce" data-hint="<?php esc_attr_e('Follow us on: Tripadvisor','rovoko');?>" href="<?php echo esc_url(rovoko_get_theme_opt('social_tripadvisor_url')); ?>" target="_blank">
            <i class="fab fa-tripadvisor"></i>
        </a>
    <?php } 
endif;