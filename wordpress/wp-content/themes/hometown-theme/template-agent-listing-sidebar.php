<?php 
// Template Name: Agent Listing with Sidebar
get_header(); 

if ( get_query_var('paged') ) {
    $paged = get_query_var('paged');
} elseif ( get_query_var('page') ) {
    $paged = get_query_var('page');
} else {
    $paged = 1;
}
$query = array(
	'post_type' => 'agent',
	'paged'=> $paged
);

if(is_page()) {
	$wp_query = new WP_Query($query);
}
?>

<div class="main-content">
<div class="section">
<div class="row">

	<div class="large-8 columns">

	<ul class="large-block-grid-3 medium-block-grid-3">
	<?php while ( have_posts() ) : the_post(); ?>
		<li><?php nt_agent_card($post->ID); ?></li>
	<?php endwhile; ?>
	</ul>

	<div class="vspace"></div>
	<?php get_template_part('section/section', 'nav'); ?>
	</div>

	<aside class="large-3 columns">
		<?php dynamic_sidebar('agent'); ?>
	</aside>

</div></div>
</div><!-- .main-content -->

<?php get_footer(); ?>