<?php
/**
 * Display login signup form
 *
 * @package AnsPress
 * @author  Rahul Aryan <support@anspress.io>
 */

?>

<?php if ( ! is_user_logged_in() ) : ?>
	<div class="ap-login">
		<div class="ap-cell">
			<div class="ap-cell-inner">
				<?php do_action( 'wordpress_social_login' ); ?>

				<div class="login-reg-box clearfix">
					<div class="login-box">
						<?php echo do_shortcode( '[theme-my-login default_action="login" before_title="<h3>" after_title="</h3>" show_reg_link=0 show_pass_link=0]' ); ?>
					</div>
					<div class="reg-box">
						<?php echo do_shortcode( '[theme-my-login default_action="register" before_title="<h3>" after_title="</h3>" show_log_link=0 show_pass_link=0]' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php endif; ?>
