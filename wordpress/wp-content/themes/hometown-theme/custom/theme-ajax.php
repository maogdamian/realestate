<?php

add_action( 'wp_ajax_nopriv_do_favourite', 'do_favourite' );
add_action( 'wp_ajax_do_favourite', 'do_favourite' );
function do_favourite(){
	// var_dump($_REQUEST);
	$property_id = $_REQUEST['params']['propertyId'];
	$user_id = get_current_user_id();

	$favourites = (array)get_post_meta($property_id, '_meta_favourites', true );
	if(in_array($user_id, $favourites)) {
		unset($favourites[array_search($user_id, $favourites)]);
	} else {
		array_push($favourites, $user_id);
	}
	update_post_meta($property_id, '_meta_favourites', $favourites);
	update_post_meta($property_id, '_meta_favourites_count', count($favourites));

	$result = array('result' => 'ok');
	die( json_encode($result) );
}

add_action( 'wp_ajax_nopriv_mailchimp_subscribe', 'mailchimp_subscribe' );
add_action( 'wp_ajax_mailchimp_subscribe', 'mailchimp_subscribe' );
function mailchimp_subscribe() {
	require_once( THEME_LIBS_DIR . '/MailChimp.php' );
	$MailChimp = new MailChimp(nt_get_option('advance', 'mailchimp_api'));
	$result = $MailChimp->call('lists/subscribe', array(
        'id'                => $_REQUEST['list_id'],
        'email'             => array('email'=>$_REQUEST['email']),
        'double_optin'      => true,
        'update_existing'   => true,
        'replace_interests' => false,
        'send_welcome'      => false,
    ));
    if(@$result['error']) {
    	$ret = array('result' => $result['error']);
    } else {
    	$ret = array('result' => $result['email'].' '.__('has been subscribed.', 'theme_front'));
    }
	die( json_encode($ret) );
}


?>