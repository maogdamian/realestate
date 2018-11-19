<?php

add_action( 'wp_ajax_nt_ajax_save_option', 'nt_ajax_save_option' );
function nt_ajax_save_option() {
	wp_parse_str( stripslashes( $_REQUEST['options'] ), $options);

	update_option(THEME_SLUG . '_options', $options);

	$result = array('result' => 'ok');
	echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
	die();
}

add_action( 'wp_ajax_nt_ajax_generate_stack_option', 'nt_ajax_generate_stack_option' );
function nt_ajax_generate_stack_option() {
	$stack_option = json_decode(stripslashes($_POST['option']),true);
	$stack_config = json_decode(stripslashes($_POST['config']),true);
	$stack_subgroup = json_decode(stripslashes($_POST['subgroup']),true);
	if(!is_array($stack_subgroup)){
		$stack_subgroup = array();
	}
	$stack_subgroup[] = $_POST['stack_id'];

	// modify option id, toggle, toggle_group
	$extend = '-' . $_POST['stack_id'];
	$stack_config['stack_id'] = $_POST['stack_id'];
	$stack_config['subgroup'] = $stack_subgroup;

	// generate stack option
	$nt_input_tool = new nt_input_tool($stack_option, $stack_config);
	$nt_input_tool->generate_stack_option();

	die();
}

// nt_do_shortcode
add_action( 'wp_ajax_nt_do_shortcode', 'nt_do_shortcode' );
function nt_do_shortcode() {
	$result = array('result' => do_shortcode($_REQUEST['content']));
	echo json_encode($result);
	die();
}

