<?php
/**
 * Template Name: Login Page
 *
 * @package ab
 */

get_header(); ?>
	<div class="login-page">
		<?php while ( have_posts() ) : the_post(); ?>

			<header>
				<h1 class="page-title"><?php the_title(); ?></h1>
			</header><!-- .entry-header -->
			<?php the_content(); ?>

		<?php endwhile; // end of the loop. ?>
	</div><!-- close .login-page -->
<?php get_footer(); ?>
