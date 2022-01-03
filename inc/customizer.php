<?php
/**
 * Spurs Theme Customizer
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! function_exists( 'spurs_customize_register' ) ) {
	/**
	 * Register basic customizer support.
	 *
	 * @param object $wp_customize Customizer reference.
	 */
	function spurs_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}
}
add_action( 'customize_register', 'spurs_customize_register' );

if ( ! function_exists( 'spurs_theme_customize_register' ) ) {
	/**
	 * Register individual settings through customizer's API.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer reference.
	 */
	function spurs_theme_customize_register( $wp_customize ) {

		// Theme layout settings.
		$wp_customize->add_section(
			'spurs_theme_layout_options',
			array(
				'title'       => __( 'Theme Layout Settings', 'spurs' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Container width and sidebar defaults', 'spurs' ),
				'priority'    => 160,
			)
		);

		/**
		 * Select sanitization function
		 *
		 * @param string $input Slug to sanitize.
		 * @param WP_Customize_Setting $setting Setting instance.
		 *
		 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
		 */
		function spurs_theme_slug_sanitize_select( $input, $setting ) {

			// input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
			$input = sanitize_key( $input );

			// get the list of possible select options
			$choices = $setting->manager->get_control( $setting->id )->choices;

			// return input if valid or return default option
			return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

		}

		$wp_customize->add_setting(
			'spurs_pagination',
			array(
				'default'           => 'pagination',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'spurs_theme_slug_sanitize_select',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'spurs_pagination', array(
					'label'       => __( 'Pagination / Load More', 'spurs' ),
					'description' => __( 'Pagination or Load More for post listing.', 'spurs' ),
					'section'     => 'spurs_theme_layout_options',
					'settings'    => 'spurs_pagination',
					'type'        => 'select',
					'choices'     => array(
						'pagination'       => __( 'Pagination', 'spurs' ),
						'loadmore' => __( 'Load More', 'spurs' ),
					),
					'priority'    => '30',
				)
			)
		);
	}
} // endif function_exists( 'spurs_theme_customize_register' ).
add_action( 'customize_register', 'spurs_theme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( ! function_exists( 'spurs_customize_preview_js' ) ) {
	/**
	 * Setup JS integration for live previewing.
	 */
	function spurs_customize_preview_js() {
		wp_enqueue_script(
			'spurs_customizer',
			get_template_directory_uri() . '/js/customizer.js',
			array( 'customize-preview' ),
			'20130508',
			true
		);
	}
}
add_action( 'customize_preview_init', 'spurs_customize_preview_js' );
