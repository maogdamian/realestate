<?php

class LT_Widget_Property_Compare extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget-property-compare', 'description' => __('Property Compare', 'theme_admin') );
		parent::__construct('property-compare', FRAMEWORK_NAME.' - '.__('Property Compare', 'theme_admin'), $widget_ops);
	}

	function widget( $args, $instance ) {
		if(!is_singular('property')) return;
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

		
		$args = array(
			'post_type'			=> 'property',
			'numberposts'		=> -1,
			'suppress_filters' 	=> 0,
			'post__not_in'	=> array(get_queried_object()->ID)
		);
		$posts = get_posts($args);

		$output = '<form action="" method="get" class="compare-form">';
		$output .= '<select name="compare-with" class="property-select2">';
		$output .= '<option value="" selected>'.__('Compare with','theme_front').'</option>';
		foreach( $posts as $post ) {
			$thumb = get_post_thumbnail_id( $post->ID );
			$thumb = nt_image_src( $thumb, 'select' );
			$output .= '<option data-img="'.$thumb.'" value="'.$post->ID.'">'.$post->post_title.'</option>';
		}
		$output .= '</select>';
		$output .= '</form>';


		if ( !empty( $output ) ) {
			echo $before_widget;
			if ( $title )
				echo $before_title . $title . $after_title;
			echo $output;
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		// $instance['count'] = (int) $new_instance['count'];
		// $instance['type'] = strip_tags($new_instance['type']);
		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		// $count = isset($instance['count']) ? absint($instance['count']) : 4;
		// $type = isset($instance['type']) ? esc_attr($instance['type']) : 'latest';

?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo 'Title'; ?>:</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>





<?php
	}
}
register_widget('lt_widget_property_compare');
