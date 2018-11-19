<?php

class LT_Widget_Property_Search extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget-property-search', 'description' => __('Property Search Form', 'theme_admin') );
		parent::__construct('property-search', FRAMEWORK_NAME.' - '.__('Property Search Form', 'theme_admin'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

		$type = $instance['type'];


		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		echo '<div class="widget-body">';
		property_search_form($type, true);
		echo '</div>';
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['type'] = strip_tags($new_instance['type']);
		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$type = isset($instance['type']) ? esc_attr($instance['type']) : 'latest';

?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo 'Title'; ?>:</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('type')); ?>">Type</label>
			<select id="<?php echo esc_attr($this->get_field_id('type')); ?>" name="<?php echo esc_attr($this->get_field_name('type')); ?>" class="widefat">
				<option value="compact" <?php echo ($type == 'compact') ? 'selected="selected"' : ''; ?>>Compact</option>
				<option value="full" <?php echo ($type == 'full') ? 'selected="selected"' : ''; ?>>Full</option>
			</select>
		</p>



<?php
	}
}
register_widget('lt_widget_property_search');
