<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package spurs
 */

$the_theme = wp_get_theme();
$container = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>

            </div><!-- #primary -->

        <!-- Do the right sidebar check
        Currently, the right sidebar check checks to see if the default understrap
        sidebar position is right or both and if true, loads the sidebar-right.php file.

        It also sets the classes for the #primary div depending on the active sidebars

        The sidebar-right.php also sets the class on the sidebar div depending on number
        of columns.

        Would like to consolidate and create a function for the right sidebar.

        Seems like it would make sense to write a function or two that can be used
        in place of the get_template_part() -->

        <?php if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>

            <?php get_sidebar( 'right' ); ?>

        <?php endif; ?>

        </div><!-- .row -->

    </div><!-- Container end -->

</div><!-- Wrapper end -->


<?php get_sidebar( 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

					<div class="site-info">

							<a href="<?php  echo esc_url( __( 'http://wordpress.org/','understrap' ) ); ?>"><?php printf( 
							/* translators:*/
							esc_html__( 'Proudly powered by %s', 'understrap' ),'WordPress' ); ?></a>
								<span class="sep"> | </span>
					
							<?php printf( // WPCS: XSS ok.
							/* translators:*/
								esc_html__( 'Theme: %1$s by %2$s.', 'understrap' ), $the_theme->get( 'Name' ),  '<a href="'.esc_url( __('http://understrap.com', 'understrap')).'">understrap.com</a>' ); ?> 
				
							(<?php printf( // WPCS: XSS ok.
							/* translators:*/
								esc_html__( 'Version: %1$s', 'understrap' ), $the_theme->get( 'Version' ) ); ?>)
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

