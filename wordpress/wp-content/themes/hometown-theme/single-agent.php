<?php get_header(); ?>

<div class="main-content">
<div class="row">

<div class="large-8 columns">
<div class="section">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php 
			if(strpos($post->post_content,'vc_row') !== false) {
				the_content();
			} else {
				echo '<div class="row"><div class="large-12 columns">';
				the_content();
				echo '</div></div>';
			}
		?>
	<?php endwhile; ?>

	<div class="vspace"></div><div class="vspace"></div>
	<h3><?php _e('Assigned Properties', 'theme_front'); ?></h3>
	<div class="vspace"></div>
	<ul class="large-block-grid-2 medium-block-grid-2">
	<?php 
		$current_agent_id = $post->ID;
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$p_query = new WP_Query(
			array(
				'post_type' => 'property', 
				'post_status' => 'publish', 
				'posts_per_page' => 8,
				'paged' => $paged,
				'meta_query' => array(
					array(
						'key' => '_meta_agent',
						'value' => serialize( strval( $current_agent_id ) ),
						'compare' => 'LIKE'
					)	
				)
			)
		);
		while($p_query->have_posts()) : $p_query->the_post();
			?>
			<li><?php nt_property_list($post->ID); ?></li>
		<?php endwhile; ?>
	</ul>

	<?php 
	wp_pagenavi(
		array(
			'query' => $p_query,
			'options' => array(
				'pages_text' => '',
				'first_text' => '',
				'last_text' => '',
				'prev_text' => '',
				'next_text' => '',
				'use_pagenavi_css' => false,
			)
		)
	); 
	wp_reset_postdata();
	?>


</div>
</div>

<aside class="sidebar large-4 columns">
<div class="section">
	<?php if ( dynamic_sidebar( 'agent' ) ); ?>
</div>
</aside>

</div><!-- .row -->
</div><!-- #content -->

<?php get_footer(); ?>