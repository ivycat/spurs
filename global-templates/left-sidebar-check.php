<?php
/**
 * Left sidebar check.
 *
 * @package spurs
 */

?>

<?php
$default_sidebar_position = get_theme_mod( 'spurs_sidebar_position' );
?>

<?php if ( 'left' === $default_sidebar_position || 'both' === $default_sidebar_position ) : ?>
	<?php get_sidebar( 'left' ); ?>
<?php endif; ?>

<?php
$html = '';
if ( 'right' === $default_sidebar_position || 'left' === $default_sidebar_position ) {
	$html = '<div class="';
	if ( is_active_sidebar( 'right-sidebar' ) || is_active_sidebar( 'left-sidebar' ) ) {
		$html .= 'col-md-8 content-area" id="primary">';
	} else {
		$html .= 'col-md-12 content-area" id="primary">';
	}
	echo $html; // WPCS: XSS OK.
} elseif ( is_active_sidebar( 'right-sidebar' ) && is_active_sidebar( 'left-sidebar' ) ) {
	$html = '<div class="';
	if ( 'both' === $default_sidebar_position ) {
		$html .= 'col-md-6 content-area" id="primary">';
	} else {
		$html .= 'col-md-12 content-area" id="primary">';
	}
	echo $html; // WPCS: XSS OK.
} else {
	echo '<div class="col-md-12 content-area" id="primary">';
}

