<?php
/**
 * Load More layout.
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'spurs_load_more' ) ) {
	/**
	 * Spurs load more function
	 *
	 * @return void
	 */
	function spurs_load_more() {
		global $wp_query; // you can remove this line if everything works for you.

		// don't display the button if there are not enough posts.
		if ( $wp_query->max_num_pages > 1 ) {
			echo '<div class="spurs_loadmore btn btn-primary btn-lg mx-auto w-25">More posts</div>'; // you can use <a> as well.
		}
	}
}
/**
 * Scripts and query for load more
 *
 * @return void
 */
function jd_my_load_more_scripts() {

	global $wp_query;

	// In most cases it is already included on the page and this line can be removed.
	wp_enqueue_script( 'jquery' );

	// register our main script but do not enqueue it yet.
	// wp_register_script( 'my_loadmore', get_stylesheet_directory_uri() . '/js/myloadmore.js', array('jquery') ); .

	// now the most interesting part.
	// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP.
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script() .
	wp_localize_script(
		'spurs-scripts',
		'spurs_loadmore_params',
		array(
			'ajaxurl'      => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX!
			'posts'        => wp_json_encode( $wp_query->query_vars ), // everything about your loop is here.
			'current_page' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
			'max_page'     => $wp_query->max_num_pages,
		)
	);

	wp_enqueue_script( 'my_loadmore' );
}
add_action( 'wp_enqueue_scripts', 'jd_my_load_more_scripts' );
/**
 * Ajax handle for load more
 *
 * @return void
 */
function spurs_loadmore_ajax_handler() {
	// prepare our arguments for the query.
	$args                = json_decode( stripslashes( $_POST['query'] ), true ); //phpcs:ignore
	// we need next page to be loaded.
	$args['paged']       = $_POST['page'] + 1; //phpcs:ignore
	$args['post_status'] = 'publish';
	$search_page         = $_POST['search_page']; //phpcs:ignore

	// it is always better to use WP_Query but not here.
	query_posts( $args ); //phpcs:ignore

	if ( have_posts() ) :

		// run the loop!
		while ( have_posts() ) :
			the_post();

			// look into your theme code how the posts are inserted, but you can use your own HTML of course.
			// do you remember? - my example is adapted for Twenty Seventeen theme.
			if ( true === $search_page ) {
				get_template_part( 'templates/loop/content', 'search' );
			} else {
				get_template_part( 'templates/loop/content', get_post_format() );
			}
			// for the test purposes comment the line above and uncomment the below one
			// the_title(); .

		endwhile;

	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}
add_action( 'wp_ajax_loadmore', 'spurs_loadmore_ajax_handler' ); // wp_ajax_{action}.
add_action( 'wp_ajax_nopriv_loadmore', 'spurs_loadmore_ajax_handler' ); // wp_ajax_nopriv_{action}.
