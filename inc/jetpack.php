<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.me/
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/infinite-scroll/
 * See: https://jetpack.me/support/responsive-videos/
 */

add_action( 'after_setup_theme', 'spurs_components_jetpack_setup' );

if ( ! function_exists( 'spurs_components_jetpack_setup' ) ) {
	/**
	 * Spurs jetpack setup
	 *
	 * @return void
	 */
	function spurs_components_jetpack_setup() {
		// Add theme support for Infinite Scroll.
		add_theme_support(
			'infinite-scroll',
			array(
				'container' => 'main',
				'render'    => 'components_infinite_scroll_render',
				'footer'    => 'page',
			)
		);

		// Add theme support for Responsive Videos.
		add_theme_support( 'jetpack-responsive-videos' );

		// Add theme support for Social Menus.
		add_theme_support( 'jetpack-social-menu' );

	}
}

/**
 * Custom render function for Infinite Scroll.
 */
if ( ! function_exists( 'spurs_components_infinite_scroll_render' ) ) {
	/**
	 * Spurs infinite scroll
	 *
	 * @return void
	 */
	function spurs_components_infinite_scroll_render() {
		while ( have_posts() ) {
			the_post();
			if ( is_search() ) {
				get_template_part( 'templates/loop/content', 'search' );
			} else {
				get_template_part( 'templates/loop/content', get_post_format() );
			}
		}
	}
}

if ( ! function_exists( 'spurs_components_social_menu' ) ) {
	/**
	 * Spurs social menu
	 *
	 * @return void
	 */
	function spurs_components_social_menu() {
		if ( ! function_exists( 'jetpack_social_menu' ) ) {
			return;
		} else {
			jetpack_social_menu();
		}
	}
}
