<?php

if(function_exists('vc_set_as_theme')) {

  include('param-icon.php');

  vc_set_as_theme(true);
  vc_set_default_editor_post_types(array('page'));
  vc_disable_frontend();

  $dir = get_template_directory() . '/vc-template/';
  vc_set_shortcodes_templates_dir($dir);

  vc_remove_element("vc_button2");
  vc_remove_element("vc_cta_button");
  vc_remove_element("vc_cta_button2");
  vc_remove_element("vc_pie");
  vc_remove_element("vc_progress_bar");
  vc_remove_element("vc_flickr");
  vc_remove_element("vc_wp_search");
  vc_remove_element("vc_wp_meta");
  vc_remove_element("vc_wp_recentcomments");
  vc_remove_element("vc_wp_calendar");
  vc_remove_element("vc_wp_pages");
  vc_remove_element("vc_wp_tagcloud");
  vc_remove_element("vc_wp_custommenu");
  vc_remove_element("vc_wp_text");
  vc_remove_element("vc_wp_posts");
  vc_remove_element("vc_wp_links");
  vc_remove_element("vc_wp_categories");
  vc_remove_element("vc_wp_archives");
  vc_remove_element("vc_wp_rss");
  vc_remove_element("vc_facebook");
  vc_remove_element("vc_tweetmeme");
  vc_remove_element("vc_googleplus");
  vc_remove_element("vc_pinterest");
  vc_remove_element("vc_message");
  vc_remove_element("vc_tour");
  vc_remove_element("vc_posts_slider");
  vc_remove_element("vc_posts_grid");
  vc_remove_element("vc_carousel");

  vc_remove_element("vc_icon");
  vc_remove_element("vc_media_grid");
  vc_remove_element("vc_masonry_media_grid");
  vc_remove_element("vc_basic_grid");
  vc_remove_element("vc_masonry_grid");

  vc_remove_element("vc_cta");

  // De-register post grid
  function nt_custom_unregister_theme_post_types() {
      global $wp_post_types;
      foreach( array( 'vc_grid_item' ) as $post_type ) {
          if ( isset( $wp_post_types[ $post_type ] ) ) {
              unset( $wp_post_types[ $post_type ] );
          }
      }
  }
  add_action( 'init', 'nt_custom_unregister_theme_post_types', 20 );

  // Custom Row Class
  add_filter('vc_shortcodes_css_class', 'custom_css_classes_for_vc_row_and_vc_column', 10, 2);
  function custom_css_classes_for_vc_row_and_vc_column($class_string, $tag) {
    if ($tag=='vc_row' || $tag=='vc_row_inner') {
      // $class_string = str_replace('vc_row-fluid', '', $class_string);
      // $class_string = str_replace('vc_row', '', $class_string);
      // $class_string = str_replace('wpb_row', '', $class_string);
    }
    if ($tag=='vc_column' || $tag=='vc_column_inner') {
      // $class_string = str_replace('wpb_column', '', $class_string);
      // $class_string = str_replace('column_container', '', $class_string);
      $class_string = preg_replace('/vc_col-sm-(\d{1,2})/', 'vc_col-sm-$1 large-$1 columns', $class_string);
      $class_string = preg_replace('/vc_col-md-(\d{1,2})/', 'vc_col-md-$1 medium-$1 columns', $class_string);
      $class_string = preg_replace('/vc_col-lg-(\d{1,2})/', 'vc_col-lg-$1 large-$1 columns', $class_string);
    }
    $class_string = trim($class_string);
    return $class_string;
  }

  // Un-Register Style & JS
  add_action( 'wp_enqueue_scripts', 'lt_unregister_js_composer_style_js' );
  function lt_unregister_js_composer_style_js() {
      wp_deregister_style('js_composer_front');
      wp_deregister_style('js_composer_custom_css');
      wp_deregister_script('wpb_composer_front_js');
  }

  // Standard Param
  $animate_attributes = array(
    'type' => 'dropdown',
    'heading' => __("Animation", 'theme_admin'),
    'param_name' => 'animate',
    'description' => "",
    "value" => Array(
      __("None", 'theme_admin') => '',
      __("Fade", 'theme_admin') => 's-fade',
      __("Short from Left", 'theme_admin') => 's-left',
      __("Short from Right", 'theme_admin') => 's-right',
      __("Short from Top", 'theme_admin') => 's-top',
      __("Short from Bottom", 'theme_admin') => 's-bottom',
    )
  );
  $el_class_attributes =array(
    'type' => 'textfield',
    'heading' => __('Extra class name', 'theme_admin'),
    'param_name' => 'el_class',
    'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'theme_admin')
  );

  // Column inner
  $col_attributes = array(
      'type' => 'column_offset',
      'heading' => __( 'Responsiveness', 'theme_admin' ),
      'param_name' => 'offset',
      'group' => __( 'Width & Responsiveness', 'theme_admin' ),
      'description' => __( 'Adjust column for different screen sizes. Control width, offset and visibility settings.', 'theme_admin')
    );
  vc_add_param('vc_column_inner', $col_attributes);

  // Carousel
  vc_remove_param('vc_images_carousel', 'title');
  // vc_remove_param('vc_images_carousel', 'img_size');

  vc_remove_param('vc_images_carousel', 'onclick');
  vc_remove_param('vc_images_carousel', 'custom_links');
  vc_remove_param('vc_images_carousel', 'custom_links_target');

  vc_remove_param('vc_images_carousel', 'mode');
  vc_remove_param('vc_images_carousel', 'speed');
  vc_remove_param('vc_images_carousel', 'slides_per_view');
  vc_remove_param('vc_images_carousel', 'autoplay');
  vc_remove_param('vc_images_carousel', 'hide_pagination_control');
  vc_remove_param('vc_images_carousel', 'hide_prev_next_buttons');
  vc_remove_param('vc_images_carousel', 'partial_view');
  vc_remove_param('vc_images_carousel', 'wrap');
  vc_remove_param('vc_images_carousel', 'el_class');

  $col_attributes = array(
       "type" => "checkbox",
       "class" => "",
       "heading" => "",
       "param_name" => "nav",
       "value" => array(__('Show navigation', 'theme_admin')=>'true'),
       "description" => ''
  );
  vc_add_param('vc_images_carousel', $col_attributes);
  $col_attributes = array(
      'type' => 'dropdown',
      'heading' => __('On click', 'theme_admin'),
      'param_name' => 'on_click',
      'description' => '',
      'default' => '',
      'value' => Array(__('Do nothing', 'theme_admin') => '', __('Open Lightbox', 'theme_admin') => 'lightbox', __('Custom URL', 'theme_admin') => 'custom_url')
    );
  vc_add_param('vc_images_carousel', $col_attributes);
  $col_attributes = array(
     "type" => "exploded_textarea",
     "class" => "",
     "heading" => __("Custom URL", 'theme_admin'),
     "param_name" => "custom_url",
     'dependency'  => array('element' => 'on_click', 'value' => array('custom_url')),
     "value" => "",
     "description" => __('Enter links for each slide (Note: divide links with linebreaks (Enter)).', 'theme_admin')
  );
  vc_add_param('vc_images_carousel', $col_attributes);
  $col_attributes = array(
      'type' => 'dropdown',
      'heading' => __('Style', 'theme_admin'),
      'param_name' => 'style',
      'description' => '',
      'default' => '',
      'value' => Array(__('None', 'theme_admin') => '', __('Light Border', 'theme_admin') => 'l-border', __('Drop Shadow', 'theme_admin') => 'shadow')
    );
  vc_add_param('vc_images_carousel', $col_attributes);
  $col_attributes = array(
    'type' => 'textfield',
    'heading' => __("Slider speed", 'theme_admin'),
    'param_name' => 'speed',
    'description' => __("set to 0 to disable autoplay", 'theme_admin'),
    "value" => '5000'
  );
  vc_add_param('vc_images_carousel', $col_attributes);
  $col_attributes = array(
    'type' => 'textfield',
    'heading' => __("Items", 'theme_admin'),
    'param_name' => 'items',
    'description' => __("number of items displayed at a time", 'theme_admin'),
    "value" => '5'
  );
  vc_add_param('vc_images_carousel', $col_attributes);
  $col_attributes = array(
    'type' => 'textfield',
    'heading' => __("Margin", 'theme_admin'),
    'param_name' => 'margin',
    'description' => __("margin between item in px unit", 'theme_admin'),
    "value" => '20'
  );
  vc_add_param('vc_images_carousel', $col_attributes);
  vc_add_param('vc_images_carousel', $el_class_attributes);

  // Button
  if(version_compare(WPB_VC_VERSION, '4.5.3') >= 0) {
    vc_remove_param('vc_btn', 'color');
    vc_remove_param('vc_btn', 'icon');
    vc_remove_param('vc_btn', 'size');
    vc_remove_param('vc_btn', 'style');
    vc_remove_param('vc_btn', 'shape');
    vc_remove_param('vc_btn', 'add_icon');
    vc_remove_param('vc_btn', 'i_align');
    vc_remove_param('vc_btn', 'button_block');
    vc_remove_param('vc_btn', 'align');
    vc_remove_param('vc_btn', 'i_type');
    vc_remove_param('vc_btn', 'i_icon_fontawesome');
    vc_remove_param('vc_btn', 'i_icon_openiconic');
    vc_remove_param('vc_btn', 'i_icon_typicons');
    vc_remove_param('vc_btn', 'i_icon_entypo');
    vc_remove_param('vc_btn', 'i_icon_linecons');
    vc_remove_param('vc_btn', 'i_icon_pixelicons');
    vc_remove_param('vc_btn', 'custom_background');
    vc_remove_param('vc_btn', 'custom_text');
    vc_remove_param('vc_btn', 'el_class');
  }


  vc_remove_param('vc_button', 'color');
  vc_remove_param('vc_button', 'icon');
  vc_remove_param('vc_button', 'size');
  vc_remove_param('vc_button', 'style');
  vc_remove_param('vc_button', 'shape');
  vc_remove_param('vc_button', 'add_icon');
  vc_remove_param('vc_button', 'i_align');
  vc_remove_param('vc_button', 'button_block');
  vc_remove_param('vc_button', 'align');
  vc_remove_param('vc_button', 'i_type');
  vc_remove_param('vc_button', 'i_icon_fontawesome');
  vc_remove_param('vc_button', 'i_icon_openiconic');
  vc_remove_param('vc_button', 'i_icon_typicons');
  vc_remove_param('vc_button', 'i_icon_entypo');
  vc_remove_param('vc_button', 'i_icon_linecons');
  vc_remove_param('vc_button', 'i_icon_pixelicons');
  vc_remove_param('vc_button', 'el_class');

  $params = array(
    array(
      'type' => 'nt_icon',
      'heading' => __('Icon', 'theme_admin'),
      'param_name' => 'icon',
      'description' => '',
      'default' => '',
    ),
    array(
      'type' => 'dropdown',
      'heading' => __('Icon Position', 'theme_admin'),
      'param_name' => 'icon_position',
      'description' => '',
      'default' => 'left',
      'value' => Array(__('Left', 'theme_admin') => 'left', __('Right', 'theme_admin') => 'right')
    ),
    // array(
    //   'type' => 'dropdown',
    //   'heading' => 'Style',
    //   'param_name' => 'style',
    //   'description' => '',
    //   'default' => 'primary',
    //   'value' => Array('Primary' => 'primary', 'Secondary' => 'secondary')
    // ),
    array(
      'type' => 'colorpicker',
      'heading' => __('Color', 'theme_admin'),
      'param_name' => 'color',
      'description' => '',
      'default' => '',
      'value' => ''
    ),
    array(
      'type' => 'dropdown',
      'heading' => __('Alignment', 'theme_admin'),
      'param_name' => 'align',
      'description' => '',
      'default' => 'left',
      'value' => Array(__('Left', 'theme_admin') => 'left', __('Center', 'theme_admin') => 'center', __('Right', 'theme_admin') => 'right')
    ),
    array(
      'type' => 'dropdown',
      'heading' => __('Size', 'theme_admin'),
      'param_name' => 'size',
      'description' => '',
      'default' => 'regular',
      'value' => Array(__('Regular', 'theme_admin') => 'regular', __('Large', 'theme_admin') => 'large', __('Small', 'theme_admin') => 'small')
    ),

  );
  vc_add_params('vc_button', $params);
  vc_add_param('vc_button', $el_class_attributes);
  vc_add_params('vc_btn', $params);
  vc_add_param('vc_btn', $el_class_attributes);

  // Text Separator
  vc_remove_param('vc_text_separator', 'color');
  vc_remove_param('vc_text_separator', 'accent_color');
  vc_remove_param('vc_text_separator', 'style');
  vc_remove_param('vc_text_separator', 'border_width');
  vc_remove_param('vc_text_separator', 'el_width');
  vc_remove_param('vc_text_separator', 'el_class');
  vc_remove_param('vc_text_separator', 'align');
  $params = array(

    array(
      "type" => "textfield",
      "heading" => __("Sub Title", 'theme_admin'),
      "param_name" => "sub_title",
      "value" => '',
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Sub Title Position", 'theme_admin'),
      "param_name" => "sub_title_position",
      'value' => Array(__('After Title', 'theme_admin') => 'after', __('Before Title', 'theme_admin') => 'before')
    ),
    array(
       "type" => "checkbox",
       "class" => "",
       "heading" => "",
       "param_name" => "border",
       "value" => array(__('Disable Separator Line', 'theme_admin')=>'false'),
       "description" => ''
    ),

  );
  vc_add_params('vc_text_separator', $params);
  vc_add_param('vc_text_separator', $el_class_attributes);

  // Tabs
  vc_remove_param('vc_tabs', 'title');
  vc_remove_param('vc_tabs', 'interval');

  // Accordion
  vc_remove_param('vc_accordion', 'title');

  // Row
  vc_remove_param('vc_row', 'font_color');
  $params = array(
    array(
      "type" => "dropdown",
      "heading" => __('Element Color', 'theme_admin'),
      "param_name" => "element_color",
      "value" => array(
                        __("Dark (for light BG)", 'theme_admin') => '',
                        __("Light (for dark BG)", 'theme_admin') => 'light'
                      ),
    ),
  );
  vc_add_params('vc_row', $params);

  // Image
  vc_remove_param('vc_single_image', 'style');
  vc_remove_param('vc_single_image', 'el_class');
  $params = array(
    array(
      "type" => "dropdown",
      "heading" => __('Style', 'theme_admin'),
      "param_name" => "style",
      "value" => array(
                        __("None", 'theme_admin') => '',
                        __("Round", 'theme_admin') => 'round',
                        __("Circle", 'theme_admin') => 'circle',
                        __("Drop Shadow", 'theme_admin') => 'shadow'
                      ),
    ),
  );
  vc_add_params('vc_single_image', $params);
  vc_add_param('vc_single_image', $el_class_attributes);

  // Gallery
  vc_remove_param('vc_gallery', 'el_class');
  vc_remove_param('vc_gallery', 'title');
  vc_remove_param('vc_gallery', 'type');
  vc_remove_param('vc_gallery', 'interval');
  $params = array(
    array(
      "type" => "textfield",
      "heading" => __('Interval', 'theme_admin'),
      "param_name" => "interval",
      "value" => '',
      "description"  => __('slide interval in milliseconds (leave blank to disable auto rotate)', 'theme_admin')
    ),
  );
  vc_add_params('vc_gallery', $params);
  vc_add_param('vc_gallery', $el_class_attributes);






  // Post
  $post_category = array();
  $category = get_terms('category', array('hide_empty' => false));
  if(is_array($category)) {
    foreach ($category as $c) {
      $post_category[$c->name] = $c->term_id;
    }
  }
  class WPBakeryShortCode_VC_Post extends WPBakeryShortCode {}
  vc_map( array(
     "name" => __("Post", 'theme_admin'),
     "base" => "vc_post",
     "description" => __('Post Listing', 'theme_admin'),
     "class" => "",
     "category" => 'Content',
     "icon" => 'icon-wpb-application-icon-large',
     "params" => array(
        array(
             "type" => "checkbox",
             "class" => "",
             "heading" => __("Filter Category", 'theme_admin'),
             "param_name" => "category_in",
             "value" => $post_category,
             "description" => __('select category to be shown, choose none to show all', 'theme_admin')
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
           "type" => "checkbox",
           "class" => "",
           "heading" => "",
           "param_name" => "show_excerpt",
           "value" => array(__('Show Excerpt', 'theme_admin')=>'true'),
           "description" => ''
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
           "default" => '',
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
  vc_add_param('vc_post', $el_class_attributes);

  // Icon Box
  class WPBakeryShortCode_VC_Icon_Box extends WPBakeryShortCode {}
  vc_map( array(
     "name" => __("Icon Box", 'theme_admin'),
     "description" => __('Icon Box', 'theme_admin'),
     "base" => "vc_icon_box",
     "class" => "",
     "category" => 'Content',
     "icon" => 'icon-wpb-vc_carousel',
     "params" => array(
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Title", 'theme_admin'),
           "param_name" => "title",
           "value" => "Title",
           "description" => ''
        ),
        array(
           "type" => "textarea",
           "class" => "",
           "heading" => __("Content", 'theme_admin'),
           "param_name" => "content",
           "value" => '',
           "description" => ''
        ),
        array(
          "type" => "dropdown",
          "heading" => __('Style', 'theme_admin'),
          "param_name" => "style",
          "value" => array(
                        "Icon Top" => 'icon-top',
                        "Icon Left" => 'icon-left',
                        "Icon Right" => 'icon-right',
                      ),
        ),
        array(
           "type" => "nt_icon",
           "class" => "",
           "heading" => __("Icon", 'theme_admin'),
           "param_name" => "icon",
           "value" => '',
           "description" => ''
        ),
        array(
           "type" => "colorpicker",
           "class" => "",
           "heading" => __("Icon Color", 'theme_admin'),
           "param_name" => "icon_color",
           "value" => '',
           "description" => __('leave blank to use theme accent color', 'theme_admin')
        ),
        array(
           "type" => "textfield",
           "class" => "",
           "heading" => __("Button Text", 'theme_admin'),
           "param_name" => "button_text",
           "value" => "",
           "description" => ''
        ),
        array(
           "type" => "vc_link",
           "class" => "",
           "heading" => __("Button Link", 'theme_admin'),
           "param_name" => "button_link",
           "value" => "",
           "description" => ''
        ),
     )
  ) );

  // Teaser Box
  class WPBakeryShortCode_VC_Teaser_Box extends WPBakeryShortCode {}
  vc_map( array(
     "name" => __("Teaser Box", 'theme_admin'),
     "description" => __('Teaser Box', 'theme_admin'),
     "base" => "vc_teaser_box",
     "class" => "",
     "category" => 'Content',
     "icon" => 'icon-wpb-vc_carousel',
     "params" => array(
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Title", 'theme_admin'),
           "param_name" => "title",
           "value" => "Title",
           "description" => ''
        ),
        array(
           "type" => "textarea",
           "class" => "",
           "heading" => __("Content", 'theme_admin'),
           "param_name" => "content",
           "value" => '',
           "description" => ''
        ),
        array(
           "type" => "attach_image",
           "class" => "",
           "heading" => __("Image", 'theme_admin'),
           "param_name" => "image",
           "value" => '',
           "description" => '',
        ),
        array(
           "type" => "textfield",
           "class" => "",
           "heading" => __("Button Text", 'theme_admin'),
           "param_name" => "button_text",
           "value" => "",
           "description" => ''
        ),
        array(
           "type" => "vc_link",
           "class" => "",
           "heading" => __("Button Link", 'theme_admin'),
           "param_name" => "button_link",
           "value" => "",
           "description" => ''
        ),
     )
  ) );

  // Running
  class WPBakeryShortCode_VC_Stat extends WPBakeryShortCode {}
  vc_map( array(
     "name" => __("Running Stat", 'theme_admin'),
     "description" => __('Running Stat', 'theme_admin'),
     "base" => "vc_stat",
     "icon" => "icon-wpb-vc_carousel",
     "category" => 'Content',
     "params" => array(
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Title", 'theme_admin'),
           "param_name" => "title",
           "value" => "title"
        ),
        array(
           "type" => "textfield",
           "class" => "",
           "heading" => __("Number", 'theme_admin'),
           "param_name" => "number",
           "value" => "100"
        ),
        array(
           "type" => "textfield",
           "class" => "",
           "heading" => __("Unit", 'theme_admin'),
           "param_name" => "unit",
           "value" => ''
        ),
        array(
           "type" => "nt_icon",
           "class" => "",
           "heading" => __("Icon", 'theme_admin'),
           "param_name" => "icon",
           "value" => '',
           "description" => ''
        ),

     )
  ) );

  // Twitter
  class WPBakeryShortCode_NT_Twitter extends WPBakeryShortCode {}
  vc_map( array(
     "name" => __("Twitter", 'theme_admin'),
     "description" => __('Twitter Feed Box', 'theme_admin'),
     "base" => "vc_twitter",
     "icon" => "icon-wpb-tweetme",
     "category" => 'Content',
     "params" => array(
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("Twitter Account", 'theme_admin'),
           "param_name" => "account",
           "value" => "twitter",
           "description" => ""
        )
     )
  ) );

  // Testimonial
  if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
      class WPBakeryShortCode_VC_Testimonial extends WPBakeryShortCodesContainer {
      }
  }
  vc_map( array(
      "name" => __("Testimonial Container", 'theme_admin'),
      "base" => "vc_testimonial",
      "as_parent" => array('only' => 'vc_testimonial_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
      "content_element" => true,
      'icon' => 'icon-wpb-atm',
      "show_settings_on_create" => false,
      "params" => array(
        // add params same as with any other content element
        array(
          "type" => "textfield",
          "heading" => __('Interval', 'theme_admin'),
          "param_name" => "interval",
          "value" => '',
          "description"  => __('slide interval in milliseconds (leave blank to disable auto rotate)', 'theme_admin')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", 'theme_admin'),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'theme_admin')
        )
      ),
      "js_view" => 'VcColumnView',
  ) );
  class WPBakeryShortCode_VC_Testimonial_Item extends WPBakeryShortCode {}
  vc_map( array(
      "name" => __("Testimonial Item", 'theme_admin'),
      "base" => "vc_testimonial_item",
      "content_element" => true,
      'icon' => 'icon-wpb-atm',
      "as_child" => array('only' => 'vc_testimonial'), // Use only|except attributes to limit parent (separate multiple values with comma)
      // "js_view" => 'VcIconListView',
      "params" => array(
          // add params same as with any other content element
          array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("Name", 'theme_admin'),
            "param_name" => "name",
            "description" => ''
          ),
          array(
            "type" => "textfield",
            // "holder" => "div",
            "heading" => __("Meta", 'theme_admin'),
            "param_name" => "meta",
            "description" => __("job position, organization, etc.", 'theme_admin')
          ),
          array(
            "type" => "dropdown",
            // "holder" => "div",
            "heading" => __("Rating", 'theme_admin'),
            "param_name" => "rating",
            "description" => "0-5",
            "value" => array(
              "5" => '5',
              "4" => '4',
              "3" => '3',
              "2" => '2',
              "1" => '1',
              "0" => '0',
              ),
          ),
          array(
            "type" => "textarea",
            "heading" => __("Quote", 'theme_admin'),
            "param_name" => "quote",
            "description" => ""
          ),
      ),
  ) );

  // Icon List
  if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
      class WPBakeryShortCode_VC_Icon_List extends WPBakeryShortCodesContainer {
      }
  }
  vc_map( array(
      "name" => __("Icon List Container", 'theme_admin'),
      "base" => "vc_icon_list",
      "as_parent" => array('only' => 'vc_icon_list_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
      "content_element" => true,
      'icon' => 'icon-wpb-atm',
      "show_settings_on_create" => false,
      "params" => array(
          // add params same as with any other content element
        array(
          "type" => "dropdown",
          "heading" => __('Style', 'theme_admin'),
          "param_name" => "style",
          "default" => 'small',
          "value" => array(
                            __("Small", 'theme_admin') => 'small',
                            __("Big", 'theme_admin') => 'big',
                          ),
        ),
        array(
          "type" => "dropdown",
          "heading" => __('Icon Position', 'theme_admin'),
          "param_name" => "icon_position",
          "default" => 'icon-left',
          "value" => array(
                            __("Left", 'theme_admin') => 'icon-left',
                            __("Right", 'theme_admin') => 'icon-right',
                          ),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", 'theme_admin'),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'theme_admin')
        )
      ),
      "js_view" => 'VcColumnView'
  ) );
  if ( class_exists( 'WPBakeryShortCode' ) ) {
      class WPBakeryShortCode_VC_Icon_List_Item extends WPBakeryShortCode {
      }
  }
  vc_map( array(
      "name" => __("Icon List Item", 'theme_admin'),
      "base" => "vc_icon_list_item",
      "content_element" => true,
      'icon' => 'icon-wpb-atm',
      "as_child" => array('only' => 'vc_icon_list'), // Use only|except attributes to limit parent (separate multiple values with comma)
      "params" => array(
          // add params same as with any other content element
          array(
            "type" => "textarea",
            "holder" => "div",
            "heading" => __("Content", 'theme_admin'),
            "param_name" => "title",
          ),
          array(
             "type" => "nt_icon",
             "class" => "",
             "heading" => __("Icon", 'theme_admin'),
             "param_name" => "icon",
             "value" => '',
             "description" => ''
          ),
      )
  ) );

  // Animated Box
  if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
      class WPBakeryShortCode_VC_Animate_Box extends WPBakeryShortCodesContainer {
      }
  }
  vc_map( array(
      "name" => __("Animate Container", 'theme_admin'),
      "base" => "vc_animate_box",
      "as_parent" => array('only' => 'vc_single_image'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
      "content_element" => true,
      'icon' => 'icon-wpb-atm',
      "show_settings_on_create" => false,
      "params" => array(

        array(
            "type" => "textfield",
            "heading" => __("Extra class name", 'theme_admin'),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'theme_admin')
        )
      ),
      "js_view" => 'VcColumnView'
  ) );





  // Newsletter
  class WPBakeryShortCode_VC_Newsletter extends WPBakeryShortCode {}
  vc_map( array(
     "name" => __("Newsletter", 'theme_admin'),
     "description" => __('MailChimp', 'theme_admin'),
     "base" => "vc_newsletter",
     "icon" => "vc_icon-vc-gitem-post-title",
     "category" => 'Content',
     // "js_view" => 'VcGapView',
     "params" => array(
        array(
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => __("List ID", 'theme_admin'),
           "param_name" => "list_id",
           "value" => '',
           "description" => __("how to find list ID: <a href='http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id'>http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id</a>", 'theme_admin')
        ),
        array(
           "type" => "textfield",
           "class" => "",
           "heading" => __("Placeholder Text", 'theme_admin'),
           "param_name" => "placeholder",
           "value" => '',
           "description" => ""
        ),
        array(
           "type" => "textfield",
           "class" => "",
           "heading" => __("Button Text", 'theme_admin'),
           "param_name" => "button_text",
           "value" => '',
           "description" => ""
        ),
        array(
           "type" => "colorpicker",
           "class" => "",
           "heading" => __("Button Color", 'theme_admin'),
           "param_name" => "button_color",
           "value" => '',
           "description" => ""
        )
     )
  ) );


  // Pricing
  class WPBakeryShortCode_VC_Pricing extends WPBakeryShortCode {}
  vc_map( array(
     "name" => __("Pricing", 'theme_admin'),
     "description" => '',
     "base" => "vc_pricing",
     "icon" => "icon-wpb-vc_carousel",
     "category" => 'Content',
     // "js_view" => 'VcGapView',
     "params" => array(
        // array(
        //   'type' => 'checkbox',
        //   'heading' => "Featured",
        //   'param_name' => 'featured',
        //   'description' => "",
        //   "value" => array('Enable'=>'true')
        // ),
        array(
           "type" => "textfield",
           "class" => "",
           "holder" => "div",
           "heading" => __("Title Text", 'theme_admin'),
           "param_name" => "title",
           "value" => "",
           "description" => ''
        ),
        array(
           "type" => "textfield",
           "class" => "",
           "heading" => __("Price Text", 'theme_admin'),
           "param_name" => "price",
           "value" => "",
           "description" => 'example: $29.50'
        ),
         array(
           "type" => "textarea",
           "class" => "",
           "heading" => __("Features", 'theme_admin'),
           "param_name" => "features",
           "value" => "",
           "description" => __('One feature per line', 'theme_admin')
        ),
        array(
           "type" => "textfield",
           "class" => "",
           "heading" => __("Button Text", 'theme_admin'),
           "param_name" => "button_text",
           "value" => "",
           "description" => ''
        ),
         array(
           "type" => "vc_link",
           "class" => "",
           "heading" => __("Button Link", 'theme_admin'),
           "param_name" => "button_link",
           "value" => "",
           "description" => ''
        ),
         array(
           "type" => "colorpicker",
           "class" => "",
           "heading" => __("Button Color", 'theme_admin'),
           "param_name" => "button_color",
           "value" => '',
           "description" => __('leave blank to use transparent color', 'theme_admin')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", 'theme_admin'),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'theme_admin')
        )
     )
  ) );













}
