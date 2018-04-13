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
	return Spurs_Wrapping::$Main_Template;
}

function spurs_template_base() {
	return Spurs_Wrapping::$base;
}


class Spurs_Wrapping {

	/**
	 * Stores the full path to the main template file
	 * @return string
	 */
	static $Main_Template;

	/**
	 * Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
	 * @return string
	 */
	static $base;

	static function wrap( $template ) {
		self::$Main_Template = $template;

		self::$base = substr( basename( self::$Main_Template ), 0, - 4 );

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

add_filter( 'template_include', array( 'Spurs_Wrapping', 'wrap' ), 99 );