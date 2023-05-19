/**
 * An accessible menu for WordPress
 */

(function($) {

    // Keyboard navigation
    $('.menu-item a, a.dropdown-toggle').on('keydown', function(e) {

        if (['ArrowLeft','ArrowUp','ArrowRight','ArrowDown','Enter'].indexOf(e.key) == -1) {
            return
        }

        switch(e.key) {

            case 'ArrowDown': // down key
                e.preventDefault();
                
                if ( $(this).closest('ul.dropdown-menu.show').length > 0 && 
                    $(this).closest('ul.dropdown-menu.dropdown-submenu.show').length == 0 ) {
                        e.stopPropagation();
                        $(this).parent('li').next('li.menu-item').children('a').focus()
                }
                if ( $(this).next('ul.dropdown-menu') && ! $(this).next('ul.dropdown-menu.dropdown-submenu') ) {
                    $(this).next('ul.dropdown-menu').addClass('show')
                    $(this).attr('aria-expanded', 'true')
                    $(this).parent().closest('li.menu-item').addClass('show')
                    console.log('ArrowDown');
                }
				break;

            case 'ArrowLeft': // left key
                e.preventDefault()

                if ( $(this).closest('ul.dropdown-menu.dropdown-submenu.show').length > 0 ) {
                    if ( $(this).parent('li.menu-item:first-child').length > 0 ) {
                        $(this).closest('ul').prev('a').focus();
                        $(this).closest('ul.dropdown-menu.dropdown-submenu.show').removeClass('show')
                        $('li.item-menu.show').removeClass('show')
                        $('a.dropdown-item').attr('aria-expanded', 'false')
                    }
                }
                if ( $(this).parent().closest('li').prev('li.menu-item').children('a') ) {
                    $(this).parent().closest('li').prev('li.menu-item').children('a').focus()
                    console.log('ArrowLeft');
                }
                break;

	    	case 'ArrowRight': // right key
                if ( $(this).closest('ul.dropdown-menu.dropdown-submenu').length > 0 ) {
                    return
                } else if ( $(this).closest('ul.dropdown-menu').length > 0 ) {
                    console.log( 'submenu' )
                    if ( $(this).next('ul.dropdown-menu.dropdown-submenu') ) {
                        $(this).next('ul.dropdown-menu.dropdown-submenu').addClass('show')
                        $(this).attr('aria-expanded', 'true')
                        $(this).parent().closest('li.menu-item').addClass('show')
                    }
                } else {
                    console.log( 'menu' )
                    $(this).parent('li').next('li.menu-item').children('a').focus()
                }

                if ( $(this).next('ul.dropdown-menu.dropdown-submenu.show') ) {
                    $(this).next('ul.dropdown-menu.dropdown-submenu.show').children('li.menu-item:first').children('a').focus()
                }
                
                break;

            case 'ArrowUp': // up key
                e.preventDefault();
                
                if ( $(this).closest('ul.dropdown-menu.show').length > 0 && 
                    $(this).closest('ul.dropdown-menu.dropdown-submenu.show').length == 0 ) {
                        e.stopPropagation();
                        $(this).parent('li').prev('li.menu-item').children('a').focus()

                        if ( $(this).parent('li.menu-item:first-child').length > 0 ) {
                            $(this).closest('ul.dropdown-menu').prev('a.dropdown-toggle').focus()
                            // $(this).closest('ul.dropdown-menu.show').prev('a').
                        }

                        // if ( $(this).parent().prev().length == 0 ) {
                        //     e.stopPropagation();
                        //     $(this).parent('li').prev('li.menu-item>a').focus()
                        //     $(this).parent().parent().parent().find('ul.dropdown-menu.show').removeClass('show')
                        //     $(this).parent().parent().parent().find('a.dropdown-toggle').attr('aria-expanded', 'false')
                        // }
                } 
                if ( $(this).closest('ul.dropdown-menu.dropdown-submenu').length > 0 ) {
                    if ( $(this).parent('li.menu-item:first-child').length > 0 ) {
                        e.stopPropagation();
                    }
                }
                if ( $(this).closest('li.menu-item:first').length > 0 ) {
                    $(this).closest('ul.dropdown-menu.show').prev('a.dropdown-toggle').focus()
                }
                break;

            case 'Enter': // Enter Key
                if ( $(this).next('ul.dropdown-menu.show').length ) {
                    console.log( 'Enter' )
                    $(this).next('ul.dropdown-menu.show').removeClass('show')
                    $(this).attr('aria-expanded', 'false')
                    $(this).parent().closest('li.menu-item').removeClass('show')
                    $(this).click()
                } else if ( $(this).next('ul.dropdown-menu').length ){
                    $(this).next('ul.dropdown-menu').addClass('show')
                    $(this).attr('aria-expanded', 'true')
                    $(this).parent().closest('li.menu-item').addClass('show')
                    $(this).click()
                }

                if ( $(this).closest('ul.navbar-nav').length > 0 && $(this).closest('ul.dropdown-menu').length == 0 ) {
                    if( $('ul.dropdown-menu.show').length ) {
                        $('ul.dropdown-menu').removeClass('show')
                        $('ul.dropdown-menu').prev('a').attr('aria-expanded', 'false')
                        $('ul.dropdown-menu').closest('li.menu-item').removeClass('show')
                    }
                }

		}
	});
})(jQuery);