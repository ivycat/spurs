<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package spurs
 */

if ( ! is_active_sidebar( 'sidebar-left' ) ) {
	return;
} ?>

<div class="<?php spurs_sidebar_classes(); ?>" id="sidebar-left" role="complementary">
	<?php dynamic_sidebar( 'sidebar-left' ); ?>
</div><!-- #left-sidebar -->
