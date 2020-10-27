<?php
/**
 * Spurs enqueue scripts
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'spurs_scripts' ) ) {
	/**
	 * Load theme JS and CSS
	 */
	function spurs_scripts() {
		// Get the theme data.
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );

		$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/css/theme.min.css' );
		wp_enqueue_style( 'spurs-styles', get_stylesheet_directory_uri() . '/css/theme.min.css', array(), $css_version );

		wp_enqueue_script( 'jquery' );

		//wp_enqueue_script('google.maps.api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBzGRoIbHnQqqYWxOYuTpE58WYGx6RkAjo&v=3.exp', null, null, true);

		$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/theme.min.js' );
		wp_enqueue_script( 'spurs-scripts', get_template_directory_uri() . '/js/theme.min.js', array(), $js_version, true );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
} // endif function_exists( 'spurs_scripts' ).

add_action( 'wp_enqueue_scripts', 'spurs_scripts' );

add_action('admin_head', 'spurs_admin_inline_styles');
function spurs_admin_inline_styles() {
	echo '<style>
    .wp-block{max-width: 1070px}
    .wp-block[data-align=wide]{max-width: 1250px}
  </style>';
}
