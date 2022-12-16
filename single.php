<?php
/**
 * The template for displaying all single posts.
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

while ( have_posts() ) :
	the_post();
	if ( get_post_type() === 'post' ) {
		get_template_part( 'templates/loop/content', 'single' );
		//phpcs:ignore spurs_post_nav();
	} else {
		get_template_part( 'templates/loop/content-single', get_post_type() );
	}

	// If comments are open or we have at least one comment, load up the comment template.
	// @codingStandardsIgnoreStart
	// if ( comments_open() || get_comments_number() ) :
	// 	comments_template();
	// endif;
	// @codingStandardsIgnoreEnd

endwhile; // end of the loop.
