<?php

	// Option
	$options = array(

		// Google Analytic
		array(
			'title' 	=> __('Google Map', 'theme_admin'),
			'options' 	=> array(
				array(
					'type' 			=> 'text',
					'id' 			=> 'gmap_api',
					'title' 		=> __('API Key', 'theme_admin'),
					'description' 	=> 'use for front-end and back-end Google Map, you can get it <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">here</a>',
					'default' 		=> ''
				),
			)
		),

		// Google Analytic
		array(
			'title' 	=> __('Google Analytic', 'theme_admin'),
			'options' 	=> array(
				array(
					'type' 			=> 'text',
					'id' 			=> 'analytic_ua',
					'title' 		=> __('Google Analytic Tracking ID', 'theme_admin'),
					'description' 	=> 'UA-XXXXXXXX-X',
					'default' 		=> ''
				),
			)
		),

		// MailChimp
		array(
			'title' 	=> 'MailChimp',
			'options' 	=> array(
				array(
					'type' 			=> 'text',
					'id' 			=> 'mailchimp_api',
					'title' 		=> __('MailChimp API Key', 'theme_admin'),
					'description' 	=> __('find it at: '.'<a href="http://kb.mailchimp.com/article/where-can-i-find-my-api-key" target="_blank">Link</a>', 'theme_admin'),
					'default' 		=> ''
				),
			)
		),

		// Twitter API
		// array(
		// 	'title' 	=> 'Twitter App <small><a href="https://dev.twitter.com/apps" target="_blank">get them here</a></small>',
		// 	'options' 	=> array(
		// 		array(
		// 			'type' 			=> 'text',
		// 			'id' 			=> 'twitter_consumer_key',
		// 			'title' 		=> 'Consumer key',
		// 			'description' 	=> '',
		// 			'default' 		=> ''
		// 		),
		// 		array(
		// 			'type' 			=> 'text',
		// 			'id' 			=> 'twitter_consumer_secret',
		// 			'title' 		=> 'Consumer secret',
		// 			'description' 	=> '',
		// 			'default' 		=> ''
		// 		),
		// 		array(
		// 			'type' 			=> 'text',
		// 			'id' 			=> 'twitter_user_token',
		// 			'title' 		=> 'Access token',
		// 			'description' 	=> '',
		// 			'default' 		=> ''
		// 		),
		// 		array(
		// 			'type' 			=> 'text',
		// 			'id' 			=> 'twitter_user_secret',
		// 			'title' 		=> 'Access token secret',
		// 			'description' 	=> '',
		// 			'default' 		=> ''
		// 		),
		// 	)
		// ),

		// reCAPTCHAR
		array(
			'title' 	=> 'Invisible reCAPTCHA',
			'options' 	=> array(

				array(
					'type' 			=> 'text',
					'id' 			=> 'recaptchar_site_key',
					'title' 		=> __('Site Key', 'theme_admin'),
					'description' 	=> __('you can get one <a href="https://www.google.com/recaptcha/intro/index.html" target="_blank">here</a>', 'theme_admin'),
					'default' 		=> '',
				),
				array(
					'type' 			=> 'text',
					'id' 			=> 'recaptchar_secret_key',
					'title' 		=> __('Secret Key', 'theme_admin'),
					'description' 	=> __('you can get one <a href="https://www.google.com/recaptcha/intro/index.html" target="_blank">here</a>', 'theme_admin'),
					'default' 		=> '',
				),

			)
		),

		// Misc
		array(
			'title' 	=> 'Misc',
			'options' 	=> array(
				array(
					'type' 			=> 'on_off',
					'id' 			=> 'open_external_link',
					'title' 		=> __('Open External Link in new tab', 'theme_admin'),
					'description' 	=> __('link outside the site domain will be opened in new tab', 'theme_admin'),
					'default' 		=> 'off'
				),
				array(
					'type' 			=> 'on_off',
					'id' 			=> 'show_customize',
					'title' 		=> __('Show Customize Panel', 'theme_admin'),
					'description' 	=> __('show customize panel on frontend, should turn off in live site.', 'theme_admin'),
					'default' 		=> 'off'
				),
				array(
					'type' 			=> 'textarea',
					'id' 			=> 'custom_css',
					'row'			=> 10,
					'title' 		=> __('Custom CSS', 'theme_admin'),
					'description' 	=> '',
					'default' 		=> ''
				),
				array(
					'type' 			=> 'textarea',
					'id' 			=> 'custom_js',
					'row'			=> 10,
					'title' 		=> __('Custom JS', 'theme_admin'),
					'description' 	=> '',
					'default' 		=> ''
				),
			)
		),

		// Custom Icon
		array(
			'title' 	=> 'Custom Icon',
			'options'	=> array(
				array(
					'type' 			=> 'custom_icon',
					'id' 			=> 'custom_icon',
					'title' 		=> __('Custom Icon Pack', 'theme_admin'),
					'description' 	=> __('you can generate custom icon pack at <a href="http://fontello.com/" target="_blank">http://fontello.com/</a>', 'theme_admin'),
					'default' 		=> ''
				),
			)
		),

		// Save & Load Configuration
		array(
			'title' 	=> 'Save & Load Configuration',
			'options'	=> array(
				array(
					'type' 			=> 'export_options',
					'id' 			=> 'theme_export_options',
					'title' 		=> __('Export Option', 'theme_admin'),
					'description' 	=> __('backup options as .txt file', 'theme_admin'),
					'default' 		=> ''
				),
				array(
					'type' 			=> 'import_options',
					'id' 			=> 'theme_import_options',
					'title' 		=> __('Import Option', 'theme_admin'),
					'description' 	=> __('import options from .txt file', 'theme_admin'),
					'default' 		=> ''
				),
			)
		),

	);

	$config = array(
		'title' => __('Advance', 'theme_admin'),
		'group_id' => 'advance',
		'active_first' => false
	);


return array( 'options' => $options, 'config' => $config );

?>
