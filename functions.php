<?php
/**
 * Spurs functions and definitions
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$spurs_includes = array(
	'/cleanup.php',             // Editor functions.
	'/custom-comments.php',     // Custom comments.
	'/custom-cpt.php',          // Initialize theme default settings.
	'/customizer.php',          // Customizer additions.
	'/enqueue.php',             // Enqueue scripts and styles.
	'/extras.php',              // Custom functions that act independently of the theme templates.
	'/hooks.php',               // Custom hooks.
	'/jetpack.php',             // Jetpack compatibility.
	'/load-more.php',           // Custom Load More.
	'/pagination.php',          // Custom pagination.
	'/setup.php',               // Theme setup and custom theme supports.
	'/template-tags.php',       // Custom template tags.
	'/theme-wrapper.php',       // Load theme wrapper.
	'/widgets.php',             // Register widget area.
	'/woocommerce.php',         // WooCommerce functions.
	'/wpcom.php',               // WooCommerce functions.
);

foreach ( $spurs_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}
