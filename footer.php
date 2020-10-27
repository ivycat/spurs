<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$the_theme        = wp_get_theme();
$container        = get_theme_mod( 'spurs_container_type' );
$sidebar_position = get_theme_mod( 'spurs_sidebar_position' );
?>

</div><!-- / .wrapper -->


<?php get_template_part( 'templates/sidebar/footer', 'full' ); ?>

<div class="wrapper" id="wrapper-footer">
    <div class="<?php echo esc_attr( $container ); ?>">
        <div class="row">
            <div class="col-md-12">
                <footer class="site-footer" id="colophon">
                    <div class="site-info small">
						<?php spurs_site_info(); ?>
                    </div>
                </footer>
            </div>
        </div>
    </div>
</div>

</div><!-- / #page -->

<?php wp_footer(); ?>

</body>

</html>

