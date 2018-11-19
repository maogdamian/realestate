<?php
// Template Name: Member
if(!is_user_logged_in()) { wp_redirect( home_url() ); exit; }
get_header(); ?>

<div class="main-content">
<div class="row">

<div class="large-8 columns">
<div class="section">
<?php
	if(nt_get_request('fn') == 'submit-property' || nt_get_request('fn') == 'edit-property') {
		get_template_part('section/section', 'member-add-property');
	} else if(nt_get_request('fn') == 'edit-profile') {
		get_template_part('section/section', 'member-edit-profile');
	} else {
		get_template_part('section/section', 'member-dashboard');
	}
?>
</div>

</div>

<aside class="sidebar large-4 columns">
<div class="section">

	<div id="text-6" class="widget widget_text">
	<div class="textwidget">
		<ul>
			<li><a href="<?php the_permalink(); ?>"><?php _e('Dashboard', 'theme_front'); ?></a></li>
			<li><a href="<?php echo add_query_arg(array('fn'=>'submit-property'), get_permalink()); ?>"><?php _e('Submit Properties', 'theme_front'); ?></a></li>
			<li><a href="<?php echo add_query_arg(array('fn'=>'edit-profile'), get_permalink()); ?>"><?php _e('Edit Profile', 'theme_front'); ?></a></li>
			<li><a href="<?php echo wp_logout_url(home_url()); ?>"><?php _e('Logout', 'theme_front'); ?></a></li>
		</ul>
	</div>
	</div>

	<?php dynamic_sidebar('member'); ?>
</div>
</aside>

</div>
</div><!-- #content -->

<?php get_footer(); ?>
