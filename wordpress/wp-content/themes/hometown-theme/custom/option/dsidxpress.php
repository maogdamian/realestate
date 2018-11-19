<?php 
	
	// Option
	$options = array(
		array(
			'title' 	=> __('Layout', 'theme_admin'),
			'options' 	=> array(
				
				array(
					'type' 			=> 'radio',
					'id' 			=> 'default_layout',
					'title' 		=> __('Default Layout', 'theme_admin'),
					'description' 	=> __('choose page default layout', 'theme_admin'),
					'default' 		=> 'sidebar-right',
					'options' 		=> array(
						'full-width' 	=> __('Full Width', 'theme_admin'),
						'sidebar-right' => __('Sidebar Right', 'theme_admin'),
						'sidebar-left' => __('Sidebar Left', 'theme_admin')
					)
				)
				
			)
		),

		array(
			'title' 	=> __('Page Title', 'theme_admin'),
			'options' 	=> array(
				
				array(
					'type' 			=> 'radio',
					'id' 			=> 'element_style',
					'title' 		=> __('Element Style', 'theme_admin'),
					'description' 	=> '',
					'default' 		=> 'element-light',
					'options' 		=> array(
						'element-light' => __('Light (best for dark BG)', 'theme_admin'),
						'element-dark'	=> __('Dark (best for light BG)', 'theme_admin')
					)
				),
				array(
					'type' 			=> 'color',
					'id'			=> 'bg_color',
					'title' 		=> __('BG Color', 'theme_admin'),
					'description'	=> '',
					'default' 		=> '#bc0054',
				),
				array(
					'type' 			=> 'image',
					'id' 			=> 'bg_image',
					'title' 		=> __('BG Image', 'theme_admin'),
					'description' 	=> ''
				),
				array(
					'type' 			=> 'radio',
					'id'			=> 'bg_image_style',
					'title' 		=> __('BG Image Style', 'theme_admin'),
					'description' 	=> '',
					'default' 		=> 'cover',
					'options' 		=> array(
						'cover' 	=> __('Cover', 'theme_admin'),
						'contain' 	=> __('Contain', 'theme_admin'),
						'repeat' 	=> __('Repeat', 'theme_admin'),
					),
				),
				
			)
		),

	);
	
	$config = array(
		'title' 		=> __('dsIDXpress', 'theme_admin'),
		'group_id' 		=> 'dsidxpress',
		'active_first' 	=> false
	);
	
return array( 'options' => $options, 'config' => $config );

?>