<?php
/**
 * Single post partial template.
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="entry-meta">
			<?php spurs_posted_on(); ?>
		</div>
	</header>

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content">
		<?php the_content();
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'spurs' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php spurs_entry_footer(); ?>
	</footer>

</article>
