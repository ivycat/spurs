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
		return spurs_Wrapping::$main_template;
	}

	function spurs_template_base() {
		return spurs_Wrapping::$base;
	}


	class spurs_Wrapping {

		/**
		 * Stores the full path to the main template file
		 */
		static $main_template;

		/**
		 * Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
		 */
		static $base;

		static function wrap( $template ) {
			self::$main_template = $template;

			self::$base = substr( basename( self::$main_template ), 0, -4 );

			if ( 'index' == self::$base ) {
				self::$base = false;
			}

			$templates = array( 'wrapper.php' );

			if ( self::$base ) {
				array_unshift( $templates, sprintf( 'wrapper-%s.php', self::$base ) );
			}
			return locate_template( $templates );
		}
	}

	add_filter( 'template_include', array( 'spurs_Wrapping', 'wrap' ), 99 );