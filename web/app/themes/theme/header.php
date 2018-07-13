<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress/AskBug
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_template_directory_uri(); ?>/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/favicon/favicon-16x16.png">
	<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php do_action( 'before' ); ?>

	<nav class="site-nav navbar">
		<div class="container">
			<div class="site-nav-flex">
				<button id="menu-toggle"><i class="apicon-menu"></i></button>

				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="site-nav-logo site-nav-flexi">
					<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<?php if ( ! empty( get_theme_mod( 'ab_logo' ) ) ) : ?>
							<img src="<?php echo get_theme_mod( 'ab_logo' ); ?>" />
						<?php else : ?>
							<i class="apicon-logo"></i>
						<?php endif; ?>
					</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="site-nav-flexi primary-menuc" id="primary-menu">
					<?php if ( taxonomy_exists( 'question_category' ) ) : ?>
						<div id="category-dropdown" class="btn-group pull-left">
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="apicon-category"></i>
							</button>
							<?php get_template_part( 'parts/category-dropdown' ); ?>
						</div><!-- #category-dropdown -->
					<?php endif; ?>

					<?php
						wp_nav_menu(
							array(
								'theme_location' 	=> 'primary',
								'depth'             => 2,
								'container'         => null,
								'menu_class' 		=> 'nav navbar-nav',
								'fallback_cb' 		=> 'wp_bootstrap_navwalker::fallback',
								'menu_id'			=> 'main-menu',
								'walker' 			=> new wp_bootstrap_navwalker()
							)
						);
					?>

					<form class="site-nav-search navbar-form site-nav-flexi" role="search" method="get" action="<?php echo ap_link_to('/'); ?>">
						<i class="apicon-search" id="search-toggle"></i>
						<input type="search" class="form-control" id="main-search" placeholder="<?php echo esc_attr_x( 'Type and hit enter', 'placeholder', 'ab' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="ap_s" title="<?php _ex( 'Search for:', 'label', 'ab' ); ?>">
					</form>

				</div><!-- /.navbar-collapse -->

				<div class="site-nav-ask site-nav-flexi">
					<a href="<?php ap_link_to( 'ask' ); ?>" class="btn btn-header-ask">
						<?php _e( 'Ask', 'ab' ); ?>
					</a>
				</div>

				<?php if ( is_user_logged_in() ) : ?>
					<?php get_template_part( 'parts/top-right-loggedin' ); ?>
				<?php else : ?>
					<?php get_template_part( 'parts/top-right-nonlogged' ); ?>
				<?php endif; ?>

			</div>
		</div><!-- /.container -->
	</nav><!-- /.site-nav -->

	<?php get_template_part( 'parts/home-intro' ); ?>

	<?php if ( is_active_sidebar( 'stats' ) && is_front_page() ) : ?>
		<div class="site-stats-pos">
			<div class="container">
				<?php dynamic_sidebar( 'stats' ); ?>
			</div>
		</div>
	<?php endif; ?>

	<div class="main-content">

