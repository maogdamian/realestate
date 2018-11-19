<?php

class nt_input_tool {
	var $options;
	var $config;
	var $saved_data;
	var $multi_counter = 0;

	function __construct( $options, $config ) {
		$this->options = $options;
		$this->config = $config;
	}

	function get_saved_theme_option() {
		$groups = nt_get_option();
		if( is_array($groups) ) {
			foreach ( $groups as $group_key => $group ) {
				if( is_array( $group ) ) {
					foreach ( $group as $field_key => $field ) {
						$options[ $group_key . '_' . $field_key ] = stripslashes_deep( $field );
					}
				}
			}
			return $options;
		}
		return false;
	}

	function get_saved_meta_option() {
		global $post;
		$keys = @get_post_custom_keys( $post->ID );
		if( is_array($keys) ) {
			foreach ( $keys as $key ) {
				$metas[ preg_replace('/_/', '', $key, 1) ] = get_post_meta( $post->ID, $key, true );
			}
			return $metas;
		}
		return false;
	}

	function generate_theme_option() {
		$this->saved_data = $this->get_saved_theme_option();

		$pane_active = ( isset($this->config['active_first']) && $this->config['active_first'] ) ? 'active' : '';
		echo '<div class="theme-box-content-pane theme-input ' . $pane_active . '"  id="' . $this->config['group_id'] . '-pane">';

		foreach( $this->options as $group ){
			echo '<table class="option-table widefat">';

			echo '<tbody>';
			echo '<tr class="separator"><td colspan="100"><strong>' . $group['title'] . '</strong></td></tr>';
			foreach( $group['options'] as $option ){
				$toggle_group = ( isset($option['toggle_group']) ) ? ' input-list-toggle ' . $this->toggle_group($option) : '';

				echo '<tr class="input-list' . $toggle_group . '">';
				echo '<td class="input-detail">';
				echo '<label for="' . $this->id( $option ) . '">' . $option['title'] . '</label>';
				echo '<small>' . $option['description'];

				if( isset($option['tip']) ) echo ' <a class="tips" title="' . $option['tip'] . '">[?]</a>';

				echo '</small>';
				echo '</td>';
				echo '<td class="input-field">';
					$this->{$option['type']}($option);
				echo '</td>';
				echo '</tr>';
			} // end sub foreach
			echo '</tbody>';
			echo '</table>';
			echo '<div class="spacer-20"></div>';
		} // end main foreach

		echo '</div>';
	}

	function generate_meta_option( $options = null, $saved_data = null ) {
		// if no $options passed then use $this->options
		$options = ( $options !== null ) ? $options : $this->options;

		$this->saved_data = ( $saved_data !== null ) ? $saved_data : $this->get_saved_meta_option();

		echo '<table class="option-table theme-input custom-meta-table">';

		foreach( $options as $option ){
			$toggle_group = ( isset($option['toggle_group']) ) ? ' input-list-toggle ' . $this->toggle_group($option) : '';

			if( $option['type'] == 'separator' ) {

				echo '<tr class="separator"><td colspan="100"><strong>';
				if( isset( $option['title'] ) ) echo $option['title'];
				echo '</strong></td></tr>';

			} elseif( $option['type'] == 'stack-disable' ) {
				echo '<tr class="input-list'. $toggle_group .'">';
				echo '<td colspan="2">';
				$this->$option['type']($option);
				echo '</td>';
				echo '</tr>';
			} else {

				echo '<tr class="input-list' . $toggle_group . '">';

				echo '<td class="input-detail">';
				echo '<label for="' . $this->id( $option ) . '">' . $option['title'] . '</label>';
				echo '<small>' . $option['description'];

				if( isset($option['tip']) ) echo ' <a class="tips" title="' . $option['tip'] . '">[?]</a>';

				echo '</small>';
				echo '</td>';

				echo '<td class="input-field">';
					$this->{$option['type']}($option);
				echo '</td>';
				echo '</tr>';

			}

		}
		echo '</table>';
	}

