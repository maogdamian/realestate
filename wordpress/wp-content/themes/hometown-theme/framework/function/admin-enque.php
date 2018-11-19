<?php

// Include JS
add_action('admin_enqueue_scripts', 'nt_admin_scripts');
function nt_admin_scripts( $page ) {

	if( !in_array( $page, array( 'edit.php', 'post.php', 'post-new.php', 'appearance_page_theme_options') ) ) return;

	// Core
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script('jquery-form');
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_media();
	wp_enqueue_script('iris');

	// iPhone style checkbox
	wp_enqueue_script('nt-iphone-style-checkboxes-script', THEME_FRAMEWORK_ASSETS_URI . '/js/iphone-style-checkboxes.js', false, THEME_VERSION, true);

	// Input Slider
	wp_enqueue_script('nt-simple-slider', THEME_FRAMEWORK_ASSETS_URI . '/js/simple-slider.min.js', false, THEME_VERSION, true);

	// Location Picker
	$gmap_api = (nt_get_option('advance', 'gmap_api'))?nt_get_option('advance', 'gmap_api'):'AIzaSyCBybfWlOOpsXx05tU1amB9kSIV3ijZ5PE';
	wp_enqueue_script('nt-google-map', '//maps.google.com/maps/api/js?sensor=false&libraries=places&key='.$gmap_api, false, THEME_VERSION, true);
	wp_enqueue_script('nt-locationpicker', THEME_FRAMEWORK_ASSETS_URI . '/js/locationpicker.jquery.js', false, THEME_VERSION, true);

	// Numeric
	wp_enqueue_script('nt-numeric', THEME_FRAMEWORK_ASSETS_URI . '/js/jquery.numeric.min.js', false, THEME_VERSION, true );

	// Admin JS
	wp_enqueue_script('nt-admin', THEME_FRAMEWORK_ASSETS_URI . '/js/admin.js', false, THEME_VERSION, true );
}

// Include CSS
add_action('admin_enqueue_scripts', 'nt_admin_styles');
function nt_admin_styles( $page ) {

	if( !in_array( $page, array( 'edit.php', 'post.php', 'post-new.php', 'widget.php', 'toplevel_page_theme_setting', 'grizzly_page_theme_document', 'appearance_page_theme_options') ) ) return;

	// Core
	// wp_enqueue_style('thickbox');
	// wp_enqueue_style( 'linecons', THEME_URI . '/style/linecons.css', true, THEME_VERSION );
	wp_enqueue_style( 'nt-icon', THEME_URI . '/css/nt-icon.css', true, THEME_VERSION );



	// Custom Fontello Icon
	$custom_icons = nt_get_option('advance', 'custom_icon');
	$upload_dir = wp_upload_dir();
	if(is_array($custom_icons)) {
		foreach( $custom_icons as $custom_icon ) {
			$custom_icon = explode('|', $custom_icon);
			$custom_icon_style_url = $upload_dir['baseurl'] .'/nt_custom_icon/'. $custom_icon[2].'/css/'.$custom_icon[1].'.css';
			wp_enqueue_style( 'nt-icon-'.$custom_icon[2], $custom_icon_style_url, true, THEME_VERSION );
		}
	}

	// Admin Style
	wp_enqueue_style('nt-theme-admin-style', THEME_FRAMEWORK_ASSETS_URI . '/css/style.css', false, THEME_VERSION);
	wp_enqueue_style( 'nt-custom-vc', THEME_FRAMEWORK_ASSETS_URI . '/css/custom-vc.less', false, THEME_VERSION );
}
