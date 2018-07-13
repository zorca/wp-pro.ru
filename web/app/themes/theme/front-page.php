<?php
/**
 * The template for displaying Front page.
 *
 * @package ab
 */

get_header(); ?>

<?php if(is_active_sidebar( 'home-users' )): ?>
	<div class="home-users">
		<div class="container">
			<?php dynamic_sidebar( 'home-users' ); ?>
		</div>
	</div>
<?php endif; ?>

<div class="container">
	<div class="row">

		<div id="content" class="main-content-inner col-sm-12 col-md-9">
			<?php echo do_shortcode('[anspress]'); ?>
		</div><!-- close .*-inner (main-content or sidebar, depending if sidebar is used) -->

		<div class="sidebar col-sm-12 col-md-3">
			<div class="sidebar-padder">
				<?php do_action( 'before_sidebar' ); ?>
				<?php if(!dynamic_sidebar( 'home-sidebar' )): ?>
					<div class="widget">
						<div class="border-box">
							<h3><?php _e('What is reputation?', 'ab'); ?></h3>
							<p><?php _e('Learn more about our reputation system and how to earn them.', 'ab'); ?></p>
							<a href="<?php echo home_url( '/reputation-faq' ); ?>" class="btn btn-xs"><?php _e('Learn more', 'ab'); ?></a>
						</div>
					</div>
					<?php
						$widget_args = array(
							'before_widget' => '<div class="widget">',
							'after_widget'  => '</div></div>',
							'before_title'  => '<h3 class="widget-title">',
							'after_title'   => '</h3><div class="widget-inner">',
						);
					?>
					<?php the_widget( 'AnsPress_Category_Widget', array('title' => __('Categories', 'ab'), 'parent' => 0, 'number' => 10, 'hide_empty' => false, 'orderby' => 'count', 'order' => 'DESC'), $widget_args ); ?>
				<?php endif; ?>
			</div><!-- close .sidebar-padder -->
		</div>

	</div><!-- close .row -->
</div><!-- close .container -->

<?php get_footer(); ?>