	function generate_meta_option_for_side() {
		$this->saved_data = $this->get_saved_meta_option();

		echo '<table class="option-table theme-input widefat sidebar-table custom-meta-table">';
		foreach( $this->options as $option ){
			echo '<tr class="input-list">';
			echo '<td class="input-detail input-field">';
			echo '<label for="' . $this->id( $option ) . '">' . $option['title'] . '</label>';
			echo ' <small>' . $option['description'];

			if( isset($option['tip']) ) echo ' <a class="tips" title="' . $option['tip'] . '">[?]</a>';

			echo '</small><div class="spacer-10"></div>';
				$this->$option['type']($option);
			echo '</td>';
			echo '</tr>';
		}
		echo '</table>';
	}

	function generate_stack_option( $saved_data = null ) {
		$this->saved_data = ( $saved_data != null ) ? $saved_data : $this->get_saved_meta_option();
		//$this->saved_data = $this->get_saved_meta_option();
		$stack_id = (isset($this->config['stack_id']))?'stack_id="' . $this->config['stack_id'] . '"':'';
		$template_id = (isset($this->config['template_id']))?'template_id="' . $this->options['id'] . '"':'';

		echo '<div class="stack stack-'.$this->options['id'].'">';
			echo '<div class="stack_header"><i class="nt-icon-align-justify"></i><span class="stack_header_type">'.$this->options['title'].'</span> <span class="stack_header_name"></span><i class="nt-icon-doc-inv stack_duplicate_button"></i><i class="nt-icon-cancel-circled stack_remove_button"></i></div>';
			echo '<div class="inside">';
				echo '<input type="hidden" class="stack_id" name="'.$this->name(array()).'[stack_id]" value="'.$this->config['stack_id'].'" />';
				echo '<input type="hidden" name="'.$this->name(array()).'[template_id]" value="'.$this->options['id'].'" />';
				$this->generate_meta_option( $this->options['options'], $this->saved_data );
			echo '</div>';
		echo '</div>';
	}

	//////////////////////////////////////////////////////////////////////////

	function name( $option ) {
		$subgroup = '';
		if( isset($this->config['subgroup']) && is_array($this->config['subgroup']) ){
			foreach($this->config['subgroup'] as $sub) {
				$subgroup .= '[' . $sub . ']';
			}
		}

		$option_id = '';
		if( isset($option['id']) ){
			$option_id = '[' . $option['id'] . ']';
		}

		$name = '';
		$name = $this->config['group_id'] . $subgroup . $option_id;
		return $name;
	}

	function id( $option ) {
		$subgroup = '';
		if( isset($this->config['subgroup']) && is_array($this->config['subgroup']) ){
			foreach($this->config['subgroup'] as $sub) {
				$subgroup .= '-' . $sub;
			}
		}

		$option_id = '';
		if( isset($option['id']) ){
			$option_id = '-' . $option['id'];
		}

		$id = '';
		$id = $this->config['group_id'] . $subgroup . $option_id;
		return $id;
	}

	function toggle( $option ) {
		$subgroup = '';
		if( isset($this->config['subgroup']) && is_array($this->config['subgroup']) ){
			foreach($this->config['subgroup'] as $sub) {
				$subgroup .= '-' . $sub;
			}
		}

		$option_toggle = '';
		if( isset($option['toggle']) ){
			$option_toggle = '-' . $option['toggle'];
		}

		$toggle = '';
		if( isset($this->config['multi']) && $this->config['multi'] ) {
			$toggle = $this->config['group_id'] . '-' . $this->multi_counter . $subgroup . $option_toggle;
		} else {
			$toggle = $this->config['group_id'] . $subgroup . $option_toggle;
		}
		return $toggle;
	}

	function toggle_group( $option ) {
		// Return if toggle_group has not been set
		if(!isset( $option['toggle_group'] ))
			return;

		// Explode to Array, many toggle_group is possible
		$toggle_groups = explode(' ', $option['toggle_group']);

		$subgroup = '';
		if( isset($this->config['subgroup']) && is_array($this->config['subgroup']) ){
			foreach($this->config['subgroup'] as $sub) {
				$subgroup .= '-' . $sub;
			}
		}

		$ret_toggle_group = '';
		if( isset($this->config['multi']) && $this->config['multi'] ) {
			foreach ($toggle_groups as $toggle_group) {
				$ret_toggle_group .= $this->config['group_id'] . '-' . $this->multi_counter . $subgroup . '-' . $toggle_group . ' ';
			}
		} else {
			foreach ($toggle_groups as $toggle_group) {
				$ret_toggle_group .= $this->config['group_id'] . $subgroup . '-' . $toggle_group . ' ';
			}
		}
		return $ret_toggle_group;
	}

