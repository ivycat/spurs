<?php
/**
 * Template Name: Default Template
 *
 * Template for displaying page content at default (slim) width.
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

while ( have_posts() ) : the_post();
	get_template_part( 'templates/loop/content', 'page' );

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
endwhile; // end of the loop.
