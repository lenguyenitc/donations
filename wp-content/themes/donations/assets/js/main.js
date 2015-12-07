jQuery(document).ready(function($) {
	"use strict";
	
	/* window */
	var window_width, window_height, scroll_top;
	
	/* admin bar */
	var adminbar = $('#wpadminbar');
	var adminbar_height = 0;
	
	/* header menu */
	var header = $('#zo-header');
	var header_top = 0;
	
	/* scroll status */
	var scroll_status = '';
	
	/**
	 * window load event.
	 * 
	 * Bind an event handler to the "load" JavaScript event.
	 * @author ZoTheme
	 */
	$(window).load(function() {
		
		/** current scroll */
		scroll_top = $(window).scrollTop();
		
		/** current window width */
		window_width = $(window).width();
		
		/** current window height */
		window_height = $(window).height();
		
		/* get admin bar height */
		adminbar_height = adminbar.length > 0 ? adminbar.outerHeight(true) : 0 ;
		
		/* get top header menu */
		header_top = adminbar_height;
		
		/* check sticky menu. */
		if(ZOOptions.menu_sticky == '1'){
			zo_stiky_menu(scroll_top);
		}
		
		/* check mobile menu */
		zo_mobile_menu();
		
		/* page loading. */
		zo_page_loading();
		
		/* check video size */
		zo_auto_video_width();
	});

	/**
	 * reload event.
	 * 
	 * Bind an event handler to the "navigate".
	 */
	window.onbeforeunload = function(){ zo_page_loading(1); }
	
	/**
	 * resize event.
	 * 
	 * Bind an event handler to the "resize" JavaScript event, or trigger that event on an element.
	 * @author ZoTheme
	 */
	$(window).resize(function(event, ui) {
		/** current window width */
		window_width = $(event.target).width();
		
		/** current window height */
		window_height = $(window).height();
		
		/** current scroll */
		scroll_top = $(window).scrollTop();
		
		/* check sticky menu. */
		if(ZOOptions.menu_sticky == '1'){
			zo_stiky_menu(scroll_top);
		}
		
		/* check mobile menu */
		zo_mobile_menu();
		
		/* check video size */
		zo_auto_video_width();
	});
	
	/**
	 * scroll event.
	 * 
	 * Bind an event handler to the "scroll" JavaScript event, or trigger that event on an element.
	 * @author ZoTheme
	 */
	var lastScrollTop = 0;
	
	$(window).scroll(function() {
		/** current scroll */
		scroll_top = $(window).scrollTop();
		/** check scroll up or down. */
		if(scroll_top < lastScrollTop) {
			/* scroll up. */
			scroll_status = 'up';
		} else {
			/* scroll down. */
			scroll_status = 'down';
		}
		
		lastScrollTop = scroll_top;
		
		/* check sticky menu. */
		if(ZOOptions.menu_sticky == '1'){
			zo_stiky_menu();
		}

		/* check sticky menu fixed page */
		if(ZOOptions.menu_sticky == '0'){
			zo_stiky_menu_fixed_page();
		}
		
	});

	/**
	 * Stiky menu
	 * 
	 * Show or hide sticky menu.
	 * @author ZoTheme
	 * @since 1.0.0
	 */
	function zo_stiky_menu() {
		if (header_top < scroll_top) {
			switch (true) {
				case (window_width > 992):
					header.addClass('header-fixed');
					$('body').addClass('fixed-margin-top');
					break;
				case ((window_width <= 992 && window_width >= 768) && (ZOOptions.menu_sticky_tablets == '1')):
					header.addClass('header-fixed');
					$('body').addClass('fixed-margin-top');
					break;
				case ((window_width <= 768) && (ZOOptions.menu_sticky_mobile == '1')):
					header.addClass('header-fixed');
					$('body').addClass('fixed-margin-top');
					break;
			}
		} else {
			header.removeClass('header-fixed');
			$('body').removeClass('fixed-margin-top');
		}
	}
	function zo_stiky_menu_fixed_page() {
		if (header_top < scroll_top) {
			header.addClass('header-fixed-page-trans');
		} else {
			header.removeClass('header-fixed-page-trans');
		}
	}
	
	/**
	 * Mobile menu
	 * 
	 * Show or hide mobile menu.
	 * @author ZoTheme
	 * @since 1.0.0
	 */
	
	$('body').on('click', '#zo-menu-mobile', function(){
		var navigation = $(this).parent().find('#zo-header-navigation');
		if(!navigation.hasClass('collapse')){
			navigation.addClass('collapse');
		} else {
			navigation.removeClass('collapse');
		}
	});
	/* check mobile screen. */
	function zo_mobile_menu() {
		var menu = $('#zo-header-navigation');
		
		/* active mobile menu. */
		switch (true) {
		case (window_width <= 992 && window_width >= 768):
			menu.removeClass('phones-nav').addClass('tablets-nav');
			/* */
			zo_mobile_menu_group(menu);
			break;
		case (window_width <= 768):
			menu.removeClass('tablets-nav').addClass('phones-nav');
			break;
		default:
			menu.removeClass('mobile-nav tablets-nav');
			menu.find('li').removeClass('mobile-group');
			break;
		}	
	}
	/* group sub menu. */
	function zo_mobile_menu_group(nav) {
		nav.each(function(){
			$(this).find('li').each(function(){
				if($(this).find('ul:first').length > 0){
					$(this).addClass('mobile-group');
				}
			});
		});
	}
	
	/**
	 * Auto width video iframe
	 * 
	 * Youtube Vimeo.
	 * @author ZoTheme
	 */
	function zo_auto_video_width() {
		$('.entry-video iframe').each(function(){
			var v_width = $(this).width();
			
			v_width = v_width / (16/9);
			$(this).attr('height',v_width + 35);
		})
	}
	
	
	/**
	 * Parallax.
	 * 
	 * @author ZoTheme
	 * @since 1.0.0
	 */
	var zo_parallax = $('.zo_parallax');
	if(zo_parallax.length > 0 && ZOOptions.paralax == '1'){
		zo_parallax.each(function() {
			"use strict";
			var speed = $(this).attr('data-speed');
			
			speed = (speed != undefined && speed != '') ? speed : 0.1 ;
			
			$(this).parallax("50%", speed);
		});
	}
	
	/**
	 * Page Loading.
	 */
	function zo_page_loading($load) {
		switch ($load) {
		case 1:
			$('#zo-loadding').css('display','block')
			break;
		default:
			$('#zo-loadding').css('display','none')
			break;
		}
	}
	
	/**
	 * Back To Top
	 * 
	 * @author ZoTheme
	 * @since 1.0.0
	 */
	$('body').on('click', '#back_to_top', function () {
        $("html, body").animate({
            scrollTop: 0
        }, 1500);
    });
    $('body').on('click', '#scroll_to_top', function () {
        $("html, body").animate({
            scrollTop: 0
        }, 1000);
    });

	/* Remove Link Schedule */
	$('body').on('click', '.tt_timetable .event_container > a',function () {
		return false;
	});

    /**
     * Post Like.
     *
     * @author ZoTheme
     * @since 1.0.0
     */

    $('body').on('click', '.zo-post-like', function () {
        "use strict";
        /* get post id. */
        var bt_like = $(this);

        var post_id = bt_like.attr('data-id');

        if(post_id != undefined && post_id != ''){
            /* add like. */
            $.post(ajaxurl, {
                action : 'zo_post_like',
                id : post_id,
                dataType: "json"
            }, function(response) {
                if(response != ''){
                    bt_like.find('i').attr('class', 'fa fa-heart')
                    bt_like.find('span').html(response);
                }
            });
        }

    });

    /**
     * Fix cause process bar
     * Check and set bar limit
     */
    $(window).load(function() {
        $('.zo-cause-progress').each(function () {
            var thisEl = $(this),
                thisOffset = thisEl.offset(),
                number = $('.number', thisEl),
                numberOffset = number.offset();
            if (numberOffset.left < thisOffset.left) {
                number.css('transform', 'translate(0, -50%)');
            } else if(numberOffset.left + number.outerWidth() > thisOffset.left + thisEl.outerWidth()) {
                number.css('transform', 'translate(-100%, -50%)');
            }
        });
    });

});