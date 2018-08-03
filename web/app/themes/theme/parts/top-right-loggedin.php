<?php
/**
 * Template top right menu.
 *
 * @link http://anspress.io
 * @since 3.0.0
 *
 * @package WordPress/AskBug
 */

$notification_active = ap_is_addon_active( 'notifications.php' );
$profile_active = ap_is_addon_active( 'profile.php' );
?>
<?php if ( $notification_active || $profile_active ) : ?>
	<ul id="top-right" class="nav navbar-nav top-right site-nav-flexi">
		<!-- Notification -->
		<?php if ( $notification_active ) : ?>
			<li>
				<a id="ap-userdp-noti" href="#apNotifications" class="ap-menu-noti top-ricon" >
					<i class="apicon-globe top-ricon"></i>
					<span><?php echo number_format_i18n( ap_count_unseen_notifications() ); ?></span>
				</a>
			</li>
		<?php endif; ?>

		<!-- Profile -->
		<?php if ( $profile_active ) : ?>
			<li class="ap-userdp-menu btn-group">
				<a id="ap-userdp-menu" href="#" class="dropdown-toggle top-ricon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<?php echo get_avatar( get_current_user_id(), 30 ); ?>
				</a>

				<?php if ( ! class_exists( '\AnsPress\Addons\Profile' ) ) : ?>
					<?php AnsPress_Profile_Hooks::user_pages(); ?>
					<?php AnsPress_Profile_Hooks::user_menu( get_current_user_id(), 'dropdown-menu' ); ?>
				<?php else : ?>
					<?php
						$addon = \AnsPress\Addons\Profile::init();
						$addon->user_pages();
						$addon->user_menu( get_current_user_id(), 'dropdown-menu' );
					?>
				<?php endif; ?>

			</li>
		<?php endif; ?>
	</ul>
<?php endif; ?>
