<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$id = get_the_ID();

if ( is_home() ) {
	$id = get_option( 'page_for_posts' );
}

?>
<header class="entry-header">
    <h1 class="entry-title"><?php echo get_the_title( $id ); ?></h1>
</header>

<div class="entry-content pt-5">
    <div class="latest-news-list">
        <div class="card-group has-col-3">
			<?php
			if ( have_posts() ) : while ( have_posts() ) : the_post();

		/*
		* Include the Post-Format-specific template for the content.
		* If you want to override this in a child theme, then include a file
		* called content-___.php (where ___ is the Post Format name) and that will be used instead.
		*/
		get_template_part( 'templates/loop/content', get_post_format() );
	endwhile;
else :
	get_template_part( 'templates/loop/content', 'none' );
endif;

