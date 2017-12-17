<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package spurs
 */
if ( is_front_page() ) :
	get_template_part( 'global-templates/hero' );
endif;

while ( have_posts() ) : the_post();
	get_template_part( 'loop-templates/content', 'page' );

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
endwhile; // end of the loop.