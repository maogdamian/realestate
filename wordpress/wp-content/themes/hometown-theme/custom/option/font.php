<?php 
	
	// Option
	$options = array(
		
		array(
			'title' 	=> __('General', 'theme_admin'),
			'options' 	=> array(
				
				array(
					'type' 			=> 'select',
					'id' 			=> 'general_family',
					'title' 		=> __('Font Family', 'theme_admin'),
					'description' 	=> __('site wide font family', 'theme_admin'),
					'default' 		=> 'Arial,Helvetica,Garuda,sans-serif',
					'options' 		=> array(
						"'Arial Black',Gadget,sans-serif"
						=> '"Arial Black",Gadget,sans-serif',
						'Arial,Helvetica,Garuda,sans-serif' 		
						=> 'Arial,Helvetica,Garuda,sans-serif',
						'Verdana,Geneva,Kalimati,sans-serif' 
						=> 'Verdana,Geneva,Kalimati,sans-serif',
						"'Lucida Sans Unicode','Lucida Grande',Garuda,sans-serif" 
						=> '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"'Lucida Sans Unicode','Lucida Grande',Garuda,sans-serif" 
						=> '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
						"Georgia,'Nimbus Roman No9 L',serif" 
						=> 'Georgia,"Nimbus Roman No9 L",serif',
						"'Palatino Linotype','Book Antiqua',Palatino,FreeSerif,serif" 
						=> '"Palatino Linotype","Book Antiqua",Palatino,FreeSerif,serif',
						'Tahoma,Geneva,Kalimati,sans-serif' 
						=> 'Tahoma,Geneva,Kalimati,sans-serif',
						"'Trebuchet MS',Helvetica,Jamrul,sans-serif" 
						=> '"Trebuchet MS",Helvetica,Jamrul,sans-serif',
						"'Times New Roman',Times,FreeSerif,serif" 
						=> '"Times New Roman",Times,FreeSerif,serif'
					)
				),

				array(
					'type' 			=> 'select',
					'id' 			=> 'google_web_font',
					'title' 		=> __('Google Web Font Family', 'theme_admin'),
					'description' 	=> __('<a href="http://www.google.com/fonts/" target="_blank">Google Web Font</a><br />internet connection required', 'theme_admin'),
					'default' 		=> 'Raleway',
					'source'		=> array(
						'gfonts' 	=> ''
					)
				),
				array(
					'type' 			=> 'select',
					'id' 			=> 'apply_google_web_font',
					'title' 		=> __('Apply Google Web Font', 'theme_admin'),
					'description' 	=> '',
					'default' 		=> 'all',
					'options'		=> array(
						'all' => __('All', 'theme_admin'),
						'heading' => __('Only Heading', 'theme_admin')
					)
				),
				
				array(
					'type' 			=> 'range',
					'id' 			=> 'general_font_size',
					'title' 		=> __('Font Size', 'theme_admin'),
					'description' 	=> __('site wide font size, heading text size will relative to this value', 'theme_admin'),
					'unit' 			=> 'px',
					'default' 		=> '14',
					'min' 			=> '13',
					'max' 			=> '18',
					'step' 			=> '1'
				),
				array(
					'type' 			=> 'range',
					'id' 			=> 'nav_font_size',
					'title' 		=> __('Menu Font Size', 'theme_admin'),
					'description' 	=> __('font size of primary menu', 'theme_admin'),
					'unit' 			=> 'px',
					'default' 		=> '14',
					'min' 			=> '13',
					'max' 			=> '18',
					'step' 			=> '1'
				),
						
			)
		),
		
		// Heading
		// array(
		// 	'title' 	=> 'Heading',
		// 	'options' 	=> array(
				
		// 		array(
		// 			'type' 			=> 'range',
		// 			'id' 			=> 'h1_font_size',
		// 			'title' 		=> 'H1 font size',
		// 			'description' 	=> 'font size of h1 tag',
		// 			'unit' 			=> 'px',
		// 			'default' 		=> '32',
		// 			'min' 			=> '14',
		// 			'max' 			=> '32',
		// 			'step' 			=> '1'
		// 		),
		// 		array(
		// 			'type' 			=> 'range',
		// 			'id' 			=> 'h2_font_size',
		// 			'title' 		=> 'H2 font size',
		// 			'description' 	=> 'font size of h2 tag',
		// 			'unit' 			=> 'px',
		// 			'default' 		=> '28',
		// 			'min' 			=> '14',
		// 			'max' 			=> '32',
		// 			'step' 			=> '1'
		// 		),
		// 		array(
		// 			'type' 			=> 'range',
		// 			'id' 			=> 'h3_font_size',
		// 			'title' 		=> 'H3 font size',
		// 			'description' 	=> 'font size of h3 tag',
		// 			'unit' 			=> 'px',
		// 			'default' 		=> '26',
		// 			'min' 			=> '14',
		// 			'max' 			=> '32',
		// 			'step' 			=> '1'
		// 		),
		// 		array(
		// 			'type' 			=> 'range',
		// 			'id' 			=> 'h4_font_size',
		// 			'title' 		=> 'H4 font size',
		// 			'description' 	=> 'font size of h4 tag',
		// 			'unit' 			=> 'px',
		// 			'default' 		=> '24',
		// 			'min' 			=> '14',
		// 			'max' 			=> '32',
		// 			'step' 			=> '1'
		// 		),
		// 		array(
		// 			'type' 			=> 'range',
		// 			'id' 			=> 'h5_font_size',
		// 			'title' 		=> 'H5 font size',
		// 			'description' 	=> 'font size of h5 tag',
		// 			'unit' 			=> 'px',
		// 			'default' 		=> '20',
		// 			'min' 			=> '14',
		// 			'max' 			=> '32',
		// 			'step' 			=> '1'
		// 		),
		// 		array(
		// 			'type' 			=> 'range',
		// 			'id' 			=> 'h6_font_size',
		// 			'title' 		=> 'H6 font size',
		// 			'description' 	=> 'font size of h6 tag',
		// 			'unit' 			=> 'px',
		// 			'default' 		=> '16',
		// 			'min' 			=> '14',
		// 			'max' 			=> '32',
		// 			'step' 			=> '1'
		// 		),
				
		// 	)
		// ),
		
	);
	
	$config = array(
		'title' 	=> __('Font', 'theme_admin'),
		'group_id' 	=> 'font',
	);
	
	
return array( 'options' => $options, 'config' => $config );

?>