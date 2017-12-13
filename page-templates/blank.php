<?php
/**
 * Template Name: Blank Page Template
 *
 * Template for displaying a blank page.
 *
 * @package spurs
 */

while ( have_posts() ) : the_post();
	get_template_part( 'loop-templates/content', 'blank' );
endwhile; // end of the loop.