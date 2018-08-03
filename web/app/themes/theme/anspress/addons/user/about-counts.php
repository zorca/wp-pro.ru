<?php
/**
 * User about meta box template
 * Shows in AnsPress user profile about page.
 *
 * @link https://anspress.io
 * @since 3.0.0
 * @package WordPress/AskBug
 */

$user_id         = ap_current_user_id();
$total_questions = ap_total_posts_count( 'question', false, $user_id );
$unanswered_q    = ap_total_posts_count( 'question', 'unanswered', $user_id );

$total_answers   = ap_total_posts_count( 'answer', false, $user_id );
$best_a          = ap_total_posts_count( 'answer', 'best_answer', $user_id );
$comment_count   = ab_count_user_comments( $user_id );
$reputation      = ap_get_user_reputation_meta( $user_id );
$curr_month_rep  = (int) ab_count_user_reputation_month( $user_id );
?>
<div class="ap-row">
	<div class="ap-col-3">
		<div class="ap-user-count ap-user-ancount">
			<i class="apicon-answer"></i>
			<div class="no-overflow">
				<span class="count-type">
					<strong><?php echo esc_attr( $total_answers->total ); ?></strong>
					<?php _e( 'Answers', 'ab' ); ?>
				</span>
				<span><?php printf( __( '%d Best answers', 'ab' ), $best_a->total ); ?></span>
			</div>
		</div>
	</div>
	<div class="ap-col-3">
		<div class="ap-user-count ap-user-qcount">
			<i class="apicon-question"></i>
			<div class="no-overflow">
				<span class="count-type">
					<strong><?php echo $total_questions->total; ?></strong>
					<?php _e( 'Questions', 'ab' ); ?>
				</span>
				<span><?php printf( __( '%d Unanswered', 'ab' ), $unanswered_q->total ); ?></span>
			</div>
		</div>
	</div>
	<div class="ap-col-3">
		<div class="ap-user-count ap-user-ccount">
			<i class="apicon-comments"></i>
			<div class="no-overflow">
				<span class="count-type">
					<strong><?php echo $comment_count->total; ?></strong>
					<?php _e( 'Comments', 'ab' ); ?>
				</span>
				<span><?php printf( __( '%d Unapproved', 'ab' ), $comment_count->unapproved ); ?></span>
			</div>
		</div>
	</div>
	<div class="ap-col-3">
		<div class="ap-user-count ap-user-rcount">
			<i class="apicon-reputation"></i>
			<div class="no-overflow">
				<span class="count-type">
					<strong><?php echo $reputation; ?></strong>
					<?php _e( 'Reputation', 'ab' ); ?>
				</span>
				<span><?php printf( __( '%d This month', 'ab' ), $curr_month_rep ); ?></span>
			</div>
		</div>
	</div>
</div>
