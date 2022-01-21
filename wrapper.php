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

get_header( spurs_template_base() );

if (!is_front_page() && function_exists('yoast_breadcrumb')) {
	yoast_breadcrumb('<div id="breadcrumbs">', '</div>');
}

?>

	<div id="primary" class="<?php spurs_content_classes(); ?>">
		<main class="site-main" id="main">
			<?php include spurs_template_path(); ?>
			<?php

				if( 'pagination' === get_theme_mod( 'spurs_pagination' ) ){
					spurs_pagination();
				} else {
					spurs_load_more();
				}

			?>
		</main>
	</div>

<?php
get_footer( spurs_template_base() );
