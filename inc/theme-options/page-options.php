<?php
function rovoko_page_options_register($metabox)
{
    
    if (!$metabox->isset_args('page')) {
        $metabox->set_args('page', array(
            'opt_name'     => rovoko_get_page_opt_name(),
            'display_name' => esc_html__('Page Settings','rovoko'),
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }

    $metabox->add_section('page', array(
        'title'  => esc_html__('General','rovoko'),
        'desc'   => esc_html__('General settings for the page.','rovoko'),
        'icon'   => 'el-icon-home',
        'fields' => array_merge(
            array(
                array(
                    'id'          => 'primary_color',
                    'type'        => 'color',
                    'title'       => esc_html__('Primary Color','rovoko'),
                    'transparent' => false,
                ),
                array(
                    'id'          => 'accent_color',
                    'type'        => 'color',
                    'title'       => esc_html__('Accent Color','rovoko'),
                    'transparent' => false,
                ),

            ),
            rovoko_page_opts(true),
            rovoko_general_opts(['default' => true])
        )
    ));
    $metabox->add_section('page', rovoko_header_top_opts(['default' => true])); 
    $metabox->add_section('page', array(
        'title'  => esc_html__('Header','rovoko'),
        'desc'   => esc_html__('Header settings for the page.','rovoko'),
        'icon'   => 'el-icon-website',
        'fields' => array_merge(
            rovoko_header_opts(['default' => true]),
            rovoko_header_atts(true)
        )
    ));
    // Logo 
    $metabox->add_section('page', rovoko_header_page_logo());
    // Ontop Header
    $metabox->add_section('page', rovoko_ontop_header_opts(['default' => true,'subsection' => false]));
	
    $metabox->add_section('page', array(
        'title'  => esc_html__('Page Title','rovoko'),
        'desc'   => esc_html__('Settings for page header area.','rovoko'),
        'icon'   => 'el-icon-map-marker',
        'fields' => rovoko_page_title_opts(['default' => true])
    ));

    $metabox->add_section('page', rovoko_footer_opts(['default' => true]));

    /* Config Post Options */
    if (!$metabox->isset_args('post')) {
        $metabox->set_args('post', array(
            'opt_name'     => rovoko_get_page_opt_name(),
            'display_name' => esc_html__('Post Settings','rovoko'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default',
            'panels'   => true
        ));
    }

    $metabox->add_section('post', array(
        'title'  => esc_html__('General','rovoko'),
        'desc'   => esc_html__('General settings for this post.','rovoko'),
        'icon'   => 'el-icon-home',
        'fields' => array_merge(
            array(
                array(
                    'id'       => 'post_sidebar_pos',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Layouts','rovoko'),
                    'subtitle' => esc_html__('select a layout for single...','rovoko'),
                    'options'  => array(
                        '-1'     => esc_html__('Default','rovoko'),
                        'left'   => esc_html__('Left Widget','rovoko'),
                        'right'  => esc_html__('Right Widget','rovoko'),
                        'none'   => esc_html__('No Widget (Full)','rovoko'),
                        'center' => esc_html__('No Widget (Center)','rovoko')
                    ),
                    'default'  => '-1'
                )
            )
        )
    ));
    $metabox->add_section('post', array(
        'title'  => esc_html__('Post Title','rovoko'),
        'desc'   => esc_html__('Settings for page header area.','rovoko'),
        'icon'   => 'el-icon-map-marker',
        'fields' => rovoko_page_title_opts(['default' => true])
    ));

    /**
     * Config post format meta options
     *
    */
    if (!$metabox->isset_args('ef5_pf_audio')) {
        $metabox->set_args('ef5_pf_audio', array(
            'opt_name'     => 'post_format_audio',
            'display_name' => esc_html__('Audio','rovoko'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }

    if (!$metabox->isset_args('ef5_pf_link')) {
        $metabox->set_args('ef5_pf_link', array(
            'opt_name'     => 'post_format_link',
            'display_name' => esc_html__('Link','rovoko'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }

    if (!$metabox->isset_args('ef5_pf_quote')) {
        $metabox->set_args('ef5_pf_quote', array(
            'opt_name'     => 'post_format_quote',
            'display_name' => esc_html__('Quote','rovoko'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }

    if (!$metabox->isset_args('ef5_pf_video')) {
        $metabox->set_args('ef5_pf_video', array(
            'opt_name'     => 'post_format_video',
            'display_name' => esc_html__('Video','rovoko'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }

    if (!$metabox->isset_args('ef5_pf_gallery')) {
        $metabox->set_args('ef5_pf_gallery', array(
            'opt_name'     => 'post_format_gallery',
            'display_name' => esc_html__('Gallery','rovoko'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }
    $metabox->add_section('ef5_pf_video', array(
        'title'  => esc_html__('Video','rovoko'),
        'fields' => array(
            array(
                'id'    => 'post-video-url',
                'type'  => 'text',
                'title' => esc_html__( 'Video URL','rovoko' ),
                'desc'  => esc_html__( 'YouTube or Vimeo video URL','rovoko' )
            ),

            array(
                'id'             => 'post-video-file',
                'type'           => 'media',
                'library_filter' => array('mp4','m4v','wmv','avi','mpg','ogv','3gp','3g2','ogg','mine'),
                'title'          => esc_html__( 'Video Upload','rovoko' ),
                'desc'           => esc_html__( 'Upload or Choose video file','rovoko' ), 
                'url'            => true                       
            ),

            array(
                'id'        => 'post-video-html',
                'type'      => 'textarea',
                'title'     => esc_html__( 'Embadded video','rovoko' ),
                'desc'  => esc_html__( 'Use this option when the video does not come from YouTube or Vimeo','rovoko' )
            )
        )
    ));

    $metabox->add_section('ef5_pf_gallery', array(
        'title'  => esc_html__('Gallery','rovoko'),
        'fields' => array(
            array(
                'id'       => 'post-gallery-lightbox',
                'type'     => 'switch',
                'title'    => esc_html__('Lightbox?','rovoko'),
                'subtitle' => esc_html__('Enable lightbox for gallery images.','rovoko'),
                'default'  => true
            ),
            array(
                'id'          => 'post-gallery-images',
                'type'        => 'gallery',
                'title'       => esc_html__('Gallery Images ','rovoko'),
                'subtitle'    => esc_html__('Upload images or add from media library.','rovoko')
            )
        )
    ));

    $metabox->add_section('ef5_pf_audio', array(
        'title'  => esc_html__('Audio','rovoko'),
        'fields' => array(
            array(
                'id'       => 'post-audio-url',
                'type'     => 'text',
                'title'    => esc_html__('Audio URL','rovoko'),
                'description' => esc_html__('Audio file URL in format: mp3, ogg, wav.','rovoko'),
                'validate' => 'url',
                'msg'      => 'Url error!'
            ),
            array(
                'id'             => 'post-audio-file',
                'type'           => 'media',
                'library_filter' => array('mp3','m4a','ogg','wav'),
                'title'          => esc_html__( 'Add a audio','rovoko' ),
                'desc'           => esc_html__( 'Upload or Choose audio file','rovoko' ),                        
            ),
        )
    ));

    $metabox->add_section('ef5_pf_link', array(
        'title'  => esc_html__('Link','rovoko'),
        'fields' => array(
            array(
                'id'       => 'post-link-title',
                'type'     => 'text',
                'title'    => esc_html__('Title','rovoko'),
            ),
            array(
                'id'       => 'post-link-url',
                'type'     => 'text',
                'title'    => esc_html__('URL','rovoko'),
                'validate' => 'url',
                'msg'      => 'Url error!'
            )
        )
    ));

    $metabox->add_section('ef5_pf_quote', array(
        'title'  => esc_html__('Quote','rovoko'),
        'fields' => array(
            array(
                'id'       => 'post-quote-text',
                'type'     => 'textarea',
                'title'    => esc_html__('Quote Text','rovoko')
            ),
            array(
                'id'       => 'post-quote-cite',
                'type'     => 'text',
                'title'    => esc_html__('Cite','rovoko')
            )
        )
    ));
}
add_action('ef5_post_metabox_register', 'rovoko_page_options_register');