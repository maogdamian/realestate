<?php

// ENQUEUE JS

// WP Native Scripts
wp_enqueue_script('jquery');
// wp_enqueue_script('common');
wp_enqueue_script( 'jquery-form' );

if( is_single() ) {
	wp_enqueue_script( 'comment' );
	wp_enqueue_script( 'comment-reply' );
}

// Support IE
if( nt_is_ie() && nt_is_ie() <= 8 ) {
	wp_enqueue_script('lt-html5', THEME_URI . '/js/html5.js', null, THEME_VERSION, false );
	wp_enqueue_script('lt-respond', THEME_URI . '/js/respond.min.js', false, THEME_VERSION, false );
}
$gmap_api = (nt_get_option('advance', 'gmap_api'))?nt_get_option('advance', 'gmap_api'):'AIzaSyCBybfWlOOpsXx05tU1amB9kSIV3ijZ5PE';
wp_enqueue_script('lt-google-maps', "//maps.googleapis.com/maps/api/js?libraries=places&geometry&key=".$gmap_api, false, THEME_VERSION, true );

wp_enqueue_script('lt-social', THEME_URI . '/js/specific/jssocials.min.js', false, THEME_VERSION, true );
wp_enqueue_script('lt-pack', THEME_URI . '/js/pack-min.js', false, THEME_VERSION, true );

wp_enqueue_script('lt-theme', THEME_URI . '/js/theme.js', false, THEME_VERSION, true );
$translation_array = array( 'templateUrl' => get_template_directory_uri() );
wp_localize_script( 'lt-theme', 'object_name', $translation_array );



// ENQUEUE CSS

// Custom Fontello Icon
$custom_icons = nt_get_option('advance', 'custom_icon');
$upload_dir = wp_upload_dir();
if(is_array($custom_icons)) {
	foreach( $custom_icons as $custom_icon ) {
		$custom_icon = explode('|', $custom_icon);
		$custom_icon_style_url = $upload_dir['baseurl'] .'/nt_custom_icon/'. $custom_icon[2].'/css/'.$custom_icon[1].'.css';
		wp_enqueue_style( 'lt-icon-'.$custom_icon[1], $custom_icon_style_url, true, THEME_VERSION );
	}
}

wp_enqueue_style( 'lt-icon', THEME_URI . '/font/flaticon.css', true, THEME_VERSION );
wp_enqueue_style( 'lt-foundation', THEME_URI . '/css/foundation.css', true, THEME_VERSION );
wp_enqueue_style( 'lt-screen', THEME_URI . '/css/screen.css', true, THEME_VERSION );

// RTL
if( nt_text_direction() == 'rtl' ) {
	wp_enqueue_style( 'lt-rtl', THEME_URI . '/css/rtl.css', false, THEME_VERSION );
}

// Customize
if( nt_get_option('advance', 'show_customize') == 'on' || isset($_REQUEST['customize']) ) {
	wp_enqueue_style( 'nt-customize-panel', THEME_URI . '/css/customize-panel.css', true, THEME_VERSION );
}

// Standard style.css for child-theme
wp_enqueue_style( 'lt-child', get_stylesheet_uri(), false, THEME_VERSION );

$google_font = nt_get_option('font', 'google_web_font');
if( $google_font != '' ){
	wp_enqueue_style( 'lt-google-webfont', '//fonts.googleapis.com/css?family='.str_replace( ' ', '+', $google_font ).':400,300', false, THEME_VERSION );
}
