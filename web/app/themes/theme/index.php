<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ab
 */

/**
 * The Template for displaying all single posts.
 *
 * @package ab
 */

get_header(); ?>
	<div class="container">
		<div class="row">
			<div id="content" class="main-content-inner col-sm-12<?php echo is_active_sidebar( 'sidebar-1' ) ? ' col-md-9' : ' col-md-12' ?>">
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content' ); ?>

				<?php endwhile; // end of the loop. ?>
				<?php ab_content_nav( 'nav-below' ); ?>
			</div><!-- close .*-inner (main-content or sidebar, depending if sidebar is used) -->
			<?php get_sidebar(); ?>
		</div><!-- close .row -->
	</div><!-- close .container -->
<?php get_footer(); ?>
