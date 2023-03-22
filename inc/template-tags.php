<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
if ( ! function_exists( 'spurs_posted_on' ) ) {
	/**
	 * Function to display posts publish date, modified date, and author. 
	 *
	 * @return void
	 */
	function spurs_posted_on() {

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$updated_time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

			$updated_time_string = sprintf(
				$updated_time_string,
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);

			$posted_on = apply_filters(
				'spurs_posted_on',
				sprintf(
					'<div class="updated-on">%1$s %2$s%3$s</div>',
					esc_html_x( ' Updated on', 'post date', 'spurs' ),
					apply_filters( 'spurs_posted_on_time', $updated_time_string ),
					esc_html( '' )
				)
			);

		} else {
			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

			$time_string = sprintf(
				$time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() )
			);

			$posted_on = apply_filters(
				'spurs_posted_on',
				sprintf(
					'<div class="posted-on">%1$s %2$s</div>',
					esc_html_x( 'Posted on', 'post date', 'spurs' ),
					apply_filters( 'spurs_posted_on_time', $time_string )
				)
			);
		}

		$byline = apply_filters(
			'spurs_posted_by',
			sprintf(
				'<div class="byline"> %1$s&nbsp<span class="author vcard"><a class="url fn n" href="%2$s">%3$s</a></span></div>',
				$posted_on ? esc_html_x( 'by', 'post author', 'spurs' ) : esc_html_x( 'Posted by', 'post author', 'spurs' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			)
		);
		echo $posted_on . $byline;
		
		// if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		// echo $updated_on;// WPCS: XSS OK.
		// }.
	}
}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
if ( ! function_exists( 'spurs_entry_footer' ) ) {
	function spurs_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'sp' ) );
			if ( $categories_list && spurs_categorized_blog() ) {
				/* translators: %s: Categories of current post */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %s', 'sp' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '<span class="badge badge-warning">', '</span> <span class="badge badge-warning">', '</span>' );
			if ( $tags_list ) {
				/* translators: %s: Tags of current post */
				printf( '<div class="tags-links">' . esc_html__( 'Tagged %s', 'sp' ) . '</div>', $tags_list ); // WPCS: XSS OK.
			}
		}
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'spurs' ), esc_html__( '1 Comment', 'spurs' ), esc_html__( '% Comments', 'spurs' ) );
			echo '</span>';
		}
	}
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
if ( ! function_exists( 'spurs_categorized_blog' ) ) {

	function spurs_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'spurs_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories(
				array(
					'fields'     => 'ids',
					'hide_empty' => 1,
					// We only need to know if there is more than one category.
					'number'     => 2,
				) 
			);
			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );
			set_transient( 'spurs_categories', $all_the_cool_cats );
		}
		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so components_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so components_categorized_blog should return false.
			return false;
		}
	}
}

/**
 * Flush out the transients used in spurs_categorized_blog.
 */
add_action( 'edit_category', 'spurs_category_transient_flusher' );
add_action( 'save_post', 'spurs_category_transient_flusher' );
if ( ! function_exists( 'spurs_category_transient_flusher' ) ) {
	function spurs_category_transient_flusher() {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Like, beat it. Dig?
		delete_transient( 'spurs_categories' );
	}
}

/**
 * Left sidebar loading logic
 */
if ( ! function_exists( 'spurs_left_sidebar' ) ) {

	function spurs_left_sidebar() {
		$spurs_sidebar_position = get_theme_mod( 'spurs_sidebar_position' );

		if ( ! is_page_template( 'page-templates/full-width.php' ) && ! is_page_template( 'page-templates/sidebar-right.php' ) ) {
			if ( is_page_template( 'page-templates/sidebar-left.php' ) || is_page_template( 'page-templates/both-sidebars.php' ) || 'left' === $spurs_sidebar_position || 'both' === $spurs_sidebar_position ) {
				get_template_part( 'templates/sidebar/sidebar', 'left' );
			}
		}
	}
}

/**
 * Right sidebar loading logic
 */
if ( ! function_exists( 'spurs_right_sidebar' ) ) {

	function spurs_right_sidebar() {
		$spurs_sidebar_position = get_theme_mod( 'spurs_sidebar_position' );

		if ( ! is_page_template( 'page-templates/full-width.php' ) || ! is_page_template( 'page-templates/sidebar-left.php' ) ) {
			if ( is_page_template( 'page-templates/sidebar-right.php' ) || is_page_template( 'page-templates/both-sidebars.php' ) ) {
				get_template_part( 'templates/sidebar/sidebar', 'right' );
			} elseif ( is_page_template( 'default' ) && ( 'right' === $spurs_sidebar_position || 'both' === $spurs_sidebar_position ) ) {
				get_template_part( 'templates/sidebar/sidebar', 'right' );
			}
		}
	}
}

/**
 * Content classes loading logic
 */
