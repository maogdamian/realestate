<?php 
	$layout = nt_get_option('page', 'default_layout', 'full-width');
	get_template_part('template', $layout);
?>
