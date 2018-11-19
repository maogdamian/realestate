<?php 
	
// Option
$options = array(
	
	// Background
	array(
		'title' 	=> __('Layout & Background', 'theme_admin'),
		'options' 	=> array(
			
			// array(
			// 	'type' 			=> 'on_off',
			// 	'id' 			=> 'text_rtl',
			// 	'title' 		=> 'RTL text direction',
			// 	'description' 	=> 'turn on for language that read from right to left',
			// 	'default' 		=> 'off'
			// ),
			array(
				'type' 			=> 'radio',
				'id' 			=> 'direction',
				'title' 		=> __('Text Direction', 'theme_admin'),
				'description' 	=> '',
				'default' 		=> 'ltr',
				'options' 		=> array(
					'ltr' 	=> __('Left to Right', 'theme_admin'),
					'rtl' 		=> __('Right to Left', 'theme_admin'),
				)
			),
			// array(
			// 	'type' 			=> 'on_off',
			// 	'id' 			=> 'page_load',
			// 	'title' 		=> 'Page Load Overlay',
			// 	'description' 	=> '',
			// 	'default' 		=> 'on'
			// ),
			
			array(
				'type' 			=> 'radio',
				'id' 			=> 'looks_feels',
				'title'		 	=> __('Looks & Feels', 'theme_admin'),
				'description' 	=> '',
				'default' 		=> 'element-round',
				'options' 		=> array(
					'element-round' 	=> __('Round', 'theme_admin'),
					// 'element-semi-round' 		=> 'Semi-Round',
					'element-crisp' 		=> __('Crisp', 'theme_admin'),
				)
			),

			array(
				'type' 			=>	'color',
				'id' 			=>	'site_color',
				'title' 		=>	__('Accent Color', 'theme_admin'),
				'description' 	=>	__('this color will be used sitewide', 'theme_admin'),
				'default' 		=>	'#bc0054',
			),

			array(
				'type' 			=> 'radio',
				'id' 			=> 'site_layout',
				'toggle' 		=> 'toggle-site-layout',
				'title'		 	=> __('Layout', 'theme_admin'),
				'description' 	=> 'site layout',
				'toggle'		=>	'toggle-site-layout',
				'default' 		=> 'full-width',
				'options' 		=> array(
					'full-width' 	=> __('Full Width', 'theme_admin'),
					'boxed' 		=> __('Boxed', 'theme_admin'),
				)
			),
			array(
				'type' 			=>	'color',
				'id' 			=>	'bg_color',
				'toggle_group' 	=> 'toggle-site-layout toggle-site-layout-boxed',
				'title' 		=>	__('Background Color', 'theme_admin'),
				'description' 	=>	__('choose color to use as background', 'theme_admin'),
				'default' 		=>	'#eee',
				
			),
			

			array(
				'type' 			=> 'image',
				'id' 			=> 'bg_image',
				'toggle_group' 	=> 'toggle-site-layout toggle-site-layout-boxed',
				'title' 		=> __('Background Image', 'theme_admin'),
				'description' 	=> __('choose image to use as background', 'theme_admin'),
				
			),
			array(
				'type' 			=> 'radio',
				'id' 			=> 'bg_style',
				'toggle_group' 	=> 'toggle-site-layout toggle-site-layout-boxed',
				'title' 		=> __('Background Style', 'theme_admin'),
				'description' 	=> '',
				'default' 		=> 'cover',
				'options' 		=> array(
					'contain' 		=> __('Contain', 'theme_admin'),
					'cover' 		=> __('Cover', 'theme_admin'),
					'repeat' 	=> __('Repeat', 'theme_admin'),
				),
				
			),		
					
		)
	),


	// Background
	// array(
	// 	'title' 	=> 'Page Load Overlay',
	// 	'options' 	=> array(
			
				
	// 		array(
	// 			'type' 			=> 'on_off',
	// 			'id' 			=> 'page_load',
	// 			'title' 		=> 'Page Load',
	// 			'description' 	=> '',
	// 			'default' 		=> 'on'
	// 		),

					
	// 	)
	// ),
	
);

$config = array(
	'title'			=> __('Appearance', 'theme_admin'),
	'group_id' 		=> 'appearance',
	'active_first' 	=> false
);
	
	
return array( 'options' => $options, 'config' => $config );

?>