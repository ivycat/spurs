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

		<?php if ( ( is_page_template( 'page-templates/sidebar-left.php' ) || is_page_template( 'page-templates/sidebar-right.php' ) || is_page_template( 'page-templates/both-sidebars.php' ) ) && ( is_active_sidebar( 'sidebar-left' ) || is_active_sidebar( 'sidebar-right' ) )  ) {
			echo '<div class="container"><div class=row>';
		} ?>

		<?php spurs_left_sidebar(); ?>

		<main class="site-main <?php spurs_column_classes() ?>" id="main">
			<?php include spurs_template_path(); ?>
		</main>

		<?php spurs_right_sidebar(); ?>

		<?php if ( ( is_page_template( 'page-templates/sidebar-left.php' ) || is_page_template( 'page-templates/sidebar-right.php' ) ) && ( is_active_sidebar( 'sidebar-left' ) || is_active_sidebar( 'sidebar-right' ) )  ) {
			echo '</div></div>';
		} ?>

	</div>

<?php
if( 'pagination' === get_theme_mod( 'spurs_pagination' ) ){
	spurs_pagination();
} else {
	spurs_load_more();
}

get_footer( spurs_template_base() );