	function value( $option )
	{
		$default = ( isset($option['default']) ) ? $option['default'] : '';

		$value = '';
		if( isset($this->config['subgroup']) && is_array($this->config['subgroup']) ) {

			if( isset($this->config['multi']) && $this->config['multi'] ) {
				// $value = ( isset( $this->saved_data[$this->config['group_id']][$this->multi_counter][$option['id']] ) ) ? $this->saved_data[$this->config['group_id']][$this->multi_counter][$option['id']] : $default;
			} else {
				$subgroup = $this->config['subgroup'];
				$subgroup[] = $option['id'];

				$temp = '';
				$success = true;
				$firstsub = array_shift($subgroup);

				if( isset( $this->saved_data[$this->config['group_id'] . '_' . $firstsub] ) ) {
					$temp = $this->saved_data[$this->config['group_id'] . '_' . $firstsub];
					foreach ($subgroup as $sub) {
						if( isset( $temp[$sub] ) ) {
							$temp = $temp[$sub];
						} else {
							$success = false;
							break;
						}
					}
				} else {
					$success = false;
				}

				$value = ($success) ? $temp : $default;

			}

		} else {
			$value = ( isset( $this->saved_data[$this->config['group_id'] . '_' . $option['id'] ] ) ) ? $this->saved_data[ $this->config['group_id'] . '_' . $option['id'] ] : $default;
		}
		return $value;
	}

	///////////////////////////////////////////////////////////////////////////////

	function text( $option ) {
		$value = $this->value($option);

		echo '<input type="text" class="input-text" id="' . $this->id( $option ) . '" name="' . $this->name( $option ) . '" value="' . stripslashes(htmlspecialchars($value)) . '" />';
		if(isset($option['locale']) && $option['locale']) {
			$locales = nt_get_locale_list();
			if(is_array($locales))
			foreach($locales as $locale) {
				$l_option = $option;
				$l_option['id'] .= '_'.$locale;
				$value = $this->value($l_option);
				echo '<div class="locale-wrap clearfix"><input type="text" class="input-text" id="' . $this->id( $l_option ) . '" name="' . $this->name( $l_option ) . '" value="' . stripslashes(htmlspecialchars($value)) . '" /><span>'.$locale.'</span></div>';
			}
		}


	}

	function content( $option ) {
		$value = $this->value($option);

		echo $option['value'];
	}

	function number( $option ) {
		$value = $this->value($option);

		echo '<input type="text" class="input-text numeric" id="' . $this->id( $option ) . '" name="' . $this->name( $option ) . '" value="' . stripslashes(htmlspecialchars($value)) . '" />';
	}

	function textarea( $option ) {
		$value = $this->value($option);

		// Rows
		$row = isset( $option['row'] ) ? 'rows="' . $option['row'] . '"' : '';

		// Theme Option Export/Import
		if( $option['id'] == 'theme_export_option' ) $value = serialize( nt_get_option() );

		echo '<textarea class="input-textarea" id="' . $this->id( $option ) . '" name="' . $this->name( $option ) . '" ' . $row . '>' . $value . '</textarea>';
		if(isset($option['locale']) && $option['locale']) {
			$locales = nt_get_locale_list();
			if(is_array($locales))
			foreach($locales as $locale) {
				$l_option = $option;
				$l_option['id'] .= '_'.$locale;
				$value = $this->value($l_option);
				echo '<div class="locale-wrap clearfix"><textarea class="input-textarea" id="' . $this->id( $l_option ) . '" name="' . $this->name( $l_option ) . '" ' . $row . '>' . $value . '</textarea><span>'.$locale.'</span></div>';
			}
		}
	}

	function radio( $option ) {
		$value = $this->value($option);

		$toggle = ( isset($option['toggle']) ) ? ' toggle="' . $this->toggle($option) . '"' : '';

		foreach( $option['options'] as $radio_slug => $radio_title ){
			$checked = ( $radio_slug == $value ) ? 'checked="checked"' : '';
			echo '<div class="input-field-row">';
			echo '<input type="radio" name="' . $this->name( $option ) . '" value="' . $radio_slug . '" id="' . $this->id( $option ) . '-' . $radio_slug . '" class="input-radio" ' . $checked . $toggle . ' />';
			echo ' <label for="' . $this->id( $option ) . '-' . $radio_slug . '">' . $radio_title . '</label>';
			echo '</div>';
		}
	}

