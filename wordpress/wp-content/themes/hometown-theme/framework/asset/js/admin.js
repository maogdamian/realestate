function register_base_admin($) {
	var scope = null;
	if(arguments.length > 1) {
		scope = arguments[1];
	} else {
		scope = $(document);
	}

	

	// VC Icon
    $('body').on('click', '.icon-item', function(e){
        e.preventDefault();
        $(this).siblings('.icon-item.active').removeClass('active');
        $(this).addClass('active');
        $(this).parents('.nt_icon_block').find('.wpb_vc_param_value').val($(this).data('id'));
        $(this).parents('.nt_icon_block').find('.cur-icon').html($(this).html());
        $(this).parents('.nt_icon_block').find('.icon-list-box').hide();
    });
    $('body').on('click', '.icons-select', function(e){
        e.preventDefault();
        $(this).parents('.nt_icon_block').find('.icon-list-box').toggle();
    });

	// Custom Font
	scope.find('.nt-custom-icon-list i').click(function(){
		$(this).parents('li').remove();
	});

	// Numberic
	$('.numeric').numeric();

	// Icon Box
	scope.find('.nt-theme-icon-box .item').click(function(){
		$(this).addClass('active');
		$(this).siblings('.item').removeClass('active');
		$(this).parents('.nt-theme-icon-box').siblings('input').val($(this).data('val'));
	});

	// Location Picker
	scope.find('.location-picker').each(function(){
		var zoom = $(this).data('zoom');
		var cur = $(this);
		if(!zoom) zoom = 15;
		$(this).locationpicker({
			location: {latitude: $(this).data('latitude'), longitude: $(this).data('longitude')},
			scrollwheel: false,
			enableAutocomplete: true,
			radius: 0,
			zoom: zoom,
			inputBinding: {
		    	latitudeInput: $(this).siblings('.latitude'),
		    	longitudeInput: $(this).siblings('.longitude'),
		    	radiusInput: null,
		    	locationNameInput: $(this).siblings('.location'),
		    	zoomLevelInput: $(this).siblings('.zoom')
		    },
		});
		var mapContext = $(this).locationpicker('map');
		console.log(mapContext.map.getZoom());
		$(this).siblings('.zoom').val(mapContext.map.getZoom());

		google.maps.event.addListener(mapContext.map, 'zoom_changed', function() {
			$(cur).siblings('.zoom').val(mapContext.map.getZoom());
		});

	});

	// Disable Enter on theme option form
	$('#theme-options-form input, #theme-options-form select').on("keyup keypress", function(e) {
	  var code = e.keyCode || e.which; 
	  if (code  == 13) {               
	    e.preventDefault();
	    return false;
	  }
	});

	// 2 Click Confirm Bt
	scope.find('.button').click(function(){
		if($(this).data('confirm'))
		if(window.confirm($(this).data('confirm'))) {
			if($(this).hasClass('first-click')) {
				$(this).siblings('.second-click').show();
				$(this).hide();
			}
			return true;
		} else {
			return false;
		}
     	
	});

	// Input File
	scope.find('.input-file-wrap').each(function(){
		$('.input-file-bt', $(this)).click(function(e){
			e.preventDefault();
			$(this).siblings('.input-file-real').trigger('click');
		});
		$('.input-file-real', $(this)).change(function(){
			$(this).siblings('.input-file-bt').hide();
			$(this).siblings('.input-file-name').html($(this).val());
		});
	});

	// On-Off
	scope.find('.input-on-off').iphoneStyle();

	// Toggle Group
	scope.find('.input-on-off[toggle]').change(function(event, recursive){
		// console.log( 'on-off: ' + $(this).is(':checked'));
		if( $(this).is(':checked') ) {
			$('.input-list.' + $(this).attr('toggle') ).show();
			$( $('.input-on-off, .input-radio', '.input-list.' + $(this).attr('toggle')).get().reverse() ).trigger('change');
		} else {
			$('.input-list.' + $(this).attr('toggle') ).hide();
		}
	});
	scope.find('.input-radio[toggle]').change(function(event, recursive){
		if( $(this).is(':checked') ) {
			$('.input-list.' + $(this).attr('toggle') ).hide();
			$('.input-list.' + $(this).attr('toggle') + '-' + $(this).attr('value') ).show();
			$( $('.input-on-off, .input-radio', '.input-list.' + $(this).attr('toggle') + '-' + $(this).attr('value')).get().reverse() ).trigger('change');
		}
	});
	scope.find('.input-select[toggle]').change(function(event, recursive){
		$('.input-list.' + $(this).attr('toggle') ).hide();
		$('.input-list.' + $(this).attr('toggle') + '-' + $(this).attr('value') ).show();	
	});
	// Hide Toggle Group
	scope.find( $('.input-on-off, .input-radio, .input-select').get().reverse() ).trigger('change');
	
	// Color
	scope.find('.input-color').each(function(){
		$(this).iris({
		    hide: true,
		    palettes: ['#ad0000', '#ff6600', '#70b001', '#00ad8d', '#008abc', '#600089', '#bc0054', '#333333'],
		    change: function(event, ui) {
		        $("#headlinethatchanges").css( 'color', ui.color.toString());
		        $(this).siblings('.color-indicator').css('background-color', ui.color.toString());
		    }
		});
	});
	$(document).on('mousedown', function(ev){
		if ( $(ev.target).closest('.iris-picker').length == 0
			&& $(ev.target).siblings('.iris-picker').length == 0 ) {
			$('.iris-picker').hide();
		}
	});
	$('.input-color').focus(function(){
		$(this).iris('show');
	});
	
	// Date
	/*
	scope.find('.input-date').each(function(){
		var cur_input = $(this);
		$(this).datepicker().on('changeDate', function(ev){
			$(cur_input).siblings('.input-date-value').val( ev.date.valueOf()/1000 - ev.date.getTimezoneOffset() * 60 );
		});
	});
	*/
	
	// Range
	scope.find('.input-range').each(function(){
		var defaults = {
			range: '0,10',
			step: 1,
			snap: true
		};
		var options = $.extend({}, defaults, $(this).data());
		options.range = options.range.split(',');
		$(this).simpleSlider(options);
		$(this).bind("slider:changed", function (event, data) {
	 		$(this).siblings('.input-range-value').html(data.value.toFixed(2));
		});
	});
	
	// Radio Image
	scope.find('.radio-img-list label').click(function(){
		$('.radio-img-list label', $(this).parents('.input-field') ).removeClass('active');
		$(this).addClass('active');
	});
	
	// Checkbox Image
	scope.find('.checkbox-img-list input[type="checkbox"]').change(function(){
		$(this).is(':checked') ? $(this).siblings('label').addClass('active') : $(this).siblings('label').removeClass('active');
	});
	
	// Theme Box
	scope.find('#theme-box-tabs ul li').click(function(e){
		e.preventDefault();
		if( ! $(this).hasClass('active') ){
			$('#theme-box-tabs ul li').removeClass('active');
			$(this).addClass('active');
			$('#theme-box-content .theme-box-content-pane').removeClass('active').hide();
			$('#theme-box-content .theme-box-content-pane:eq('+$(this).index()+')').addClass('active').show();
		}
	});
	
	// Option Box save button
	scope.find('#theme-options-save').click(function(){
		$('.notification-box').css('top', $(window).scrollTop() + 100).html('<i class="nt-icon-clock-1"></i> saving').stop(true, true).fadeIn();
		var current = $(this);
		var data = {
			action: 'nt_ajax_save_option',
			options: $('#theme-options-form').serialize()
		};
		
		$.post(ajaxurl, data, function(response) {
		    if('ok' == response.result){
		    	$('.notification-box').html('<i class="nt-icon-ok"></i> success').delay(1000).fadeOut('slow');
		    } else {
		    	$('.notification-box').html('<i class="nt-icon-attention-circled"></i> fail').delay(1000).fadeOut('slow');
		    }
		}, 'json');
	});
	if(typeof nt_option_auto_save !== 'undefined') $('#theme-options-save').trigger('click');
	
	// Stack
	// Add the new stack
	scope.find('.stack_add_button').click( function() {
		try {
			var parent = $(this).closest('.stack_menu').parent();
			var selected_option = $(this).closest('.stack_menu').children('select.stack_select_template').find('option:selected');
			var container = parent.children('.stack_container');
			var hidden = parent.children('input:hidden:first');
			
			// defind unique
			var stack_id = generate_stack_id(container);
			var option = selected_option.attr('opt');
			var config = selected_option.attr('conf');
			var subgroup = $(this).attr('subgroup');

			// Remove Stack Dummy
			$('.dummy-stack', container).remove();

			var data = {
				'action': 'nt_ajax_generate_stack_option',
				'stack_id': stack_id,
				'config': config,
				'option': option,
				'subgroup': subgroup,
			};

			$.post(ajaxurl, data, function(response) {
				container.append(response);
				
				// register the event handler
				var new_stack = container.children(':last');
				register_base_admin($, new_stack);
			});
		} catch (e) {
			alert(e);
		}
	});
	
	scope.find('.stack_container').sortable({
		item: '.stack',
		handle: '.nt-icon-align-justify',
		axis: 'y'
	});
	scope.find('.stack_remove_button').click(function(){
		$(this).closest('.stack').remove();
	});
	scope.find('.stack_duplicate_button').click(function(e){
		e.stopPropagation();
		var clone_stack = $(this).closest('.stack').clone(true);
		$(this).closest('.stack').after(clone_stack);
		// register_base_admin($, clone_stack);
	});
	scope.find('.stack_header').click( function(){
		$(this).siblings('.inside').toggle();
	});
	scope.find('[id*="stack_title"]').change(function(){
		var stack_title = '';
		if( $(this).val() != '' ) {
			if( $(this).is('select') ) {
				stack_title = '- ' + $('option:selected', $(this)).text();
			} else if( $(this).is('[type="radio"]') ) {
				if( $(this).is(':checked') ) stack_title = '- ' + $(this).val();
			} else {
				stack_title = '- ' + $(this).val();
			}
		}
		$(this).closest('.stack').find('.stack_header_name').first().html(stack_title);
	});
	scope.find('[id*="stack_title"]').keyup(function(){
		$(this).trigger('change');
	});
	scope.find('[id*="stack_title"]').trigger('change');

	function generate_stack_id(stack_container){
		var stack_id = 0;
		stack_container.find('input:hidden.stack_id').each(function(){
			var used_id = parseInt($(this).attr('value'));
			if(stack_id<=used_id){
				stack_id = used_id + 1;
			}
		});
		return stack_id;
	}

	// Media Uploader
	scope.find('.images_container').sortable();
	scope.find('.images_add_button').on('click', function(e){
		var multi = ($(this).attr('multi') == 'yes') ? true : false;
		var frame = wp.media({
			//title : 'Pick the images for this work',
			multiple : multi,
			library : { type : 'image'},
			button : { text : 'Choose' },
		});
		var button = $(this);
		frame.on('select',function() {
			// get selections and save to hidden input plus other AJAX stuff etc.
			var selected_images =  JSON.parse(JSON.stringify(frame.state().get('selection')));

			var images_container = button.closest('td.input-field').find('.image_container');
			var name = button.data('field-name');
			
			// xdebug(selected_images);

			for(var i=0,l=selected_images.length; i<l; i++){
				if(multi){
					for(var size_name in selected_images[i].sizes){
						images_container.append('<div class="uploaded-image" attachment_id="' + selected_images[i].id + '" style="float: left;"><input type="hidden" name="' + name + '[]" value="' + selected_images[i].id + '" /><img src="' + selected_images[i].sizes[size_name].url + '"/><div class="image-action-box"><i class="nt-icon-cancel-circled"></i></div></div>');
						break;
					}
				} else {
					for(var size_name in selected_images[i].sizes){
						images_container.html('<div class="uploaded-image" attachment_id="' + selected_images[i].id + '" style="float: left;"><input type="hidden" name="' + name + '" value="' + selected_images[i].id + '" /><img src="' + selected_images[i].sizes[size_name].url + '"/><div class="image-action-box"><i class="nt-icon-cancel-circled"></i></div></div>');
						break;
					}
				}

				
			}
		});
		frame.on('open',function() {
			
		});
		frame.on('close',function() {
		});
		frame.open();
	});

	$(scope).on('click', '.nt-icon-cancel-circled', function(e){
		e.preventDefault();
		$(this).parents('.uploaded-image').fadeOut('fast', function(){
			$(this).remove();
		});
		$(this).parents('.uploaded-file').fadeOut('fast', function(){
			$(this).remove();
		});
	});
	scope.find('.uploaded-images-container').sortable({
		items : '.uploaded-image',
		cursor : 'move',
		placeholder : 'ui-sortable-placeholder'
	}).disableSelection();


	// Upload File
	scope.find('.file_add_button').on('click', function(e){
		var multi = false;
		var frame = wp.media({
			//title : 'Pick the images for this work',
			multiple : multi,
			// library : { type : 'video'},
			button : { text : 'Choose' },
		});
		var button = $(this);
		frame.on('select',function() {
			// get selections and save to hidden input plus other AJAX stuff etc.
			var selected_images =  JSON.parse(JSON.stringify(frame.state().get('selection')));

			var images_container = button.closest('td.input-field').find('.uploaded-file-container');
			var name = button.data('field-name');
			console.log(selected_images);
			// xdebug(selected_images);

			for(var i=0,l=selected_images.length; i<l; i++){
				
				images_container.html('<div class="uploaded-file" attachment_id="' + selected_images[i].id + '"><input type="hidden" name="' + name + '" value="' + selected_images[i].id + '" />'+selected_images[i].url+'<div class="image-action-box"><i class="nt-icon-cancel-circled"></i></div></div>');
			}
		});
		frame.on('open',function() {
			
		});
		frame.on('close',function() {
		});
		frame.open();
	});
	
}

jQuery(document).ready(register_base_admin);