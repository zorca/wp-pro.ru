<?php
/**
 * User questions meta box template.
 * Shows in AnsPress user profile about page.
 *
 * @link https://anspress.io
 * @since 3.0.0
 * @package WordPress/AskBug
 */

?>

<div class="ap-user-list">
	<?php if ( ap_have_questions() ) : ?>
		<?php while ( ap_have_questions() ) : ap_the_question(); ?>
			<div class="ap-user-listitem clearfix">
				<span class="ap-user-listans"><?php ap_answers_count(); ?></span>
				<div class="ap-user-listcont">
					<a class="ap-user-listtitle" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<div class="ap-user-listmeta">
						<span class="votes apicon-thumb-up"><?php ap_votes_net(); ?></span>
						<span class="views apicon-eye"><?php ap_post_field( 'views' ); ?></span>
						<span class="views apicon-pulse"><?php ap_last_active(); ?></span>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
</div>
