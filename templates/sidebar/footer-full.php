<?php
/**
 * Sidebar setup for footer full.
 *
 * @package spurs
 */

$container = get_theme_mod( 'spurs_container_type' );

/**
 * The full-width footer widget area
 */
if ( is_active_sidebar( 'footer-full' ) ) { ?>

    <div class="wrapper" id="wrapper-footer-full">
        <div class="<?php echo esc_attr( $container ); ?>" id="footer-full-content" tabindex="-1">
            <div class="row">
				<?php dynamic_sidebar( 'footer-full' ); ?>
            </div>
        </div>
    </div><!-- #wrapper-footer-full -->

<?php } ?>
