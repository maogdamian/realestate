jQuery(document).ready(function ($) {
	'use strict';

	// FitVids
	$('fitvids').fitVids();

	// Search
	$('.header-top .search-button').click(function (e) {
		e.preventDefault();
		$('.search-box').toggleClass('active');
		if ($('.search-box').hasClass('active')) {
			$('.search-box input').focus();
		}
	});
	$('.search-box .close-button').click(function (e) {
		e.preventDefault();
		$('.search-box').removeClass('active');
	});

	// Message Mask
	$('.message-mask i').click(function (e) {
		e.preventDefault();
		$(this).parents('.message-mask').addClass('inactive');
	});

	// Sticky
	$('.header-wrap.sticky-on').sticky({ topSpacing: $('.header-top').outerHeight() * -1 });

	// Match Height
	$('.card, .mega-menu > .sub-menu > li').matchHeight(true);



	// Wrap Input Submit
	$('input[type="submit"].lt-button').wrap('<span class="lt-button-wrap"></span>');

	// Property Compare
	$('.property-compare-form select').change(function (e) {
		$(this).parents('form').submit();
	});

	// DSIDX
	$('.dsidx-controls a').click(function (e) {
		e.preventDefault();
		$(this).siblings('a').removeClass('active');
		$(this).addClass('active');
	});
	$('.dsidx-contact-form').addClass('nt-form');
	$('.dsidx-resp-search-form input[type="submit"], #dsidx-contact-form-submit').addClass('lt-button primary');

	// Mobile
	$('header .menu-toggle').click(function (e) {
		$('.layout-wrap').toggleClass('mobile-menu-active');
		$(this).toggleClass('active');
	});
	$('.mobile-menu li.menu-item-has-children > a, .widget_nav_menu li.menu-item-has-children > a').append('<i class="toggle flaticon-bottom4"></i>');
	$('.mobile-menu li i.toggle').click(function (e) {
		e.preventDefault();
		$(this).parents('a').siblings('ul').toggle();
	});
	$('.widget_nav_menu li i.toggle').click(function (e) {
		e.preventDefault();
		$(this).parents('a').siblings('ul').toggle();
	});

	// Image Upload
	$('.upload-img .remove-bt').click(function (e) {
		e.preventDefault();
		$(this).parents('.upload-img').remove();
	});
	$('.repeat-field-bt').click(function (e) {
		e.preventDefault();
		$(this).siblings('.clone').before($(this).siblings('.clone').clone().show().removeClass('clone'));
	});

	// Location Picker
	$('.location-picker').each(function () {
		$(this).locationpicker({
			location: { latitude: $(this).data('latitude'), longitude: $(this).data('longitude') },
			scrollwheel: false,
			enableAutocomplete: true,
			radius: 0,
			inputBinding: {
				latitudeInput: $(this).parent().find('.latitude'),
				longitudeInput: $(this).parent().find('.longitude'),
				radiusInput: null,
				locationNameInput: $(this).parent().find('.location')
			},
		});
	});

	// Wish List
	$('.add-wish-list').click(function (e) {
		e.preventDefault();
		var current = $(this);
		var data = {
			action: 'do_favourite',
			params: $(this).data()
		};
		$.post(ajaxurl, data, function (response) {
			if ('ok' == response.result) {
				$(current).toggleClass('active');
			}
		}, 'json');
	});

	// Numberic
	$('.numeric').numeric();

	// Select2
	$('select').not('.ihf-container select').addClass('select2');
	$('.select2').select2({});

	function formatProperty(state) {
		if (!state.id) { return state.text; }
		var $state = $(
			'<span><img src="' + $(state.element).data('img') + '" /> ' + state.text + '</span>'
		);
		return $state;
	};
	$('.property-select2').select2({
		templateResult: formatProperty
	});

	// Range Slider
	var inputFormat = wNumb({
		decimals: 0
	});
	var viewFormat = wNumb({
		decimals: 0,
		thousand: ',',
		mark: '.'
	});
	var defaults = {
		start: [0, 9999999],
		range: {
			'min': 0,
			'max': 100
		},
		connect: true
	};
	$('.rangeSlider').each(function () {
		var options = $.extend({}, defaults, $(this).data());
		viewFormat = wNumb({
			decimals: 0,
			thousand: $(this).data('thousands-sep'),
			mark: $(this).data('decimal-point')
		});

		if ($(this).data('min') >= 0) options['range']['min'] = $(this).data('min');
		if ($(this).data('max') >= 0) options['range']['max'] = $(this).data('max');
		if ($(this).data('cmin') >= 0) options['start'][0] = $(this).data('cmin');
		if ($(this).data('cmax') >= 0) options['start'][1] = $(this).data('cmax');
		$(this).noUiSlider(options);
		$(this).Link('lower').to($(this).siblings('.lower'), null, inputFormat);
		$(this).Link('upper').to($(this).siblings('.upper'), null, inputFormat);
		$(this).Link('lower').to($(this).siblings('label').find('.lower span'), null, viewFormat);
		$(this).Link('upper').to($(this).siblings('label').find('.upper span'), null, viewFormat);
	});

	// Primary Nav Left & Right
	if ($('#primary-nav-left').length && $('#primary-nav-right').length) {
		if ($('#primary-nav-left').width() < $('#primary-nav-right').width()) {
			$('#primary-nav-left').width($('#primary-nav-right').width());
		} else {
			$('#primary-nav-right').width($('#primary-nav-left').width());
		}
	}

	// AJAX Form
	$('.ajax-form').ajaxForm({
		dataType: 'json',
		beforeSubmit: function (arr, $form, options) {
			$('button .text', $form).hide();
			$('button .spinner', $form).show();
		},
		success: function (data, statusText, xhr, $form) {
			$('button .text', $form).show();
			$('button .spinner', $form).hide();

			$('.form-response', $form).hide().html(data.result).fadeIn();
			$form[0].reset();
		}
	});


	// Mega menu position
	$('.header-main .primary-nav li.mega-menu > ul').each(function () {
		var parentOffset = $(this).parents('li.mega-menu').offset();
		var parentWidth = $(this).parents('li.mega-menu').outerWidth();
		var containerOffset = $(this).parents('.columns').offset();
		var containerWidth = $(this).parents('.columns').width();
		var containerPadding = parseInt($(this).parents('.columns').css('padding-left').replace('px', ''));
		if ($('body').hasClass('rtl')) {
			$(this).css('left', (Math.round(parentOffset.left - (containerOffset.left + containerPadding)) * -1) + 'px');
			$(this).css('right', 'auto');
		} else {
			var dif = (parentOffset.left + parentWidth) - (containerOffset.left + containerPadding + containerWidth);
			$(this).css('right', Math.round(dif) + 'px');
		}

	});

	// 3rd level menu position
	$('.primary-nav > ul > li:not(.mega-menu)').mouseover(function () {
		$('.sub-menu .sub-menu', $(this)).each(function () {
			if ($('body').hasClass('rtl')) {
				$(this).css('right', $(this).parents('.sub-menu').outerWidth() - 2);
			} else {
				$(this).css('left', $(this).parents('.sub-menu').outerWidth() - 2);
			}
		});
	});

	// NAV
	$('#primary-nav .bt-menu-trigger').click(function (e) {
		e.preventDefault();
		if ($(this).hasClass('bt-menu-open')) {
			$(this).removeClass('bt-menu-open');
			$('#primary-nav').removeClass('active');
			$('#primary-nav ul.menu').slideUp('fast');
		} else {
			$(this).addClass('bt-menu-open');
			$('#primary-nav').addClass('active');
			$('#primary-nav ul.menu').slideDown('fast');
		}
	});

	// Form
	$('.validate-form').each(function () {
		if ($(this).is('form')) {
			var curForm = $(this);
		} else {
			var curForm = $('form', $(this));
		}
		$(curForm).validate({
			errorPlacement: function (error, element) {
				if (!$('.form-response label', curForm).is(':visible')) {
					$('.form-response', curForm).html(error).fadeIn();
				}
			}
		});
	});

	// Modal
	$('.modal-link').click(function (e) {
		e.preventDefault();
		$('.modal-mask').addClass('active');
		$('.modal-mask').find('.' + $(this).data('modal')).addClass('active');
		$('.modal-mask').find('.' + $(this).data('modal')).find('.tab-list li:first-child a').trigger('click');
	});
	$('.modal-mask .close-bt').click(function (e) {
		e.preventDefault();
		$(this).parents('.modal-mask').removeClass('active');
		$(this).parents('.modal').removeClass('active');
	});

	// Carousel
	var defaults = {
		navText: ['<i class="flaticon-arrow395"></i>', '<i class="flaticon-move13"></i>'],
		responsiveRefreshRate: 50
	};
	imagesLoaded($('.lt-carousel'), function (instance) {
		$('.lt-carousel').each(function () {
			var options = $.extend({}, defaults, $(this).data());
			options.responsive = {
				0: { items: $(this).data('s-items') },
				640: { items: $(this).data('m-items') },
				1025: { items: $(this).data('items') }
			}

			if (options.loop && $(this).children().length == 1) {
				options.loop = false;
			}

			$(this).owlCarousel(options);
			if ($(this).data('bg')) {
				$(this).on('changed.owl.carousel', function (event) {
					var index = event.item.index;

					if (options.loop) {
						index = (index - 2);
						if (index < 0) index = event.item.count - 1;
						if (index == event.item.count) index = 0;
					}
					// console.log(event.item.index+' : '+index);

					$($(this).data('bg')).find('.item.active').removeClass('active');
					$($(this).data('bg')).find('.item').eq(index).addClass('active');

				});
			}
		});

		$('.lt-carousel').on('changed.owl.carousel', function (event) {
			var options = $.extend({}, defaults, $(this).data());
			var index = event.item.index;

			if (options.loop) index = (index - 2) % event.item.count;
			if ($($(this).data('nav-thumb')).length) {
				$('li', $(this).data('nav-thumb')).removeClass('active');
				$($(this).data('nav-thumb')).find('li').eq(index).addClass('active');
			}
		});

		$('.thumb-nav li:first-child').addClass('active');
		$('.thumb-nav li').click(function () {
			$($(this).parents('.thumb-nav').data('nav-thumb')).trigger('to.owl.carousel', [$(this).index(), null, true]);
		});


	});

	imagesLoaded($('body'), function (instance) {
		// Swipe Box
		$('.swipebox').swipebox();
	});

	// Accordion
	$('.wpb_accordion').each(function () {
		if ($(this).data('active-tab')) {
			$('.wpb_accordion_section:eq(' + ($(this).data('active-tab') - 1) + ')', $(this)).addClass('active');
		}
	});
	$('.wpb_accordion_header').click(function () {
		if ($(this).parents('.wpb_accordion_section').hasClass('active')) {
			if ($(this).parents('.wpb_accordion').data('collapsible') == 'no' && $(this).parents('.wpb_accordion').find('.wpb_accordion_section.active').length <= 1)
				return;

			$(this).parents('.wpb_accordion_section').removeClass('active');
			$(this).parents('.wpb_accordion_section').find('.wpb_accordion_content').slideUp(250);
		} else {
			$(this).parents('.wpb_accordion').find('.wpb_accordion_section.active').removeClass('active');

			$(this).parents('.wpb_accordion_section').addClass('active');
			$(this).parents('.wpb_accordion_section').find('.wpb_accordion_content').slideDown(250);
		}
	});
	// Tab
	$('.vc_tta-tabs').each(function () {
		$('.vc_tta-panel', $(this)).first().addClass('vc_active');
		$('.vc_tta-tabs-list li:first-child').addClass('vc_active');
	});
	$('.vc_tta-tabs-list li').click(function (e) {
		e.preventDefault();
		if (!$(this).hasClass('vc_active')) {
			var index = $(this).index();
			$(this).addClass('vc_active');
			$(this).siblings('li.vc_active').removeClass('vc_active');
			$('.vc_tta-panel', $(this).parents('.vc_tta-tabs')).removeClass('vc_active');
			$('.vc_tta-panel:eq(' + index + ')', $(this).parents('.vc_tta-tabs')).addClass('vc_active');
		}
	});
	$('.tab-list a').click(function (e) {
		e.preventDefault();
		$(this).parents('.tab-list').find('li').removeClass('active');
		$(this).parents('li').addClass('active');
		$(this).parents('.tab-list').siblings('.pane').removeClass('active');
		$(this).parents('.tab-list').siblings('.pane.' + $(this).data('pane')).addClass('active');
	});

	// Transition Animate
	$('.wpb_animate_when_almost_visible').one('inview', function () {
		var delay = 150 + (600 * $(this).prevAll('.wpb_animate_when_almost_visible').length);
		$(this).delay(delay).queue(function () {
			$(this).addClass('animate-active').dequeue();
		});
	});

	// Animate Number
	$('.animate-number').html('0');
	var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',');
	$('.animate-number').one('inview', function () {
		var start = $(this).data('to') - 100;
		if (start < 0) start = 0;
		$(this).prop('number', start).animateNumber({
			number: $(this).data('to'),
			numberStep: comma_separator_number_step,
			easing: 'easeOutQuad'
		}, 1000);
	});

	// Toggle
	$('.wpb_toggle').click(function (e) {
		e.preventDefault();
		$(this).toggleClass('active');
		$(this).next('.wpb_toggle_content').toggleClass('active');
	});

	// Trigger Form
	$('.property-view-form select').change(function (e) {
		window.location.href = $(this).val();
	});

	// Map
	var maps = [];
	$('.map-wrap').each(function () {
		$(this).attr('id', 'map-' + Math.floor(Math.random() * 100));
		var markers = $(this).children();
		var latlng = new google.maps.LatLng(-34.397, 150.644);
		var defaults = {
			center: latlng,
			zoomControl: true,
			scaleControl: false,
			streetViewControl: false,
			panControl: false,
			mapTypeControl: false,
			overviewMapControl: false,
			scrollwheel: false,
			zoom: 5,
			maxZoom: 18,
			clickableIcons: false,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.LARGE,
				position: google.maps.ControlPosition.RIGHT_TOP
			}
		};
		var options = $.extend({}, defaults, $(this).data());
		var map = new google.maps.Map($(this).get(0), options);
		maps[$(this).attr('id')] = map;
		google.maps.event.addListener(map, 'idle', function () {
			$('.gm-style').removeClass('gm-style');
		});

		// Marker
		var mks = [];
		var latlngbounds = new google.maps.LatLngBounds();
		for (var i = 0; i < markers.length; i++) {
			var marker_data = $(markers[i]).data();
			var latlng = new google.maps.LatLng(marker_data.latitude, marker_data.longitude);
			var marker_content = '<div class="marker center-marker" data-lat="' + marker_data.latitude + '" data-lng="' + marker_data.longitude + '"><div class="dot"></div></div>';
			if (marker_data.content) marker_content = '<div class="marker" data-lat="' + marker_data.latitude + '" data-lng="' + marker_data.longitude + '"><div class="dot"></div></div><div class="info-box ' + marker_data.active + '">' + marker_data.content + '</div>';
			var richMarker = new RichMarker({
				position: latlng,
				flat: true,
				anchor: RichMarkerPosition.MIDDLE,
				map: map,
				content: marker_content
			});
			latlngbounds.extend(latlng);
			mks.push(richMarker);
		}
		var mcOptions = { maxZoom: 15, imagePath: object_name.templateUrl + '/image/cluster/m' };
		var markerCluster = new MarkerClusterer(map, mks, mcOptions);
		map.fitBounds(latlngbounds);
		// map.setZoom(options['zoom']);

		google.maps.event.addListenerOnce(map, "idle", function () {
			console.log(options['zoom']);
			if (options['zoom'] >= 0) map.setZoom(options['zoom']);
		});

		if (options.style == 'bw') {
			var styles = [
				{
					stylers: [
						{ saturation: -100 }
					]
				}];
			map.setOptions({ styles: styles });
		}

	});

	$(document).on('click', '.marker', function (e) {
		e.preventDefault();
		e.stopPropagation();

		if ($(this).hasClass('center-marker')) return;
		if (!$(this).siblings('.info-box').hasClass('active')) {
			$('.map-wrap .info-box.active').removeClass('active');

			var map = maps[$(this).parents('.map-wrap').attr('id')];
			var center = new google.maps.LatLng($(this).data('lat'), $(this).data('lng'));
			map.panTo(center);
			map_recenter(center, 0, -120, map);
		} else {

		}
		$(this).siblings('.info-box').toggleClass('active');
	});



	// Sharrre
	jsSocials.shares.print = {
		label: "Print",
		logo: "nt-icon-doc-inv",
		shareUrl: "javascript:window.print()",
		countUrl: ''
	};
	$(".share-box").jsSocials({
		showLabel: false,
		showCount: true,
		shares: [
			{
				share: "facebook",
				logo: 'nt-icon-facebook'
			},
			{
				share: "twitter",
				logo: 'nt-icon-twitter'
			},
			{
				share: "googleplus",
				logo: 'nt-icon-gplus'
			},
			{
				share: "pinterest",
				logo: 'nt-icon-pinterest-circled'
			},
			{
				share: "email",
				logo: 'nt-icon-mail-alt'
			},
			{
				share: "print"
			}
		]
	});



	// Compare
	$('.compare-form select').on('change', function () {
		$(this).parents('form').submit();
	});
});

function map_recenter(latlng, offsetx, offsety, map) {
	var point1 = map.getProjection().fromLatLngToPoint(
		(latlng instanceof google.maps.LatLng) ? latlng : map.getCenter()
	);
	var point2 = new google.maps.Point(
		((typeof (offsetx) == 'number' ? offsetx : 0) / Math.pow(2, map.getZoom())) || 0,
		((typeof (offsety) == 'number' ? offsety : 0) / Math.pow(2, map.getZoom())) || 0
	);
	map.panTo(map.getProjection().fromPointToLatLng(new google.maps.Point(
		point1.x - point2.x,
		point1.y + point2.y
	)));
}
