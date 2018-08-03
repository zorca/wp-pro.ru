<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package ab
 */

if ( ! function_exists( 'ab_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function ab_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';

	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'ab' ); ?></h1>
		<ul class="pager">

		<?php if ( is_single() ) : // navigation links for single posts ?>

			<?php previous_post_link( '<li class="nav-previous previous">%link</li>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'ab' ) . '</span>'.__('Previous', 'ab') ); ?>
			<?php next_post_link( '<li class="nav-next next">%link</li>', __('Next', 'ab').'<span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'ab' ) . '</span>' ); ?>

		<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

			<?php if ( get_next_posts_link() ) : ?>
			<li class="nav-previous previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'ab' ) ); ?></li>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<li class="nav-next next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'ab' ) ); ?></li>
			<?php endif; ?>

		<?php endif; ?>

		</ul>
	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // ab_content_nav

if ( ! function_exists( 'ab_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function ab_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'media' ); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'ab' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'ab' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body media">
			<a class="pull-left" href="#">
				<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
			</a>
			<div class="media-body">
				<div class="comment-meta">
					<?php comment_reply_link(
						array_merge(
								$args, array(
									'reply_text' 	=> '<i  class="i-mail-reply"></i> '.__('Reply', 'ab'),
									'add_below' 	=> 'div-comment',
									'depth' 		=> $depth,
									'max_depth' 	=> $args['max_depth'],
									'before' 		=> '<span class="reply comment-reply pull-right">',
									'after' 		=> '</span><!-- .reply -->'
								)
							)
						);
					?>
					<?php printf( '<cite class="fn">%s</cite> said ', get_comment_author_link() ); ?>

					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( __( '%s ago', 'ab' ), human_time_diff( get_comment_time( 'U' ) ) ); ?>
						</time>
					</a>

					<?php edit_comment_link( __( '<span style="margin-left: 5px;" class="glyphicon glyphicon-edit"></span> Edit', 'ab' ), '<span class="edit-link">', '</span>' ); ?>
				</div>

				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'ab' ); ?></p>
				<?php endif; ?>

				<div class="comment-content ">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->
			</div><!-- .media-body -->

		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for ab_comment()

if ( ! function_exists( 'ab_the_attached_image' ) ) :
/**
 * Prints the attached image with a link to the next attached image.
 */
function ab_the_attached_image() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'ab_attachment_size', array( 1200, 1200 ) );
	$next_attachment_url = wp_get_attachment_url();

	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the
	 * URL of the next adjacent image in a gallery, or the first image (if
	 * we're looking at the last image in a gallery), or, in a gallery of one,
	 * just the link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'ab_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function ab_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$time_string = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		$time_string
	);

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ){
		$time_string_update = '<time class="updated" datetime="%1$s">%2$s</time>';
		$time_string_update = sprintf( $time_string_update,
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		$time_string_update = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			$time_string_update
		);
		$time_string .= __(', updated on ', 'ab') . $time_string_update;
	}

	printf( __( '<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'ab' ),
		$time_string,
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'ab' ), get_the_author() ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category
 */
function ab_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so ab_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so ab_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in ab_categorized_blog
 */
function ab_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'ab_category_transient_flusher' );
add_action( 'save_post',     'ab_category_transient_flusher' );

function ab_darken($color, $percentage) {
	$simple_color_adjuster = new Simple_Color_Adjuster;
	return $simple_color_adjuster->darken( $color, $percentage );
}

function ab_lighten($color, $percentage) {
	$simple_color_adjuster = new Simple_Color_Adjuster;
	return $simple_color_adjuster->lighten( $color, $percentage );
}

/**
 * Find all unclosed HTML tags and close them.
 * @param  string $html Html string.
 * @return string       Sanitised html.
 */
function ab_closetag($html) {
	// Put all opened tags into an array.
	preg_match_all( '#<([a-z]+)( .*)?(?!/)>#iU', $html, $result );
	$openedtags = $result[1];

	// Put all closed tags into an array.
	preg_match_all( '#</([a-z]+)>#iU', $html, $result );
	$closedtags = $result[1];
	$len_opened = count( $openedtags );

	// All tags are closed.
	if( count( $closedtags ) == $len_opened ) {
		return $html;
	}

	$openedtags = array_reverse( $openedtags );

	# close tags
	for ( $i = 0; $i < $len_opened; $i++ ) {
		if ( ! in_array( $openedtags[ $i ], $closedtags ) ) {
			$html .= "</" . $openedtags[$i] . ">";
		} else {
			unset ( $closedtags[ array_search( $openedtags[$i], $closedtags) ] );
		}
	}
	return $html;
}

/**
 * Count total numbers of comment of a user.
 *
 * @param integer $user_id User id.
 * @return object
 */
