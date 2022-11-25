<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

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
			if ( 'tag' === $value ) {
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

if ( ! function_exists( 'spurs_post_nav' ) ) {
	/**
	 * Display navigation to next/previous post when applicable.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function spurs_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="container navigation post-navigation">
			<h2 class="sr-only"><?php esc_html_e( 'Post navigation', 'spurs' ); ?></h2>
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
if ( ! function_exists( 'spurs_pingback' ) ) {
	/**
	 * Add a pingback url auto-discovery header for single posts of any post type.
	 */
	function spurs_pingback() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">' . "\n";
		}
	}
}
add_action( 'wp_head', 'spurs_pingback' );

if ( ! function_exists( 'spurs_mobile_web_app_meta' ) ) {
	/**
	 * Add mobile-web-app meta.
	 */
	function spurs_mobile_web_app_meta() {
		echo '<meta name="mobile-web-app-capable" content="yes">' . "\n";
		echo '<meta name="apple-mobile-web-app-capable" content="yes">' . "\n";
		echo '<meta name="apple-mobile-web-app-title" content="' . esc_attr( get_bloginfo( 'name' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'spurs_mobile_web_app_meta' );


/**
 * Search/replace string to make everything lower case and convert spaces and underscores to dashes.
 *
 * @param [type] $string url parameter as a string.
 * @return null|string|string[]
 */
function spurs_tidy_url( $string ) {
	// Convert everything to lower case.
	$string = strtolower( $string );

	// Make everything alphanumeric (removes all other characters).
	$string = preg_replace( '/[^a-z0-9_\s-]/', '', $string );

	// Clean up multiple dashes or whitespace.
	$string = preg_replace( '/[\s-]+/', ' ', $string );

	// Convert whitespace and underscore to dash.
	$string = preg_replace( '/[\s_]/', '-', $string );

	return $string;
}

/**
 * Set Google Maps API Key for Advanced Custom Fields
 */
add_action( 'acf/init', 'rcn_acf_init' );
/**
 * ACF init
 *
 * @return void
 */
function rcn_acf_init() {
	acf_update_setting( 'google_api_key', '' );
}


if ( ! function_exists( 'bg' ) ) {
	/**
	 * Output background image style
	 *
	 * @param array|string $img Image array or url.
	 * @param string       $size Image size to retrieve.
	 * @param bool         $echo Whether to output the the style tag or return it..
	 * @param string       $additional_style Additional style to add.
	 *
	 * @return string|void String when retrieving.
	 */
	function bg( $img, $size = '', $echo = true, $additional_style = '' ) {
		if ( ! $img ) {
			return;
		}

		if ( is_array( $img ) ) {
			$url = $size ? $img['sizes'][ $size ] : $img['url'];
		} else {
			$url = $img;
		}

		// @codingStandardsIgnoreStart
		/*
		if (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false) {

			$webp_suffix_url = $url . '.webp';
			$headers = @get_headers($webp_suffix_url);

			if (strpos($headers[0], '200') > -1) {
				$url = $webp_suffix_url;
			} else {
				$webp_url = preg_replace('/(?:jpg|png|gif)$/i', 'webp', $url);
				$headers = @get_headers($webp_url);

				if (strpos($headers[0], '200') > -1) {
					$url = $webp_url;
				}
			}
		}
		*/
		// @codingStandardsIgnoreEnd

		$string = 'style="background-image: url(' . $url . '); ' . $additional_style . '"';

		if ( $echo ) {
			echo wp_kses_post( $string );
		} else {
			return $string;
		}
	}
}

if ( ! function_exists( 'show_template' ) ) {
	/**
	 * Output HTML markup of template with passed args
	 *
	 * @param string $file File name without extension (.php).
	 * @param array  $args Array with args ($key=>$value).
	 * @param string $default_folder Requested file folder.
	 * */
	function show_template( $file, $args = null, $default_folder = 'parts' ) {
		echo return_template( $file, $args, $default_folder ); //phpcs:ignore
	}
}

if ( ! function_exists( 'return_template' ) ) {
	/**
	 * Return HTML markup of template with passed args
	 *
	 * @param string $file File name without extension (.php).
	 * @param array  $args Array with args ($key=>$value).
	 * @param string $default_folder Requested file folder.
	 *
	 * @return string template HTML
	 * */
	function return_template( $file, $args = null, $default_folder = 'parts' ) {
		$file = $default_folder . '/' . $file . '.php';
		if ( $args ) {
			// extract() usage is highly discouraged, due to the complexity and unintended issues it might cause.
			extract( $args ); // phpcs:ignore 
		}
		if ( locate_template( $file ) ) {
			ob_start();
			include locate_template( $file ); // Theme Check free. Child themes support.
			$template_content = ob_get_clean();

			return $template_content;
		}

		return '';
	}
}

//phpcs:ignore add_action( 'init', 'spurs_register_cpt_taxonomies');

/**
 * Remove comment below in order to create CPTs and Taxonomies dynamically.
 *
 * @return void
 */
function spurs_register_cpt_taxonomies() {
	spurs_register_cpts();
	spurs_register_taxonomies();
}

/**
 * Register custom post type
 *
 * @return void
 */
function spurs_register_cpts() {

	$cpts[] = array(
		'name'  => 'report',
		'names' => array(
			'singular'    => 'report',
			'plural'      => 'reports',
			'uc_singular' => 'Report',
			'uc_plural'   => 'Reports',
		),
		'icon'  => 'analytics',
	);

	if ( count( $cpts ) > 0 ) {
		foreach ( $cpts as $cpt ) {
			$cpt_obj = new Spurs_CPT_Creator();
			$cpt_obj->register_cpt( $cpt['name'], $cpt['names'], $cpt['icon'] );
		}
	}
}

/**
 * Register taxonomy
 *
 * @return void
 */
function spurs_register_taxonomies() {

	$taxonomies[] = array(
		'name'         => 'report-type',
		'post_type'    => 'report',
		'names'        => array(
			'singular'    => 'report-type',
			'plural'      => 'report-types',
			'uc_singular' => 'Report Type',
			'uc_plural'   => 'Report Types',
		),
		'hierarchical' => true,
	);

	if ( count( $taxonomies ) > 0 ) {
		foreach ( $taxonomies as $tax ) {
			$tax_obj = new Spurs_CPT_Creator();
			$tax_obj->register_taxonomy( $tax['name'], $tax['post_type'], $tax['names'], $tax['hierarchical'] );
		}
	}
}
