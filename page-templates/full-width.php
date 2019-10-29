<?php
/**
 * Template Name: Full width
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

while ( have_posts() ) : the_post();
	get_template_part( 'templates/loop/content', 'page' );

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
endwhile; // end of the loop.
