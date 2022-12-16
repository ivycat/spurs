<?php
/**
 * WordPress.com-specific functions and definitions
 *
 * This file is centrally included from `wp-content/mu-plugins/wpcom-theme-compat.php`.
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Adds support for wp.com-specific theme functions.
 *
 * @global array $themecolors
 */
add_action( 'after_setup_theme', 'spurs_wpcom_setup' );

if ( ! function_exists( 'spurs_wpcom_setup' ) ) {
	/**
	 * WPCom setup
	 *
	 * @return void
	 */
	function spurs_wpcom_setup() {
		global $themecolors;

		// Set theme colors for third party services.
		if ( ! isset( $themecolors ) ) {
			$themecolors = array(
				'bg'     => '',
				'border' => '',
				'text'   => '',
				'link'   => '',
				'url'    => '',
			);
		}

		/* Add WP.com print styles */
		add_theme_support( 'print-styles' );
	}
}


/*
 * WordPress.com-specific styles
 */
add_action( 'wp_enqueue_scripts', 'spurs_wpcom_styles' );

if ( ! function_exists( 'spurs_wpcom_styles' ) ) {
	/**
	 * WPCom Styles
	 *
	 * @return void
	 */
	function spurs_wpcom_styles() {
		wp_enqueue_style( 'spurs-wpcom', get_template_directory_uri() . '/inc/style-wpcom.css', array(), '20160411' );
	}
}
