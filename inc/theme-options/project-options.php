<?php
// Meta Options
function rovoko_project_options($metabox)
{
	/* Config Service Options */
	if (!$metabox->isset_args('project')) {
		$metabox->set_args('project', array(
			'opt_name'     => rovoko_get_page_opt_name(),
			'display_name' => esc_html__('Project Options', 'rovoko'),
		), array(
			'context'  => 'advanced',
			'priority' => 'high',
			'panels'   => false
		));
	}
	$metabox->add_section('project', array(
		'title'  => esc_html__('Project', 'rovoko'),
		'icon'   => 'el-icon-adjust-alt',
		'fields' => array_merge(
			array(
				array(
					'title'    => esc_html__('Description', 'rovoko'),
					'id'       => 'project_description',
					'type'     => 'textarea',
				),
				array(
					'id'       => 'project_more_option',
					'type'     => 'multi_text',
					'title'    => esc_html__('Add more project options', 'rovoko'),
					'subtitle' => __('Split title and value by mark: || <br> Ex: far fa-user || Client || Martin Stewart', 'rovoko'),
				),
				array(
					'title'    => esc_html__('Description Two', 'rovoko'),
					'id'       => 'project_description_2',
					'type'     => 'textarea',
				),
				array(
					'title'    => esc_html__('Description Three', 'rovoko'),
					'id'       => 'project_description_3',
					'type'     => 'textarea',
				),
			)
		)
	));
	
}
add_action('ef5_post_metabox_register', 'rovoko_project_options');
