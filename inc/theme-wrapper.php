<?php
/**
 * Enable the theme wrapper.
 *
 * Thanks to:
 * Scribu http://scribu.net/wordpress/theme-wrappers.html
 * Ben Word and the team at roots.io
 *
 * @package spurs
 */

function spurs_template_path() {
	return SpursWrapping::$MainTemplate;
}

function spurs_template_base() {
	return SpursWrapping::$base;
}


class SpursWrapping {

	/**
	 * Stores the full path to the main template file
	 * @return string
	 */
	static $MainTemplate;

	/**
	 * Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
	 * @return string
	 */
	static $base;

	static function wrap( $template ) {
		self::$MainTemplate = $template;

		self::$base = substr( basename( self::$MainTemplate ), 0, - 4 );

		if ( 'index' == self::$base ) {
			self::$base = false;
		}

		$templates = array( 'wrapper.php' );

		if ( false !== self::$base ) {
			array_unshift( $templates, sprintf( 'wrapper-%s.php', self::$base ) );
		}

		return locate_template( $templates );
	}
}

add_filter( 'template_include', array( 'SpursWrapping', 'wrap' ), 99 );