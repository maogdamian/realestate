<?php
	$message = null;

	// Call by URL with "fn" param
	if( isset( $_REQUEST['import_options'] ) ) {
		$message = nt_import_options();
	}
	if( isset( $_REQUEST['reset_options'] ) ) {
		$message = nt_reset_options();
	}
	if( isset( $_REQUEST['import_content'] ) ) {
		?>
		<script type="text/javascript">
		jQuery(document).ready(function($) {
			var data = {
				action: 'nt_ajax_import_content',
				options: <?php echo "'".$_REQUEST['import_options_file_name']."'"; ?>
			};
			$('#theme-box-wrap .start').show();
			$('#theme-box-wrap .wait').show();
			$.post(ajaxurl, data, function(response) {
			    if('ok' == response.result){
			    	$('#theme-box-wrap .wait').hide();
			    	$('#theme-box-wrap .done').show();
			    } else {
			    	$('#theme-box-wrap .wait').hide();
			    	$('#theme-box-wrap .fail').show();
			    }
			}, 'json');
		});
		</script>
		<div id="theme-box-wrap">
			<div class="start" style="display:none;">
				<p><i class="nt-icon-download"></i> Importing Demo Content ...</p>
			</div>
			<div class="wait" style="display:none;"><p><i class="nt-icon-cog spin"></i> Please wait ...</p></div>
			<div class="fail" style="display:none;">
				<p><i class="nt-icon-cancel"></i> Importing demo content failed, something wrong occur.</p>
				<p><a href="<?php echo admin_url(); ?>themes.php?page=theme_options" class="button-primary">Theme Options</a></p>
			</div>
			<div class="done" style="display:none;">
				<p><i class="nt-icon-ok"></i> Importing demo content has been done.</p>
				<p><a href="<?php echo get_site_url(); ?>" class="button-primary">Visit Website</a></p>
			</div>
		</div>
		<?php
		return;
	}
	if( isset( $_REQUEST['import_fontello'] ) ) {
		$message =  nt_import_fontello();
	}

	function nt_import_fontello() {
		if( $_FILES['import_fontello_file']['name'] != "" ) {
			$upload_overrides = array( 'test_form' => false );
			$movefile = wp_handle_upload( $_FILES['import_fontello_file'], $upload_overrides );

			if( !$movefile ) return 'Error, there is an issue in upload process';
			// var_dump($movefile);

			if( $movefile['type'] != 'application/zip' ) return 'Error: incorrect file format (require zip file)';

			WP_Filesystem();
			global $wp_filesystem;
			$destination = wp_upload_dir();
			$unzip_path = $destination['basedir'].'/nt_custom_icon';
			$unzipfile = unzip_file( $movefile['file'], $unzip_path);

			if(!$unzipfile) return 'Error, there is an issue in unzip process';

			$zip = zip_open($movefile['file']);
			$zip_entry = zip_read($zip);
			$font_folder = basename(zip_entry_name($zip_entry));
			$font_config = $wp_filesystem->get_contents( $unzip_path.'/'.$font_folder.'/config.json' );

			if(!$font_config) return 'Error, config.json not found';

			$font_config_json = json_decode($font_config);
			$font_name = $font_config_json->name;
			if($font_name == '') $font_name = 'fontello';

			$options = get_option(THEME_SLUG . '_options');

			if(array_key_exists('custom_icon', $options['advance'])) {
				$custom_icon_array = $options['advance']['custom_icon'];
				foreach($custom_icon_array as $key => $custom_icon_item) {
					if (strpos($custom_icon_item,'|'.$font_folder) !== false) {
						unset($custom_icon_array[$key]);
					}
				}
			}

			$custom_icon_array[] = '|'.$font_name.'|'.$font_folder;
			$options['advance']['custom_icon'] = $custom_icon_array;
			update_option(THEME_SLUG . '_options', $options);

			return 'Success: Custom Fontello Icon Imported';
		}
	}

	function nt_import_options() {
		if( $_FILES['import_options_file']['name'] != "" ) {
			$upload_overrides = array( 'test_form' => false );
			$movefile = wp_handle_upload( $_FILES['import_options_file'], $upload_overrides );
			if ( $movefile ) {
				$options = unserialize(  file_get_contents($movefile['file'] ) );
				update_option(THEME_SLUG . '_options', $options);
				return 'Admin Options Imported';
			} else {

			}
		}
	}

	function nt_reset_options() {
		delete_option( THEME_SLUG . '_options' );
		return 'Success: theme options have been reset';
	}
?>

<div id="theme-box-wrap">

	<?php if( $message ): ?>
		<div class="theme-box-message"><?php echo $message; ?></div>
	<?php endif; ?>

	<form id="theme-options-form" enctype="multipart/form-data" method="post">

	<div id="theme-box" class="wrap">

		<div id="theme-box-head">

			<h2>Theme Options</h2>

		</div>

		<div id="theme-box-body" class="clearfix">

			<div id="theme-box-tabs">
				<ul>
					<?php
					$counter = 0;
					foreach( $sections as $section_slug => $section ): ?>
						<li class="<?php echo ($counter++ == 0) ? 'active' : ''; ?>"><a href="#<?php echo esc_url($section_slug); ?>"><i class="<?php echo esc_attr($section['icon']); ?>"></i> <?php echo $section['name']; ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div id="theme-box-content">

				<?php
					foreach( $sections as $section_slug => $section ){
						$s_file = locate_template( THEME_OPTIONS_DIR.'/' . $section_slug . '.php');
						$section = include_once($s_file);
						$nt_input_tool = new nt_input_tool( $section['options'], $section['config'] );
						$nt_input_tool->generate_theme_option();
					}
				?>

			</div>

		</div>


		<div id="theme-box-foot">
			<input type="submit" name="reset_options" value="<?php echo 'Reset Options'; ?>" class="button" id="theme-options-reset-confirm" data-confirm="Are you sure that you want to reset all theme options to default value?" />
			<input type="button" name="save" value="<?php echo 'Save Options'; ?>" class="button-primary" id="theme-options-save" />
		</div>

		<div class="notification-box notification-ok">
			<?php echo 'options saved'; ?>
		</div>

	</div>
	</form>

</div> <!-- #theme-box-wrap -->



<?php
	// Autosave
	if( isset( $_REQUEST['save'] ) ) : ?>
	<script type="text/javascript">
		var nt_option_auto_save = true;
	</script>
<?php endif; ?>
