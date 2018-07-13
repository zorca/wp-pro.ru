<?php
/**
 * This file is responsible for displaying AskBug users page
 *
 * @package    WordPress/AskBug
 * @license    https://www.gnu.org/licenses/gpl-2.0.txt GNU Public License
 * @author     Rahul Aryan <support@anspress.io>
 */

?>

<div class="ab-users">

	<?php foreach ( (array) $ap_user_query->results as $user ) :?>
		<?php
			$link            = ap_user_link( $user->ID );
			$total_questions = ap_total_posts_count( 'question', false,$user->ID );
			$unanswered_q    = ap_total_posts_count( 'question', 'unanswered', $user->ID );
			$total_answers   = ap_total_posts_count( 'answer', false, $user->ID );
			$best_a          = ap_total_posts_count( 'answer', 'best_answer', $user->ID );
			$comment_count   = ab_count_user_comments( $user->ID );
			$reputation      = ap_get_user_reputation_meta( $user->ID );
			$curr_month_rep  = (int) ab_count_user_reputation_month( $user->ID );
		?>

		<div class="ab-users-item">

				<div class="ab-users-info ab-users-stat">
					<a href="<?php echo esc_url( $link ); ?>" class="ab-users-avatar">
						<?php echo get_avatar( $user->ID, 50 ); ?>
					</a>

					<a href="<?php echo esc_url( $link ); ?>" class="ab-users-name">
						<?php ap_user_display_name( [ 'user_id' => $user->ID, 'echo' => true ] ); ?>
					</a>

					<a class="ab-users-rep" href="<?php echo esc_url( $link ); ?>"><?php printf( __( '%d Reputation', 'anspress-question-answer' ), $reputation ); ?></a>
				</div>

				<div class="ab-users-questions ab-users-stat">
					<i class="apicon-question"></i>
					<span class="stat-first"><?php printf( _n( '%d Question', '%d Questions', $total_questions->total, 'ab' ), $total_questions->total ); ?></span>
					<span><?php printf( _n( '%d Unanswered Question', '%d Unanswered Questions', $unanswered_q->total, 'ab' ), $unanswered_q->total ); ?></span>
				</div>

				<div class="ab-users-answers ab-users-stat">
					<i class="apicon-answer"></i>
					<span class="stat-first"><?php printf( _n( '%d Answer', '%d Answers', $total_answers->total, 'ab' ), $total_answers->total ); ?></span>
					<span><?php printf( _n( '%d Best Answer', '%d Best Answers', $best_a->total, 'ab' ), $best_a->total ); ?></span>
				</div>

				<div class="ab-users-comments ab-users-stat">
					<i class="apicon-comments"></i>
					<span class="stat-first"><?php printf( _n( '%d Comment', '%d Comments', $comment_count->total, 'ab' ), $comment_count->total ); ?></span>
				</div>

		</div><!-- close .ab-users-item -->
	<?php endforeach; ?>

</div>
