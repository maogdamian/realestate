<?php 
	
$top_bar_item_stack[] = array(
	'id' => 'link',
	'type' => 'stack_template',
	'title' => __('Link', 'theme_admin'),
	'description' => '',
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Link', 'theme_admin'),
			'description'	=> ''
		),
		array(
			'type' 			=> 'icon',
			'id'			=> 'icon',
			'title' 		=> __('Icon', 'theme_admin'),
			'description' 	=> '',
			'default'		=> '',
		),
	)
);

// $top_bar_item_stack[] = array(
// 	'id' => 'top_bar_menu',
// 	'type' => 'stack_template',
// 	'title' => 'Menu',
// 	'description' => '',
// 	'options' => array(
// 		array(
// 			'type' 			=> 'select',
// 			'id'			=> 'stack_title',
// 			'title' 		=> 'Text',
// 			'description'	=> '',
// 			'source'		=> array(
// 				'nav-menu'	=> true
// 			),
// 			'default'	=> ''
// 		),
// 	)
// );

// $top_bar_item_stack[] = array(
// 	'id' => 'top_bar_search',
// 	'type' => 'stack_template',
// 	'title' => 'Search',
// 	'description' => '',
// 	'options' => array(
// 	)
// );

// $top_bar_item_stack[] = array(
// 	'id' => 'top_bar_wpml_language_switcher',
// 	'type' => 'stack_template',
// 	'title' => 'WPML Language Switcher',
// 	'description' => '',
// 	'options' => array(
// 	)
// );

// $top_bar_item_stack[] = array(
// 	'id' => 'top_bar_qts_language_switcher',
// 	'type' => 'stack_template',
// 	'title' => 'qTranslate Language Switcher',
// 	'description' => '',
// 	'options' => array(
// 	)
// );

// $top_bar_item_stack[] = array(
// 	'id' => 'top_bar_space',
// 	'type' => 'stack_template',
// 	'title' => 'Space',
// 	'description' => '',
// 	'options' => array(
// 	)
// );

// Option
$options = array(
	
	// Header
	array(
		'title' 	=> 'Style',
		'options' 	=> array(
			array(
				'type' 			=> 'radio',
				'id' 			=> 'header_type',
				'title' 		=> __('Header Type', 'theme_admin'),
				'description' 	=> '',
				'default' 		=> 'logo-left',
				'options' 		=> array(
					'logo-left' => __('Logo Left', 'theme_admin'),
					'logo-center'	=> __('Logo Center', 'theme_admin')
				)
			),
			array(
				'type' 			=> 'on_off',
				'id' 			=> 'sticky',
				'title' 		=> __('Sticky', 'theme_admin'),
				'description' 	=> '',
				'default'		=> 'on'
			),
			array(
				'type' 			=> 'text',
				'id' 			=> 'height',
				'title' 		=> __('Header Height', 'theme_admin'),
				'description' 	=> 'px unit',
				'default'		=> '100'
			),
			array(
				'type' 			=> 'radio',
				'id' 			=> 'element_style',
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
				'id'			=> 'bg_color',
				'title' 		=> __('BG Color', 'theme_admin'),
				'description'	=> '',
				'default' 		=> '#fff',
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
				'default' 		=> 'contain',
				'options' 		=> array(
					'contain' 	=> __('Contain', 'theme_admin'),
					'cover' 	=> __('Cover', 'theme_admin'),
					'repeat' 	=> __('Repeat', 'theme_admin'),
				),
			),
			
		)
	),
	
	array(
		'title' 	=> __('Logo', 'theme_admin'),
		'options' 	=> array(
			
			array(
				'type' 			=> 'image',
				'id' 			=> 'logo',
				'title' 		=> __('Image', 'theme_admin'),
				'description' 	=> __('use @2x image size, recommended height is 60px', 'theme_admin'),
			),
		)
	),

	array(
		'title' 	=> __('Top Bar', 'theme_admin'),
		'options' 	=> array(
			array(
				'type' 			=> 'on_off',
				'id' 			=> 'show_topbar',
				'toggle'		=> 'toggle-show-topbar',
				'title' 		=> __('Show Top Bar', 'theme_admin'),
				'description' 	=> '',
				'default'		=> 'on'
			),
			array(
				'type' 			=> 'text',
				'id' 			=> 'announce_text',
				'toggle_group'	=> 'toggle-show-topbar toggle-show-topbar-on',
				'locale'		=> true,
				'title' 		=> __('Announce Text', 'theme_admin'),
				'description' 	=> '',
			),
			array(
				'type' 			=> 'on_off',
				'id' 			=> 'show_search',
				'toggle_group'	=> 'toggle-show-topbar toggle-show-topbar-on',
				'title' 		=> __('Show Search Button', 'theme_admin'),
				'description' 	=> '',
				'default'		=> 'on'
			),
			array(
				'type' 			=> 'on_off',
				'id' 			=> 'show_login',
				'toggle_group'	=> 'toggle-show-topbar toggle-show-topbar-on',
				'title' 		=> __('Show Login Menu', 'theme_admin'),
				'description' 	=> '',
				'default'		=> 'on'
			),
			array(
				'type' 			=> 'on_off',
				'id' 			=> 'show_wpml',
				'toggle_group'	=> 'toggle-show-topbar toggle-show-topbar-on',
				'toggle'		=>	'toggle-show-wpml',
				'title' 		=> __('Language Switcher', 'theme_admin'),
				'description' 	=> '',
				'default'		=> 'on'
			),
			array(
				'type' 			=> 'radio',
				'id'			=> 'wpml_switcher_type',
				'toggle_group'	=> 'toggle-show-wpml toggle-show-wpml-on toggle-show-topbar toggle-show-topbar-on',
				'title' 		=> __('Switcher Style', 'theme_admin'),
				'description' 	=> __('for WPML, Polylang', 'theme_admin'),
				'default' 		=> 'text',
				'options' 		=> array(
					'text' 	=> __('Text', 'theme_admin'),
					'flag' 	=> __('Flag', 'theme_admin'),
				),
			),
			array(
				'type' 			=> 'stack',
				'id' 			=> 'social_items',
				'toggle_group'	=> 'toggle-show-topbar toggle-show-topbar-on',
				'title' 		=> __('Social Links', 'theme_admin'),
				'description' 	=> '',
				'templates'		=> $top_bar_item_stack,
				'stack_button'	=> __('Add Links', 'theme_admin')
			),
		)
	),

	
	
);

$config = array(
	'title' 		=> __('Header', 'theme_admin'),
	'group_id' 		=> 'header',
	'active_first' 	=> false
);
	
	
return array( 'options' => $options, 'config' => $config );

?>