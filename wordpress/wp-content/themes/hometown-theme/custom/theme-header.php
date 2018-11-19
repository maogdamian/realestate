<!-- Theme Dynamic CSS -->
<style type="text/css">

	/* Font */
	body { font-family: <?php echo nt_get_option('font', 'general_family'); ?>; font-size: <?php echo nt_get_option('font', 'general_font_size', '15'); ?>px; line-height: 1.6em; }
	h1 { font-size: <?php echo nt_get_option('font', 'general_font_size', 15)+16; ?>px; line-height: 1.5em; }
	h2 { font-size: <?php echo nt_get_option('font', 'general_font_size', 15)+12; ?>px; line-height: 1.5em; }
	h3 { font-size: <?php echo nt_get_option('font', 'general_font_size', 15)+8; ?>px; line-height: 1.5em; }
	h4 { font-size: <?php echo nt_get_option('font', 'general_font_size', 15)+6; ?>px; line-height: 1.5em; }
	h5 { font-size: <?php echo nt_get_option('font', 'general_font_size', 15)+4; ?>px; line-height: 1.5em; }
	h6 { font-size: <?php echo nt_get_option('font', 'general_font_size', 15)+2; ?>px; line-height: 1.5em; }
	.primary-nav { font-size: <?php echo nt_get_option('font', 'nav_font_size'); ?>px; }

	/* BG Color */
	.primary-nav > ul > li.bubble a, .lt-button.primary, input.primary[type='submit'], input.primary[type='button'], .rangeSlider .noUi-connect, .map-wrap .marker .dot, .map-wrap .marker:after, .map-wrap .cluster:before, .map-wrap .cluster:after, .card .status:before, .hero .status:before, .property-hero .status:before, #nprogress .bar, .button:hover, input[type='submit']:hover, input[type='button']:hover, .lt-button:hover, .tooltip, .map-outer-wrap .overlay-link, .select2-container--default .select2-results__option--highlighted[aria-selected], .hero .badge .status:before  { background-color: <?php echo nt_get_option('appearance', 'site_color'); ?>; }
	

	/* Color */
	a, .header-wrap .header-top .nav-language.type-text li.active a, .primary-nav li.current-menu-item > a, .primary-nav li.current-menu-ancestor > a, .login-form .tab-list li a, .box-icon .feature-icon { color: <?php echo nt_get_option('appearance', 'site_color'); ?>; }

	/* Border */
	.primary-nav > ul > li > ul.sub-menu, #nprogress .spinner-icon, .lt-button.primary, input.primary[type='submit'], input.primary[type='button'], .button:hover, input[type='submit']:hover, input[type='button']:hover, .lt-button:hover { border-color: <?php echo nt_get_option('appearance', 'site_color'); ?>; }

	.tooltip:after { border-top-color: <?php echo nt_get_option('appearance', 'site_color'); ?>; }

	/* Shadow */
	#nprogress .peg { box-shadow: 0 0 10px <?php echo nt_get_option('appearance', 'site_color'); ?>, 0 0 5px <?php echo nt_get_option('appearance', 'site_color'); ?>; }


	/* Background */
	body { 
		background-color: <?php echo nt_get_option('appearance', 'bg_color', '#fff'); ?>;
		background-image: url( <?php $bg = wp_get_attachment_image_src( nt_get_option('appearance', 'bg_image'), 'full' ); echo $bg[0]; ?> );
		<?php if( nt_get_option('appearance', 'bg_style') != 'repeat' ): ?>
			background-size: <?php echo nt_get_option('appearance', 'bg_style'); ?>;
			background-repeat: no-repeat;
		<?php else: ?>
			background-repeat: repeat;
		<?php endif; ?>
	}
	.header-bg {
		background-color: <?php echo nt_get_option('header', 'bg_color'); ?>;
		<?php if(nt_get_option('header', 'bg_image')): ?>
		background-image: url( <?php $bg = wp_get_attachment_image_src( nt_get_option('header', 'bg_image'), 'full' ); echo $bg[0]; ?> );
		<?php endif; ?>
		<?php if( nt_get_option('header', 'footer_bg_style') != 'repeat' ): ?>
			background-size: <?php echo nt_get_option('header', 'bg_image_style'); ?>;
			background-repeat: no-repeat;
		<?php else: ?>
			background-repeat: repeat;
		<?php endif; ?>
	}
	.footer-main {
		background-color: <?php echo nt_get_option('footer', 'footer_bg_color'); ?>;
		background-image: url( <?php $bg = wp_get_attachment_image_src( nt_get_option('footer', 'footer_bg_image'), 'full' ); echo $bg[0]; ?> );
		<?php if( nt_get_option('footer', 'footer_bg_image_style') != 'repeat' ): ?>
			background-size: <?php echo nt_get_option('footer', 'footer_bg_image_style'); ?>;
			background-repeat: no-repeat;
		<?php else: ?>
			background-repeat: repeat;
		<?php endif; ?>
	}
</style>
<!-- End Theme Dynamic CSS -->


<?php 
// Font to Apply
$google_font = nt_get_option('font', 'google_web_font');
if( $google_font != '' ): ?>
<!-- Google Web Font -->
<style type="text/css">
	<?php if( nt_get_option('font', 'apply_google_web_font', 'all') == 'all' ): ?>
		body { font-family: "<?php echo $google_font; ?>"; }
	<?php else: ?>
		h1, h2, h3, h4, h5, h6 { font-family: "<?php echo $google_font; ?>"; }
	<?php endif; ?>
</style>
<!-- End Google Web Font -->
<?php endif; ?>


<?php if( nt_get_option('advance', 'custom_css') ): ?>
<!-- Theme Custom CSS -->
<style type="text/css">
<?php echo nt_get_option('advance', 'custom_css'); ?>
</style>
<!-- End Theme Custom CSS -->
<?php endif; ?>

<?php if( nt_get_option('advance', 'custom_js') ): ?>
<!-- Theme Custom JS -->
<script type="text/javascript">
jQuery(document).ready(function($) {
<?php echo nt_get_option('advance', 'custom_js'); ?>
});	
</script>
<!-- End Theme Custom JS -->
<?php endif; ?>

<?php if( nt_get_option('advance', 'open_external_link') == 'on' ): ?>
<!-- Theme Open External Link in new Tab -->
<script type="text/javascript">
jQuery(document).ready(function($) {
	$('a').filter(function() {
	   return this.hostname && this.hostname !== location.hostname;
	}).attr("target","_blank");
});
</script>
<!-- End Theme Open External Link in new Tab -->
<?php endif; ?>