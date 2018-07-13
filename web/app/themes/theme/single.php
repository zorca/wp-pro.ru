<?php
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

					<?php get_template_part( 'content', 'single' ); ?>

					<?php ab_content_nav( 'nav-below' ); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() )
							comments_template();
					?>

				<?php endwhile; // end of the loop. ?>
			</div><!-- close .*-inner (main-content or sidebar, depending if sidebar is used) -->
			<?php get_sidebar(); ?>
		</div><!-- close .row -->
	</div><!-- close .container -->
<?php get_footer(); ?>
