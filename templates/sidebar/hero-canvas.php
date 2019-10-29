<?php
/**
 * Sidebar - Hero canvas setup.
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( is_active_sidebar( 'hero-canvas' ) ) :
	dynamic_sidebar( 'hero-canvas' );
endif;
