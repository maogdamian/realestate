<?php 
	
// Option
$options = array(
	array(
		'title' 	=> __('Add your own custom option - <a href="#">Developer API</a>', 'theme_admin'),
		'options' 	=> array(
		)
	),
);

$config = array(
	'title' 		=> __('Custom', 'theme_admin'),
	'group_id' 		=> 'custom',
	'active_first' 	=> false
);

// Apply filter 'nt_page_builder'
$options = apply_filters('nt_custom_option', $options);

return array( 'options' => $options, 'config' => $config );

?>