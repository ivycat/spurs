<?php
/**
 * Template Name: Left & right sidebars
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @package spurs
 */

while ( have_posts() ) : the_post();
	get_template_part( 'loop-templates/content', 'page' );

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
endwhile; // end of the loop.