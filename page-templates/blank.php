<?php
/**
 * Template Name: Blank Page Template
 *
 * Template for displaying a blank page.
 *
 * @package spurs
 */

?>
<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'loop-templates/content', 'blank' ); ?>

<?php endwhile; // end of the loop. ?>