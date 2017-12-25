<?php
/**
 * Declaring widgets
 *
 * @package spurs
 */

/**
 * Count number of widgets in a sidebar
 * Used to add classes to widget areas so widgets can be displayed one, two, three or four per row
 */
if ( ! function_exists( 'spurs_slbd_count_widgets' ) ) {
	function spurs_slbd_count_widgets( $sidebar_id ) {
		// If loading from front page, consult $_wp_sidebars_widgets rather than options
		// to see if wp_convert_widget_settings() has made manipulations in memory.
		global $_wp_sidebars_widgets;
		if ( empty( $_wp_sidebars_widgets ) ) {
			$_wp_sidebars_widgets = get_option( 'sidebars_widgets', array() );
		}
		$sidebar_widget_count = $_wp_sidebars_widgets;

		if ( isset( $sidebar_widget_count[$sidebar_id] ) ) {
			$widget_count   = count( $sidebar_widget_count[$sidebar_id] );
			$widget_classes = 'widget-count-' . count( $sidebar_widget_count[$sidebar_id] );

			if ( 0 == $widget_count % 4 || $widget_count > 6 ) {
				// Four widgets per row if there are exactly four or more than six
				$widget_classes .= ' col-md-3';
			} elseif ( 6 == $widget_count ) {
				// If two widgets are published
				$widget_classes .= ' col-md-2';
			} elseif ( $widget_count >= 3 ) {
				// Three widgets per row if there's three or more widgets 
				$widget_classes .= ' col-md-4';
			} elseif ( 2 == $widget_count ) {
				// If two widgets are published
				$widget_classes .= ' col-md-6';
			} elseif ( 1 == $widget_count ) {
				// If just on widget is active
				$widget_classes .= ' col-md-12';
			}

			return $widget_classes;
		}
	}
}

if ( ! function_exists( 'spurs_widgets_init' ) ) {
	/**
	 * Initializes themes widgets.
	 */
	function spurs_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Right Sidebar', 'spurs' ),
			'id'            => 'right-sidebar',
			'description'   => 'Right sidebar widget area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Left Sidebar', 'spurs' ),
			'id'            => 'left-sidebar',
			'description'   => 'Left sidebar widget area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Hero Slider', 'spurs' ),
			'id'            => 'hero',
			'description'   => 'Hero slider area. Place two or more widgets here and they will slide!',
			'before_widget' => '<div class="carousel-item">',
			'after_widget'  => '</div>',
			'before_title'  => '',
			'after_title'   => '',
		) );

		register_sidebar( array(
			'name'          => __( 'Hero Static', 'spurs' ),
			'id'            => 'static-hero',
			'description'   => 'Static Hero widget. no slider functionality',
			'before_widget' => '<div id="%1$s" class="static-hero-widget %2$s ' . spurs_slbd_count_widgets( 'static-hero' ) . '">',
			'after_widget'  => '</div><!-- .static-hero-widget -->',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer Full', 'spurs' ),
			'id'            => 'footer-full',
			'description'   => 'Widget area below main content and above footer',
			'before_widget' => '<div id="%1$s" class="footer-widget %2$s ' . spurs_slbd_count_widgets( 'footer-full' ) . '">',
			'after_widget'  => '</div><!-- .footer-widget -->',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

	}
} // endif function_exists( 'spurs_widgets_init' ).
add_action( 'widgets_init', 'spurs_widgets_init' );

