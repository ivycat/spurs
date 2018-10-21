<?php
/**
 * Template Name: Blank page
 *
 * Template for displaying a blank page.
 *
 * @package spurs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
while ( have_posts() ) : the_post();
	get_template_part( 'templates/loop/content', 'blank' );
endwhile; // end of the loop.
