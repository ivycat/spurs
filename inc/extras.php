<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package spurs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_filter( 'body_class', 'spurs_body_classes' );

if ( ! function_exists( 'spurs_body_classes' ) ) {
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @return array
	 */
	function spurs_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		return $classes;
	}
}

// Removes tag class from the body_class array to avoid Bootstrap markup styling issues.
add_filter( 'body_class', 'spurs_adjust_body_class' );

if ( ! function_exists( 'spurs_adjust_body_class' ) ) {
	/**
	 * Setup body classes.
	 *
	 * @param string $classes CSS classes.
	 *
	 * @return mixed
	 */
	function spurs_adjust_body_class( $classes ) {

		foreach ( $classes as $key => $value ) {
			if ( 'tag' == $value ) {
				unset( $classes[ $key ] );
			}
		}

		return $classes;
	}
}

// Filter custom logo with correct classes.
add_filter( 'get_custom_logo', 'spurs_change_logo_class' );

if ( ! function_exists( 'spurs_change_logo_class' ) ) {
	/**
	 * Replaces logo CSS class.
	 *
	 * @param string $html Markup.
	 *
	 * @return mixed
	 */
	function spurs_change_logo_class( $html ) {

		$html = str_replace( 'class="custom-logo"', 'class="img-fluid"', $html );
		$html = str_replace( 'class="custom-logo-link"', 'class="navbar-brand custom-logo-link"', $html );
		$html = str_replace( 'alt=""', 'title="Home" alt="logo"', $html );

		return $html;
	}
}

/**
 * Display navigation to next/previous post when applicable.
 */
if ( ! function_exists( 'spurs_post_nav' ) ) {

	function spurs_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
        <nav class="container navigation post-navigation">
            <h2 class="sr-only"><?php _e( 'Post navigation', 'spurs' ); ?></h2>
            <div class="row nav-links justify-content-between">
				<?php

				if ( get_previous_post_link() ) {
					previous_post_link( '<span class="nav-previous">%link</span>', _x( '<i class="fa fa-angle-left"></i>&nbsp;%title', 'Previous post link', 'spurs' ) );
				}
				if ( get_next_post_link() ) {
					next_post_link( '<span class="nav-next">%link</span>', _x( '%title&nbsp;<i class="fa fa-angle-right"></i>', 'Next post link', 'spurs' ) );
				}
				?>
            </div><!-- .nav-links -->
        </nav><!-- .navigation -->

		<?php
	}
}

/**
 * Search/replace string to make everything lower case and convert spaces and underscores to dashes.
 *
 * @param $string
 *
 * @return null|string|string[]
 */
function spurs_tidy_url( $string ) {
	// Convert everything to lower case
	$string = strtolower( $string );

	// Make everything alphanumeric (removes all other characters)
	$string = preg_replace( "/[^a-z0-9_\s-]/", "", $string );

	// Clean up multiple dashes or whitespace
	$string = preg_replace( "/[\s-]+/", " ", $string );

	// Convert whitespace and underscore to dash
	$string = preg_replace( "/[\s_]/", "-", $string );

	return $string;
}

/**
 * Set Google Maps API Key for Advanced Custom Fields
 */
add_action( 'acf/init', 'rcn_acf_init' );
function rcn_acf_init() {
	acf_update_setting( 'google_api_key', '' );
}


/**
 * Output background image style
 *
 * @param array|string $img Image array or url
 * @param string $size Image size to retrieve
 * @param bool $echo Whether to output the the style tag or return it.
 *
 * @return string|void String when retrieving.
 */
function bg( $img, $size = '', $echo = true ) {

	if ( ! $img ) {
		return;
	}

	if ( is_array( $img ) ) {
		$url = $size ? $img['sizes'][ $size ] : $img['url'];
	} else {
		$url = $img;
	}

	$string = 'style="background-image: url(' . $url . ')"';

	if ( $echo ) {
		echo $string;
	} else {
		return $string;
	}
}

/**
 * Output HTML markup of template with passed args
 *
 * @param string $file File name without extension (.php)
 * @param array $args Array with args ($key=>$value)
 * @param string $default_folder Requested file folder
 *
 * */
function show_template( $file, $args = null, $default_folder = 'parts' ) {
	echo return_template( $file, $args, $default_folder );
}

/**
 * Return HTML markup of template with passed args
 *
 * @param string $file File name without extension (.php)
 * @param array $args Array with args ($key=>$value)
 * @param string $default_folder Requested file folder
 *
 * @return string template HTML
 * */
function return_template( $file, $args = null, $default_folder = 'parts' ) {
	$file = $default_folder . '/' . $file . '.php';
	if ( $args ) {
		extract( $args );
	}
	if ( locate_template( $file ) ) {
		ob_start();
		include( locate_template( $file ) ); //Theme Check free. Child themes support.
		$template_content = ob_get_clean();

		return $template_content;
	}

	return '';
}

/**
 * Remove WordPress Generator HTML comments
 */
remove_action( 'wp_head', 'wp_generator' );

/**
 * Remove WooCommerce Generator HTML comments.
 */
remove_action( 'wp_head', 'wc_generator_tag' );

/**
 * Remove All in One SEO Pack HTML comments
 * @link //gist.github.com/llgruff/a7ab776167aa0ed307ec445df54e5fdb
 */
if ( defined( 'AIOSEOP_VERSION' ) ) {
	add_action( 'get_header', function () {
		ob_start(
			function ( $o ) {
				return preg_replace( '/\n?<.*?One SEO Pack.*?>/mi', '', $o );
			}
		);
	} );
	add_action( 'wp_head', function () {
		ob_end_flush();
	}, 999 );
}
/**
 * Remove Yoast SEO HTML comments
 * @link //gist.github.com/llgruff/a7ab776167aa0ed307ec445df54e5fdb
 * @link //gist.github.com/paulcollett/4c81c4f6eb85334ba076
 */
if ( defined( 'WPSEO_VERSION' ) ) {
	add_action( 'get_header', function () {
		ob_start(
			function ( $o ) {
				return preg_replace( '/\n?<.*?yoast.*?>/mi', '', $o );
			}
		);
	} );
	add_action( 'wp_head', function () {
		ob_end_flush();
	}, 999 );
}
/**
 * Remove Google Analytics by MonsterInsights HTML comments
 * @link https://wordpress.org/plugins/remove-google-analytics-comments/
 */
function isgabmi_active( $plugin ) {
	$network_active = false;
	if ( is_multisite() ) {
		$plugins = get_site_option( 'active_sitewide_plugins' );
		if ( isset( $plugins[ $plugin ] ) ) {
			$network_active = true;
		}
	}

	return in_array( $plugin, get_option( 'active_plugins' ) ) || $network_active;
}

if ( isgabmi_active( 'google-analytics-for-wordpress/googleanalytics.php' ) || isgabmi_active( 'google-analytics-premium/googleanalytics.php' ) ) {
	add_action( 'get_header', function () {
		ob_start( function ( $o ) {
			return preg_replace( '/\n?<.*?monsterinsights.*?>/mi', '', $o );
		} );
	} );
	add_action( 'wp_head', function () {
		ob_end_flush();
	}, 999 );
}

