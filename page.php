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
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
if ( is_front_page() ) :
	get_template_part( 'templates/global/hero' );
endif;

while ( have_posts() ) : the_post();
	get_template_part( 'templates/loop/content', 'page' );
endwhile; // end of the loop.
