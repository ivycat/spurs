$ = jQuery;
jQuery(function($){ // use jQuery code inside this to avoid "$ is not defined" error
	$('.spurs_loadmore').click(function(){

 		var search_page = false;
 		if ($('body').hasClass('search-results')){
 			search_page = true;
 		}
		var button = $(this),
		    data = {
			'action': 'loadmore',
			'query': spurs_loadmore_params.posts, // that's how we get params from wp_localize_script() function
			'page' : spurs_loadmore_params.current_page,
			'search_page' : search_page
		};

		$.ajax({ // you can also use $.post here
			url : spurs_loadmore_params.ajaxurl, // AJAX handler
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Loading...'); // change the button text, you can also add a preloader image
			},
			success : function( data ){
				if( data ) {
					button.text( 'More posts' );
					$('.latest-news-list > .card-group').append(data); // insert new posts
					spurs_loadmore_params.current_page++;

					if ( spurs_loadmore_params.current_page == spurs_loadmore_params.max_page )
						button.remove(); // if last page, remove the button

					// you can also fire the "post-load" event here if you use a plugin that requires it
					// $( document.body ).trigger( 'post-load' );
				} else {
					button.remove(); // if no data, remove the button as well
				}
			}
		});
	});
});
