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
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if ( is_front_page() ) :
	get_template_part( 'templates/global/hero');
endif;

while ( have_posts() ) : the_post();
	get_template_part( 'loop-templates/content', 'page' );
endwhile; // end of the loop.
