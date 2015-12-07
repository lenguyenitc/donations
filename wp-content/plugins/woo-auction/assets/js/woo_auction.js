// Watcher
var Watcher = Watcher || {'options': {}, 'watch': {}};
jQuery.noConflict();
(function ($) {
    $.fn.once = function (id, fn) {
        if (typeof id != 'string') {
            // Generate a numeric ID if the id passed can't be used as a CSS class.
            if (!(id in cache)) {
                cache[id] = ++uuid;
            }
            // When the fn parameter is not passed, we interpret it from the id.
            if (!fn) {
                fn = id;
            }
            id = 'jquery-once-' + cache[id];
        }
        // Remove elements from the set that have already been processed.
        var name = id + '-processed';
        var elements = this.not('.' + name).addClass(name);
        return $.isFunction(fn) ? elements.each(fn) : elements;
    };

    Watcher.attach = function (context, options) {
        context = context || document;
        options = options || Watcher.options;
        // Execute all of them.
        $.each(Watcher.watch, function () {
            if ($.isFunction(this.attach)) {
                this.attach(context, options);
            }
        });
    };

    Watcher.detach = function (context, options, trigger) {
        context = context || document;
        options = options || Watcher.options;
        trigger = trigger || 'unload';
        // Execute all of them.
        $.each(Watcher.watch, function () {
            if ($.isFunction(this.detach)) {
                this.detach(context, options, trigger);
            }
        });
    };

    // Attach all watch.
    $(function () {
        Watcher.attach(document, Watcher.options);
    });
})(jQuery);
// End Watcher

