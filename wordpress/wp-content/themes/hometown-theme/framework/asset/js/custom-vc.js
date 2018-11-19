jQuery(document).ready(function($) {

	// Icon
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

    if(typeof vc != 'undefined')
    window.VcGapView = vc.shortcode_view.extend({
        changeShortcodeParams:function (model) {
            var params = model.get('params');
            window.VcTextSeparatorView.__super__.changeShortcodeParams.call(this, model);
            this.$el.find('.wpb_element_wrapper').prepend('<div class="middle-line"></div>');
        }
    });

    if(typeof vc != 'undefined')
    window.VcButtonView = vc.shortcode_view.extend({
        changeShortcodeParams:function (model) {
            var params = model.get('params');
            window.VcButtonView.__super__.changeShortcodeParams.call(this, model);
            if(params.align) {
                this.$el.find('.wpb_element_wrapper').removeClass('left right center').addClass(params.align);
            }
            if(params.color) {
                this.$el.find('.title').css('background-color', params.color).css('color', '#fff');
            } else {
                this.$el.find('.title').css('background-color', '').css('color', '');
            }
        }
    });



    if(typeof vc != 'undefined')
    window.VcIconListView = vc.shortcode_view.extend({
        changeShortcodeParams:function (model) {
            var params = model.get('params');
            window.VcIconListView.__super__.changeShortcodeParams.call(this, model);
            var wrapper = this.$el.find('.wpb_element_wrapper');
            if(params.icon) {
                wrapper.find('.wrap-icon').remove();
                var icon = $('<div class="wrap-icon"></div>');
                wrapper.prepend(icon);
                icon.append('<i class="'+params.icon+' nt-icon"></i>'); 
            } else {
                 wrapper.find('.wrap-icon').remove();
            }
        }
    });

    if(typeof vc != 'undefined')
    window.VcStatView = vc.shortcode_view.extend({
        changeShortcodeParams:function (model) {
            var params = model.get('params');
            window.VcStatView.__super__.changeShortcodeParams.call(this, model);
            var wrapper = this.$el.find('.wpb_element_wrapper');
            if(params.icon) {
                wrapper.find('.wrap-icon').remove();
                var icon = $('<div class="wrap-icon"></div>');
                wrapper.prepend(icon);
                icon.append('<i class="'+params.icon+' nt-icon"></i>');
            } else {
                 wrapper.find('.wrap-icon').remove();
            }
            if(params.number) {
                wrapper.find('.wrap-number').remove();
                var number = $('<div class="wrap-number">'+params.number+'</div>');
                wrapper.prepend(number);
            } else {
                 wrapper.find('.wrap-number').remove();
            }
        }
    });

    if(typeof vc != 'undefined')
    window.VcFeatureView = vc.shortcode_view.extend({
        changeShortcodeParams:function (model) {
            var params = model.get('params');
            // this.$el.find('.wpb_element_wrapper').html(params.foo);

            window.VcFeatureView.__super__.changeShortcodeParams.call(this, model);
            if (_.isObject(params)) {
                var wrapper = this.$el.find('.wpb_element_wrapper');
                
                if(params.icon) {
                    wrapper.find('.wrap-icon').remove();
                    var icon = $('<div class="wrap-icon"></div>');
                    wrapper.prepend(icon);
                    icon.append('<i class="'+params.icon+' nt-icon"></i>');
                } else {
                     wrapper.find('.wrap-icon').remove();
                }

                if(params.image) {
                    wrapper.find('.img-wrap').remove();
                    var image = $('<div class="img-wrap"></div>');
                    wrapper.prepend(image);
                    
                    $.ajax({
                      type:'POST',
                      url:window.ajaxurl,
                      data:{
                        action:'wpb_single_image_src',
                        content: params.image,
                        size: 'thumbnail'
                      },
                      dataType:'html'
                    }).done(function (url) {
                        image.css({backgroundImage: 'url(' + url + ')'});
                    });  
                } else {
                    wrapper.find('.img-wrap').remove();
                }
                
            }
        }
    });


});