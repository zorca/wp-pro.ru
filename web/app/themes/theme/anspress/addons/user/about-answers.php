<div class="ap-user-list">
	<?php if ( ap_have_answers() ) : ?>
		<?php while ( ap_have_answers() ) : ap_the_answer(); ?>
			<div class="ap-user-listitem clearfix">
				<div class="ap-user-listcont">
					<a class="ap-user-listtitle" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<div class="ap-user-listmeta">
						<span class="votes apicon-thumb-up"><?php ap_votes_net(); ?></span>
						<span class="views apicon-pulse"><?php ap_last_active(); ?></span>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
</div>
