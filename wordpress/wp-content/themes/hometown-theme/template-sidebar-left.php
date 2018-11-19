<?php 
// Template Name: Sidebar Left
get_header(); ?>

<div class="main-content">
<div class="row">

<div class="large-8 large-push-4 columns">
<?php while ( have_posts() ) : the_post(); ?>
	<?php 
		if(strpos($post->post_content,'vc_row') !== false) {
			the_content();
		} else {
			echo '<div class="section"><div class="row"><div class="large-12 columns">';
			the_content();
			echo '</div></div></div>';
		}
	?>
<?php endwhile; ?>

	<?php if(!post_password_required()) comments_template(); ?>
</div>

<aside class="sidebar sidebar-left large-4 large-pull-8 columns">
<div class="section">
	<?php get_sidebar(); ?>
</div>
</aside>

</div>
</div><!-- #content -->

<?php get_footer(); ?>