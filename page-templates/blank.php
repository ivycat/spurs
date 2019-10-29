<?php
/**
 * Template Name: Blank page
 *
 * Template for displaying a blank page.
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
while ( have_posts() ) : the_post();
	get_template_part( 'templates/loop/content', 'blank' );
endwhile; // end of the loop.
