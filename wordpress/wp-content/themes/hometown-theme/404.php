<?php 
get_header(); ?>

<div class="main-content">
<div class="section">
<div class="row">
<div class="large-4 columns">
	<form method="get" class="nt-search-form" action="<?php echo home_url(); ?>">
		<div class="input-field infield-button">
			<input type="text" id="search-text" class="input-text waterfall" name="s" placeholder="<?php _e('Search &#8230;', 'theme_front');?>" />
			<button class="lt-button"><?php _e('Search', 'theme_front'); ?></button>
		</div>
	</form>
</div>
</div>
</div>
</div><!-- #content -->

<?php get_footer(); ?>