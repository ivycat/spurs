<?php
/**
 * Search results partial template.
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
			'</a></h2>' ); ?>

		<?php if ( 'post' == get_post_type() ) { ?>
            <div class="entry-meta">
				<?php spurs_posted_on(); ?>
            </div>
		<?php } ?>
    </header>

    <div class="entry-summary">
		<?php the_excerpt(); ?>
    </div>

    <footer class="entry-footer">
		<?php spurs_entry_footer(); ?>
    </footer>

</article>
