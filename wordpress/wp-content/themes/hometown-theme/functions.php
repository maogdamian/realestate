<?php

require_once( get_template_directory() . '/custom/config.php' );
require_once( get_template_directory() . '/framework/base.php' );

$theme = new LT_Base($nt_config);

// Disable Contact Form 7 CSS
add_action( 'wp_enqueue_scripts', 'nt_dequeue_function', 1000 );
function nt_dequeue_function() {
    wp_deregister_style( array('wp-pagenavi') );
}

add_action('init', 'nt_do_output_buffer');
function nt_do_output_buffer() {
        ob_start();
}


