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
(function ($) {
  // Skip to content focuses on first anchor tag inside #main upon click.
  $(".skip-link.screen-reader-text").on("click", function (e) {
    $(e.currentTarget.hash).find("a").first().focus();
  });
  var screenReaderText = {
    expand: "Expand child menu",
    collapse: "Collapse child menu"
  };
  var dropdownToggle = $("<button />", {
    class: "dropdown-toggle",
    "aria-expanded": false,
    role: "button"
  }).append($("<div />", {
    class: "chevron-right"
  })).append($("<span />", {
    class: "screen-reader-text sr-only screen-readers",
    text: screenReaderText.expand
  }));
  // Adds the dropdown toggle button
  $(".menu-item-has-children > a").after(dropdownToggle);
  // Keyboard navigation
  $(".menu-item a, a.dropdown-toggle, button.dropdown-toggle").on("keydown", function (e) {
    if (["ArrowLeft", "ArrowUp", "ArrowRight", "ArrowDown", "Enter"].indexOf(e.key) == -1) {
      return;
    }
    console.log("keboard key = ", e.key);
    switch (e.key) {
      case "ArrowDown":
        // down key
        e.preventDefault();
        e.stopPropagation();
        if ($(this).closest("ul.dropdown-menu.show").length > 0 && $(this).closest("ul.dropdown-menu.dropdown-submenu.show").length == 0) {
          e.stopPropagation();
          $(this).parent("li").next("li.menu-item").children("a").focus();
        } else if ($(this).closest("ul.dropdown-menu.dropdown-submenu.show").length > 0) {
          $(this).parent("li").next("li.menu-item").children("a").focus();
        }
        if ($(this).next("ul.dropdown-menu.show").length > 0) {
          $(this).next("ul.dropdown-menu.show").children("li.menu-item:first-child").children("a").focus();
        }
        break;
      case "ArrowLeft":
        // left key
        e.preventDefault();
        /**
         * Check 2nd sub menu
         */
        if ($(this).closest("ul.dropdown-menu.dropdown-submenu.show").length > 0) {
          console.log("Inside 2nd Submenu");
          if ($(this).parent("li.menu-item:first-child").length > 0) {
            console.log("First item of 2nd Submenu");
            $(this).closest("ul").prev("button.dropdown-toggle").focus();
          }
        }
        if ($(this).prev("a").length > 0) {
          $(this).prev("a").focus();
          console.log("left Anchor exists in same parent");
        } else if ($(this).parent("li").prev("li.menu-item").children("button.dropdown-toggle").length > 0) {
          $(this).parent("li").prev("li.menu-item").children("button.dropdown-toggle").focus();
          console.log("On left button exsist");
        } else if ($(this).parent("li").prev("li.menu-item").children("a").length > 0) {
          $(this).parent("li").prev("li.menu-item").children("a").focus();
          console.log("left key main menu");
          console.log("Button does not exist on left, going for previous Anchor element");
          /**
           * Close open dropdown class
           */
          /**
           * Select active parent menu item
           */
          // var activeDropdownItem = $(
          // 	"#main-menu .menu-item-has-children.dropdown.active.show"
          // );
          /**
           * Remove show class from the dropdown menu.
           * update aria-expande attribute to false for a.
           * update aria-expande attribute to false for button.
           * Remove show class from the parent dropdown menu.
           */
          // activeDropdownItem
          // 	.find("ul.dropdown-menu.show")
          // 	.removeClass("show");
          // activeDropdownItem.find("a").attr("aria-expanded", "false");
          // activeDropdownItem.find("button").attr("aria-expanded", "false");
          // activeDropdownItem.removeClass("show");
        }

        break;
      case "ArrowRight":
        // right key
        /**
         * Check 2nd sub menu
         */
        if ($(this).closest("ul.dropdown-menu.dropdown-submenu").length > 0) {
          console.log("2nd submenu");
          return;
        } else if ($(this).closest("ul.dropdown-menu").length > 0) {
          console.log("1st submenu");
          /**
           * Check 1st sub menu
           */
          if ($(this).next("button.dropdown-toggle").length > 0) {
            console.log("1st submenu button exists on right, added focus");
            $(this).next("button.dropdown-toggle").focus();
          }
        } else {
          console.log("main menu");
          /**
           * In the main menu
           */
          if ($(this).next("button.dropdown-toggle").length > 0) {
            console.log("on right button exsist");
            /**
             * On the arrow
             */
            $(this).next("button.dropdown-toggle").focus();
          } else if (
          /**
           * Check for next item
           */
          $(this).parent("li").next("li.menu-item").children("a").length > 0) {
            console.log("button does not exist on right, going for next Anchor element");
            $(this).parent("li").next("li.menu-item").children("a").focus();
            /**
             * Close open dropdown class
             */
            /**
             * Select active parent menu item
             */
            var activeDropdownItem = $("#main-menu .menu-item-has-children.dropdown.active.show");
            /**
             * Remove show class from the dropdown menu.
             * update aria-expande attribute to false for a.
             * update aria-expande attribute to false for button.
             * Remove show class from the parent dropdown menu.
             */
            activeDropdownItem.find("ul.dropdown-menu.show").removeClass("show");
            activeDropdownItem.find("a").attr("aria-expanded", "false");
            activeDropdownItem.find("button").attr("aria-expanded", "false");
            activeDropdownItem.removeClass("show");
          }
        }
        if ($(this).next("ul.dropdown-menu.dropdown-submenu.show")) {
          $(this).next("ul.dropdown-menu.dropdown-submenu.show").children("li.menu-item:first").children("a").focus();
        }
        break;
      case "ArrowUp":
        // up key
        e.preventDefault();
        e.stopPropagation();
        if ($(this).closest("ul.dropdown-menu.show").length > 0 && $(this).closest("ul.dropdown-menu.dropdown-submenu.show").length == 0) {
          e.stopPropagation();
          $(this).parent("li").prev("li.menu-item").children("a").focus();
          if ($(this).parent("li.menu-item:first-child").length > 0) {
            $(this).closest("ul.dropdown-menu").prev("button.dropdown-toggle").focus();
          }
        }
        if ($(this).closest("ul.dropdown-menu.dropdown-submenu").length > 0) {
          if ($(this).parent("li.menu-item:first-child").length > 0) {
            e.stopPropagation();
          } else {
            $(this).parent("li").prev("li.menu-item").children("a").focus();
          }
        }
        if ($(this).closest("li.menu-item:first").length > 0) {
          $(this).closest("ul.dropdown-menu.show").prev("a.dropdown-toggle").focus();
        }
        break;
      case "Enter":
        // Enter Key
        e.preventDefault();
        e.stopPropagation();
        if ($(this).is("[href]") && $(this).attr("href") !== "#") {
          window.location.href = $(this).attr("href");
        } else if ($(this).attr("role") === "button") {
          console.log("Opening sub menu");
          if ($(this).next("ul.dropdown-menu.show").length > 0) {
            console.log("role: close");
            $(this).next("ul.dropdown-menu.show").removeClass("show");
            $(this).prev("a").attr("aria-expanded", "false");
            $(this).attr("aria-expanded", "false");
            $(this).parent().closest("li.menu-item").removeClass("show");
            $(this).click();
          } else if ($(this).next("ul.dropdown-menu").length > 0) {
            console.log("role: open");
            $(this).next("ul.dropdown-menu").addClass("show");
            $(this).prev("a").attr("aria-expanded", "true");
            $(this).attr("aria-expanded", "true");
            $(this).parent().closest("li.menu-item").addClass("show");
            $(this).click();
          }
        }
        break;
    }
  });
  /**
   * For accessibility
   * hide all dropdown when focus any main menu item
   */
  $("#main-menu>.menu-item>a").focusin(function () {
    /**
     * Close open dropdown class
     */
    /**
     * Select active parent menu item
     */
    var activeDropdownItem = $("#main-menu .menu-item-has-children.dropdown.active.show");
    if (activeDropdownItem.length > 0) {
      /**
       * Remove show class from the dropdown menu.
       * update aria-expande attribute to false for a.
       * update aria-expande attribute to false for button.
       * Remove show class from the parent dropdown menu.
       */
      activeDropdownItem.find("ul.dropdown-menu.show").removeClass("show");
      activeDropdownItem.find("a").attr("aria-expanded", "false");
      activeDropdownItem.find("button").attr("aria-expanded", "false");
      activeDropdownItem.removeClass("show");
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