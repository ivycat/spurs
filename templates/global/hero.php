<?php
/**
 * Hero setup.
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<?php if ( is_active_sidebar( 'hero-slider' ) || is_active_sidebar( 'hero-static' ) ) { ?>

	<div class="wrapper" id="wrapper-hero">
		<?php
		get_template_part( 'templates/sidebar/hero' );
		get_template_part( 'templates/sidebar/hero', 'static' );
		?>
	</div>

	<?php
}
