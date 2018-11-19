<?php 
	
	// Option
	$options = array(
		
	
		
		array(
			'title' 	=> __('General', 'theme_admin'),
			'options' 	=> array(
				array(
					'type' => 'text',
					'id' => 'null_price',
					'locale'		=> true,
					'title' => __('Blank Price Text', 'theme_admin'),
					'default' => 'POA',
					'description' => __('this text will be show when you leave price field as blank', 'theme_admin'),
				),
				// array(
				// 	'type' => 'number',
				// 	'id' => 'decimal_point_num',
				// 	'locale' => true,
				// 	'title' => 'Decimal Point',
				// 	'default' => '0',
				// 	'description' => 'number of decimal points',
				// ),
				array(
					'type' => 'text',
					'id' => 'decimal_point',
					'locale'		=> true,
					'title' => __('Decimal Point Separator', 'theme_admin'),
					'default' => '.',
					'description' => __('must different from "thousands separator"', 'theme_admin'),
				),
				array(
					'type' => 'text',
					'id' => 'thousands_sep',
					'locale'		=> true,
					'title' => __('Thousands Separator', 'theme_admin'),
					'default' => ',',
					'description' => __('must different from "decimal point"', 'theme_admin'),
				),
				array(
					'type' => 'text',
					'id' => 'currency',
					'locale'		=> true,
					'title' => __('Currency Symbol', 'theme_admin'),
					'default' => '$',
					'description' => '',
				),
				array(
					'type' => 'radio',
					'id' => 'currency_position',
					'title' => __('Currency Symbol Position', 'theme_admin'),
					'default' => 'before',
					'description' => '',
					'options' 		=> array(
						'before' 	=> __('Before', 'theme_admin'),
						'after' => __('After', 'theme_admin'),
					)
				),
				array(
					'type' => 'text',
					'id' => 'area',
					'locale'		=> true,
					'title' => __('Area Unit', 'theme_admin'),
					'default' => 'ft<sup>2</sup>',
					'description' => sprintf(__('use %s for square sign', 'theme_admin'), htmlentities('<sup>2</sup>')),
					
				),
				array(
					'type' 			=> 'on_off',
					'id' 			=> 'favourite',
					'title' 		=> __('Favourite Button', 'theme_admin'),
					'description' 	=> __('user can add property to their favourite list', 'theme_admin'),
					'default'		=> 'on'
				),
				array(
					'type' => 'radio',
					'id' => 'map_style',
					'title' => __('Map Style', 'theme_admin'),
					'default' => 'bw',
					'description' => '',
					'options' 		=> array(
						'bw' => __('Black & White', 'theme_admin'),
						'color' 	=> __('Color', 'theme_admin'),
					)
				),
			)
		),

		array(
			'title' 	=> __('Listing Page (Archive & Search Result)', 'theme_admin'),
			'options' 	=> array(
				
				array(
					'type' 			=> 'radio',
					'id' 			=> 'layout',
					'title' 		=> __('Layout', 'theme_admin'),
					'description' 	=> '',
					'default' 		=> 'full-width',
					'options' 		=> array(
						'full-width' 	=> __('Full Width', 'theme_admin'),
						'sidebar-right' => __('Sidebar Right', 'theme_admin'),
						'sidebar-left' => __('Sidebar Left', 'theme_admin')
					)
				),
				array(
					'type' => 'number',
					'id' => 'per_page',
					'title' => __('Properties per Page', 'theme_admin'),
					'default' => '9',
					'description' => __('<br />Leave blank to use default value (wp-admin > setting > reading > Blog pages show at most). <br /><br />Set to -1 to show all', 'theme_admin'),
				),
				array(
					'type' => 'radio',
					'id' => 'default_sorting',
					'title' => __('Default Sorting', 'theme_admin'),
					'default' => 'date-desc',
					'description' => '',
					'options' 		=> array(
						'price-asc' => __('Price Low to High', 'theme_admin'),
						'price-desc' 	=> __('Price High to Low', 'theme_admin'),
						'date-asc' 	=> __('Date Old to New', 'theme_admin'),
						'date-desc' 	=> __('Date New to Old', 'theme_admin'),

						'name-asc' 	=> __('Name Ascending', 'theme_admin'),
						'name-desc' 	=> __('Name Descending', 'theme_admin'),
					)
				),
				
			)
		),

		array(
			'title' 	=> __('Single Property Page', 'theme_admin'),
			'options' 	=> array(
				
				array(
					'type' 			=> 'radio',
					'id' 			=> 'single_layout',
					'title' 		=> __('Layout', 'theme_admin'),
					'description' 	=> '',
					'default' 		=> 'sidebar-left',
					'options' 		=> array(
						'full-width' 	=> __('Full Width', 'theme_admin'),
						'sidebar' => __('Sidebar Right', 'theme_admin'),
						'sidebar-left' => __('Sidebar Left', 'theme_admin')
					)
				),
				array(
					'type' 			=> 'range',
					'id' 			=> 'slide_timeout',
					'title' 		=> __('Slide Autoplay Timeout', 'theme_admin'),
					'description' 	=> __('set to 0 to disable autoplay', 'theme_admin'),
					'unit' 			=> 'ms',
					'default' 		=> '4000',
					'min' 			=> '0',
					'max' 			=> '10000',
					'step' 			=> '500'
				),
				array(
					'type' 			=> 'on_off',
					'id' 			=> 'single_share',
					'title' 		=> __('Share Buttons', 'theme_admin'),
					'description' 	=> __('turn on to show "Share Buttons"', 'theme_admin'),
					'default' 		=> 'on',
				),
				
			)
		),

		array(
			'title' 	=> __('Contact', 'theme_admin'),
			'options' 	=> array(
				
				array(
					'type' => 'textarea',
					'id' => 'contact_note',
					'locale'		=> true,
					'title' => __('Contact Note', 'theme_admin'),
					'default' => '',
					'description' => __('this content will be displayed beside property contact form', 'theme_admin'),
				),
				array(
					'type' => 'text',
					'id' => 'contact_email',
					'title' => __('Contact Email', 'theme_admin'),
					'default' => '',
					'description' => __('this Email will be used when send to Email is not specified', 'theme_admin'),
				),
				
			)
		),
		

		array(
			'title' 	=> __('Submission', 'theme_admin'),
			'options' 	=> array(
				
				array(
					'type' => 'on_off',
					'id' => 'submit_require_payment',
					'toggle' => 'toggle-require-payment',
					'default' => 'off',
					'title' => __('Require Payment', 'theme_admin'),
					'description' => '',
				),
				array(
					'type' => 'radio',
					'id' => 'paypal_server',
					'toggle_group' => 'toggle-require-payment toggle-require-payment-on',
					'title' => __('Paypal Server', 'theme_admin'),
					'default' => 'sandbox',
					'description' => '',
					'options' 		=> array(
						'sandbox' 	=> __('Sandbox', 'theme_admin'),
						'production' => __('Production', 'theme_admin'),
					)
				),
				array(
					'type' => 'text',
					'id' => 'paypal_merchant_id',
					'toggle_group' => 'toggle-require-payment toggle-require-payment-on',
					'title' => __('Paypal Merchant ID', 'theme_admin'),
					'default' => '',
					'description' => '',
				),
				array(
					'type' => 'number',
					'id' => 'submission_price',
					'toggle_group' => 'toggle-require-payment toggle-require-payment-on',
					'title' => __('Submission Price (USD)', 'theme_admin'),
					'default' => '0.99',
					'description' => '',
				),
			)
		),

		array(
			'title' 	=> __('Advance', 'theme_admin'),
			'options' 	=> array(
				
				
				array(
					'type' => 'text',
					'id' => 'slug',
					'title' => __('slug', 'theme_admin'),
					'default' => '',
					'description' => sprintf(__('Custom slug for "property" post type. Leave blank to use default value.<br /><br />After update this value, please navigate to <a href="%s">permalinks page</a> and click on "Save Changes" button.', 'theme_admin'), admin_url('/options-permalink.php')),
				),
				
			)
		),
		
	);
	
	$config = array(
		'title' 		=> __('Property', 'theme_admin'),
		'group_id' 		=> 'property',
		'active_first' 	=> false
	);
	
	
return array( 'options' => $options, 'config' => $config );

?>