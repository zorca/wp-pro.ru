<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package ab
 */

get_header(); ?>
	<div class="container">
		<div class="row">
			<div id="content" class="main-content-inner col-sm-12<?php echo is_active_sidebar( 'sidebar-1' ) ? ' col-md-9' : ' col-md-12' ?>">

					<?php if ( have_posts() ) : ?>

						<header>
							<h2 class="page-title"><?php printf( __( 'Search Results for: %s', 'ab' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
						</header><!-- .page-header -->

						<?php // start the loop. ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'content', 'search' ); ?>

						<?php endwhile; ?>

						<?php ab_content_nav( 'nav-below' ); ?>

					<?php else : ?>

						<?php get_template_part( 'no-results', 'search' ); ?>

					<?php endif; // end of loop. ?>

			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>