<?php
/**
 * Theme basic setup.
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

add_action( 'after_setup_theme', 'spurs_setup' );
if ( ! function_exists( 'spurs_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function spurs_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Spurs, use a find and replace
		 * to change 'spurs' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'spurs', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'spurs' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Adding Thumbnail basic support
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Adding support for Widget edit icons in customizer
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'spurs_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Set up the WordPress Theme logo feature.
		add_theme_support( 'custom-logo' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for default styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full width blocks.
		add_theme_support( 'align-wide' );

		// Check and setup theme default settings.
		spurs_setup_theme_default_settings();

		// Adds Pacific Coast Producers brand colors to Blocks color palette.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => __( 'Green', 'spurs' ),
				'slug'  => 'green',
				'color' => '#6aaf08',
			),
			array(
				'name'  => __( 'Dark Green', 'spurs' ),
				'slug'  => 'dark-green',
				'color' => '#548a06',
			),
			array(
				'name'  => __( 'Blue', 'spurs' ),
				'slug'  => 'blue',
				'color' => '#007ac3',
			),
			array(
				'name'  => __( 'Black', 'spurs' ),
				'slug'  => 'black',
				'color' => '#2b2b2b',
			),
			array(
				'name'  => __( 'White', 'spurs' ),
				'slug'  => 'white',
				'color' => '#FFFFFF',
			),

		) );

		// Hard cropped featured images
		add_image_size( 'featured-rounded', 230, 230, true );
	}
} // spurs_setup.

add_filter( 'excerpt_more', 'spurs_custom_excerpt_more' );
if ( ! function_exists( 'spurs_custom_excerpt_more' ) ) {
	/**
	 * Removes the ... from the excerpt read more link
	 *
	 * @param string $more The excerpt.
	 *
	 * @return string
	 */
	function spurs_custom_excerpt_more( $more ) {
		if ( ! is_admin() ) {
			$more = '';
		}

		return $more;
	}
}

add_filter( 'wp_trim_excerpt', 'spurs_all_excerpts_get_more_link' );
if ( ! function_exists( 'spurs_all_excerpts_get_more_link' ) ) {
	/**
	 * Adds a custom read more link to all excerpts, manually or automatically generated
	 *
	 * @param string $post_excerpt Posts's excerpt.
	 *
	 * @return string
	 */
	function spurs_all_excerpts_get_more_link( $post_excerpt ) {
		$post_excerpt = $post_excerpt . ' [...]<p><a class="btn btn-secondary spurs-read-more-link" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">' . __( 'Read More...',
					'spurs' ) . '</a></p>';

		return $post_excerpt;
	}
}

// ACF Pro Options Page
if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page( array(
		'page_title' => 'Theme General Settings',
		'menu_title' => 'Theme Settings',
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect'   => false
	) );

}