<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package spurs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$the_theme        = wp_get_theme();
$container        = get_theme_mod( 'spurs_container_type' );
$sidebar_position = get_theme_mod( 'spurs_sidebar_position' );
?>

</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->


<?php get_sidebar( 'footer-full' ); ?>

<div class="wrapper" id="wrapper-footer">
    <div class="<?php echo esc_attr( $container ); ?>">
        <div class="row">
            <div class="col-md-12">
                <footer class="site-footer" id="colophon">
                    <div class="site-info small">
						<?php spurs_site_info(); ?>
                    </div><!-- .site-info -->
                </footer><!-- #colophon -->
            </div><!--col end -->
        </div><!-- row end -->
    </div><!-- container end -->
</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