if ( ! function_exists( 'spurs_content_classes' ) ) {

	/**
	 * Prints classes for content area div depending on active sidebars.
	 *
	 * Usage add this function between the class quotes like so
	 *      <div class="<?php spurs_content_classes(); ?>" id="primary">
	 */
	function spurs_content_classes() {
		$spurs_sidebar_position = get_theme_mod( 'spurs_sidebar_position' );
		$html                   = '';

		if ( is_page_template( 'page-templates/sidebar-left.php' ) && is_active_sidebar( 'left-sidebar' ) ) {
			$html .= 'left-sidebar-template column-8 content-area';
			echo $html; // WPCS: XSS OK.

		} elseif ( is_page_template( 'page-templates/sidebar-right.php' ) && is_active_sidebar( 'right-sidebar' ) ) {
			$html .= 'right-sidebar-template column-8 container content-area';
			echo $html; // WPCS: XSS OK.

		} elseif ( is_page_template( 'page-templates/both-sidebars.php' ) && ( is_active_sidebar( 'left-sidebar' ) ) && is_active_sidebar( 'right-sidebar' ) ) {
			$html .= 'both-sidebar-template column-6 content-area';
			echo $html; // WPCS: XSS OK.

		} elseif ( is_page_template( 'page-templates/full-width.php' ) ) {
			$html .= 'full-width-template column-12 content-area';
			echo $html; // WPCS: XSS OK.

		} elseif ( is_page_template( array( 'page-templates/full-width-slim.php', 'page-templates/landing.php' ) ) ) {
			$html .= 'full-width-slim-template column-8 off-2 content-area';
			echo $html; // WPCS: XSS OK.

		} elseif ( is_single() || is_search() || is_404() ) {
			$html .= 'full-width-slim-template column-8 off-2 content-area';
			echo $html; // WPCS: XSS OK.

		} elseif ( 'right' === $spurs_sidebar_position || 'left' === $spurs_sidebar_position ) {

			if ( is_active_sidebar( 'sidebar-right' ) || is_active_sidebar( 'sidebar-left' ) ) {
				$html .= 'column-8 content-area';
			} else {
				$html .= 'column-12 content-area';
			}
			echo $html; // WPCS: XSS OK.

		} elseif ( is_active_sidebar( 'sidebar-right' ) && is_active_sidebar( 'sidebar-left' ) ) {
			$html = '';
			if ( 'both' === $spurs_sidebar_position ) {
				$html .= 'column-6 content-area';
			} else {
				$html .= 'column-12 content-area';
			}
			echo $html; // WPCS: XSS OK.

		} else {
			echo 'column-12 content-area';
		}
	}
}

/**
 * Content classes loading logic
 */
if ( ! function_exists( 'spurs_column_classes' ) ) {

	/**
	 * Prints classes for content area div depending on active sidebars.
	 *
	 * Usage add this function between the class quotes like so
	 *      <div class="<?php spurs_column_classes(); ?>" id="primary">
	 */
	function spurs_column_classes() {
		$html = '';

		if ( is_page_template( 'page-templates/sidebar-left.php' ) && is_active_sidebar( 'sidebar-left' ) ) {
			$html .= 'col-md-8 left-sidebar-template';
			echo $html; // WPCS: XSS OK.

		} elseif ( is_page_template( 'page-templates/sidebar-right.php' ) && is_active_sidebar( 'sidebar-right' ) ) {
			$html .= 'col-md-8 right-sidebar-template';
			echo $html; // WPCS: XSS OK.

		} elseif ( is_page_template( 'page-templates/both-sidebars.php' ) && ( is_active_sidebar( 'sidebar-left' ) ) && is_active_sidebar( 'sidebar-right' ) ) {
			$html .= 'both-sidebar-template col-md-6';
			echo $html; // WPCS: XSS OK.

		}
	}
}

/**
 * Sidebar classes
 */
if ( ! function_exists( 'spurs_sidebar_classes' ) ) {

	/**
	 * Prints classes for sidebars area div depending on active sidebars.
	 *
	 * Add this function between the class quotes like so
	 *      <div class="<?php spurs_sidebar_classes(); ?>">
	 */
	function spurs_sidebar_classes() {

		$spurs_sidebar_position = get_theme_mod( 'spurs_sidebar_position' );
		$html                   = '';

		if ( is_page_template( 'page-templates/both-sidebars.php' ) && ( is_active_sidebar( 'sidebar-left' ) ) && is_active_sidebar( 'sidebar-right' ) ) {
			$html .= 'col-md-3 widget-area';
			echo $html; // WPCS: XSS OK.
		} elseif ( ( is_page_template( 'page-templates/sidebar-left.php' ) && is_active_sidebar( 'sidebar-left' ) ) ||
				   ( is_page_template( 'page-templates/sidebar-right.php' ) && is_active_sidebar( 'sidebar-right' ) ) ) {
			$html .= 'col-md-4 widget-area';
			echo $html; // WPCS: XSS OK.
		} elseif ( ( 'right' === $spurs_sidebar_position || 'left' === $spurs_sidebar_position ) && ( is_active_sidebar( 'sidebar-right' ) || is_active_sidebar( 'sidebar-left' ) ) ) {
			$html .= 'col-md-4 content-area';
			echo $html; // WPCS: XSS OK.
		} elseif ( ( 'both' === $spurs_sidebar_position ) && ( is_active_sidebar( 'sidebar-right' ) && is_active_sidebar( 'sidebar-left' ) ) ) {
			$html .= 'col-md-3 content-area';
			echo $html; // WPCS: XSS OK.
		} else {
			$html .= 'col-12 widget-area';
			echo $html; // WPCS: XSS OK.
		}
	}
}


