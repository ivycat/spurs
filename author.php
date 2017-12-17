<header class="page-header author-header">

	<?php
	$curauth = ( isset( $_GET['author_name'] ) ) ? get_user_by( 'slug',
		$author_name ) : get_userdata( intval( $author ) );
	?>

    <h1><?php esc_html_e( 'About:', 'spurs' ); ?><?php echo esc_html( $curauth->nickname ); ?></h1>

	<?php if ( ! empty( $curauth->ID ) ) :
		echo get_avatar( $curauth->ID );
	endif; ?>

    <dl>
		<?php if ( ! empty( $curauth->user_url ) ) : ?>
            <dt><?php esc_html_e( 'Website', 'spurs' ); ?></dt>
            <dd>
                <a href="<?php echo esc_url( $curauth->user_url ); ?>"><?php echo esc_html( $curauth->user_url ); ?></a>
            </dd>
		<?php endif; ?>

		<?php if ( ! empty( $curauth->user_description ) ) : ?>
            <dt><?php esc_html_e( 'Profile', 'spurs' ); ?></dt>
            <dd><?php echo esc_html( $curauth->user_description ); ?></dd>
		<?php endif; ?>
    </dl>

    <h2><?php esc_html_e( 'Posts by', 'spurs' ); ?> <?php echo esc_html( $curauth->nickname ); ?>:</h2>

</header><!-- .page-header -->

<ul>
    <!-- The Loop -->
	<?php if ( have_posts() ) :
		while ( have_posts() ) : the_post(); ?>
            <li>
                <a rel="bookmark" href="<?php the_permalink() ?>"
                   title="<?php esc_html_e( 'Permanent Link:', 'spurs' ); ?> <?php the_title(); ?>">
					<?php the_title(); ?></a>,
				<?php spurs_posted_on(); ?> <?php esc_html_e( 'in',
					'spurs' ); ?> <?php the_category( '&' ); ?>
            </li>
		<?php endwhile;
	else :
		get_template_part( 'loop-templates/content', 'none' );
	endif; ?>
    <!-- End Loop -->
</ul>

