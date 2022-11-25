<?php
/**
 * Sidebar - Hero setup
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * The Hero widget area
 */
if ( is_active_sidebar( 'hero-slider' ) ) : ?>

	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

		<div class="carousel-inner" role="listbox">
			<?php dynamic_sidebar( 'hero-slider' ); ?>
		</div>

		<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only"><?php esc_html_e( 'Previous', 'spurs' ); ?></span>
		</a>

		<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only"><?php esc_html_e( 'Next', 'spurs' ); ?></span>
		</a>

	</div>

	<script>
		jQuery(".carousel-item").first().addClass("active");
	</script>

	<?php
endif;
