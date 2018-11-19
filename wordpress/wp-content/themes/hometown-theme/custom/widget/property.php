<?php

class LT_Widget_Property extends WP_Widget
{

    public function __construct()
    {
        $widget_ops = array('classname' => 'widget-property', 'description' => __('Property List', 'theme_admin'));
        parent::__construct('property', FRAMEWORK_NAME . ' - ' . __('Property List', 'theme_admin'), $widget_ops);
    }

    public function widget($args, $instance)
    {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        $count = (int) $instance['count'];
        $type = $instance['type'];

        $args = array(
            'post_type' => 'property',
            'numberposts' => $count,
            'suppress_filters' => 0,
            'bypass_filter' => true,
        );

        if ($type == 'random') {
            $args['orderby'] = 'rand';
            $args['bypass_sort'] = true;
        } elseif ($type == 'favourite') {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = '_meta_favourites_count';
            $args['bypass_sort'] = true;
        }

        $posts = get_posts($args);

        $output = '<ul>';
        foreach ($posts as $post) {
            if (has_post_thumbnail($post->ID)) {
                $price = get_post_meta($post->ID, '_meta_price', true);
                if (!$price) {
                    $price = nt_get_option('property', 'null_price');
                }

                $per = get_post_meta($post->ID, '_meta_per', true);
                $thumb = get_post_thumbnail_id($post->ID);
                $thumb = nt_image_src($thumb, 'thumbnail');
                $output .= '<li>';
                $output .= '<a href="' . get_permalink($post->ID) . '"><img src="' . $thumb . '" /></a>';
                $output .= '<a href="' . get_permalink($post->ID) . '">' . get_the_title($post->ID) . '</a>';
                if ($price) {
                    $output .= '<span class="price">' . nt_currency($price, $per) . '</span>';
                }

                $output .= '</li>';
            }
        }
        $output .= '</ul>';

        if (!empty($output)) {
            echo $before_widget;
            if ($title) {
                echo $before_title . $title . $after_title;
            }

            echo $output;
            echo $after_widget;
        }
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['count'] = (int) $new_instance['count'];
        $instance['type'] = strip_tags($new_instance['type']);
        return $instance;
    }

    public function form($instance)
    {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $count = isset($instance['count']) ? absint($instance['count']) : 4;
        $type = isset($instance['type']) ? esc_attr($instance['type']) : 'latest';

        ?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo 'Title'; ?>:</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php echo 'How many property to display?'; ?></label>
		<select id="<?php echo esc_attr($this->get_field_id('count')); ?>" class="ads-count" name="<?php echo esc_attr($this->get_field_name('count')); ?>" class="widefat">
			<?php for ($i = 1; $i <= 10; $i++): ?>
			<option value="<?php echo $i; ?>" <?php echo ($count == $i) ? 'selected="selected"' : ''; ?>><?php echo $i; ?></option>
			<?php endfor;?>
		</select></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('type')); ?>">Type</label>
			<select id="<?php echo esc_attr($this->get_field_id('type')); ?>" name="<?php echo esc_attr($this->get_field_name('type')); ?>" class="widefat">
				<option value="latest" <?php echo ($type == 'latest') ? 'selected="selected"' : ''; ?>>Latest</option>
				<option value="favourite" <?php echo ($type == 'favourite') ? 'selected="selected"' : ''; ?>>Most Favourite</option>
				<option value="random" <?php echo ($type == 'random') ? 'selected="selected"' : ''; ?>>Random</option>
			</select>
		</p>



<?php
}
}
register_widget('lt_widget_property');
