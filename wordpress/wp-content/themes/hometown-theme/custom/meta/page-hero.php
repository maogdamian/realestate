<?php

$config = array(
	'title' => __('Hero Options', 'theme_admin'),
	'group_id' => 'hero',
	'context' => 'normal',
	'priority' => 'core',
	'types' => array( 'page' )
);

$property_item_stack[] = array(
	'id' => 'property',
	'type' => 'stack_template',
	'title' => __('Property', 'theme_admin'),
	'description' => '',
	'options' => array(
		array(
			'type' 			=> 'select',
			'id'			=> 'stack_title',
			'title' 		=> __('Property', 'theme_admin'),
			'description'	=> '',
			'source'	=> array('post_type' => 'property')
		),
	)
);

$general_slide_item_stack[] = array(
	'id' => 'slide',
	'type' => 'stack_template',
	'title' => __('Slide', 'theme_admin'),
	'description' => '',
	'options' => array(
		array(
			'type' 			=> 'text',
			'id'			=> 'stack_title',
			'title' 		=> __('Title', 'theme_admin'),
			'description'	=> '',
		),
		array(
			'type' 			=> 'textarea',
			'id'			=> 'description',
			'title' 		=> __('Description', 'theme_admin'),
			'description'	=> '',
		),
		array(
			'type' 			=> 'text',
			'id'			=> 'button',
			'title' 		=> __('Button Text', 'theme_admin'),
			'description'	=> '',
		),
		array(
			'type' 			=> 'text',
			'id'			=> 'url',
			'title' 		=> __('URL', 'theme_admin'),
			'description'	=> '',
		),
		array(
			'type' 			=> 'image',
			'id'			=> 'bg_image',
			'title' 		=> __('Background Image', 'theme_admin'),
			'description'	=> '',
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
	)
);

$options = array(


	array(
		'type' => 'radio',
		'id' => 'type',
		'toggle' => 'toggle-hero-type',
		'title' => __('Hero Type', 'theme_admin'),
		'description' => '',
		'default' => '',
		'options' => array(
			'' => __('None', 'theme_admin'),
			'map' => __('Map', 'theme_admin'),
			'slide' => __('Property Slider', 'theme_admin'),
			'general-slide' => __('General Slider', 'theme_admin'),
			'rev-slide' => __('Revolution Slider', 'theme_admin'),
		)
	),

	

	array(
		'type' 			=> 'select',
		'id'			=> 'rev_slide',
		'toggle_group' => 'toggle-hero-type toggle-hero-type-rev-slide',
		'title' 		=> __('Revolution Slider', 'theme_admin'),
		'description'	=> '',
		'source'	=> array('revslider' => true)
	),

	array(
		'type' 			=> 'range',
		'id' 			=> 'property_map_height',
		'toggle_group' => 'toggle-hero-type toggle-hero-type-map',
		'title' 		=> __('Map Height', 'theme_admin'),
		'description' 	=> '',
		'unit' 			=> 'px',
		'default' 		=> '500',
		'min' 			=> '200',
		'max' 			=> '1000',
		'step' 			=> '10'
	),
	array(
		'type' 			=> 'range',
		'id' 			=> 'property_map_zoom',
		'toggle_group' => 'toggle-hero-type toggle-hero-type-map',
		'title' 		=> __('Map Zoom', 'theme_admin'),
		'description' 	=> 'set to -1 for auto zoom',
		'unit' 			=> '',
		'default' 		=> '-1',
		'min' 			=> '-1',
		'max' 			=> '16',
		'step' 			=> '1'
	),
	array(
		'type' => 'select',
		'id' => 'property_map_properties',
		'toggle_group' => 'toggle-hero-type toggle-hero-type-map',
		'title' => __('Filter Properties', 'theme_admin'),
		'description' => __('Select properties to show on the map. Select none to show all. To select multiple options<br />OSX: cmd + click<br />Window: ctrl + click', 'theme_admin'),
		'multiple'	=> 8,
		'source'	=> array('post_type' => 'property')
	),


	array(
		'type' => 'radio',
		'id' => 'property_slide_style',
		'toggle_group' => 'toggle-hero-type toggle-hero-type-slide',
		'title' => __('Slide Style', 'theme_admin'),
		'description' => '',
		'default' => '1',
		'options' => array(
			'1' => __('Style #1', 'theme_admin'),
			'2' => __('Style #2', 'theme_admin'),
		)
	),
	array(
		'type' 			=> 'range',
		'id' 			=> 'property_slide_height',
		'toggle_group' => 'toggle-hero-type toggle-hero-type-slide',
		'title' 		=> __('Slide Height', 'theme_admin'),
		'description' 	=> __('adjust to change slide height', 'theme_admin'),
		'unit' 			=> 'px',
		'default' 		=> '500',
		'min' 			=> '350',
		'max' 			=> '1000',
		'step' 			=> '10'
	),
	array(
		'type' 			=> 'range',
		'id' 			=> 'property_slide_timeout',
		'toggle_group' => 'toggle-hero-type toggle-hero-type-slide',
		'title' 		=> __('Autoplay Timeout', 'theme_admin'),
		'description' 	=> __('set to 0 to disable autoplay', 'theme_admin'),
		'unit' 			=> 'ms',
		'default' 		=> '4000',
		'min' 			=> '0',
		'max' 			=> '10000',
		'step' 			=> '500'
	),
	array(
		'type' 			=> 'stack',
		'id' 			=> 'properties',
		'toggle_group' => 'toggle-hero-type toggle-hero-type-slide',
		'title' 		=> __('Properties Slide', 'theme_admin'),
		'description' 	=> '',
		'templates'		=> $property_item_stack,
		'stack_button'	=> __('Add Slide', 'theme_admin')
	),

	array(
		'type' 			=> 'range',
		'id' 			=> 'general_slide_padding',
		'toggle_group' => 'toggle-hero-type toggle-hero-type-general-slide',
		'title' 		=> __('Slide Vertical Padding', 'theme_admin'),
		'description' 	=> __('adjust to change slide height', 'theme_admin'),
		'unit' 			=> 'px',
		'default' 		=> '100',
		'min' 			=> '50',
		'max' 			=> '200',
		'step' 			=> '5'
	),
	array(
		'type' 			=> 'range',
		'id' 			=> 'general_slide_timeout',
		'toggle_group' => 'toggle-hero-type toggle-hero-type-general-slide',
		'title' 		=> __('Autoplay Timeout', 'theme_admin'),
		'description' 	=> __('set to 0 to disable autoplay', 'theme_admin'),
		'unit' 			=> 'ms',
		'default' 		=> '4000',
		'min' 			=> '0',
		'max' 			=> '10000',
		'step' 			=> '500'
	),
	array(
		'type' 			=> 'stack',
		'id' 			=> 'general_slide',
		'toggle_group' => 'toggle-hero-type toggle-hero-type-general-slide',
		'title' 		=> __('Slide', 'theme_admin'),
		'description' 	=> '',
		'templates'		=> $general_slide_item_stack,
		'stack_button'	=> 'Add Slide'
	),


	array(
		'type' => 'on_off',
		'id' => 'property_search',
		'toggle' => 'toggle-hero-search',
		'title' => __('Property Search Box', 'theme_admin'),
		'default' => 'off',
		'description' => '',
	),
	array(
		'type' => 'radio',
		'id' => 'property_search_type',
		'toggle' => 'toggle-hero-search-type',
		'toggle_group' => 'toggle-hero-search toggle-hero-search-on',
		'title' => __('Type', 'theme_admin'),
		'description' => '',
		'default' => 'hometown',
		'options' => array(
			'hometown' => __('Hometown Property Search Form', 'theme_admin'),
			'dsidx' => __('<a href="http://www.dsidxpress.com/">dsIDXpress</a> Search Form', 'theme_admin'),
			'optima_express' => __('<a href="http://www.ihomefinder.com/products/optima/">Optima Express</a> Search Form', 'theme_admin'),
		)
	),
	array(
		'type' => 'radio',
		'id' => 'property_search_style',
		'toggle_group' => 'toggle-hero-search toggle-hero-search-on toggle-hero-search-type toggle-hero-search-type-hometown',
		'title' => __('Search Box Style', 'theme_admin'),
		'description' => '',
		'default' => 'full',
		'options' => array(
			'full' => __('Full', 'theme_admin'),
			'compact' => __('Compact', 'theme_admin'),
		)
	),
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
	// 	'id' => 'show_main_title',
	// 	'toggle' => 'toggle-show-title',
	// 	'title' => 'Show Title',
	// 	'default' => 'on',
	// 	'description' => 'turn off to hide title section',
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
	// array(
	// 	'type' 			=> 'radio',
	// 	'id' 			=> 'title_element_style',
	// 	'toggle_group' => 'toggle-show-title toggle-show-title-on',
	// 	'title' 		=> 'Title Element Style',
	// 	'description' 	=> '',
	// 	'default' 		=> '',
	// 	'options' 		=> array(
	// 		'' => 'Default',
	// 		'element-light' => 'Light (best for dark BG)',
	// 		'element-dark'	=> 'Dark (best for light BG)'
	// 	)
	// ),
	// array(
	// 	'type' 			=> 'color',
	// 	'id'			=> 'title_bg_color',
	// 	'toggle_group' => 'toggle-show-title toggle-show-title-on',
	// 	'title' 		=> 'Title BG Color',
	// 	'description'	=> '',
	// 	'default' 		=> '',
	// ),
	// array(
	// 	'type' 			=> 'image',
	// 	'id' 			=> 'title_bg_image',
	// 	'toggle_group' => 'toggle-show-title toggle-show-title-on',
	// 	'title' 		=> 'Title BG Image',
	// 	'description' 	=> ''
	// ),
	// array(
	// 	'type' 			=> 'radio',
	// 	'id'			=> 'title_bg_image_style',
	// 	'toggle_group' => 'toggle-show-title toggle-show-title-on',
	// 	'title' 		=> 'Title BG Image Style',
	// 	'description' 	=> '',
	// 	'default' 		=> '',
	// 	'options' 		=> array(
	// 		'' 	=> 'Default',
	// 		'cover' 	=> 'Cover',
	// 		'contain' 	=> 'Contain',
	// 		'repeat' 	=> 'Repeat',
	// 	),
	// ),

	
	
);
new nt_metaboxes_tool($config, $options);



?>
