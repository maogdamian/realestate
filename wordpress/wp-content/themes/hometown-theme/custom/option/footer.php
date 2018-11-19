<?php 
	
	// Option
	$options = array(
		array(
			'title' 	=> __('Footer', 'theme_admin'),
			'options' 	=> array(
				
				array(
					'type' 			=> 'radio',
					'id' 			=> 'footer_element_style',
					'title' 		=> __('Element Style', 'theme_admin'),
					'description' 	=> '',
					'default' 		=> 'element-dark',
					'options' 		=> array(
						'element-light' => __('Light (best for dark BG)', 'theme_admin'),
						'element-dark'	=> __('Dark (best for light BG)', 'theme_admin')
					)
				),
				array(
					'type' 			=> 'color',
					'id'			=> 'footer_bg_color',
					'title' 		=> __('BG Color', 'theme_admin'),
					'description'	=> '',
					'default' 		=> '#fafafa',
				),
				array(
					'type' 			=> 'image',
					'id' 			=> 'footer_bg_image',
					'title' 		=> __('BG Image', 'theme_admin'),
					'description' 	=> ''
				),
				array(
					'type' 			=> 'radio',
					'id'			=> 'footer_bg_image_style',
					'title' 		=> __('BG Image Style', 'theme_admin'),
					'description' 	=> '',
					'default' 		=> 'contain',
					'options' 		=> array(
						'contain' 	=> __('Contain', 'theme_admin'),
						'cover' 	=> __('Cover', 'theme_admin'),
						'repeat' 	=> __('Repeat', 'theme_admin'),
					),
				),
				array(
					'type' 			=> 'text',
					'id' 			=> 'footer_text',
					'locale'		=> true,
					'title' 		=> __('Footer Text', 'theme_admin'),
					'description' 	=> '',
					'default'	=> 'Copyright &copy; 2014 Yoursite.com'
				),
				array(
					'type' 			=> 'stack',
					'id' 			=> 'social_items',
					'title' 		=> __('Social Links', 'theme_admin'),
					'description' 	=> '',
					'templates'		=> $top_bar_item_stack,
					'stack_button'	=> __('Add Links', 'theme_admin')
				),
				
				
			)
		),
		
		array(
			'title' 	=> 'Pre Footer',
			'options' 	=> array(
				
				array(
					'type' 			=> 'on_off',
					'id' 			=> 'footer_show',
					'toggle'		=> 'toggle-pre-footer',
					'title' 		=> __('Show', 'theme_admin'),
					'description' 	=> __('turn off to hide', 'theme_admin'),
					'default'		=> 'on'
				),
				array(
					'type' 			=> 'radio',
					'id' 			=> 'pre_footer_columns',
					'toggle_group'	=> 'toggle-pre-footer toggle-pre-footer-on',
					'title' 		=> __('Columns', 'theme_admin'),
					'description' 	=> '',
					'default' 		=> '4-cols',
					'options' 		=> array(
						'4-cols' => __('4 Coloumns', 'theme_admin'),
						'3-cols'	=> __('3 Columns', 'theme_admin')
					)
				),
				
				
			)
		),

	);

	
	
	$config = array(
		'title' 		=> __('Footer', 'theme_admin'),
		'group_id' 		=> 'footer',
		'active_first' 	=> false
	);
	
	
return array( 'options' => $options, 'config' => $config );

?>