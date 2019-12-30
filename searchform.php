<?php
/**
 * The template for displaying search forms
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<label class="assistive-text screen-reader-text" for="s"><?php esc_html_e( 'Search', 'spurs' ); ?></label>
	<div class="input-group">
		<input class="field form-control" id="s" name="s" type="text"
		       placeholder="<?php esc_attr_e( 'Search &hellip;', 'spurs' ); ?>" value="<?php the_search_query(); ?>">
		<span class="input-group-append">
			<input class="submit btn btn-primary" id="searchsubmit" name="submit" type="submit"
			       value="<?php esc_attr_e( 'Search', 'spurs' ); ?>">
	    </span>
	</div>
</form>
