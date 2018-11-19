<?php get_header(); ?>

<div class="main-content">
<div class="row">
	
	<div class="large-8 columns">
	<div class="section section-blog">
	<?php while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="article-head">
			<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<div class="post-meta">
				<?php if( nt_get_option('blog', 'meta_date', 'on') == 'on' ): ?>
					<span class="meta-item"><span><?php echo get_the_date(); ?></span></span>
				<?php endif; ?>
				<?php if( nt_get_option('blog', 'meta_author', 'on') == 'on' ): ?>
					<span class="meta-item"><span><?php echo the_author_posts_link(); ?></span></span>
				<?php endif; ?>
				<?php if( nt_get_option('blog', 'meta_category', 'on') == 'on' && get_the_category_list() != '' ): ?>
					<span class="meta-item">
						<span><?php echo get_the_category_list(', '); ?></span>
					</span>
				<?php endif; ?>
				<?php if( nt_get_option('blog', 'meta_category', 'on') == 'on' && get_the_tag_list() != '' ): ?>
					<span class="meta-item">
						<span><?php echo get_the_tag_list('', ', '); ?></span>
					</span>
				<?php endif; ?>
				<?php if( nt_get_option('blog', 'meta_comment', 'on') == 'on' && comments_open() ): ?>
					<span class="meta-item">
						<span><?php comments_popup_link(__('No Comments','theme_front'), __('1 Comment','theme_front'), __('% Comments','theme_front'), '', ''); ?></span>
					</span>
				<?php endif; ?>
			</div>
		</div>
	</article>
	<?php endwhile; ?>
	<div class="vspace" style="height: 40px;"></div>
	<?php get_template_part('section/section', 'nav'); ?>

	</div>
	</div>

	<aside class="sidebar large-4 columns">
	<div class="section">
		<?php dynamic_sidebar('blog'); ?>
	</div>
	</aside>

</div>
</div>

<?php get_footer(); ?>