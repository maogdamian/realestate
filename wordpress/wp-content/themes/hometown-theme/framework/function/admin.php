<?php

class NT_admin {

	var $theme;

	function init( $theme ) {

		$this->theme = $theme;

		// Add admin functions
		$this->functions();

		// Add Admin Menu
		add_action('admin_menu', array(&$this,'add_option_menu') );

		// Add custom post types
		$this->theme_types();

		// Add custom metas
		$this->theme_metas();


	}

	// Admin functions
	function functions() {
		locate_template( THEME_FUNCTIONS_DIR . '/admin-enque.php', true);
		locate_template( THEME_FUNCTIONS_DIR . '/input-tool.php', true );
		locate_template( THEME_FUNCTIONS_DIR . '/meta-tool.php', true );
		locate_template( THEME_FUNCTIONS_DIR . '/admin-ajax.php', true );
	}

	// Theme options menu
	function add_option_menu() {
		// Add theme options under Appearrence
		add_theme_page( __('Theme Options', 'theme_admin'), __('Theme Options', 'theme_admin'), 'edit_theme_options', 'theme_options', array(&$this, 'option_page') );
	}

	function option_page() {
		// Setting page
		$sections = $this->theme->options;
		$option_template = locate_template( THEME_FUNCTIONS_DIR.'/admin-options-template.php');
		include($option_template);
	}



	// Custom Post Types
	function theme_types() {
		do_action('lt_cpt_admin_init');
	}

	// Custom Meta
	function theme_metas() {
		foreach (new DirectoryIterator(THEME_DIR.THEME_METAS_DIR) as $file){
		    if($file->isDot()) continue;

		    if(pathinfo($file->getFilename(), PATHINFO_EXTENSION) != 'php') continue;

		    $register_file = THEME_METAS_DIR.'/'.$file->getFilename();
		    locate_template( $register_file, true );
		}
	}

}
?>