	function checkbox( $option ) {
		$value = $this->value($option);

		foreach( $option['options'] as $checkbox_slug => $checkbox_title ) {
			$checked = ( is_array($value) && in_array( $checkbox_slug, $value ) ) ? 'checked="checked"' : '';
			echo '<div class="input-field-row">';
			echo '<input type="checkbox" name="' . $this->name( $option ) . '[]" value="' . $checkbox_slug . '" id="' . $this->id( $option ) . '-' . $checkbox_slug . '" class="input-checkbox" ' . $checked . ' />';
			echo '<label for="' . $this->id( $option ) . '-' . $checkbox_slug . '">' . $checkbox_title . '</label>';
			echo '</div>';
		}
	}

	function icon( $option ) {
		$value = $this->value($option);
		echo '<div class="nt-theme-icon-box">';
		foreach( nt_icon_list() as $key => $val ) {
			// $source[ $key ] = $val;
			$class = '';
			if( $value == $val ) $class = 'active';
			echo '<div class="item '.$class.'" data-val="'.$val.'"><i class="'.$val.'"></i></div>';
		}

		$custom_icons = nt_get_option('advance', 'custom_icon');
		$upload_dir = wp_upload_dir();
		if(is_array($custom_icons)) {
			foreach( $custom_icons as $custom_icon ) {
				$custom_icon = explode('|', $custom_icon);
				$custom_icon_style_path = $upload_dir['basedir'] .'/nt_custom_icon/'. $custom_icon[2].'/css/'.$custom_icon[1].'.css';
				echo '<div class="bar">'.$custom_icon[1].'</div>';
				foreach( nt_icon_list($custom_icon_style_path) as $key => $val ) {
					$class = '';
					if( $value == $val ) $class = 'active';
					echo '<div class="item '.$class.'" data-val="'.$val.'"><i class="'.$val.'"></i></div>';
				}
			}

		}

		echo '</div>';
		echo '<input type="hidden" id="' . $this->id( $option ) . '" name="' . $this->name( $option ) . '" value="' . $value . '" />';
	}

