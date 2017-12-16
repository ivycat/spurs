<?php
/**
 * Static hero sidebar setup.
 *
 * @package spurs
 */

$container   = get_theme_mod( 'spurs_container_type' );

?>

<?php if ( is_active_sidebar( 'static-hero' ) ) : ?>

	<!-- ******************* The Hero Widget Area ******************* -->

	<div class="wrapper" id="wrapper-static-hero">

			<div class="<?php echo esc_attr( $container ); ?>" id="wrapper-static-content" tabindex="-1">

				<div class="row">

					<?php dynamic_sidebar( 'static-hero' ); ?>

				</div>

			</div>

	</div><!-- #wrapper-static-hero -->

<?php endif; ?>
