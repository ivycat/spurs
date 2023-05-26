(function ($) {
	// Skip to content focuses on first anchor tag inside #main upon click.
	$(".skip-link.screen-reader-text").on("click", function (e) {
		$(e.currentTarget.hash).find("a").first().focus();
	});

	var screenReaderText = {
		expand: "Expand child menu",
		collapse: "Collapse child menu",
	};
	var dropdownToggle = $("<button />", {
		class: "dropdown-toggle",
		"aria-expanded": false,
		role: "button",
	})
		.append($("<div />", { class: "chevron-right" }))
		.append(
			$("<span />", {
				class: "screen-reader-text sr-only screen-readers",
				text: screenReaderText.expand,
			})
		);
	// Adds the dropdown toggle button
	$(".menu-item-has-children > a").after(dropdownToggle);
	// Keyboard navigation
	$(".menu-item a, a.dropdown-toggle, button.dropdown-toggle").on(
		"keydown",
		function (e) {
			if (
				["ArrowLeft", "ArrowUp", "ArrowRight", "ArrowDown", "Enter"].indexOf(
					e.key
				) == -1
			) {
				return;
			}
			console.log("keboard key = ", e.key);
			switch (e.key) {
				case "ArrowDown": // down key
					e.preventDefault();
					e.stopPropagation();

					if (
						$(this).closest("ul.dropdown-menu.show").length > 0 &&
						$(this).closest("ul.dropdown-menu.dropdown-submenu.show").length ==
							0
					) {
						e.stopPropagation();
						$(this).parent("li").next("li.menu-item").children("a").focus();
					} else if (
						$(this).closest("ul.dropdown-menu.dropdown-submenu.show").length > 0
					) {
						$(this).parent("li").next("li.menu-item").children("a").focus();
					}
					if ($(this).next("ul.dropdown-menu.show").length > 0) {
						$(this)
							.next("ul.dropdown-menu.show")
							.children("li.menu-item:first-child")
							.children("a")
							.focus();
					}
					break;

				case "ArrowLeft": // left key
					e.preventDefault();
					/**
					 * Check 2nd sub menu
					 */
					if (
						$(this).closest("ul.dropdown-menu.dropdown-submenu.show").length > 0
					) {
						console.log("Inside 2nd Submenu");
						if ($(this).parent("li.menu-item:first-child").length > 0) {
							console.log("First item of 2nd Submenu");
							$(this).closest("ul").prev("button.dropdown-toggle").focus();
						}
					}

					if ($(this).prev("a").length > 0) {
						$(this).prev("a").focus();
						console.log("left Anchor exists in same parent");
					} else if (
						$(this)
							.parent("li")
							.prev("li.menu-item")
							.children("button.dropdown-toggle").length > 0
					) {
						$(this)
							.parent("li")
							.prev("li.menu-item")
							.children("button.dropdown-toggle")
							.focus();
						console.log("On left button exsist");
					} else if (
						$(this).parent("li").prev("li.menu-item").children("a").length > 0
					) {
						$(this).parent("li").prev("li.menu-item").children("a").focus();
						console.log("left key main menu");
						console.log(
							"Button does not exist on left, going for previous Anchor element"
						);
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

				case "ArrowRight": // right key
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
							$(this).parent("li").next("li.menu-item").children("a").length > 0
						) {
							console.log(
								"button does not exist on right, going for next Anchor element"
							);

							$(this).parent("li").next("li.menu-item").children("a").focus();
							/**
							 * Close open dropdown class
							 */
							/**
							 * Select active parent menu item
							 */
							var activeDropdownItem = $(
								"#main-menu .menu-item-has-children.dropdown.active.show"
							);
							/**
							 * Remove show class from the dropdown menu.
							 * update aria-expande attribute to false for a.
							 * update aria-expande attribute to false for button.
							 * Remove show class from the parent dropdown menu.
							 */
							activeDropdownItem
								.find("ul.dropdown-menu.show")
								.removeClass("show");
							activeDropdownItem.find("a").attr("aria-expanded", "false");
							activeDropdownItem.find("button").attr("aria-expanded", "false");
							activeDropdownItem.removeClass("show");
						}
					}

					if ($(this).next("ul.dropdown-menu.dropdown-submenu.show")) {
						$(this)
							.next("ul.dropdown-menu.dropdown-submenu.show")
							.children("li.menu-item:first")
							.children("a")
							.focus();
					}
					break;

				case "ArrowUp": // up key
					e.preventDefault();
					e.stopPropagation();

					if (
						$(this).closest("ul.dropdown-menu.show").length > 0 &&
						$(this).closest("ul.dropdown-menu.dropdown-submenu.show").length ==
							0
					) {
						e.stopPropagation();
						$(this).parent("li").prev("li.menu-item").children("a").focus();

						if ($(this).parent("li.menu-item:first-child").length > 0) {
							$(this)
								.closest("ul.dropdown-menu")
								.prev("button.dropdown-toggle")
								.focus();
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
						$(this)
							.closest("ul.dropdown-menu.show")
							.prev("a.dropdown-toggle")
							.focus();
					}
					break;

				case "Enter": // Enter Key
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
		}
	);
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
		var activeDropdownItem = $(
			"#main-menu .menu-item-has-children.dropdown.active.show"
		);
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
