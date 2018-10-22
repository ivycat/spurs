<?php
/**
 * Hero setup.
 *
 * @package spurs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<?php if ( is_active_sidebar( 'hero-slider' ) || is_active_sidebar( 'hero-static' ) ) { ?>

    <div class="wrapper" id="wrapper-hero">
	    <?php get_template_part( 'templates/sidebar/hero' ); ?>
	    <?php get_template_part( 'templates/sidebar/hero', 'static' ); ?>
    </div>

<?php }
