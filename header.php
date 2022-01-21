<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package spurs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container        = get_theme_mod( 'spurs_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">

	<div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">

		<a class="skip-link screen-reader-text sr-only" href="#content"><?php esc_html_e( 'Skip to content',
				'spurs' ); ?></a>

		<nav class="navbar navbar-expand-md navbar-dark bg-dark">

			<?php if ( 'container' == $container ) : ?>
			<div class="container">
				<?php endif; ?>

				<?php if ( ! has_custom_logo() ) : // Your site title as branding in the menu ?>
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="navbar-brand mb-0">
							<a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"
							   title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
						</h1>
					<?php else : ?>
						<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"
						   title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
					<?php endif;
				else :
					the_custom_logo();
				endif; // end custom logo ?>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
				        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<?php wp_nav_menu( //The WordPress Menu goes here
					array(
						'theme_location'  => 'primary',
						//'container_class' => 'collapse navbar-collapse',
						//'container_id'    => 'navbarNavDropdown',
						//'menu_class'      => 'navbar-nav',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						//'depth'           => 2,
						//'walker'          => new Spurs_WP_Bootstrap_Navwalker(),
					)
				); ?>
				<?php if ( 'container' == $container ) : ?>
			</div>
		<?php endif; ?>
		</nav>
	</div>

	<div class="wrapper" id="page-wrapper">
