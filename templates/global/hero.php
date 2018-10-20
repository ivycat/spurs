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

<?php if ( is_active_sidebar( 'slider-hero' ) || is_active_sidebar( 'static-hero' ) ) { ?>

    <div class="wrapper" id="wrapper-hero">
	    <?php get_sidebar( 'hero' ); ?>
		<?php get_sidebar( 'static-hero' ); ?>
    </div>

<?php }
