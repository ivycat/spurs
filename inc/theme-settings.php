<?php
/**
 * Check and setup theme's default settings
 *
 * @package spurs
 *
 */

if ( ! function_exists( 'spurs_setup_theme_default_settings' ) ) {
	function spurs_setup_theme_default_settings() {

		// Check if settings are set, if not set defaults.
		// Caution: DO NOT check existence using === always check with == .

		// Latest blog posts style.
		$spurs_now_posts_look = get_theme_mod( 'spurs_now_posts_look' );
		if ( '' == $spurs_now_posts_look ) {
			set_theme_mod( 'spurs_now_posts_look', 'default' );
		}

		// Sidebar position.
		$spurs_sb_position = get_theme_mod( 'spurs_sb_position' );
		if ( '' == $spurs_sb_position ) {
			set_theme_mod( 'spurs_sb_position', 'right' );
		}

		// Container width.
		$spurs_container_type = get_theme_mod( 'spurs_container_type' );
		if ( '' == $spurs_container_type ) {
			set_theme_mod( 'spurs_container_type', 'container' );
		}
	}
}

add_action( 'after_setup_theme', 'spurs_setup_theme_default_settings' );
