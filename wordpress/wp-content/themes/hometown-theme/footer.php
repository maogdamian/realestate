<footer class="footer-main <?php echo nt_get_option('footer', 'footer_element_style', 'element-dark') ?>">

<?php if(nt_get_option('footer', 'footer_show', 'on') == 'on'): ?>
<div class="footer-top">
<div class="row">
<?php if(nt_get_option('footer', 'pre_footer_columns', '4-cols') == '4-cols'): ?>
	<div class="large-3 medium-6 columns"><?php if ( dynamic_sidebar( 'footer-1' ) ); ?></div>
	<div class="large-3 medium-6 columns"><?php if ( dynamic_sidebar( 'footer-2' ) ); ?></div>
	<div class="large-3 medium-6 columns"><?php if ( dynamic_sidebar( 'footer-3' ) ); ?></div>
	<div class="large-3 medium-6 columns"><?php if ( dynamic_sidebar( 'footer-4' ) ); ?></div>
<?php else: ?>
	<div class="large-4 medium-6 columns"><?php if ( dynamic_sidebar( 'footer-1' ) ); ?></div>
	<div class="large-4 medium-6 columns"><?php if ( dynamic_sidebar( 'footer-2' ) ); ?></div>
	<div class="large-4 medium-6 columns"><?php if ( dynamic_sidebar( 'footer-3' ) ); ?></div>
<?php endif; ?>
</div>
</div>
<?php endif; ?>

<div class="footer-bottom">
	<div class="row">

	<?php if(is_array(nt_get_option('footer', 'social_items'))): ?>
	<ul class="social-list">
	<?php foreach( nt_get_option('footer', 'social_items') as $link ): ?>
	<li><a href="<?php echo esc_url($link['stack_title']); ?>"><?php echo do_shortcode('[nt_icon id="'.$link['icon'].'"]'); ?></a></li>
	<?php endforeach; ?>
	</ul>
	<?php endif; ?>

	<div class="copyright-text"><?php echo nt_get_option('footer', 'footer_text', 'Copyright &copy; '.date("Y").' '.get_bloginfo('name')); ?></div>
	</div>
</div>

</footer>


</div></div><!-- .layout-wrap -->

<div class="modal-mask">
	<div class="modal login-modal">
		<?php get_template_part('section/section', 'login-register'); ?>
		<i class="flaticon-cross37 close-bt"></i>
	</div>
</div>

<?php
global $nt_site_message;
if($nt_site_message): ?>
<div class="message-mask">
<div class="inner">
<p><?php echo esc_html($nt_site_message); ?></p>
<i class="flaticon-correct7"></i>
</div>
</div>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>
