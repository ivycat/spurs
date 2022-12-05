<?php
/**
 * Check and setup theme's default settings
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'spurs_setup_theme_default_settings' ) ) {
	/**
	 * Spurs default settings
	 *
	 * @return void
	 */
	function spurs_setup_theme_default_settings() {

		// Check if settings are set, if not set defaults.
		// Caution: DO NOT check existence using === always check with == .

		// Latest blog posts style.
		$spurs_now_posts_look = get_theme_mod( 'spurs_now_posts_look' );
		if ( '' === $spurs_now_posts_look ) {
			set_theme_mod( 'spurs_now_posts_look', 'default' );
		}

		// Sidebar position.
		$spurs_sidebar_position = get_theme_mod( 'spurs_sidebar_position' );
		if ( '' === $spurs_sidebar_position ) {
			set_theme_mod( 'spurs_sidebar_position', 'none' );
		}

		// Container width.
		$spurs_container_type = get_theme_mod( 'spurs_container_type' );
		if ( '' === $spurs_container_type ) {
			set_theme_mod( 'spurs_container_type', 'container' );
		}
	}
}
