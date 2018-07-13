<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to ab_comment() which is
 * located in the includes/template-tags.php file.
 *
 * @package ab
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

	<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<header>
			<h2 class="comments-title">
				<?php
					printf( _n( '1 Comment', '%d Comments', get_comments_number(), 'ab' ),
						number_format_i18n( get_comments_number() ));
				?>
			</h2>
		</header>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h5 class="screen-reader-text"><?php _e( 'Comment navigation', 'ab' ); ?></h5>
			<ul class="pager">
				<li class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'ab' ) ); ?></li>
				<li class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'ab' ) ); ?></li>
			</ul>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list media-list">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use ab_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define ab_comment() and that will be used instead.
				 * See ab_comment() in includes/template-tags.php for more.
				 */
				wp_list_comments( array( 'callback' => 'ab_comment', 'avatar_size' => 50 ) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'ab' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'ab' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'ab' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'ab' ); ?></p>
	<?php endif; ?>

	<?php comment_form( $args = array(
			  'id_form'           => 'commentform',  // that's the wordpress default value! delete it or edit it ;)
			  'id_submit'         => 'commentsubmit',
			  'title_reply'       => __( 'Leave a Reply', 'ab' ),  // that's the wordpress default value! delete it or edit it ;)
			  'title_reply_to'    => __( 'Leave a Reply to %s', 'ab' ),  // that's the wordpress default value! delete it or edit it ;)
			  'cancel_reply_link' => __( 'Cancel Reply', 'ab' ),  // that's the wordpress default value! delete it or edit it ;)
			  'label_submit'      => __( 'Post Comment', 'ab' ),  // that's the wordpress default value! delete it or edit it ;)

			  'comment_field' =>  '<p><textarea placeholder="'. __('Start typing...', 'ap') .'" id="comment" class="form-control" name="comment" cols="45" rows="4" aria-required="true"></textarea></p>',

			  'comment_notes_after' => '<div class="allowed-tags-toggle"><p class="form-allowed-tags">' .
				__( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:', 'ab' ) .
				'</p><div class="form-allowed-tags-info alert alert-info">' . allowed_tags() . '</div></div>'

			  // So, that was the needed stuff to have bootstrap basic styles for the form elements and buttons

			  // Basically you can edit everything here!
			  // Checkout the docs for more: http://codex.wordpress.org/Function_Reference/comment_form
			  // Another note: some classes are added in the bootstrap-wp.js - ckeck from line 1

	));

	?>

</div><!-- #comments -->
