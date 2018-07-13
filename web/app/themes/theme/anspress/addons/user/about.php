<?php
/**
 * User profile template
 * User profile index template.
 *
 * @link https://anspress.io
 * @since 4.0.0
 * @package AnsPress
 */

?>

<div id="metaboxes" class="ap-user-about clearfix">
	<div id="metabox-width" class="ap-col-6"></div>
	<div class="ap-about-counts ap-user-col col-6">
		<?php include ap_get_theme_location( 'addons/user/about-counts.php' ); ?>
	</div>

	<div class="ap-about-about ap-user-col col-6">
		<div class="ap-about-box">
			<?php include ap_get_theme_location( 'addons/user/about-about.php' ); ?>
		</div>
	</div>

	<div class="ap-about-reputations ap-user-col col-6">
		<div class="ap-about-box">
			<?php
				$reputations = new AnsPress_Reputation_Query( array(
					'user_id' => ap_current_user_id(),
					'number'  => 5,
				) );

				include ap_get_theme_location( 'addons/user/about-reputations.php' );
			?>
		</div>
	</div>

	<div class="ap-about-votes ap-user-col col-6">
		<div class="ap-about-box">
			<?php include ap_get_theme_location( 'addons/user/about-votes.php' ); ?>
		</div>
	</div>

	<div class="ap-about-answers ap-user-col col-6">
		<div class="ap-about-box">
			<?php
				global $questions;
				$questions = ap_get_questions( array(
					'ap_current_user_ignore' => true,
					'author'                 => ap_current_user_id(),
					'limit'                  => 5,
				) );

				include ap_get_theme_location( 'addons/user/about-questions.php' );
			?>
		</div>
	</div>

	<div class="ap-about-questions ap-user-col col-6">
		<div class="ap-about-box">
			<?php
				global $answers;
				$answers = new Answers_Query( array(
					'ap_current_user_ignore' => true,
					'author'                 => ap_current_user_id(),
					'limit'                  => 5,
				) );

				include ap_get_theme_location( 'addons/user/about-answers.php' );
			?>
		</div>
	</div>
</div>
