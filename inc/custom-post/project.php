<?php

add_filter( 'ef5_extra_post_types', 'rovoko_cpts_project', 10, 1 );
function rovoko_cpts_project( $post_types ) {
	$post_types['project'] = array(
		'status'        => true,
		'name'          => esc_html__( 'Projects', 'rovoko' ),
		'singular_name' => esc_html__( 'Project', 'rovoko' ),
		'args'          => array(
			'menu_position' => 15,
			'menu_icon'     => 'dashicons-image-filter',
			'rewrite'       => array(
				'slug'       => rovoko_get_theme_opt( 'project_slug', 'project' ),
				'with_front' => true
			),
			'supports'      => array(
				'title',
				'editor',
				'thumbnail',
			)
		)
	);

	return $post_types;
}

add_filter( 'ef5_extra_taxonomies', 'rovoko_cpts_project_tax', 10, 1 );
function rovoko_cpts_project_tax( $taxo ) {
	$taxo['project_cat'] = array(
		'status'     => true,
		'post_type'  => array( 'project' ),
		'taxonomy'   => esc_html__( 'Project Category', 'rovoko' ),
		'taxonomies' => esc_html__( 'Project Categories', 'rovoko' ),
		'args'       => array(),
		'labels'     => array()
	);
	$taxo['project_tag'] = array(
		'status'     => true,
		'post_type'  => array( 'project' ),
		'taxonomy'   => esc_html__( 'Project Tag', 'rovoko' ),
		'taxonomies' => esc_html__( 'Project Tags', 'rovoko' ),
		'args'       => array(
			'hierarchical' => false,
		),
		'labels'     => array()
	);

	return $taxo;
}