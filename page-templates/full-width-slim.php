<?php
/**
 * Template Name: Full width slim
 *
 * Template for displaying a slim page without sidebar even if a sidebar widget is published.
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! is_front_page() && function_exists( 'yoast_breadcrumb' ) ) {
	yoast_breadcrumb( '<div id="breadcrumbs">', '</div>' );
}

while ( have_posts() ) : the_post();
	get_template_part( 'templates/loop/content', 'page' );
endwhile; // end of the loop.
