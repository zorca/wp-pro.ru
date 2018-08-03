<?php
/**
 * Template Name: Activities Page
 * Template used to display activities page
 *
 * @package ab
 * @since 3.1.3
 */

get_header(); ?>
	<div class="container">
		<div class="row">
			<div id="content" class="main-content-inner col-sm-12<?php echo is_active_sidebar( 'activities' ) ? ' col-md-9' : ' col-md-12' ?>">
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

				<?php endwhile; // end of the loop. ?>
			</div><!-- close .*-inner (main-content or sidebar, depending if sidebar is used) -->

			<?php if ( is_active_sidebar( 'activities' ) ) : ?>
				<div class="sidebar col-sm-12 col-md-3">
					<div class="sidebar-padder">
						<?php dynamic_sidebar( 'activities' ); ?>
					</div><!-- close .sidebar-padder -->
				</div>
			<?php endif; ?>

		</div><!-- close .row -->
	</div><!-- close .container -->
<?php get_footer(); ?>