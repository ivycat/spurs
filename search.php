<?php
/**
 * The template for displaying search results pages.
 *
 * @package spurs
 */
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( have_posts() ) : ?>
	<header class="page-header">
		<h1 class="page-title"><?php printf(
			/* translators:*/
				esc_html__( 'Search Results for: %s', 'spurs' ),
				'<span>' . get_search_query() . '</span>' ); ?></h1>
	</header><!-- .page-header -->

	<?php /* Start the Loop */
	while ( have_posts() ) : the_post();
		/**
		 * Run the loop for the search to output the results.
		 * If you want to overload this in a child theme then include a file
		 * called content-search.php and that will be used instead.
		 */
		get_template_part( 'templates/loop/content', 'search' );
	endwhile;
else :
	get_template_part( 'templates/loop/content', 'none' );
endif;
