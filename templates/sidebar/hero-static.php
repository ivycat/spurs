<?php
/**
 * Static hero sidebar setup.
 *
 * @package spurs
 */

$container = get_theme_mod( 'spurs_container_type' );

 if ( is_active_sidebar( 'hero-static' ) ) {
	 /**
	  * The Hero widget area
	  */ ?>

     <div class="wrapper" id="wrapper-hero-static">
			<div class="<?php echo esc_attr( $container ); ?>" id="wrapper-static-content" tabindex="-1">
				<div class="row">
					<?php dynamic_sidebar( 'hero-static' ); ?>
				</div>
			</div>
	</div><!-- #wrapper-hero-static -->

<?php } ?>
