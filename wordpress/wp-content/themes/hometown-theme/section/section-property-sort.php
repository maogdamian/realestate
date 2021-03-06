<?php
if(is_page()) {
	$link = get_permalink();
} else {
	if(is_tax()) {
		$link = get_term_link(get_queried_object()->term_id);
	} else {
		$link = get_post_type_archive_link('property');
	}
}
?>
<form class="property-view-form" method="get">
<ul class="view-option-list clearfix">
	<li style="width: 200px;">
		<select class="select2" name="sort" data-minimum-results-for-search="Infinity">
			<option value=""><?php _e('Sort By', 'theme_front');?></option>
			<option value="<?php echo add_query_arg('sort', 'price-asc', $link . '?' . $_SERVER['QUERY_STRING']); ?>" <?php if (nt_get_request('sort') == "price-asc"): ?>selected="selected"<?php endif;?>><?php _e('Price Low to High', 'theme_front');?></option>
			<option value="<?php echo add_query_arg('sort', 'price-desc', $link . '?' . $_SERVER['QUERY_STRING']); ?>" <?php if (nt_get_request('sort') == "price-desc"): ?>selected="selected"<?php endif;?>><?php _e('Price High to Low', 'theme_front');?></option>
			<option value="<?php echo add_query_arg('sort', 'date-desc', $link . '?' . $_SERVER['QUERY_STRING']); ?>" <?php if (nt_get_request('sort') == "date-desc"): ?>selected="selected"<?php endif;?>><?php _e('Date New to Old', 'theme_front');?></option>
			<option value="<?php echo add_query_arg('sort', 'date-asc', $link . '?' . $_SERVER['QUERY_STRING']); ?>" <?php if (nt_get_request('sort') == "date-asc"): ?>selected="selected"<?php endif;?>><?php _e('Date Old to New', 'theme_front');?></option>
			<option value="<?php echo add_query_arg('sort', 'name-asc', $link . '?' . $_SERVER['QUERY_STRING']); ?>" <?php if (nt_get_request('sort') == "name-asc"): ?>selected="selected"<?php endif;?>><?php _e('Name Ascending', 'theme_front');?></option>
			<option value="<?php echo add_query_arg('sort', 'name-desc', $link . '?' . $_SERVER['QUERY_STRING']); ?>" <?php if (nt_get_request('sort') == "name-desc"): ?>selected="selected"<?php endif;?>><?php _e('Name Descending', 'theme_front');?></option>
		</select>
	</li>
</ul>
</form>
