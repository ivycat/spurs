<?php
/**
 * Check and setup theme's default settings
 *
 * @package spurs
 *
 */

if ( ! function_exists( 'spurs_setup_theme_default_settings' ) ) :
	function spurs_setup_theme_default_settings() {

		// check if settings are set, if not set defaults.
		// Caution: DO NOT check existence using === always check with == .
		// Latest blog posts style.
		$spurs_posts_index_style = get_theme_mod( 'spurs_posts_index_style' );
		if ( '' == $spurs_posts_index_style ) {
			set_theme_mod( 'spurs_posts_index_style', 'default' );
		}

		// Sidebar position.
		$spurs_sidebar_position = get_theme_mod( 'spurs_sidebar_position' );
		if ( '' == $spurs_sidebar_position ) {
			set_theme_mod( 'spurs_sidebar_position', 'right' );
		}

		// Container width.
		$spurs_container_type = get_theme_mod( 'spurs_container_type' );
		if ( '' == $spurs_container_type ) {
			set_theme_mod( 'spurs_container_type', 'container' );
		}
	}
endif;
