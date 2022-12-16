<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div class="comments-area" id="comments">
	<div class="entry-content">
		<?php // You can start editing here -- including this comment! ?>

		<?php if ( have_comments() ) : ?>

			<h2 class="comments-title">

				<?php
				$comments_number = get_comments_number();
				if ( 1 === (int) $comments_number ) {
					printf(
					/* translators: %s: post title */
						esc_html_x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'spurs' ),
						'<span>' . get_the_title() . '</span>' // phpcs:ignore
					);
				} else {
					printf( // phpcs:ignore
					/* translators: 1: number of comments, 2: post title */
						esc_html(
							_nx( // phpcs:ignore
								'%1$s thought on &ldquo;%2$s&rdquo;',
								'%1$s thoughts on &ldquo;%2$s&rdquo;',
								$comments_number,
								'comments title',
								'spurs'
							)
						),
						number_format_i18n( $comments_number ), // phpcs:ignore
						'<span>' . get_the_title() . '</span>' // phpcs:ignore
					);
				}
				?>

			</h2><!-- .comments-title -->

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through. ?>

				<nav class="comment-navigation" id="comment-nav-above">

					<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'spurs' ); ?></h1>

					<?php if ( get_previous_comments_link() ) { ?>
						<div class="nav-previous">
						<?php
						previous_comments_link(
							__(
								'&larr; Older Comments',
								'spurs'
							)
						);
						?>
								</div>
						<?php
					}
					if ( get_next_comments_link() ) {
						?>
						<div class="nav-next">
						<?php
						next_comments_link(
							__(
								'Newer Comments &rarr;',
								'spurs'
							)
						);
						?>
								</div>
					<?php } ?>

				</nav><!-- #comment-nav-above -->

			<?php endif; // check for comment navigation. ?>

				<ol class="comment-list" style="list-style: none">
				<?php
				wp_list_comments(
					array(
						'style'      => 'ol',
						'short_ping' => true,
					)
				);
				?>
			</ol><!-- .comment-list -->

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through. ?>

				<nav class="comment-navigation" id="comment-nav-below">

					<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'spurs' ); ?></h1>

					<?php if ( get_previous_comments_link() ) { ?>
						<div class="nav-previous">
						<?php
						previous_comments_link(
							__(
								'&larr; Older Comments',
								'spurs'
							)
						);
						?>
								</div>
						<?php
					}
					if ( get_next_comments_link() ) {
						?>
						<div class="nav-next">
						<?php
						next_comments_link(
							__(
								'Newer Comments &rarr;',
								'spurs'
							)
						);
						?>
								</div>
					<?php } ?>

				</nav><!-- #comment-nav-below -->

			<?php endif; // check for comment navigation. ?>

		<?php endif; // phpcs:ignroe endif have_comments(). ?>

		<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' !== get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'spurs' ); ?></p>
		<?php endif; ?>

		<?php comment_form(); // Render comments form. ?>
	</div>
</div><!-- #comments -->
