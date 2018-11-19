<?php 
	
// Option
$options = array(
	
	// Background
	array(
		'title' 	=> __('Setup', 'theme_admin'),
		'options' 	=> array(
			
			array(
				'type' 			=> 'content',
				'id' 			=> 'plugin',
				'title' 		=> __('1. Install Required Plugins', 'theme_admin'),
				'description' 	=> '',
				'default'	=> '',
				'value'	=> sprintf(__('Click <a href="%s">here</a> to install required plugins.','theme_admin'),admin_url('themes.php?page=install-required-plugins'))
			),
			// array(
			// 	'type' 			=> 'import_content',
			// 	'id' 			=> 'import_demo_content',
			// 	'title' 		=> __('2. Import Demo Content', 'theme_admin'),
			// 	'description' 	=> __('<br />must <strong>activate all required plugin</strong> before import demo content<br /><br />recommended to perform on fresh installation<br /><br />all content will be deleted', 'theme_admin'),
			// 	'options' 		=> array(
			// 		'demo-1' 	=> __('Demo #1', 'theme_admin'),
			// 		'demo-2' 	=> __('Demo #2', 'theme_admin'),
			// 	)
			// ),
			array(
				'type' 			=> 'content',
				'id' 			=> 'all_in',
				'title' 		=> __('2. Import Demo Content', 'theme_admin'),
				'description' 	=> __('<br />must <strong>activate all required plugin</strong> before import demo content<br /><br />recommended to perform on fresh installation<br /><br />all content will be deleted', 'theme_admin'),
				'value'	=> sprintf(__('1. Download and Install %s plugin<br /><br />2. Then import with this: %s<br /><br />3. After finish import, username and password for wp-admin is root / root','theme_admin'),'<a href="https://wordpress.org/plugins/all-in-one-wp-migration/">All in One WP Migration</a>', '<a href="https://www.dropbox.com/s/x4aaq3nuo1w5k2w/hometown-demo.loc-20170411-072340-324.wpress?dl=0">Demo File</a>')
			),
					
		)
	),
	
);

$config = array(
	'title'			=> __('Setup', 'theme_admin'),
	'group_id' 		=> 'setup',
	'active_first' 	=> true
);
	
	
return array( 'options' => $options, 'config' => $config );

?>