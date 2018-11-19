<?php 
// Template Name: Property Listing with Sidebar Left
get_header(); 
?>

<div class="main-content">
<div class="row">

	<div class="large-8 large-push-4 columns">
	<div class="section">

	<?php get_template_part('section/section', 'property-sort'); ?>

	<?php 
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}
		$property = array(
			'post_type' => 'property',
			'paged'=> $paged
		);
		if(is_page()) {
			$wp_query = new WP_Query($property);
		}
	?>

	<ul class="large-block-grid-2 medium-block-grid-2">
	<?php while ( have_posts() ) : the_post(); ?>
		<li><?php nt_property_card($post->ID); ?></li>
	<?php endwhile; ?>
	</ul>

	<div class="vspace"></div>
	<?php get_template_part('section/section', 'nav'); ?>

	</div>
	</div>

	<aside class="large-4 sidebar sidebar-left large-pull-8 columns">
	<div class="section">
		<?php dynamic_sidebar('property'); ?>
	</div>
	</aside>

</div>
</div><!-- .main-content -->

<?php get_footer(); ?>