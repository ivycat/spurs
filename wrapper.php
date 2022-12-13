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

if ( ! is_front_page() && function_exists( 'yoast_breadcrumb' ) ) {
	yoast_breadcrumb( '<div id="breadcrumbs">', '</div>' );
}
?>

	<div id="primary" class="<?php spurs_content_classes(); ?>">

		<?php
		/**
		 * To get template slug - get_page_template_slug() is useful.
		 * to get sidebar positioning - get_theme_mod('spurs_sidebar_position') is useful.
		 * default template can be check with - is_page_template( 'default' ) this function.
		 *
		 * Currently both option needs to selected.
		 * for Example if you want to enable right sidebar then
		 * you need to set option from both customizer and page template.
		 * If both is selected, then container class will be added.
		 */
		if (
			(
				is_page_template( 'page-templates/sidebar-left.php' ) ||
				is_page_template( 'page-templates/sidebar-right.php' ) ||
				is_page_template( 'page-templates/both-sidebars.php' )
			) && (
				is_active_sidebar( 'sidebar-left' ) ||
				is_active_sidebar( 'sidebar-right' )
			)
		) {
			echo '<div class="container"><div class=row>';
		}
		?>

		<?php spurs_left_sidebar(); ?>

		<main class="site-main <?php spurs_column_classes(); ?>" id="main">
			<?php require spurs_template_path(); ?>
			<?php

			if ( 'pagination' === get_theme_mod( 'spurs_pagination' ) ) {
				spurs_pagination();
			} else {
				spurs_load_more();
			}

			?>
		</main>


		<?php spurs_right_sidebar(); ?>

		<?php
		/**
		 * Currently both option needs to selected.
		 * for Example if you want to enable right sidebar then
		 * you need to set option from both customizer and page template.
		 * If both is selected, then container wrapper class will be added.
		 */
		if (
			(
				is_page_template( 'page-templates/sidebar-left.php' ) ||
				is_page_template( 'page-templates/sidebar-right.php' ) ||
				is_page_template( 'page-templates/both-sidebars.php' )
			) && (
				is_active_sidebar( 'sidebar-left' ) ||
				is_active_sidebar( 'sidebar-right' )
			)
		) {
			echo '</div></div>';
		}
		?>

	</div>

<?php

get_footer( spurs_template_base() );
