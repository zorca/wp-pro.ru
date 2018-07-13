<?php
/**
 * Template Name: AnsPress Page
 * Template used to display AnsPress base page
 *
 * @package ab
 */

$current_page = ap_current_page();
get_header(); ?>

	<!-- User over image -->
	<?php if ( 'user' === ap_current_page() ) : ?>
		<div class="ap-user-cover">
			<img src="<?php echo ab_get_user_cover(); ?>" />
				<?php if ( get_current_user_id() === ap_current_user_id() ) : ?>
					<form method="POST" action="#" enctype="multipart/form-data" data-action="ab_upload_form" class="ap-avatar-upload-form">
						<div class="ap-btn ap-upload-o apicon-image" title="<?php _e( 'Upload a cover', 'ab' ); ?>">
							<span><?php _e( 'Upload cover', 'ab' ); ?></span>
							<input type="file" name="cover" class="ap-upload-input" data-action="ab_upload_field">
						</div>

						<input type='hidden' value='<?php echo wp_create_nonce( 'upload_cover_' . ap_current_user_id() ); ?>' name='__nonce' />
						<input type="hidden" name="action" id="action" value="ab_upload_user_cover">
					</form>
				<?php endif; ?>
		</div>
	<?php endif; ?>

	<div class="container">
		<?php
			if ( 'user' !== ap_current_page() ) {
				dynamic_sidebar( 'AnsPress Top' );
			}
		?>
		<div id="content" class="main-content-inner">
			<?php while ( have_posts() ) : the_post(); ?>

				<h1 class="entry-title"><?php the_title(); ?></h1>

				<?php the_content(); ?>

			<?php endwhile; // end of the loop. ?>
		</div><!-- close .*-inner (main-content or sidebar, depending if sidebar is used) -->
	</div><!-- close .container -->
<?php get_footer(); ?>
