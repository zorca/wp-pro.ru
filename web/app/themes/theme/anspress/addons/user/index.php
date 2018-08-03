<?php
/**
 * User profile template
 * User profile index template.
 *
 * @link https://anspress.io
 * @since 4.0.0
 * @package AnsPress
 */

	$user_id = ap_current_user_id();
	$current_tab = ap_sanitize_unslash( 'tab', 'r', 'questions' );
?>
<div id="ap-user" class="ap-user <?php echo is_active_sidebar( 'ap-user' ) && is_anspress() ? 'ap-col-9' : 'ap-col-12' ?>">

	<div class="ap-user-navigation">
		<div class="ap-user-identity clearfix">
			<div class="ap-user-avatar">
				<?php echo get_avatar( $user_id, 80 ); ?>

				<?php if ( get_current_user_id() === $user_id ) : ?>
					<form method="POST" action="#" enctype="multipart/form-data" data-action="ab_upload_form" class="ap-avatar-upload-form">
						<div class="ap-btn ap-upload-o apicon-cloud-upload" title="<?php _e( 'Upload an avatar', 'anspress-question-answer' ); ?>">
							<span><?php _e( 'Upload avatar', 'anspress-question-answer' ); ?></span>
							<input type="file" name="avatar" class="ap-upload-input" data-action="ab_upload_field">
						</div>

						<input type='hidden' value='<?php echo wp_create_nonce( 'upload_avatar_' . get_current_user_id() ); ?>' name='__nonce' />
						<input type="hidden" name="action" id="action" value="ab_upload_user_avatar">
					</form>
				<?php endif; ?>

			</div>
			<div class="ap-user-data">
				<span class="ap-user-name"><?php echo ap_user_display_name( $user_id ); ?></span>
				<span class="ap-user-reputation">
					<?php printf( __( '%s Rep.', 'anspress-question-answer' ), ap_get_user_reputation_meta( $user_id ) ); ?>
				</span>
			</div>
		</div>
		<?php SELF::user_menu(); ?>
	</div>

	<div class="ap-user-main">
		<div class="ap-user-breadcrumbs">
			<?php the_widget( 'AnsPress_Breadcrumbs_Widget' ); ?>
		</div>

		<?php SELF::sub_page_template(); ?>
	</div>
</div>

<?php if ( is_active_sidebar( 'ap-user' ) && is_anspress()){ ?>
	<div class="ap-question-right ap-col-3">
		<?php dynamic_sidebar( 'ap-user' ); ?>
	</div>
<?php } ?>
