<?php
/**
 * Clean up HTML
 *
 * @since:      1.0.0
 * @author:     sewmyheadon
 * @link:       https://ivycat.com
 */


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

