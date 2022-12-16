<?php
/**
 * The template for displaying all WooCommerce pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package spurs
 */

$template_name = '\archive-product.php';
$args          = array();
$template_path = '';
$default_path  = untrailingslashit( plugin_dir_path( __FILE__ ) ) . '\woocommerce';

if ( is_singular( 'product' ) ) {

	woocommerce_content();

	// Fetch the template override for ANY product archive, product taxonomy, product search, or /shop landing page.
} elseif ( file_exists( $default_path . $template_name ) ) {
	wc_get_template( $template_name, $args, $template_path, $default_path );

	// If no archive-product.php template exists, default to catch-all.
} else {
	?>
		<div class="eentry-content">
			<?php woocommerce_content(); ?>
		</div>
	<?php
};
