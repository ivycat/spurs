<?php
// phpcs:ignoreFile
/**
 * Enable the theme wrapper.
 *
 * Thanks to:
 * Scribu http://scribu.net/wordpress/theme-wrappers.html
 * Ben Word and the team at roots.io
 *
 * @package spurs
 */

/**
 * Spurs template path
 *
 * @return String
 */
function spurs_template_path() {
	// variable name needs to be like snack_case.
	return SpursWrapping::$mainTemplate; // phpcs:ignore
}

/**
 * Spurs template base
 *
 * @return String
 */
function spurs_template_base() {
	return SpursWrapping::$base;
}

/**
 * Class needs to be in a seperate file
 */
class SpursWrapping {

	/**
	 * Stores the full path to the main template file
	 *
	 * @var string
	 */
	// Member variable "$mainTemplate" is not in valid snake_case format, try "$main_template".
	public static $mainTemplate; // phpcs:ignore

	/**
	 * Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
	 *
	 * @var string
	 */
	public static $base;

	/**
	 * Wrapper function
	 *
	 * @param [type] $template Template name.
	 * @return String
	 */
	public static function wrap( $template ) {
		// Object property "$mainTemplate" is not in valid snake_case format, try "$main_template".
		self::$mainTemplate = $template; // phpcs:ignore

		self::$base = substr( basename( self::$mainTemplate ), 0, - 4 ); //phpcs:ignore

		if ( 'index' === self::$base ) {
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