	function select( $option ) {
		$value = $this->value($option);

		$toggle = ( isset($option['toggle']) ) ? ' toggle="' . $this->toggle($option) . '"' : '';

		// Source : Post Type
		if( isset ( $option['source']['post_type'] ) ) {
			$source[ '' ] = '';
			$args = array(
				'post_type' => $option['source']['post_type'],
				'numberposts' => -1,
				'orderby' => 'parent',
				'order'=> 'DESC',
				'suppress_filters'  => 0,
			);
			$posts = get_posts( $args );
			foreach( $posts as $post ) {
				$source[ $post->ID ] = $post->post_title . ' (' . $post->ID . ')';
			}
		}

		// Source : RevSlider
		if( isset( $option['source']['revslider']) && class_exists('RevSlider') ) {
			$slider = new RevSlider();
			$revsliders = $slider->getArrSlidersShort();
			foreach( $revsliders as $id => $name ) {
				$source[ $id ] = $name . ' (' . $id . ')';
			}
		}

		// Source : Layer Slider
		if( isset( $option['source']['layer_slider']) ) {
			global $wpdb;
			$table_name = $wpdb->prefix . "layerslider";
			if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
			    $sliders = @$wpdb->get_results( "SELECT * FROM $table_name
										WHERE flag_hidden = '0' AND flag_deleted = '0'
										ORDER BY id ASC LIMIT 200" );
				if(!empty($sliders)){
					foreach( $sliders as $slider ) {
						$source[ $slider->id ] = $slider->name . ' (' . $slider->id . ')';
					}
				}
			}

		}

		// Source : Category
		if( isset ( $option['source']['category'] ) ) {
			$args = array( 'type' => $option['source']['category'], 'orderby' => 'term_group' );
			$taxanomies = get_categories( $args );
			foreach( $taxanomies as $taxanomy ) {
				$source[ $taxanomy->term_id ] = $taxanomy->category_nicename;
			}
		}

		// Source : Taxonomy
		if( isset ( $option['source']['taxonomy'] ) ) {
			$args = array( 'taxonomy' => $option['source']['taxonomy'], 'orderby' => 'term_group' );
			$taxanomies = get_categories( $args );
			foreach( $taxanomies as $taxanomy ) {
				$source[ $taxanomy->term_id ] = $taxanomy->category_nicename;
			}
		}

		// Source : Font Awesome
		if( isset( $option['source']['font-awesome'] ) ) {
			$source[ '' ] = 'Select icon ...';
			asort($GLOBALS['nt_font_awesome_list']);
			foreach( nt_icon_list() as $key => $list ) {
				$source[ $key ] = $list;
			}
		}

		// Source : Option Custom Sidebar
		if( isset( $option['source']['option-custom-sidebar'] ) ) {
			if( is_array( nt_get_option('sidebar', 'custom_sidebars') ) )
			foreach( nt_get_option('sidebar', 'custom_sidebars') as $list ) {
				$source[ preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower( $list['stack_title'] )) ) ] = $list['stack_title'];
			}
		}

		// Source : NAV Menu
		if( isset( $option['source']['nav-menu'] ) ) {
			$nav_menu = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
			// var_dump($nav_menu);
			foreach( $nav_menu as $list ) {
				$source[ $list->term_id ] = $list->name;
			}
		}

		// Source : Google Web Font
		if( isset ( $option['source']['gfonts'] ) ) {
			$items = get_transient( THEME_SLUG . 'gfont_items' );
			
			if( !$items ){ // No transient, request the new one
				
				$response = file_get_contents(THEME_FUNCTIONS_URI.'/gfont.json');
				
				if( is_wp_error( $response ) ) { // Failed, get from option
				   	$items = get_option( THEME_SLUG . 'gfont_items' );
				} else { // Success
					$response = json_decode($response);
					$items = $response->items;
					
					// Store
					set_transient( THEME_SLUG . 'gfont_items', $items, 60*60*12 );
				   	if( !add_option( THEME_SLUG . 'gfont_items', $items ) ) {
				   		update_option( THEME_SLUG . 'gfont_items', $items );
				   	}
				}
			}

			// Add to source
			$source[ '' ] = 'Please Select';
			if( $items ) {
				foreach( $items as $item ) {
					$source[ $item->family ] = $item->family;
				}
			} else {
				$source[ $value ] = $value;
			}
		}

		// Multiple
		$multiple = ( isset ( $option['multiple'] ) ) ? ' multiple size="'.$option['multiple'].'"' : '';

		$name = ( isset ( $option['multiple'] ) ) ? 'name="' . $this->name( $option ) . '[]"' : 'name="' . $this->name( $option ) . '"';

		// Generate
		echo '<select '.$multiple.' class="input-select" ' . $name . '" id="' . $this->id( $option ) . '" '.$toggle.'>';
		if( isset($option['options']) ) {
			foreach( $option['options'] as $select_slug => $select_title ){
				$selected = ( $select_slug == $value || ( is_array($value) && in_array( $select_slug, $value) ) ) ? 'selected="selected"' : '';
				echo '<option value="' . $select_slug . '" ' . $selected . '>' . $select_title . '</option>';
			}
		}
		if( isset($source) ) {
			foreach( $source as $select_slug => $select_title ){
				$selected = ( $select_slug == $value || ( is_array($value) && in_array( $select_slug, $value) ) ) ? 'selected="selected"' : '';
				echo '<option value="' . $select_slug . '" ' . $selected . '>' . $select_title . '</option>';
			}
		}
		echo '</select>';

	}

	function input_file( $option ) {
		$value = $this->value($option);

		echo '<input type="hidden" class="dummy-input" name="' . $this->name( $option ) . '" />';
		// echo '<div class="file-extensions" value="' . $option['extensions'] . '"></div>';
		echo '<div class="uploaded-file-container">';
		if( $value ) {
			echo '<div class="uploaded-file">';
			echo '<span>'.wp_get_attachment_url( $value ).'</span>';
			echo '<div class="image-action-box"><i class="nt-icon-cancel-circled"></i></div>';
			echo '<input type="hidden" name="' . $this->name( $option ) . '" value="' . $value . '" />';
			echo '</div>';
		}
		echo '</div>';
		echo '<div class="clear"></div>';
		echo '<div class="ajax-load-icon upload-image-bt-ajax-load"></div>';
		echo '<div class="upload-file-bt-box"><input type="button" value="' . 'Upload File' . '" class="button-secondary upload-file-bt file_add_button" data-field-name="' . $this->name($option) . '" /></div>';
	}


	function image( $option ) {
		$value = $this->value($option);

		echo '<input type="hidden" name="' . $this->name($option) . '" />';
		echo '<div id="' . $this->id($option) . '_image_container" class="image_container clear" value="custom_media">';

		if( $value != '' ) {
			echo '<div class="uploaded-image" attachment_id="'.$value.'">';
			echo '<input type="hidden" id="'.$this->id($option).'" name="' . $this->name($option) . '" value="'.$value.'"/>';
			echo wp_get_attachment_image($value, 'thumbnail');
			echo '<div class="image-action-box"><i class="nt-icon-cancel-circled"></i></div>';
			echo '</div>';
		}

		echo '</div><div class="clear"></div>';
		echo '<div multi="no" data-field-name="' . $this->name($option) . '" class="images_add_button button">'.'Upload Image'.'</div>';
	}


	function images( $option ) {
		$value = $this->value($option);
		echo '<input type="hidden" name="' . $this->name($option) . '" />';
		echo '<div id="' . $this->id($option) . '_images_container" class="images_container image_container clear" value="custom_media">';
		$images = ($value!='') ? $value : array();
		foreach ($images as $key => $value) {
			echo '<div class="uploaded-image" attachment_id="'.$value.'" style="float: left;">';
			echo '<input type="hidden" id="'.$this->id($option).'" name="'.$this->name($option).'[]" value="'.$value.'"/>';
			echo wp_get_attachment_image($value, 'thumbnail');
			echo '<div class="image-action-box"><i class="nt-icon-cancel-circled"></i></div>';
			echo '</div>';
		}
		echo '</div><div class="clear"></div>';
		echo '<div multi="yes" data-field-name="' . $this->name($option) . '" class="images_add_button button">'.'Upload Images'.'</div>';
	}

	// Location
	function location( $option ) {
		$value = $this->value($option);
		// var_dump($value);
		if(!$value) {
			$value = array();
			$value[1] = '37.4418834';
			$value[2] = '-122.14301949999998';
			$value[0] = '';
			$value[3] = '15';
		}
		echo '<input type="text" class="input-text location" name="' . $this->name( $option ) . '[]" value="' . stripslashes(htmlspecialchars($value[0])) . '" placeholder="Enter a Location" />';
		echo '<input type="text" class="input-text latitude" name="' . $this->name( $option ) . '[]" value="' . stripslashes(htmlspecialchars($value[1])) . '" placeholder="Latitude" />';
		echo '<input type="text" class="input-text longitude" name="' . $this->name( $option ) . '[]" value="' . stripslashes(htmlspecialchars($value[2])) . '" placeholder="Longitude" />';
		echo '<input type="hidden" class="input-text zoom" name="' . $this->name( $option ) . '[]" value="' . stripslashes(htmlspecialchars($value[3])) . '" placeholder="Zoom" />';
		echo '<div class="location-picker" style="height: 300px;" data-latitude="'.$value[1].'" data-longitude="'.$value[2].'" data-location="'.$value[0].'" data-zoom="'.$value[3].'"></div>';
	}

	// Export Options
	function export_options( $option ) {
		echo '<a href="'.THEME_FUNCTIONS_URI.'/admin-options-export.php" target="_blank" class="button">' . 'Download Backup File</a>';
	}
	function import_options( $option ) {
		echo '<div class="input-file-wrap"><input type="file" accept="txt" class="input-file-real" name="import_options_file"><a href="#" class="input-file-bt button">Browse</a><span class="input-file-name">' . 'please select backup file' . '</span></div><input type="submit" class="button-primary" value="' . 'Import Options' . '" name="import_options" />';
	}

	// Import Content
	function import_content( $option ) {

		if( is_array($option['options']) ) {
			echo '<select name="import_options_file_name" style="margin: 0 0 15px 0; display: block;">';
			echo '<option value="">Select demo content</option>';
			foreach ($option['options'] as $key => $val) {
				echo '<option value="'.$key.'">'.$val.'</option>';
			}
			echo '</select>';
		}


		echo '<input type="submit" name="import_content" value="Import Demo Content" class="button first-click" data-confirm="Are you sure that you want to import demo content? All posts / page / menu / images will be deleted." /><input type="button" name="import_content" value="Please wait. Importing ..." class="button second-click" disabled />';
	}

	// Import Fontello Icon
	function custom_icon( $option ) {
		$value = $this->value($option);
		echo '<div class="input-file-wrap"><input type="file" accept="txt" class="input-file-real" name="import_fontello_file"><a href="#" class="input-file-bt button">Browse</a><span class="input-file-name">' . 'please select fontello zip' . '</span></div><input type="submit" class="button-primary" value="' . 'Import Fontello Zip' . '" name="import_fontello" />';
		echo '<ul class="nt-custom-icon-list">';
		if(is_array($value))
		foreach( $value as $val ) {
			$val_array = explode('|', $val);
			echo '<li>'.$val_array[1].' <input type="hidden" name="'.$this->name($option).'[]" value="'.$val.'" /><i class="nt-icon-cancel-circled"></i></li>';
		}
		echo '</ul>';
	}

	function show( $option ) {
		$value = $this->value($option);

		echo stripslashes(htmlspecialchars($value));
		echo '<input type="hidden" class="input-hidden" id="' . $this->id( $option ) . '" name="' . $this->name( $option ) . '" value="' . stripslashes(htmlspecialchars($value)) . '">';
	}

	// Separator
	function separator( $option ) {

	}

	///////////////////////////////////////////////////////////////////////////////

	function color( $option ) {
		$value = $this->value($option);

		echo '<div class="color-indicator" style="background: '.$value.';"></div><input type="text" class="input-color" id="' . $this->id( $option ) . '" name="' . $this->name( $option ) . '" value="' . $value . '">';
	}

	function date( $option ) {
		$value = $this->value($option);

		$time_string = ($value != '') ? date('m/d/Y', $value) : '';
		echo '<input type="text" class="input-date" id="' . $this->id( $option ) . '" value="' . $time_string . '" >';
		echo '<input type="hidden" class="input-date-value" id="' . $this->id( $option ) . '" name="' . $this->name( $option ) . '" value="' . $value . '" >';
	}

	function time( $option ) {
		$value = $this->value($option);

		echo '<input type="text" class="input-time" id="' . $this->id( $option ) . '" name="' . $this->name( $option ) . '" value="' . $value . '" ><a href="#" class="time-trigger"></a>';
	}

	function range( $option ) {
		$value = $this->value($option);

		echo '<input type="text" class="input-range" id="' . $this->id( $option ) . '" name="' . $this->name( $option ) . '" data-slider-value="' . $value . '" data-range="' . $option['min'] . ',' . $option['max'] . '" data-step="' . $option['step'] . '" value="'. $value .'">';
		echo '<span class="input-range-value">' . $value . '</span>';
		echo '<span class="input-range-unit">' . $option['unit'] . '</span>';
	}

	function on_off( $option ) {
		$value = $this->value($option);

		$checked = ( 'on' == $value ) ? 'checked="checked"' : '';
		$toggle = ( isset($option['toggle']) ) ? ' toggle="' . $this->toggle($option) . '"' : '';

		// Sent value even the checkbox is unchecked http://stackoverflow.com/questions/476426/submit-an-html-form-with-empty-checkboxes
		echo '<input type="hidden" name="' . $this->name( $option ) . '" value="off" />';

		echo '<input type="checkbox" class="input-on-off"  name="' . $this->name( $option ) . '" id="' . $this->id( $option ) . '" value="on" ' . $checked . $toggle . ' />';
	}

	function radio_img( $option ) {
		$value = $this->value($option);

		$toggle = ( isset($option['toggle']) ) ? ' toggle="' . $this->toggle($option) . '"' : '';

		foreach( $option['options'] as $radio_slug => $radio_title ){
			$checked = ( $radio_slug == $value ) ? 'checked="checked"' : '';
			$active = ( $radio_slug == $value ) ? 'active' : '';
			echo '<div class="radio-img-list">';
			echo '<input type="radio" name="' . $this->name( $option ) . '" value="' . $radio_slug . '" id="' . $this->id( $option ) . '-' . $radio_slug . '" class="input-radio" ' . $checked . $toggle . ' />';
			echo '<label for="' . $this->id( $option ) . '-' . $radio_slug . '" class="' . $active . '"><div class="radio-img" style="background-image:url('. $option['images'][$radio_slug] .');"></div><div class="radio-img-list-desc">' . $radio_title . '</div></label>';
			echo '</div>';
		}
	}

	function checkbox_img( $option ) {
		$value = $this->value($option);

		$toggle = ( isset($option['toggle']) ) ? ' toggle="' . $this->toggle($option) . '"' : '';

		foreach( $option['options'] as $checkbox_slug => $checkbox_title ){
			$checked = ( is_array( $value ) && in_array( $checkbox_slug, $value ) ) ? 'checked="checked"' : '';
			$active = ( is_array( $value ) && in_array( $checkbox_slug, $value ) ) ? 'active' : '';
			echo '<div class="checkbox-img-list">';
			echo '<input type="checkbox" name="' . $this->name( $option ) . '[]" value="' . $checkbox_slug . '" id="' . $this->id( $option ) . '-' . $checkbox_slug . '" class="input-checkbox" ' . $checked . $toggle . ' />';
			echo '<label for="' . $this->id( $option ) . '-' . $checkbox_slug . '" class="' . $active . '"><img src="' . THEME_CUSTOM_ASSETS_URI . '/images/list-images/' . $option['images'][$checkbox_slug] . '" /></label>';
			echo '<div class="checkbox-img-list-desc">' . $checkbox_title . '</div>';
			echo '</div>';
		}
	}

	function stack( $option ) {

		$value = $this->value($option);
		if($value==''){$value=array();} // workaround for no stack

		// workaround for remove all stacks
		echo '<input type="hidden" name="'.$this->name($option).'" />';

		echo '<div class="stack_container" id="' . $this->id( $option ) . '-stack_container" name="' . $this->id( $option ) . '-stack_container">';

		// Default Page Content Stack
		if($option['id'] == 'stacks') {
			$page_content_stack = array('stack_id' => 0, 'template_id' => 'page_content');
			if( isset( $option['stack_builder'] ) && $option['stack_builder'] && !in_array($page_content_stack, $value) ) {
				$value[] = $page_content_stack;
			}
		}


		$subgroup = array();
		if( isset($this->config['subgroup']) && is_array($this->config['subgroup']) ) {
			$subgroup = $this->config['subgroup'];
		}
		$subgroup[] = $option['id'];

		// Empty Stack
		if( count($value) == 0 ) {
			echo '<div class="dummy-stack"></div>';
		}

		foreach ($value as $stack) {
			if(!is_array($stack)){continue;}

			$stack_stack_id = $stack['stack_id'];
			$stack_template_id = $stack['template_id'];
			$stack_template_title = '';
			$stack_config = json_decode(json_encode($this->config),true);
			$stack_option = array();

			// find template
			foreach ($option['templates'] as $template) {
				if($template['id'] == $stack_template_id) {
					$stack_option = $template;
					break;
				}
			}

			// modify option id, toggle, toggle_group
			$extend = '-' . $stack_stack_id;
			$stack_config['stack_id'] = $stack_stack_id;
			$stack_config['subgroup'] = array_merge($subgroup,array($stack_stack_id));

			// generate stack option
			$stack_nt_input_tool = new nt_input_tool($stack_option, $stack_config);
			$stack_nt_input_tool->generate_stack_option( $this->saved_data );
		}

		echo '</div>';
		echo '<div class="stack_menu">';
		$show_stack_select_template = (count($option['templates'])>1) ? '' : ' hidden';
		echo '<select class="stack_select_template '.$show_stack_select_template.'" id="' . $this->id( $option ) . '-stack_select">';
		foreach ($option['templates'] as $template) {
			if(  !in_array( $template['id'], array('page_content') ) ) {
				echo '<option value="' . $template['id'] . '" opt="'.htmlspecialchars(json_encode($template),ENT_QUOTES).'" conf="'.htmlspecialchars(json_encode($this->config),ENT_QUOTES).'">' . $template['title'] . '</option>';
			}
		}
		echo '</select>';
		echo '<input class="button stack_add_button" type="button" id="' . $this->id( $option ) . '-add_button" subgroup="' . htmlspecialchars(json_encode($subgroup),ENT_QUOTES) . '" value="'.$option['stack_button'].'" />';
		echo '</div>';
	}

	function fetch_google_play($option) {

	}

	///////////////////////////////////////////////////////////////////////////////

}



?>