!(function($){
	"use strict";

	Watcher.watch.jCountDown = {
        attach: function (context, settings) {
            $('.countdown', context).once('countdown', function() {
                var dataTime = $(this).data('datatime');
                var timeFormat = $(this).data('format');
                var extraData = $(this).data('extradata');
                
                // console.log(extraData);
                if (dataTime && timeFormat) {
                    $('.clock', $(this)).countdown(dataTime).on('update.countdown', function(event) {
                        $(this).html(event.strftime(timeFormat));
                    }).on('finish.countdown', function(event) {
                        
                        var self = this;
                        if(extraData.view == 'list') {
                            switch(extraData.status) {
                                case 'close': 
                                    $(self).countdown(extraData.date_end);
                                    $(self).parents('.wa-product-not-start').removeClass('wa-product-not-start');
                                    break;
                                case 'open':
                                    $(self).html('This auction has expired!');
                                    break;
                            }
                        }else if(extraData.view == 'single') {
                            switch(extraData.status) {
                                case 'close':
                                    $(self).countdown(extraData.date_end);
                                    if($('.wa-btn-content.wa-hidden').length > 0){
                                        $('.wa-btn-content').removeClass('wa-hidden');
                                        $(self).parents('.wa-product-not-start').removeClass('wa-product-not-start');
                                    }
                                    break;
                                case 'open':
                                    $(self).html('This auction has expired!');
                                    if( $('#wa-product-open-modal-bid-js').length > 0 ) {
                                        $('#wa-product-open-modal-bid-js').remove();
                                    }
                                    break;
                            }
                        }
                        
                    });
                }
            });
        }
    };

	$(function() {
        // setting page JS
        var $settings_wrap_wa = $('.settings_wrap_wa');
        if($settings_wrap_wa.length > 0) {
            $settings_wrap_wa.on('click', '.wa-setting-header-tab a', function(e){
                e.preventDefault();
                var $this = $(this),
                    tab_name = $this.data('keytab');

                if( $this.hasClass('active') ) return;

                $this.addClass('active').parent().siblings().find('a').removeClass('active');
                $settings_wrap_wa.find('.wa-setting-body-tab[data-keytab="'+tab_name+'"]')
                .addClass('active').siblings().removeClass('active');
            })
        }
        // end setting page JS

		if( $('.wa-field-dates').length > 0 ){
			$('.wa-field-dates').each(function(){
				$(this).datetimepicker({
					value: $(this).data('dates'),
					step: 10
				});
			})
		}

        if( $('.carousel').length > 0 ) {
             $('.carousel').carousel();
         }

        // wa-product-single-item-js
        var $wa_product_single_item_js = $('#wa-product-single-item-js');
        if( $wa_product_single_item_js.length > 0 ) {

            // wa-product-open-modal-bid-js
            $wa_product_single_item_js.on('click', '#wa-product-open-modal-bid-js', function(){
                var product_id = $(this).data('product-id'),
                    $wa_product_bid_price = $wa_product_single_item_js.find('#wa_product_bid_modal input#wa-product-bid-price'),
                    $modal_content = $wa_product_single_item_js.find('#wa_product_bid_modal .wa-modal-content');

                $modal_content.addClass( 'loading' );
                $modal_content.find('.wa-status').html('');

                $.ajax({
                    method: "POST",
                    url: wooauction.ajax_url,
                    data: { action: 'wa_next_price_bid_product', product_id: product_id, ajax: true },
                    success: function( result ){ 
                        var obj = JSON.parse( result );
                        // obj.step_price
                        $wa_product_bid_price
                        .attr( {'min': obj.next_price, 'step': 1} )
                        .val( obj.next_price );  

                        if( !obj.highest_bid ){
                            $modal_content.find('.wa-highest-bid-price-product').html('You are the first bid');
                        }else{
                            $modal_content.find('.wa-highest-bid-price-product').html(obj.highest_bid);
                        }

                        $modal_content.removeClass( 'loading' ); 
                    }
                })
            })

            // wa-product-bid-form
            $wa_product_single_item_js.on('submit', '#wa-product-bid-form-js', function(e) {
                e.preventDefault();
            })

            // wa-btn-bid-js
            $wa_product_single_item_js.on('click', '#wa-btn-bid-js', function(e) {
                var $this = $(this),
                    $form = $wa_product_single_item_js.find('#wa-product-bid-form-js'),
                    data = $form.serialize(),
                    $modal_content = $wa_product_single_item_js.find('#wa_product_bid_modal .wa-modal-content'),
                    text_default = $this.html(),
                    $wa_product_bid_price = $wa_product_single_item_js.find('#wa_product_bid_modal input#wa-product-bid-price');
                
                if( $wa_product_bid_price.val() < $wa_product_bid_price.attr('min') ) {
                    $wa_product_bid_price.focus();
                    return;
                }

                data += "&action=wa_save_price_bid_product";

                $this.addClass('wa-btn-hidden').html('Bidding...')

                $.ajax({
                    method: "POST",
                    url: wooauction.ajax_url,
                    data: data,
                    success: function( result ) { console.log(result);
                        var obj = JSON.parse( result );
                        $modal_content.find('.wa-status').html( obj.ico + ' ' + obj.mess );
                        $this.removeClass('wa-btn-hidden').html(text_default);

                        if( obj.st == 'success' ) {
                            if( $('.wa-content-bids-js').length > 0 ) {
                                $('.wa-content-bids-js').trigger('update_bids');
                            }
                            setTimeout(function(){
                                $('#wa_product_bid_modal').modal('hide');
                            }, 1000)
                        }else {
                            $wa_product_bid_price
                            .attr( {'min': obj.next_price} )
                            .val( obj.next_price );  
                        }
                    }
                })
            })
        
        }

        // update bids content
        var update_bids_content = function( opts ) {
            this.opts = opts;

            this.opts.content.addClass('loading');
            this.request();

            var self = this;
            this.opts.content.on('update_bids', function(){
                self.opts.content.addClass('loading');
                self.request();
            })
        }

        update_bids_content.prototype.request = function() {
            var self = this;

            $.ajax({
                method: "POST",
                url: wooauction.ajax_url,
                data: { action: 'wa_get_bids_by_productid', product_id: self.opts.product_id },
                success: function(result){
                    var obj = JSON.parse(result);

                    if( obj.st != 0 ){
                        var template = obj.template,
                            data = {
                                bids: obj.bids,
                                isuser: function(){
                                    if( !obj.user_id_current && obj.user_id_current == 0 )
                                        return;

                                    var _class = "";
                                    if( this.user_id == obj.user_id_current ){
                                        _class = "wa-bid-is-user";
                                    }

                                    return _class;
                                }
                            },
                            output = Mustache.render(template, data);

                        self.opts.content.removeClass('loading').html( output );
                    }else if( obj.st == 0 ) {
                        self.opts.content.removeClass('loading').html( '<div class="wa-bid-item row">Not item.</div>' );
                    }
                    
                    // re-update
                    setTimeout( function(){
                        self.request();
                    }, self.opts.timer )
                }
            })
        }

        // wa-content-bids-js
        var $wa_content_bids_js = $('.wa-content-bids-js');
        if( $wa_content_bids_js.length > 0 ) {
            $wa_content_bids_js.each(function(e){
                var $this = $(this),
                    pID = $this.data('productid');

                new update_bids_content( {product_id: pID, content: $this, timer: 2000} );
            })
        }
        
        // $update_current_bid_price
        var $update_current_bid_price = function(pID, output, timer){
            this.pID = pID;
            this.output = output;
            this.timer = timer;
            
            this.request();
        }
        
        $update_current_bid_price.prototype.request = function(){
            var self = this;
            
            $.ajax({
                type: 'POST',
                url: wooauction.ajax_url,
                data: { action: 'wa_update_current_bid_price', product_id: self.pID },
                success: function(result){
                    var obj = JSON.parse(result);
                    self.output.html(obj.highest_bid);
                    
                    setTimeout(function(){
                        self.request();
                    }, self.timer)
                }
            })
        }
        
        var $data_request_current_bid = $('[data-request-current-bid]');
        if( $data_request_current_bid.length > 0 ) {
            $data_request_current_bid.each(function(){
                var $this = $(this),
                    status = $this.data('request-current-bid'),
                    timer = $this.data('timer'),
                    pID = $this.data('productid');
                
                new $update_current_bid_price(pID, $this, timer);
            })
        }

        // wa-add-to-cart-js
        var $wa_add_to_cart_js = $('.wa-add-to-cart-js');
        if( $wa_add_to_cart_js.length > 0 ) {
            $wa_add_to_cart_js.on('click', function(e){
                var $this = $(this),
                    pID = $this.data('productid');

                $this.html('Please wait...').addClass('wa-btn-hidden');    
                $.ajax({
                    type: "POST",
                    url: wooauction.ajax_url,
                    data: { action: 'wa_add_to_cart', product_id: pID, type: 'add_to_cart' },
                    success: function(result) {
                        var obj = JSON.parse(result);
                        console.log( obj.mess );
                        
                        if( obj.st == 'success' ) {
                            $this.html(obj.mess).fadeOut(2000, function(){
                                $this.before( obj.view_cart );
                            })
                        }else{
                            $this.html(obj.mess);
                        }
                    }
                })
            })
        }

        // wa-buy-now-js
        var $wa_buy_now_js = $('.wa-buy-now-js');
        if($wa_buy_now_js.length > 0) {
            $wa_buy_now_js.on('click', function(e){
                var $this = $(this),
                    pID = $this.data('product-id');

                $this.html('Please wait...').addClass('wa-btn-hidden');    
                $.ajax({
                    type: "POST",
                    url: wooauction.ajax_url,
                    data: { action: 'wa_add_to_cart', product_id: pID, type: 'buy_now' },
                    success: function(result) {
                        var obj = JSON.parse(result);
                        console.log( obj.mess );
                        
                        if( obj.st == 'success' ) {
                            $this.html(obj.mess).fadeOut(2000, function(){
                                $this.before( obj.view_cart );
                            })
                        }else{
                            $this.html(obj.mess);
                        }
                    }
                })
            })
        }

        // wa-body-tab
        var $wa_body_tab = $('.wa-header-tab');
        if( $wa_body_tab.length > 0 ) {
            $wa_body_tab.on('click', function() {
                var $this = $(this),
                    keytab = $this.data('tabkey');
                if( $this.hasClass('active') ){ return };

                $this.addClass('active').siblings().removeClass('active');
                $('.wa-body-tab[data-tabkey="'+keytab+'"]').addClass('active')
                .siblings().removeClass('active');

            }).first().trigger('click');
        }

        // wa-product-images
        var $wa_product_images = $('.wa-product-images');
        if( $wa_product_images.length > 0 ) {
            $wa_product_images.find('.wa-product-images-thumbs img').on('click', function(){
                var $this = $(this),
                    $img_full_el = $wa_product_images.find('.wa-product-image-full img'),
                    url_thumb = $this.attr('src');

                $this.attr('src', $img_full_el.attr('src'));
                $img_full_el.attr('src', url_thumb);
            })
        }
	})
})(jQuery)