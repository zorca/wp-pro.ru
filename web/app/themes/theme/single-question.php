<?php
/**
 * The Template for displaying single question post.
 *
 * @since 3.1.0
 * @package ab
 */

get_header(); ?>
	<div class="container">
		<?php while ( have_posts() ) : the_post(); ?>

		<header>
			<h1 class="page-title"><?php the_title(); ?></h1>
		</header><!-- .entry-header -->

		<?php the_content(); ?>

		<?php endwhile; // end of the loop. ?>
	</div><!-- close .container -->
<?php get_footer(); ?>
