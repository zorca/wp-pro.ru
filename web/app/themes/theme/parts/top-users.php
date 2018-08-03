<?php
/**
 * Template for top users widget
 *
 * Display users for top users widget
 *
 * @link http://anspress.io
 * @since 1.0
 *
 * @package AskBug
 */

global $ap_user_query, $avatar_size;
?>

<?php foreach ( $ap_user_query as $user ) :?>
	<?php $link = ap_user_link( $user->ID ); ?>
	<?php $rep = ap_get_user_reputation_meta( $user->ID, true ); ?>

	<div class="top-users-item">
		<div class="top-users-item-inner clearfix">

			<div class="top-users-avatar">
				<a href="<?php echo esc_url( $link ); ?>">
					<?php echo get_avatar( $user->ID, $avatar_size ); ?>
				</a>
			</div>

			<div class="no-overflow">
				<a href="<?php echo esc_url( $link ); ?>"span class="top-users-name"><?php ap_user_display_name( [ 'user_id' => $user->ID, 'echo' => true ] ); ?></a>
				<a class="top-users-rep" a href="<?php echo ap_user_link( $user->ID, 'reputations' ); ?>"><?php printf( __( '%d Reputation', 'anspress-question-answer' ), $rep ); ?></a>
			</div>

		</div><!-- close .top-users-item-inner -->
	</div><!-- close .top-users-item -->
<?php endforeach; ?>
