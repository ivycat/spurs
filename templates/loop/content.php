<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

global $post;
?>

<article <?php post_class('card'); ?> id="post-<?php the_ID(); ?>">
    <div class="card-img-top img-wrapper">
        <a class="no-uppercase no-underline" href="<?php echo get_the_permalink(); ?>">
            <span class="bg-image" <?php bg( get_the_post_thumbnail_url(), false, true, 'height: 270px' ); ?>></span>
        </a>
    </div>
    <div class="card-body">
		<?php if ( 'post' === get_post_type() ) : ?>
            <div class="entry-meta">
	            <?php spurs_posted_on(); ?>
                <div class="categories pb-3">
                    <?php
                    $category = spurs_get_primary_term( 'category' );
                    if ( $category instanceof WP_Term ) {
                        printf(
                            '<a href="%1$s"><span class="category">%2$s</span></a>',
                            get_term_link($category),
                            esc_html( $category->name )
                        );
                    }
                    ?>
                </div>
            </div>
		<?php endif; ?>

        <a href="<?php echo get_the_permalink(); ?>">
	        <h4><?php echo get_the_title(); ?></h4>
        </a>
		<?php if ( get_the_content() ) : ?>
			<p><?php echo spurs_get_excerpt_by_post( $post->ID, 175 ) ?></p>
		<?php endif; ?>
    </div>
    <div class="card-footer">
        <a href="<?php echo get_the_permalink(); ?>">
            <button>LEARN MORE</button>
        </a>
    </div>
</article>
