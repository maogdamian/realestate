<?php get_header(); ?>

<?php
	// Send Message
	if(!empty($_POST)) {
		if(nt_get_option('advance', 'recaptchar_site_key') && nt_get_option('advance', 'recaptchar_secret_key')) {

			$secretKey = nt_get_option('advance', 'recaptchar_secret_key');
    	$response = $_POST['g-recaptcha-response'];
			$reCaptchaValidationUrl = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response");
    	$result = json_decode($reCaptchaValidationUrl, TRUE);

			if($result['success']) {
				$is_valid = true;
			} else {
				$is_valid = false;
			}

		} else {
			$is_valid = true;
		}

		global $nt_site_message;
		if($is_valid) {


			$from = $_REQUEST['from'];
			$phone = $_REQUEST['phone'];
			$msg = $_REQUEST['message'];
			$to = '';
			if(isset($_REQUEST['to'])) $to = $_REQUEST['to'];
			if(!$to) $to = nt_get_option('property', 'contact_email', get_bloginfo('admin_email'));

			$subject = __('Inquiry Property', 'theme_front');
			$property_id = get_post_meta( $post->ID, '_meta_id', true );
			if($property_id) {
				$subject .= ' #'.$property_id;
			}

			$headers[] = 'From: '.$from;
			$headers[] = 'Reply-To: '.$from;
			$headers[] = 'MIME-Version: 1.0';
			$headers[] = 'Content-type: text/html; charset=utf-8';

			$message = '<strong>From</strong>: '.$from;
			$message .= '<br /><strong>Phone</strong>: '.$phone;
			$message .= '<br /><strong>Property</strong>: <a href="'.get_the_permalink().'">'.$post->post_title.'</a>';
			$message .= '<br /><br /><strong>Message</strong>: <br />'.$msg;

			do_action('nt_mail', $to, $subject, $message, $headers);
			$nt_site_message = __('Your message has been sent.', 'theme_front');
		} else {
			$nt_site_message = __('There are something wrong.', 'theme_front');
		}
	}
?>



<div class="main-content">
<div class="row">

<?php if(isset($_REQUEST['compare-with'])): ?>
	<div class="large-6 columns compare-left">
		<div class="section"><?php nt_single_property($post->ID, true); ?></div>
	</div>
	<div class="large-6 columns compare-right">
		<div class="section"><?php nt_single_property($_REQUEST['compare-with'], true); ?></div>
	</div>
<?php else: ?>

	<?php if(nt_get_option('property', 'single_layout', 'sidebar') == 'sidebar-left'): ?>
		<div class="large-8 large-push-4 columns">
	<?php elseif(nt_get_option('property', 'single_layout', 'sidebar') == 'full-width'): ?>
		<div class="large-12 columns">
	<?php else: ?>
		<div class="large-8 columns">
	<?php endif; ?>

	<div class="section">
		<?php
		if(post_password_required()) {
			the_content();
		} else {
			nt_single_property($post->ID);
		}
		?>
	</div>
	</div>

	<?php if(nt_get_option('property', 'single_layout', 'sidebar') != 'full-width'): ?>
		<?php if(nt_get_option('property', 'single_layout', 'sidebar') == 'sidebar'): ?>
			<aside class="sidebar large-4 columns">
		<?php else: ?>
			<aside class="sidebar sidebar-left large-4 large-pull-8 columns">
		<?php endif; ?>
		<div class="section">
			<?php if ( dynamic_sidebar( 'property' ) ); ?>
		</div>
		</aside>
	<?php endif; ?>

<?php endif; ?>

</div><!-- .row -->
</div><!-- #content -->

<?php get_footer(); ?>
