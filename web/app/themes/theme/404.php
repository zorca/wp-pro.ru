<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package ab
 */

get_header(); ?>

	<?php // add the class "panel" below here to wrap the content-padder in Bootstrap style ;) ?>
    <div class="container">
        <div class="row">

            <header>
				<h1><?php _e( '404', 'ab' ); ?></h1>
				<p class="lead text-center"><?php _e( 'Oops! Something went wrong here.', 'ab' ); ?></p>
            </header><!-- .page-header -->

            <div class="page-content">
				<p class="text-center"><?php _e( 'Nothing could be found at this location. Maybe try a search?', 'ab' ); ?></p>

				<?php get_search_form(); ?>

            </div><!-- .page-content -->

        </div>
    </div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
