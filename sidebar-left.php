<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package spurs
 */

if ( ! is_active_sidebar( 'left-sidebar' ) ) {
	return;
}

$default_sidebar_position = get_theme_mod( 'understrap_sidebar_position' );

// when both sidebars turned on reduce col size is 3, otherwise it is 4.
if ( ( is_page_template( 'page-templates/both-sidebars.php' ) || ( 'both' === $default_sidebar_position ) ) && is_active_sidebar( 'left-sidebar' ) ) { ?>

<div class="col-md-3 widget-area" id="left-sidebar" role="complementary">
	<?php } else { ?>
<div class="col-md-4 widget-area" id="left-sidebar" role="complementary">
    <?php };
    dynamic_sidebar( 'left-sidebar' ); ?>
</div><!-- #secondary -->