function ab_count_user_comments( $user_id ) {
	$key = 'ab_comments_' . $user_id;
	$cache = wp_cache_get( $key, 'ab_counts' );

	if ( false !== $cache ) {
		return $cache;
	}

	global $wpdb;
	$counts = $wpdb->get_results( $wpdb->prepare( "SELECT count(*) as count, comment_approved as approved FROM $wpdb->comments where user_id = %d AND comment_type = 'anspress' group by comment_approved", $user_id ) ); // WPCS: db call okay.

	$new_counts = (object) [ 'total' => 0, 'approved' => 0, 'unapproved' => 0 ];

	foreach ( (array) $counts as $count ) {
		$type = '1' === $count->approved ? 'approved' : 'unapproved';
		$new_counts->$type += (int) $count->count;
		$new_counts->total += $count->count;
	}

	wp_cache_set( $key, $new_counts, 'ab_counts' );

	return $new_counts;
}

/**
 * Count user reputation for curent month.
 *
 * @param integer $user_id user ID.
 */
function ab_count_user_reputation_month( $user_id ) {
	global $wpdb;

	$cache = wp_cache_get( $user_id, 'ab_rep_month' );

	if ( false !== $cache ) {
		return $cache;
	}

	$events = $wpdb->get_results( $wpdb->prepare( "SELECT count(*) as count, rep_event  FROM {$wpdb->ap_reputations} WHERE rep_user_id = %d AND MONTH(rep_date) = MONTH(CURRENT_DATE()) GROUP BY rep_event", $user_id ) ); // WPCS: db call okay.

	$event_counts = [];
	foreach ( (array) $events as $count ) {
		$event_counts[ $count->rep_event ] = $count->count;
	}

	$count = [];
	foreach ( ap_get_reputation_events() as $slug => $event ) {
		$count[ $slug ] = isset( $event_counts[ $slug ] ) ? ( (int) $event_counts[ $slug ] * (int) $event['points'] ) : 0;
	}

	$count = array_sum( $count );
	wp_cache_set( $user_id, $count, 'ab_rep_month' );

	return $count;
}

/**
 * Get user casted and received vote counts.
 *
 * @param integer $user_id User id.
 * @return array
 */
function ab_count_votes_by_types( $user_id ) {
	global $wpdb;

	$cache = wp_cache_get( $user_id, 'ab_votes_type' );

	if ( false !== $cache ) {
		return $cache;
	}

	$casted = $wpdb->get_results( $wpdb->prepare( "SELECT count(vote_id) as count, vote_value FROM $wpdb->ap_votes WHERE vote_type = 'vote' AND vote_user_id = %d GROUP BY vote_value", $user_id ), ARRAY_A );

	$received = $wpdb->get_results( $wpdb->prepare( "SELECT count(vote_id) as count, vote_value FROM $wpdb->ap_votes WHERE vote_type = 'vote' AND vote_rec_user = %d GROUP BY vote_value", $user_id ), ARRAY_A );

	$count = [ 'casted_up_votes' => 0, 'casted_down_votes' => 0, 'received_up_votes' => 0, 'received_down_votes' => 0 ];

	foreach ( (array) $casted as $vote ) {
		if ( '1' === $vote['vote_value'] ) {
			$count['casted_up_votes'] = $vote['count'];
		} else {
			$count['casted_down_votes'] = $vote['count'];
		}
	}

	foreach ( (array) $received as $vote ) {
		if ( '1' === $vote['vote_value'] ) {
			$count['received_up_votes'] = $vote['count'];
		} else {
			$count['received_down_votes'] = $vote['count'];
		}
	}

	wp_cache_set( $user_id, $count, 'ab_votes_type' );

	return $count;
}

/**
 * Get reputation log by month of a user.
 *
 * @param integer $user_id User id.
 * @return array
 */
function ap_get_reputation_month_log( $user_id ) {
	$cache = wp_cache_get( $user_id, 'ab_rep_month_log' );

	if ( false !== $cache ) {
		return $cache;
	}

	global $wpdb;

	$reputations = $wpdb->get_results( $wpdb->prepare( "SELECT DATE_FORMAT(rep_date, '%%c-%%e') as day, rep_event, COUNT(*) as count FROM wp_ap_reputations WHERE rep_date BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() AND rep_user_id = %d GROUP BY day, rep_event", $user_id ) );

	$grouped = [];
	foreach ( (array) $reputations as $rep ) {
		$grouped[ $rep->day ][] = [ 'event' => $rep->rep_event, 'count' => $rep->count ];
	}

	$begin = new DateTime( date( 'Y-m-d', strtotime( 'today - 30 days' ) ) );
	$end = new DateTime( date( 'Y-m-d', strtotime( 'today' ) ) );
	$interval = DateInterval::createFromDateString( '1 day' );
	$period = new DatePeriod( $begin, $interval, $end );

	$reps_day = [];
	foreach ( $period as $dt ) {
		$day = $dt->format( 'n-j' );
		if ( ! isset( $reps_day[ $day ] ) ) {
			$reps_day[ $day ] = 0;
		}

		if ( isset( $grouped[ $day ] ) ) {
			foreach ( (array) $grouped[ $day ] as $gr ) {
				$reps_day[ $day ] = ap_get_reputation_event_points( $gr['event'] ) * (int) $gr['count'];
			}
		}
	}

	wp_cache_set( $user_id, $reps_day, 'ab_rep_month_log' );

	return $reps_day;
}

