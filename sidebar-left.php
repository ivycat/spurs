<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package spurs
 */

if ( ! is_active_sidebar( 'left-sidebar' ) ) {
	return;
} ?>

<div class="<?php spurs_sidebar_classes(); ?>" id="left-sidebar" role="complementary">
    <?php dynamic_sidebar( 'left-sidebar' ); ?>
</div><!-- #left-sidebar -->