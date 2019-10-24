<?php
/**
 * Static hero sidebar setup.
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'spurs_container_type' );

if ( is_active_sidebar( 'hero-static' ) ) { ?>

    <div class="wrapper" id="wrapper-hero-static">
        <div class="<?php echo esc_attr( $container ); ?>" id="wrapper-static-content" tabindex="-1">
            <div class="row">
				<?php dynamic_sidebar( 'hero-static' ); ?>
            </div>
        </div>
    </div>

<?php } ?>
