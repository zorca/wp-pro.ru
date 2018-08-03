<?php
/**
 * Login dropdown in header.
 *
 * @since 2.0
 * @package WordPress/AskBug
 */

?>

<?php if ( ! is_user_logged_in() ) : ?>
	<ul id="login-sign" class="nav navbar-nav top-right site-nav-flexi">
		<li class="dropdown">
			<a href="#" class="dropdown-toggle top-ricon" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				<i class="apicon-lock"></i>
			</a>

			<div class="dropdown-menu">
				<?php
					/**
					 * Show wordpress social login buttons.
					 */
				?>
				<?php if ( do_action( 'wordpress_social_login' ) ) : ?>
					<div class="social-login-c clearfix">
						<h4><?php _e( 'Log in using', 'ab' ); ?></h4>
						<?php do_action( 'wordpress_social_login' ); ?>
					</div>
				<?php endif; ?>

				<div class="login-c clearfix">
					<?php
						$form = wp_login_form( array( 'echo' => false ) );
						$form = str_replace( 'login-username', 'login-username form-group', $form );
						$form = str_replace( 'login-password', 'login-password form-group', $form );
						$form = str_replace( 'login-remember', 'login-submit form-group', $form );
						$form = str_replace( 'button-primary', 'btn btn-success', $form );
						$form = str_replace('</p>
						<p class="login-submit">', '', $form );
						$form = str_replace( '<p', '<div', $form );
						$form = str_replace( '</p>', '</div>', $form );
						$form = str_replace( 'class="input"', 'class="form-control"', $form );
						$form = str_replace( 'id="user_login"', 'id="user_login" placeholder="' . __( 'Enter your username', 'ab' ) . '"', $form );
						$form = str_replace( 'id="user_pass"', 'id="user_pass" placeholder="' . __( 'Enter your password', 'ab' ) . '"', $form );
						echo $form; // xss okay.
					?>
					<a href="<?php echo wp_lostpassword_url( ); ?>" class="forget-btn"><?php _e( 'Rest password', 'ab' ); ?></a>
					<a href="<?php echo wp_registration_url(); ?>" class="signup-btn btn btn-primary"><?php _e( 'New to this site? Register', 'ab' ); ?></a>
				</div>
			</div>
		</li>
	</ul>
<?php endif; ?>
