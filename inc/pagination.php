<?php
/**
 * Pagination layout.
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'spurs_pagination' ) ) {
	/**
	 * Spurs Pagination
	 *
	 * @param array  $args Pagination arguments.
	 * @param string $class classname needs to passed.
	 * @return void
	 */
	function spurs_pagination( $args = array(), $class = 'pagination' ) {

		if ( $GLOBALS['wp_query']->max_num_pages <= 1 ) {
			return;
		}

		$args = wp_parse_args(
			$args,
			array(
				'mid_size'           => 2,
				'prev_next'          => true,
				'prev_text'          => __( '&laquo;', 'spurs' ),
				'next_text'          => __( '&raquo;', 'spurs' ),
				'screen_reader_text' => __( 'Posts navigation', 'spurs' ),
				'type'               => 'array',
				'current'            => max( 1, get_query_var( 'paged' ) ),
			)
		);

		$links = paginate_links( $args );

		?>

		<nav aria-label="<?php echo esc_attr( $args['screen_reader_text'] ); ?>">
			<div class="container">
				<ul class="pagination justify-content-center mt-5">

				<?php
				foreach ( $links as $key => $link ) {
					?>
					<li class="page-item <?php echo strpos( $link, 'current' ) ? 'active' : ''; ?>">
						<?php echo esc_html( str_replace( 'page-numbers', 'page-link', $link ) ); ?>
					</li>
					<?php
				}
				?>

			</ul>
			</div>
		</nav>

		<?php
	}
}
