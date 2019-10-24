<?php
/**
 * Custom hooks.
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'spurs_site_info' ) ) {
	/**
	 * Add site info hook to WP hook library.
	 */
	function spurs_site_info() {
		do_action( 'spurs_site_info' );
	}
}

if ( ! function_exists( 'spurs_add_site_info' ) ) {
	add_action( 'spurs_site_info', 'spurs_add_site_info' );

	/**
	 * Add site info content.
	 */
	function spurs_add_site_info() {
		$the_theme = wp_get_theme();

		$site_info = sprintf(
			'<a href="%1$s">%2$s</a><span class="sep"> | </span>%3$s(%4$s)',
			esc_url( __( 'http://wordpress.org/', 'spurs' ) ),
			sprintf(
			/* translators:*/
				esc_html__( 'Proudly powered by %s', 'spurs' ), 'WordPress'
			),
			sprintf( // WPCS: XSS ok.
			/* translators:*/
				esc_html__( 'Theme: %1$s by %2$s.', 'spurs' ), $the_theme->get( 'Name' ), '<a href="' . esc_url( __( 'http://spurs.com', 'spurs' ) ) . '">spurs.com</a>'
			),
			sprintf( // WPCS: XSS ok.
			/* translators:*/
				esc_html__( 'Version: %1$s', 'spurs' ), $the_theme->get( 'Version' )
			)
		);

		echo apply_filters( 'spurs_site_info_content', $site_info ); // WPCS: XSS ok.
	}
}
