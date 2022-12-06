<?php
/**
 * Search results partial template.
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<div class="page-content">
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<div class="row">
			<header class="entry-header">
				<?php
				the_title(
					sprintf( '<h3 class="entry-title pt-2"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
					'</a></h2>'
				);
				?>

				<?php if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php spurs_posted_on(); ?>
					</div>
				<?php endif; ?>
			</header>

			<div class="entry-content mb-4">
				<?php the_excerpt(); ?>
			</div>
		</div>
	</article>
</div>
