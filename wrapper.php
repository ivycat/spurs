<?php
/**
 * The main wrapper.
 *
 * This is a meta file and not common in every WordPress theme.
 * It wraps around the page templates to remove repeated code and keep
 * the theme DRY.
 *
 * It's inspired by Scribu and the Roots/Sage project.
 *
 * @link http://scribu.net/wordpress/theme-wrappers.html
 *
 * @package spurs
 */

get_header( spurs_template_base() ); ?>

    <main class="site-main" id="main">
		<?php include spurs_template_path(); ?>
    </main><!-- #main -->

<?php
//get_sidebar( spurs_template_base() );
get_footer( spurs_template_base() );
