<?php
/**
 * Spurs functions and definitions
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$spurs_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/theme-wrapper.php',                   // Load theme wrapper.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags.
	'/pagination.php',                      // Custom pagination.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom comments.
	'/jetpack.php',                         // Jetpack compatibility.
	'/bootstrap-wp-navwalker.php',          // custom WordPress nav walker.
	'/woocommerce.php',                     // WooCommerce functions.
	'/editor.php',                          // Editor functions.
);

foreach ( $spurs_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}
