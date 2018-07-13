<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress/AskBug
 */

?>
</div><!-- close .main-content -->

<?php if ( is_active_sidebar( 'stats' ) && ! is_front_page() ) : ?>
	<div class="site-stats-pos footer-pos">
		<div class="container">
			<?php dynamic_sidebar( 'stats' ); ?>
		</div>
	</div>
<?php endif; ?>

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="footer-top">
		<div class="container">
			<div class="row site-footer-inner">
				<div class="col-md-4 col-sm-4 footer-about">
					<?php if ( ! dynamic_sidebar( 'footer-left' ) ) : ?>
						<i class="logo"><?php echo get_theme_mod( 'ab_fl_title', get_bloginfo() ); ?></i>
						<p class="footer-about-desc"><?php echo get_theme_mod( 'ab_fl_desc', get_bloginfo( 'description' ) ); ?></p>

						<ul class="footer-social nav">
							<?php if ( ! empty( get_theme_mod( 'ab_social_fb' ) ) ) : ?>
								<li><a href="<?php echo get_theme_mod( 'ab_social_fb' ); ?>" target="_blank" class="apicon-facebook-square"></a></li>
							<?php endif; ?>
							<?php if ( ! empty( get_theme_mod( 'ab_social_twitter' ) ) ) : ?>
								<li><a href="<?php echo get_theme_mod( 'ab_social_twitter' ); ?>" target="_blank" class="apicon-twitter-square"></a></li>
							<?php endif; ?>
							<?php if ( ! empty( get_theme_mod( 'ab_social_google' ) ) ) : ?>
								<li><a href="<?php echo get_theme_mod( 'ab_social_google' ); ?>" target="_blank" class="apicon-google-plus-square"></a></li>
							<?php endif; ?>
							<?php if ( ! empty( get_theme_mod( 'ab_social_github' ) ) ) : ?>
								<li><a href="<?php echo get_theme_mod( 'ab_social_github' ); ?>" target="_blank" class="apicon-mark-github"></a></li>
							<?php endif; ?>
						</ul>
					<?php endif; ?>
				</div><!-- close .col-sm-4.footer-about -->
				<div class="col-md-2 col-sm-2">
					<?php if ( ! dynamic_sidebar( 'footer-ml' ) ) : ?>
						<h3 class="widget-title"><?php _e( 'Questions', 'ab' ) ?></h3>
						<ul class="nav footer-nav">
							<li><a href="<?php ap_link_to( '/' ); ?>?filters[order_by]=active"><?php _e( 'Active questions', 'ab' ); ?></a></li>
							<li><a href="<?php ap_link_to( '/' ); ?>?filters[order_by]=newest"><?php _e( 'New questions', 'ab' );?></a></li>
							<li><a href="<?php ap_link_to( '/' ); ?>?filters[order_by]=views"><?php _e( 'Most viewed questions', 'ab' ); ?></a></li>
							<li><a href="<?php ap_link_to( '/' ); ?>?filters[order_by]=voted"><?php _e( 'Top voted questions', 'ab' ); ?></a></li>
							<li><a href="<?php ap_link_to( '/' ); ?>?filters[order_by]=solved"><?php _e( 'Solved questions', 'ab' ); ?></a></li>
							<li><a href="<?php ap_link_to( '/' ); ?>?filters[order_by]=unsolved"><?php _e( 'Unsolved questions', 'ab' ); ?></a></li>
						</ul>
					<?php endif; ?>
				</div>
				<div class="col-md-2 col-sm-2">
					<?php if ( ! dynamic_sidebar( 'footer-mr' ) ) : ?>
					<h3 class="widget-title">Links</h3>
						<ul class="nav footer-nav">
							<li><a href=#>Active questions</a></li>
							<li><a href=#>New questions</a></li>
							<li><a href=#>Most viewed questions</a></li>
							<li><a href=#>Top voted questions</a></li>
							<li><a href=#>Solved questions</a></li>
							<li><a href=#>Unsolved questions</a></li>
						</ul>
					<?php endif; ?>
				</div>
				<div class="col-md-4 col-sm-4">
					<?php if ( ! dynamic_sidebar( 'footer-right' ) ) : ?>
						<h3 class="widget-title">Subscribe for updates</h3>
						<p>Receive all latest updates and answers right into your inbox.</p>
						<form class="subscribe-widget">
							<input type="text" name="email" class="form-control" placeholder="you@domain.com" />
							<button type="submit" class="btn">Subscribe</button>
						</form>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="site-footer-inner col-sm-12">
				<div class="site-info pull-left">
					<?php do_action( 'ab_credits' ); ?>

					<?php if ( ! get_theme_mod( 'hide_copyright', false ) ) : ?>
						<?php printf( __( 'Powered by %s and %s', 'ab' ), '<a href="http://wordpress.org/" rel="generator">WordPress</a>', '<a href="http://anspress.io" target="_blank">AnsPress</a>' ); ?>
						<span class="sep"> / </span>
						<?php _e('Crafted with &#10084; by ', 'ab'); ?>
	                    <a class="credits" href="http://anspress.io/" target="_blank" title="Question and Answer plugin" alt="Question and Answer plugin"><?php _e('Rahul Aryan & Team','ab') ?></a>
	                    <span class="sep"> / </span>
	                    <?php printf(__('AskBug %s', 'ab'), '<a href="http://anspress.io/questions/ask">support forum</a>'); ?>
                	<?php endif; ?>

				</div><!-- close .site-info -->
				<div class="site-copyright pull-right"><?php printf( __('&copy; %d %s' ), date('Y'), get_bloginfo( 'name' ) ); ?></div>
			</div>
		</div>
	</div><!-- close .container -->
</footer><!-- close #colophon -->

<?php wp_footer(); ?>

</body>
</html>