/**
 * Create unique name for files.
 *
 * @param  string  $dir  Directory.
 * @param  integer $name User ID.
 * @param  string  $ext  Image extension.
 * @return string
 */
function ab_unique_filename_cb( $dir, $name, $ext ) {
	$md5 = md5( get_current_user_id() );
	return $md5 . $ext;
}

/**
 * Change upload dir for avatar upload.
 *
 * @param array $dirs Directories.
 */
function ab_switch_upload_dir( $dirs ) {
	global $ab_upload_type;

	if ( empty( $ab_upload_type ) ) {
		return $dirs;
	}

	$dir = 'avatar' === $ab_upload_type ? 'ap_avatars' : 'ap_covers';

	return array(
			'path'   => $dirs['basedir'] . '/' . $dir,
			'url'    => $dirs['baseurl'] . '/' . $dir,
			'subdir' => '/' . $dir,
	) + $dirs;
}

function ab_upload_user_files( $type = 'avatar', $file, $width = 90, $height = 90 ) {
	global $ab_upload_type;
	$ab_upload_type = $type;
	$user_id = get_current_user_id();

	if ( $_FILES[ $file ]['size'] > ap_opt( 'max_upload_size' ) ) {
		return new WP_Error( 'cannot_upload', sprintf( __( 'File cannot be uploaded, size is bigger then %d Byte', 'ab' ), ap_opt( 'max_upload_size' ) ) );
	}

	require_once ABSPATH.'wp-admin/includes/image.php';
	require_once ABSPATH.'wp-admin/includes/file.php';
	require_once ABSPATH.'wp-admin/includes/media.php';

	if ( ! empty( $_FILES[ $file ][ 'name' ] ) && is_uploaded_file( $_FILES[ $file ]['tmp_name'] ) ) {
		add_filter( 'upload_dir', 'ab_switch_upload_dir' );

		$photo = wp_handle_upload( $_FILES[ $file ], array(
			'mimes'       => array(
				'jpg|jpeg' => 'image/jpeg',
				'gif'      => 'image/gif',
				'png'      => 'image/png',
			),
			'test_form'   => false,
			'unique_filename_callback' => 'ab_unique_filename_cb',
		) );

		if ( empty( $photo[ 'file' ] ) || isset( $photo['error'] ) ) {
			return new WP_Error( 'upload_failed',  __( 'There was an error while uploading avatar, please check your image', 'ab' ) );
		}

		$uplaod_dir = wp_upload_dir( );
		$existing = md5( get_current_user_id() );

		// Find existing user avatar.
		$files_to_delete = glob( $uplaod_dir['path'] . '/' . $existing .'{.png,.jpg,.jpeg,.gif}', GLOB_BRACE );

		// Delete user avatar except current one.
		foreach ( (array) $files_to_delete as $file ) {
			if ( $photo['file'] !== $file ) {
				wp_delete_file( $file );
			}
		}

		$image = wp_get_image_editor( $photo[ 'file' ] );

		if ( ! is_wp_error( $image ) ) {
			$image->resize( $width, $height, true );
			$image->save( $photo[ 'file' ] );
		}

		remove_filter( 'upload_dir', 'ab_switch_upload_dir' );
		return $photo;
	}

	return new WP_Error( 'upload_failed',  __( 'There was an error while uploading avatar, please check your image', 'ab' ) );
}

/**
 * Get user cover image.
 *
 * @param  integer $user_id User id.
 * @return string
 */
function ab_get_user_cover( $user_id = false ) {

	if ( false === $user_id ) {
		$user_id = get_current_user_id();
	}

	$meta = get_user_meta( $user_id, 'ap_cover', true );

	if ( ! empty( $meta ) ) {
		$uplaod_dir = wp_upload_dir( );
		$path = wp_normalize_path( $uplaod_dir['basedir'] . '/ap_covers/' . $meta );

		if ( file_exists( $path ) ) {
			return $uplaod_dir['baseurl'] . '/ap_covers/' . $meta;
		}
	}

	return get_template_directory_uri() . '/includes/images/cover.jpg';
}
