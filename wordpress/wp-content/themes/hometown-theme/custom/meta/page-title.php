<?php

$config = array(
	'title' => __('Title Options', 'theme_admin'),
	'group_id' => 'general',
	'context' => 'normal',
	'priority' => 'core',
	'types' => array( 'page' )
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

	array(
		'type' => 'on_off',
		'id' => 'show_main_title',
		'toggle' => 'toggle-show-title',
		'title' => __('Show Title', 'theme_admin'),
		'default' => 'on',
		'description' => __('turn off to hide title section', 'theme_admin'),
	),
	array(
		'type' => 'text',
		'id' => 'custom_main_title',
		'toggle_group' => 'toggle-show-title toggle-show-title-on',
		'title' => __('Custom Title', 'theme_admin'),
		'description' => __('this text will override the normal page/post title', 'theme_admin'),
	),
	array(
		'type' => 'text',
		'id' => 'custom_sub_title',
		'toggle_group' => 'toggle-show-title toggle-show-title-on',
		'title' => __('Custom Sub Title', 'theme_admin'),
		'description' => __('this text will be placed below Title', 'theme_admin'),
	),
	array(
		'type' 			=> 'radio',
		'id' 			=> 'title_element_style',
		'toggle_group' => 'toggle-show-title toggle-show-title-on',
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
		'toggle_group' => 'toggle-show-title toggle-show-title-on',
		'title' 		=> __('Title BG Color', 'theme_admin'),
		'description'	=> '',
		'default' 		=> '',
	),
	array(
		'type' 			=> 'image',
		'id' 			=> 'title_bg_image',
		'toggle_group' => 'toggle-show-title toggle-show-title-on',
		'title' 		=> __('Title BG Image', 'theme_admin'),
		'description' 	=> ''
	),
	array(
		'type' 			=> 'radio',
		'id'			=> 'title_bg_image_style',
		'toggle_group' => 'toggle-show-title toggle-show-title-on',
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

$config = array(
	'title' => __('General Options', 'theme_admin'),
	'group_id' => 'general',
	'context' => 'normal',
	'priority' => 'low',
	'types' => array( 'portfolio', 'event' )
);
$options = array(
	array(
		'type' => 'on_off',
		'id' => 'show_main_title',
		'toggle' => 'toggle-show-title',
		'title' => __('Show Title', 'theme_admin'),
		'default' => 'on',
		'description' => __('turn off to hide title section', 'theme_admin'),
	),
	array(
		'type' => 'text',
		'id' => 'custom_main_title',
		'toggle_group' => 'toggle-show-title toggle-show-title-on',
		'title' => __('Custom Title', 'theme_admin'),
		'description' => __('this text will override the normal page/post title', 'theme_admin'),
	),
	array(
		'type' => 'text',
		'id' => 'custom_sub_title',
		'toggle_group' => 'toggle-show-title toggle-show-title-on',
		'title' => __('Custom Sub Title', 'theme_admin'),
		'description' => __('this text will be placed below Title', 'theme_admin'),
	),
);
new nt_metaboxes_tool($config, $options);

?>