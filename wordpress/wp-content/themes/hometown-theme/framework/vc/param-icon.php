<?php

function icon_param_settings_field($settings, $value) {
  //  $dependency = vc_generate_dependencies_attributes($settings);
   $icon_list = '<div class="icon-list-box">';
   foreach(nt_icon_list() as $icon) {
   	$active = ($value == $icon)?'active':'';
   	$icon_list .= '<div class="icon-item '.$active.'" data-id="'.$icon.'">'.do_shortcode('[nt_icon id="'.$icon.'"]').'</div>';
   }

   $custom_icons = nt_get_option('advance', 'custom_icon');
    $upload_dir = wp_upload_dir();
    if(is_array($custom_icons)) {
      foreach( $custom_icons as $custom_icon ) {
        $custom_icon = explode('|', $custom_icon);
        $custom_icon_style_path = $upload_dir['basedir'] .'/nt_custom_icon/'. $custom_icon[2].'/css/'.$custom_icon[1].'.css';
        $icon_list .= '<div class="bar">'.$custom_icon[1].'</div>';
        foreach( nt_icon_list($custom_icon_style_path) as $key => $val ) {
          $active = ($value == $icon)?'active':'';
          $icon_list .= '<div class="icon-item '.$active.'" data-id="'.$val.'">'.do_shortcode('[nt_icon id="'.$val.'"]').'</div>';
        }
      }

    }

   $icon_list .= '<div style="clear: both;"></div></div>';

   $cur_icon = ($value)?do_shortcode('[nt_icon id="'.$value.'"]'):' ';

   return '<div class="nt_icon_block">'
             .'<input name="'.$settings['param_name']
             .'" class="wpb_vc_param_value wpb-textinput '
             .$settings['param_name'].' '.$settings['type'].'_field" type="hidden" value="'
             .$value.'" /><div class="cur-icon">'.$cur_icon.'</div><div class="icons-select">select icon<i class="nt-icon-angle-down"></i></div><div style="clear: both;"></div>'.$icon_list
         .'</div>';
}
vc_add_shortcode_param('nt_icon', 'icon_param_settings_field');
