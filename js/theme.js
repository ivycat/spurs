/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
(function () {
  var isWebkit = navigator.userAgent.toLowerCase().indexOf('webkit') > -1,
    isOpera = navigator.userAgent.toLowerCase().indexOf('opera') > -1,
    isIe = navigator.userAgent.toLowerCase().indexOf('msie') > -1;
  if ((isWebkit || isOpera || isIe) && document.getElementById && window.addEventListener) {
    window.addEventListener('hashchange', function () {
      var id = location.hash.substring(1),
        element;
      if (!/^[A-z0-9_-]+$/.test(id)) {
        return;
      }
      element = document.getElementById(id);
      if (element) {
        if (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {
          element.tabIndex = -1;
        }
        element.focus();
      }
    }, false);
  }
})();
$ = jQuery;
jQuery(function ($) {
  // use jQuery code inside this to avoid "$ is not defined" error
  $(".spurs_loadmore").click(function () {
    var search_page = false;
    if ($("body").hasClass("search-results")) {
      search_page = true;
    }
    var button = $(this),
      data = {
        action: "loadmore",
        query: spurs_loadmore_params.posts,
        // that's how we get params from wp_localize_script() function
        page: spurs_loadmore_params.current_page,
        search_page: search_page
      };
    $.ajax({
      // you can also use $.post here
      url: spurs_loadmore_params.ajaxurl,
      // AJAX handler
      data: data,
      type: "POST",
      beforeSend: function (xhr) {
        button.text("Loading..."); // change the button text, you can also add a preloader image
      },

      success: function (data) {
        if (data) {
          button.text("More posts");
          $(".latest-posts-list > .card-group").append(data); // insert new posts
          spurs_loadmore_params.current_page++;
          if (spurs_loadmore_params.current_page == spurs_loadmore_params.max_page) button.remove(); // if last page, remove the button

          // you can also fire the "post-load" event here if you use a plugin that requires it
          // $( document.body ).trigger( 'post-load' );
        } else {
          button.remove(); // if no data, remove the button as well
        }
      }
    });
  });
});
/**
 * An accessible menu for WordPress
 */
(function ($) {
  // Keyboard navigation
  $('.menu-item a, a.dropdown-toggle').on('keydown', function (e) {
    if (['ArrowLeft', 'ArrowUp', 'ArrowRight', 'ArrowDown', 'Enter'].indexOf(e.key) == -1) {
      return;
    }

    switch (e.key) {
      case 'ArrowDown':
        // down key
        e.preventDefault();

        if ($(this).closest('ul.dropdown-menu.show').length > 0 && $(this).closest('ul.dropdown-menu.dropdown-submenu.show').length == 0) {
          e.stopPropagation();
          $(this).parent('li').next('li.menu-item').children('a').focus();
        }

        if ($(this).next('ul.dropdown-menu') && !$(this).next('ul.dropdown-menu.dropdown-submenu')) {
          $(this).next('ul.dropdown-menu').addClass('show');
          $(this).attr('aria-expanded', 'true');
          $(this).parent().closest('li.menu-item').addClass('show');
          console.log('ArrowDown');
        }

        break;

      case 'ArrowLeft':
        // left key
        e.preventDefault();

        if ($(this).closest('ul.dropdown-menu.dropdown-submenu.show').length > 0) {
          if ($(this).parent('li.menu-item:first-child').length > 0) {
            $(this).closest('ul').prev('a').focus();
            $(this).closest('ul.dropdown-menu.dropdown-submenu.show').removeClass('show');
            $('li.item-menu.show').removeClass('show');
            $('a.dropdown-item').attr('aria-expanded', 'false');
          }
        }

        if ($(this).parent().closest('li').prev('li.menu-item').children('a')) {
          $(this).parent().closest('li').prev('li.menu-item').children('a').focus();
          console.log('ArrowLeft');
        }

        break;

      case 'ArrowRight':
        // right key
        if ($(this).closest('ul.dropdown-menu.dropdown-submenu').length > 0) {
          return;
        } else if ($(this).closest('ul.dropdown-menu').length > 0) {
          console.log('submenu');

          if ($(this).next('ul.dropdown-menu.dropdown-submenu')) {
            $(this).next('ul.dropdown-menu.dropdown-submenu').addClass('show');
            $(this).attr('aria-expanded', 'true');
            $(this).parent().closest('li.menu-item').addClass('show');
          }
        } else {
          console.log('menu');
          $(this).parent('li').next('li.menu-item').children('a').focus();
        }

        if ($(this).next('ul.dropdown-menu.dropdown-submenu.show')) {
          $(this).next('ul.dropdown-menu.dropdown-submenu.show').children('li.menu-item:first').children('a').focus();
        }

        break;

      case 'ArrowUp':
        // up key
        e.preventDefault();

        if ($(this).closest('ul.dropdown-menu.show').length > 0 && $(this).closest('ul.dropdown-menu.dropdown-submenu.show').length == 0) {
          e.stopPropagation();
          $(this).parent('li').prev('li.menu-item').children('a').focus();

          if ($(this).parent('li.menu-item:first-child').length > 0) {
            $(this).closest('ul.dropdown-menu').prev('a.dropdown-toggle').focus(); // $(this).closest('ul.dropdown-menu.show').prev('a').
          } // if ( $(this).parent().prev().length == 0 ) {
          //     e.stopPropagation();
          //     $(this).parent('li').prev('li.menu-item>a').focus()
          //     $(this).parent().parent().parent().find('ul.dropdown-menu.show').removeClass('show')
          //     $(this).parent().parent().parent().find('a.dropdown-toggle').attr('aria-expanded', 'false')
          // }

        }

        if ($(this).closest('ul.dropdown-menu.dropdown-submenu').length > 0) {
          if ($(this).parent('li.menu-item:first-child').length > 0) {
            e.stopPropagation();
          }
        }

        if ($(this).closest('li.menu-item:first').length > 0) {
          $(this).closest('ul.dropdown-menu.show').prev('a.dropdown-toggle').focus();
        }

        break;

      case 'Enter':
        // Enter Key
        if ($(this).next('ul.dropdown-menu.show').length) {
          console.log('Enter');
          $(this).next('ul.dropdown-menu.show').removeClass('show');
          $(this).attr('aria-expanded', 'false');
          $(this).parent().closest('li.menu-item').removeClass('show');
          $(this).click();
        } else if ($(this).next('ul.dropdown-menu').length) {
          $(this).next('ul.dropdown-menu').addClass('show');
          $(this).attr('aria-expanded', 'true');
          $(this).parent().closest('li.menu-item').addClass('show');
          $(this).click();
        }

        if ($(this).closest('ul.navbar-nav').length > 0 && $(this).closest('ul.dropdown-menu').length == 0) {
          if ($('ul.dropdown-menu.show').length) {
            $('ul.dropdown-menu').removeClass('show');
            $('ul.dropdown-menu').prev('a').attr('aria-expanded', 'false');
            $('ul.dropdown-menu').closest('li.menu-item').removeClass('show');
          }
        }

    }
  });
})(jQuery);
$ = jQuery;
var window_width = $(window).outerWidth(),
  navbar = $("header.main-header"),
  announcement_bar = $(".announcement"),
  admin_bar = $("#wpadminbar");
$(document).ready(function () {
  $("#back-to-top").on("click", function () {
    $("html, body").animate({
      scrollTop: 0
    }, 1000);
  });

  // Search box toggle
  $(".header-search a, .search-box .button-close").click(function () {
    $(".search-box").toggleClass("active");
    navbar.toggleClass("search-active");
    adjust_search_box();
  });

  /**
   * Click on hash link
   * Scroll to the top of the page.
   */
  $(document).on("click", 'a[href^="#"]', function (event) {
    var target = $(this.hash),
      scroll_val = 15;
    var hrefValue = $(this).attr("href");
    if (admin_bar.length > 0) {
      scroll_val += admin_bar.outerHeight();
    }
    if (navbar.length > 0) {
      scroll_val += navbar.outerHeight();
    }
    if ("" !== target && null !== target && "#" === hrefValue) {
      // event.preventDefault();
      $("html, body").animate({
        scrollTop: target.offset().top - scroll_val
      }, 750);
    }
  });
  $(".navbar-toggler").click(function () {
    $("body").toggleClass("nav-active");
  });
  $(window).trigger("scroll");
  $(window).trigger("resize");

  // Adjust search bar position
  adjust_search_box();

  /**
   * For facetwp
   * Go to top of the page
   */
  // $(document).on("facetwp-loaded", function () {
  // 	$("html, body").animate({ scrollTop: $("#main").offset().top - 200 }, 1000);
  // });
});

$(window).on("scroll", function () {
  var scroll_top = $(window).scrollTop();
  if (scroll_top < 10) {
    navbar.removeClass("sticky-nav");
  } else {
    navbar.addClass("sticky-nav");
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
  $(".search-box").css("top", top);
}
$.fn.isInViewport = function (predefined_scroll = 0) {
  var elementTop = $(this).offset().top + predefined_scroll;
  var elementBottom = elementTop + $(this).outerHeight();
  var viewportTop = $(window).scrollTop();
  var viewportBottom = viewportTop + $(window).height();
  return elementBottom > viewportTop && elementTop < viewportBottom;
};
jQuery(function ($) {
  var submenu = $("li.mega-menu-item");
  submenu.on("open_panel", function () {
    navbar.addClass("parent-hovered");
  });
  submenu.on("close_panel", function () {
    navbar.removeClass("parent-hovered");
  });
});