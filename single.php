<?php while ( have_posts() ) : the_post();
	get_template_part( 'loop-templates/content', 'single' );
	spurs_post_nav();

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}

endwhile; // end of the loop.
