<?php
if(function_exists('vc_set_as_theme')) {

	// Property
	$property_status = array();
	$p_status = get_terms('status', 'hide_empty=false');
		if(is_array($p_status)) {
		foreach ($p_status as $ps) {
		  $property_status[$ps->name] = $ps->term_id;
		}
	}
	$property_type = array();
	$p_type = get_terms('type', 'hide_empty=false');
		if(is_array($p_type)) {
		foreach ($p_type as $pt) {
		  $property_type[$pt->name] = $pt->term_id;
		}
	}
	$property_location = array();
	$p_location = get_terms('location', 'hide_empty=false');
		if(is_array($p_location)) {
		foreach ($p_location as $pl) {
		  $property_location[$pl->name] = $pl->term_id;
		}
	}
	  class WPBakeryShortCode_VC_Property extends WPBakeryShortCode {}
	  vc_map( array(
	     "name" => __("Property", 'theme_admin'),
	     "base" => "vc_property",
	     "description" => __('Property Listing', 'theme_admin'),
	     "class" => "",
	     "category" => 'Content',
	     // "js_view" => 'VcFeatureView',
	     "icon" => 'icon-wpb-application-icon-large',
	     "params" => array(
	         array(
	           "type" => "checkbox",
	           "class" => "",
	           "heading" => __("Filter Location", 'theme_admin'),
	           "param_name" => "location_in",
	           "value" => $property_location,
	           "description" => __('select status to be shown, choose none to show all', 'theme_admin')
	        ),
	          array(
	           "type" => "checkbox",
	           "class" => "",
	           "heading" => __("Filter Type", 'theme_admin'),
	           "param_name" => "type_in",
	           "value" => $property_type,
	           "description" => __('select status to be shown, choose none to show all', 'theme_admin')
	        ),
	        array(
	           "type" => "checkbox",
	           "class" => "",
	           "heading" => __("Filter Status", 'theme_admin'),
	           "param_name" => "status_in",
	           "value" => $property_status,
	           "description" => __('select status to be shown, choose none to show all', 'theme_admin')
	        ),
	        array(
	           "type" => "checkbox",
	           "class" => "",
	           "heading" => __("Show Sort", 'theme_admin'),
	           "param_name" => "sort",
	           "value" => array(__('show sort dropdown box' , 'theme_admin')=> true),
	           "description" => ''
	        ),
	        array(
	           "type" => "checkbox",
	           "class" => "",
	           "heading" => __("Featured", 'theme_admin'),
	           "param_name" => "featured",
	           "value" => array(__('show only featured property', 'theme_admin') => true),
	           "description" => ''
	        ),
	        array(
	           "type" => "checkbox",
	           "class" => "",
	           "heading" => __("Random", 'theme_admin'),
	           "param_name" => "random",
	           "value" => array(__('random order', 'theme_admin') => true),
	           "description" => ''
	        ),
	        array(
	           "type" => "textfield",
	           "class" => "",
	           "heading" => __("Post Limit", 'theme_admin'),
	           "param_name" => "limit",
	           "value" => "",
	           "description" => __('leave blank or set to 0 for unlimit post quantity', 'theme_admin')
	        ),
	        array(
	          "type" => "dropdown",
	          "holder" => "div",
	          "heading" => __('Style', 'theme_admin'),
	          "param_name" => "style",
	          "value" => array(
	                        __("Grid", 'theme_admin') => 'grid',
	                        __("Carousel", 'theme_admin') => 'carousel',
	                      ),
	        ),
	        array(
	           "type" => "textfield",
	           "class" => "",
	           "heading" => __("Interval", 'theme_admin'),
	           "param_name" => "interval",
	           'dependency'  => array('element' => 'style', 'value' => array('carousel')),
	           "value" => "",
	           "description" => __('slide interval in milliseconds (leave blank to disable auto rotate)', 'theme_admin')
	        ),
	        array(
	           "type" => "dropdown",
	           "class" => "",
	           "heading" => __("Items", 'theme_admin'),
	           "param_name" => "items",
	           "value" => array(
	                        "3" => '3',
	                        "2" => '2',
	                        "1" => '1',
	                      ),
	           "description" => __('number of item displayed per row', 'theme_admin')
	        ),

	     )
	  ) );
		$el_class_attributes =array(
	    'type' => 'textfield',
	    'heading' => __('Extra class name', 'theme_admin'),
	    'param_name' => 'el_class',
	    'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'theme_admin')
	  );
	  vc_add_param('vc_property', $el_class_attributes);

	  // Person
	  $posts = get_posts(array('post_type'=>'agent', 'posts_per_page'=>-1, 'suppress_filters'=>false));
	  // var_dump($posts);
		$agents = array();
	  if(is_array($posts)) {
		  foreach($posts as $post) {
		    $agents[$post->post_title] = $post->ID;
		  }
	  }
	  class WPBakeryShortCode_VC_Agent extends WPBakeryShortCode {}
	  vc_map( array(
	     "name" => __("Agent", 'theme_admin'),
	     "base" => "vc_agent",
	     "description" => __('Agent Listing', 'theme_admin'),
	     "class" => "",
	     "category" => 'Content',
	     // "js_view" => 'VcFeatureView',
	     "icon" => 'icon-wpb-application-icon-large',
	     "params" => array(
	        array(
	           "type" => "checkbox",
	           "class" => "",
	           "heading" => __("Filter Agent", 'theme_admin'),
	           "param_name" => "post_in",
	           "value" => $agents,
	           "description" => __('select post to be shown, choose none to show all', 'theme_admin')
	        ),
	        array(
	           "type" => "textfield",
	           "class" => "",
	           "heading" => __("Post Limit", 'theme_admin'),
	           "param_name" => "limit",
	           "value" => "",
	           "description" => __('leave blank or set to 0 for unlimit post quantity', 'theme_admin')
	        ),
	        array(
	          "type" => "dropdown",
	          "holder" => "div",
	          "heading" => __('Style', 'theme_admin'),
	          "param_name" => "style",
	          "value" => array(
	                        __("Grid", 'theme_admin') => 'grid',
	                        __("Carousel", 'theme_admin') => 'carousel',
	                      ),
	        ),
	        array(
	           "type" => "textfield",
	           "class" => "",
	           "heading" => __("Interval", 'theme_admin'),
	           "param_name" => "interval",
	           'dependency'  => array('element' => 'style', 'value' => array('carousel')),
	           "value" => "",
	           "description" => __('slide interval in milliseconds (leave blank to disable auto rotate)', 'theme_admin')
	        ),
	        array(
	           "type" => "dropdown",
	           "class" => "",
	           "heading" => __("Items", 'theme_admin'),
	           "param_name" => "items",
	           "value" => array(
	                        "1" => '1',
	                        "2" => '2',
	                        "3" => '3',
	                        "4" => '4',
	                      ),
	           "description" => __('number of item displayed per row', 'theme_admin')
	        ),

	     )
	  ) );
		$el_class_attributes =array(
	    'type' => 'textfield',
	    'heading' => __('Extra class name', 'theme_admin'),
	    'param_name' => 'el_class',
	    'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'theme_admin')
	  );
	  vc_add_param('vc_agent', $el_class_attributes);

}
