<?php
/**
 * User about meta box template
 * Shows in AnsPress user profile about page.
 *
 * @link https://anspress.io
 * @since 3.0.0
 * @package WordPress/AskBug
 */

$description = get_the_author_meta( 'user_description', ap_current_user_id() );
$registered = get_the_author_meta( 'user_registered', ap_current_user_id() );
?>

<div class="ap-about-inner">
	<p>
		<?php if ( ! empty( $description ) ) : ?>
			<?php echo esc_html( $description ); ?>
		<?php else : ?>
			<?php _e( 'No "about me" yet..', 'ab' ); ?>
		<?php endif; ?>
	</p>
	<div class="ap-user-meta">
		<div class="ap-user-metaitem">
			<strong><?php esc_attr_e( 'Registered', 'ab' ); ?></strong>
			<span><?php echo esc_attr( ap_human_time( $registered, false ) ); ?></span>
		</div>
		<?php do_action( 'ab_user_about' ); ?>
	</div>
</div>
