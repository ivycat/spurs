$ = jQuery;
var window_width = $(window).outerWidth(),
	navbar = $('header.main-header'),
	announcement_bar = $('.announcement'),
	admin_bar = $('#wpadminbar');

$(document).ready(function () {

	$('#back-to-top').on('click', function () {
		$("html, body").animate({scrollTop: 0}, 1000);
	});

	// Search box toggle
	$('.header-search a, .search-box .button-close').click(function () {
		$('.search-box').toggleClass('active');
		navbar.toggleClass('search-active');
		adjust_search_box();
	});

	$(document).on('click', 'a[href^="#"]', function (event) {
		var target = $(this.hash),
			scroll_val = 15;

		if (admin_bar.length > 0) {
			scroll_val += admin_bar.outerHeight();
		}

		if (navbar.length > 0) {
			scroll_val += navbar.outerHeight();
		}

		if ('' !== target && null !== target) {
			event.preventDefault();
			$('html, body').animate({
				scrollTop: target.offset().top - scroll_val
			}, 750);
		}
	});

	$('.navbar-toggler').click(function () {
		$('body').toggleClass('nav-active');
	});

	$(window).trigger('scroll');
	$(window).trigger('resize');

	// Adjust search bar position
	adjust_search_box();

	$(document).on('facetwp-loaded', function () {
		$('html, body').animate({scrollTop: $('#main').offset().top - 200}, 1000);
	});

});

$(window).on('scroll', function () {
	var scroll_top = $(window).scrollTop();

	if (scroll_top < 10) {
		navbar.removeClass('sticky-nav');
	} else {
		navbar.addClass('sticky-nav');
	}

	adjust_search_box();
});

$(window).resize(function () {
	adjust_search_box();
});

function adjust_search_box() {
	let top = 0;

	if (announcement_bar.length && announcement_bar.isInViewport()) {
		top += announcement_bar.outerHeight();
	}

	if (admin_bar.length && admin_bar.isInViewport()) {
		top += admin_bar.outerHeight();
	}

	if (navbar.length && navbar.isInViewport()) {
		top += navbar.outerHeight();
	}

	$('.search-box').css('top', top);

}

$.fn.isInViewport = function (predefined_scroll = 0) {
	var elementTop = $(this).offset().top + predefined_scroll;
	var elementBottom = elementTop + $(this).outerHeight();
	var viewportTop = $(window).scrollTop();
	var viewportBottom = viewportTop + $(window).height();
	return elementBottom > viewportTop && elementTop < viewportBottom;
};

jQuery(function ($) {
	var submenu = $('li.mega-menu-item');
	submenu.on('open_panel', function () {
		navbar.addClass('parent-hovered');
	});
	submenu.on('close_panel', function () {
		navbar.removeClass('parent-hovered');
	});
});