<?php

$config = array(
	'title' => __('Title Options', 'theme_admin'),
	'group_id' => 'general',
	'context' => 'normal',
	'priority' => 'core',
	'types' => array( 'agent', 'property' )
);
$options = array(


	// array(
	// 	'type' => 'radio',
	// 	'id' => 'page_layout',
	// 	'toggle' => 'toggle-page-layout',
	// 	'title' => 'Page Layout',
	// 	'description' => '',
	// 	'default' => 'default',
	// 	'options' => array(
	// 		'default' => 'Default',
	// 		'full-width' => 'Full Width',
	// 		'sidebar' => 'Sidebar Right',
	// 		'sidebar-left' => 'Sidebar Left',
	// 	)
	// ),
	// array(
	// 	'type' => 'select',
	// 	'id' => 'custom_sidebar',
	// 	'toggle_group' => 'toggle-page-layout toggle-page-layout-sidebar toggle-page-layout-sidebar-left',
	// 	'title' => 'Custom Sidebar',
	// 	'description' => 'leave blank to use default sidebar',
	// 	'default' => '',
	// 	'source' => array( 
	// 		'option-custom-sidebar' => ''
	// 	),
	// 	'options' => array(
	// 		'' => 'choose ...'
	// 	)
	// ),

	// array(
	// 	'type' => 'on_off',
	// 	'id' => 'custom_title',
	// 	'toggle' => 'toggle-custom-title',
	// 	'title' => 'Custom Title Style',
	// 	'default' => 'off',
	// 	'description' => 'turn on to override sidewide configuration',
	// ),
	// array(
	// 	'type' => 'text',
	// 	'id' => 'custom_main_title',
	// 	'toggle_group' => 'toggle-show-title toggle-show-title-on',
	// 	'title' => 'Custom Title',
	// 	'description' => 'this text will override the normal page/post title',
	// ),
	// array(
	// 	'type' => 'text',
	// 	'id' => 'custom_sub_title',
	// 	'toggle_group' => 'toggle-show-title toggle-show-title-on',
	// 	'title' => 'Custom Sub Title',
	// 	'description' => 'this text will be placed below Title',
	// ),
	array(
		'type' 			=> 'radio',
		'id' 			=> 'title_element_style',
		// 'toggle_group' => 'toggle-custom-title toggle-custom-title-on',
		'title' 		=> __('Title Element Style', 'theme_admin'),
		'description' 	=> '',
		'default' 		=> '',
		'options' 		=> array(
			'' => __('Default', 'theme_admin'),
			'element-light' => __('Light (best for dark BG)', 'theme_admin'),
			'element-dark'	=> __('Dark (best for light BG)', 'theme_admin')
		)
	),
	array(
		'type' 			=> 'color',
		'id'			=> 'title_bg_color',
		// 'toggle_group' => 'toggle-custom-title toggle-custom-title-on',
		'title' 		=> __('Title BG Color', 'theme_admin'),
		'description'	=> '',
		'default' 		=> '',
	),
	array(
		'type' 			=> 'image',
		'id' 			=> 'title_bg_image',
		// 'toggle_group' => 'toggle-custom-title toggle-custom-title-on',
		'title' 		=> __('Title BG Image', 'theme_admin'),
		'description' 	=> ''
	),
	array(
		'type' 			=> 'radio',
		'id'			=> 'title_bg_image_style',
		// 'toggle_group' => 'toggle-custom-title toggle-custom-title-on',
		'title' 		=> __('Title BG Image Style', 'theme_admin'),
		'description' 	=> '',
		'default' 		=> '',
		'options' 		=> array(
			'' 	=> __('Default', 'theme_admin'),
			'cover' 	=> __('Cover', 'theme_admin'),
			'contain' 	=> __('Contain', 'theme_admin'),
			'repeat' 	=> __('Repeat', 'theme_admin'),
		),
	),

	
	
);
new nt_metaboxes_tool($config, $options);



?>