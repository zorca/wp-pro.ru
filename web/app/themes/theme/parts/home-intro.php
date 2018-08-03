<?php
/**
 * Template for home intro.
 *
 * @since 3.0
 * @package WordPress/AskBug
 */
$bg_opacity = get_theme_mod( 'hide_home_background', '0.1' );
?>
<?php if ( ( is_front_page() ) && ( (!get_theme_mod( 'hide_welcome_loggedin', false ) &&
	is_user_logged_in() ) || !is_user_logged_in() ) ): ?>

	<header id="masthead" class="site-header" role="banner">
		<?php $header_image = get_header_image(); ?>
		<div class="site-header-cover">
			<div class="site-header-fade" style="background-image:url(<?php header_image(); ?>);opacity:<?php echo $bg_opacity; ?>"></div>

			<div class="site-header-entry container">
				<div class="for-asker">

					<h2 class="entry-title"><?php echo get_theme_mod( 'ab_intro_qhead', 'Got lots of questions?' ); ?></h2>
					<p class="entry-content"><?php echo get_theme_mod( 'ab_intro_qdesc', 'Lucky, we got lots of answers as well.' ); ?></p>

					<?php if ( get_theme_mod( 'ab_intro_qshowbutton', true ) ) : ?>
						<div class="site-header-buttons">
							<a href="<?php ap_link_to( 'ask' ); ?>" class="btn btn-ask btn-default btn-lg"><?php echo get_theme_mod( 'ab_intro_qbuttontext', 'Ask Question' ); ?></a>
						</div>
					<?php endif; ?>

				</div>

				<div class="for-answerer">
					<div class="answer-fade-bg"></div>
					<h2 class="entry-title"><?php echo get_theme_mod( 'ab_intro_ahead', 'Are you an expert?' ); ?></h2>
					<p class="entry-content"><?php echo get_theme_mod( 'ab_intro_adesc', 'Share your knowledge and experience.' ); ?></p>

					<?php if ( get_theme_mod( 'ab_intro_ashowbutton', true ) ) : ?>
						<div class="site-header-buttons">
							<a href="<?php ap_link_to('/'); ?>?ap_sort=unanswered" class="btn btn-answer btn-default btn-lg"><?php echo get_theme_mod( 'ab_intro_abuttontext', 'Answer' ); ?></a>
						</div>
					<?php endif; ?>

				</div>

			</div>
		</div>
	</header><!-- #masthead -->

<?php endif; ?>
