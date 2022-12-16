<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! is_front_page() && function_exists( 'yoast_breadcrumb' ) ) {
	yoast_breadcrumb( '<div id="breadcrumbs">', '</div>' );
}

if ( have_posts() ) : ?>

	<header class="page-header">
		<?php
		the_archive_title( '<h1 class="page-title">', '</h1>' );
		the_archive_description( '<div class="taxonomy-description">', '</div>' );
		?>
	</header><!-- .page-header -->
	<div class="page-content container">
		<div class="latest-posts-list">
			<div class="card-group has-col-3">
	<?php
	/* Start the Loop */
	while ( have_posts() ) :
		the_post();

		/*
		 * Include the Post-Format-specific template for the content.
		 * If you want to override this in a child theme, then include a file
		 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		 */
		get_template_part( 'templates/loop/content', get_post_format() );
				endwhile;
	?>
			</div>
		</div>
	</div>
	<?php
else :
	get_template_part( 'templates/loop/content', 'none' );
endif;
