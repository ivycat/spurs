<?php
/**
 * The template for displaying the author pages.
 *
 * Learn more: https://codex.wordpress.org/Author_Templates
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; ?>

<header class="page-header author-header">

	<?php
	if ( isset( $_GET['author_name'] ) ) {
		$curauth = get_user_by( 'slug', $author_name );
	} else {
		$curauth = get_userdata( intval( $author ) );
	}
	?>

	<h1><?php esc_html_e( 'About:', 'spurs' ); ?><?php echo esc_html( $curauth->nickname ); ?></h1>

	<?php if ( ! empty( $curauth->ID ) ) :
		echo get_avatar( $curauth->ID );
	endif; ?>
	<?php if ( ! empty( $curauth->user_url ) || ! empty( $curauth->user_description ) ) : ?>
		<dl>
			<?php if ( ! empty( $curauth->user_url ) ) : ?>
				<dt><?php esc_html_e( 'Website', 'spurs' ); ?></dt>
				<dd>
					<a href="<?php echo esc_url( $curauth->user_url ); ?>"><?php echo esc_html( $curauth->user_url ); ?></a>
				</dd>
			<?php endif; ?>

			<?php if ( ! empty( $curauth->user_description ) ) : ?>
				<dt><?php esc_html_e( 'Profile', 'spurs' ); ?></dt>
				<dd><?php echo esc_html_e( $curauth->user_description ); ?></dd>
			<?php endif; ?>
		</dl>
	<?php endif; ?>
	<h2><?php esc_html_e( 'Posts by', 'spurs' ); ?> <?php echo esc_html( $curauth->nickname ); ?>:</h2>

</header><!-- .page-header -->

<ul>
	<!-- The Loop -->
	<?php if ( have_posts() ) :
		while ( have_posts() ) : the_post(); ?>
			<li>
				<?php
				printf(
					'<a rel="bookmark" href="%1$s" title="%2$s %3$s">%3$s</a>',
					esc_url( apply_filters( 'the_permalink', get_permalink( $post ), $post ) ),
					esc_attr( __( 'Permanent Link:', 'spurs' ) ),
					the_title( '', '', false )
				);
				spurs_posted_on();
				esc_html_e( 'in', 'spurs' );
				the_category( '&' );
				?>
			</li>
		<?php endwhile;
	else :
		get_template_part( 'templates/loop/content', 'none' );
	endif; ?>
	<!-- End Loop -->
</ul>

