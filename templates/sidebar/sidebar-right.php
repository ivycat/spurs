<?php
/**
 * The right sidebar containing the main widget area.
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! is_active_sidebar( 'sidebar-right' ) ) {
	return;
} ?>

<div class="<?php spurs_sidebar_classes(); ?>" id="sidebar-right" role="complementary">
	<?php dynamic_sidebar( 'sidebar-right' ); ?>
</div>
