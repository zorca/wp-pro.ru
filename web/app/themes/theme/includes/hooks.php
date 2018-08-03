<?php
/**
 * Disable admin bar
 */
add_action( 'show_admin_bar', '__return_false' );


/**
 * if no title then add widget content wrapper to before widget
 */
function ab_check_sidebar_params( $params ) {
	global $wp_registered_widgets;

	$settings_getter = $wp_registered_widgets[ $params[0]['widget_id'] ]['callback'][0];
	$settings = $settings_getter->get_settings();
	$settings = $settings[ $params[1]['number'] ];

	$params[0]['after_widget'] 	= '</div>';
	$params[0]['after_title']  	= '</h3>';

	if ( isset( $settings['title'] ) && ! empty( $settings['title'] ) ) {
		$params[0]['after_title'] .= '<div class="widget-inner">';
		$params[0]['after_widget'] 	.= '</div>';
	}

	return $params;
}
add_filter( 'dynamic_sidebar_params', 'ab_check_sidebar_params' );

/**
 * Add logout link in AnsPress dropdown menu.
 *
 * @param  array $links AnsPress links.
 * @return array
 */
function ab_ap_user_link( $links ) {

	if ( is_user_logged_in() ) {
		$links['logout'] = array(
			'slug'         => 'logout',
			'title'        => __( 'Logout', 'ab' ),
			'link'         => wp_logout_url( ),
			'order'        => 100,
			'show_in_menu' => false,
			'public'       => true,
			'class'        => 'apicon-lock',
		);
	}

	return $links;
}
add_filter( 'ap_user_menu', 'ab_ap_user_link' );

/**
 * Register AnsPress base page.
 *
 * @param array $pages Pages.
 * @return array
 */
function ab_add_users_page( $pages ) {
	$pages[ 'users_page' ] = array(
		'label'      => __( 'Users page', 'anspress-question-answer' ),
		'desc'       => __( 'Page used to display users list.', 'anspress-question-answer' ),
		'post_title' => __( 'Users', 'anspress-question-answer' ),
		'post_name'  => 'users',
	);

	return $pages;
}
add_filter( 'ap_main_pages', 'ab_add_users_page' );


/**
 * Register Users page.
 */
function ab_register_users_page() {
	ap_register_page( 'users', __( 'Users', 'ab' ), 'ab_users_page', true );
}
add_action( 'init', 'ab_register_users_page' );

/**
 * Render user page.
 */
function ab_users_page() {
	$paged = (int) get_query_var( 'paged', 1 );
	$paged = empty( $paged ) ? 1 : $paged;

	$user_args = array(
		'role__not_in' => [ 'administrator', 'ap_moderator' ],
		'number'       => 20,
		'paged'        => $paged,
		'orderby'      => 'meta_value_num',
		'order'        => 'DESC',
		'meta_query' => array(
			'relation' => 'OR',
			array(
				'key'     => 'ap_reputations',
				'type'    => 'NUMERIC',
				'compare' => 'NOT EXISTS',
			),
			array(
				'key' => 'ap_reputations',
				'type' => 'NUMERIC',
			),
		)
	);

	$ap_user_query = new WP_User_Query( $user_args );
	$total_pages = $ap_user_query->total_users / 20;

	include ap_get_theme_location( 'users.php' );

	ap_pagination( $paged, $total_pages );
}

/**
 * Filter user query so that it can be sorted by user reputation
 *
 * @param  array $query Mysql claueses.
 * @return array
 */
function ab_sort_user_by_rep( $query ) {
	global $wpdb;
	if ( isset( $query->query_vars['ap_query'] ) ) {
		$query->query_fields = $query->query_fields. ", (SELECT COUNT(*) FROM {$wpdb->ap_reputations} WHERE rep_user_id = {$wpdb->users}.ID ) as rep_count";
		$query->query_orderby = 'ORDER BY rep_count DESC';
	}
	return $query;
}
//add_filter( 'pre_user_query', 'ab_sort_user_by_rep' );

/**
 * Register AnsPress about user page.
 */
function ab_add_user_page() {
	anspress()->user_pages[] = array(
		'slug'  => 'about',
		'label' => __( 'About', 'anspress-question-answer' ),
		'icon'  => 'apicon-user',
		'cb'    => 'ab_about_page',
		'order' => 1,
	);
}
add_action( 'ap_user_pages', 'ab_add_user_page' );

/**
 * Render user about page.
 */
function ab_about_page() {
	ap_get_template_part( 'addons/user/about' );
}

/**
 * Add logout menu item and edit profile page.
 *
 * @param array $items AnsPress menu items.
 * @return array
 */
function ab_ap_menu_items( $items ) {
	anspress()->user_pages[] = array(
		'slug'  => 'logout',
		'label' => __( 'Logout', 'anspress-question-answer' ),
		'icon'  => 'apicon-lock',
		'url'   => wp_logout_url( home_url( '/' ) ),
		'order' => 20,
	);

	anspress()->user_pages[] = array(
		'slug'    => 'edit-profile',
		'label'   => __( 'Edit Profile', 'ab' ),
		'icon'    => 'apicon-profile',
		'cb'      => 'ab_user_profile_edit_page',
		'private' => true,
		'order'   => 1,
	);
}
add_action( 'ap_user_pages', 'ab_ap_menu_items', 10 );

/**
 * Redirect user after successful login.
 *
 * @param  string $redirect_to URL to redirect to.
 * @param  string $request URL the user is coming from.
 * @param  object $user Logged user's data.
 * @return string
 */
function ab_login_redirect( $redirect_to, $request, $user ) {

	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		if ( in_array( 'administrator', $user->roles ) ) {
			return $redirect_to;
		} else {
			return ap_user_link( $user->ID );
		}
	}

	return $redirect_to;
}
add_filter( 'login_redirect', 'ab_login_redirect', 10, 3 );

/**
 * User profile edit page callback.
 */
function ab_user_profile_edit_page() {
	$user_id = ap_current_user_id();

	if ( get_current_user_id() === $user_id ) {
		include ap_get_theme_location( 'addons/user/edit-profile.php' );
	} else {
		_e( 'You do not have permission to view this page', 'anspress-question-answer' ); // xss okay.
	}
}

/**
 * Ajax callback for handling user profile update.
 *
 * @return void
 * @since unknown
 */
function ab_update_user_profile() {

	if ( ! is_user_logged_in() || ! wp_verify_nonce( $_POST['__nonce'], 'update_profile' ) ) {
		wp_die( 'false' );
	}

	$allowed = [ 'first_name', 'last_name', 'display_name', 'nickname', 'description', 'user_url' ];

	$form = [ 'ID' => get_current_user_id() ];
	foreach ( $allowed as $key ) {
		if ( isset( $_POST[ $key ] ) ) {

			if ( 'user_url' === $key ) {
				$form[ $key ] = esc_url( $_POST[ $key ] );
			} else {
				$form[ $key ] = ap_sanitize_unslash( $_POST[ $key ] );
			}
		}
	}

	$user_id = wp_update_user( $form );

	if ( ! is_wp_error( $user_id ) ) {
		ap_send_json( array(
			'success' => true,
			'snackbar' => [ 'message' => __( 'Profile Updated Successfully', 'askbug' ) ],
		) );
	}

	ap_send_json( array(
		'success' => false,
		'snackbar' => [ 'message' => __( 'Failed to update profile', 'askbug' ) ],
	) );
}
add_action( 'ap_ajax_ab_update_user_profile', 'ab_update_user_profile' );

/**
 * Override default AnsPress avatar callback.
 *
 * @param boolean $override Override default return.
 * @param array   $args Avatar arguments.
 * @param mixed   $user User.
 */
function ab_user_avatar_override( $override, $args, $user ) {

	if ( is_object( $user ) && ! empty( $user->user_id ) ) {
		$user_id = (int) $user->user_id;
	} elseif ( is_object( $user ) && $user instanceof WP_user ) {
		$user_id = $user->ID;
	} elseif ( is_object( $user ) && $user instanceof WP_Comment ) {
		$user_id = $user->user_id;
	} elseif ( is_numeric( $user ) && ! empty( $user ) ) {
		$user_id = $user;
	} else {
		return false;
	}

	$meta = get_user_meta( $user_id, 'ap_avatar', true );

	if ( empty( $meta ) ) {
		return false;
	}

	$uplaod_dir = wp_upload_dir( );
	$path = wp_normalize_path( $uplaod_dir['basedir'] . '/ap_avatars/' . $meta );

	if ( file_exists( $path ) ) {
		$args['url'] = $uplaod_dir['baseurl'] . '/ap_avatars/' . $meta;
		return $args;
	}

	return false;
}
add_filter( 'ap_pre_avatar_url', 'ab_user_avatar_override', 10, 3 );

/**
 * Ajax callback for uploading avatar.
 */
function ab_upload_user_avatar() {

	if ( ! is_user_logged_in() ||
		! wp_verify_nonce( $_POST['__nonce'], 'upload_avatar_' . get_current_user_id() ) ) {
			die( wp_json_encode( [ 'success' => false ] ) );
	}

	$photo = ab_upload_user_files( 'avatar', 'avatar', 90, 90 );

	if ( is_wp_error( $photo ) ) {
		ap_ajax_json( [
			'success'  => false,
			'snackbar' => [ 'message' => $photo->get_error_messages() ],
		] );
	}

	update_user_meta( get_current_user_id(), 'ap_avatar', basename( $photo[ 'file' ] ) );

	ap_ajax_json( [
		'success'  => true,
		'snackbar' => [ 'message' => __( 'Successfully uploaded avatar', 'ab' ) ],
		'url'      => esc_url( $photo['url'] ),
		'type'     => 'avatar',
	] );
}
add_action( 'wp_ajax_ab_upload_user_avatar', 'ab_upload_user_avatar' );

/**
 * Ajax callback for uploading avatar.
 */
function ab_upload_user_cover() {
	if ( ! is_user_logged_in() ||
		! wp_verify_nonce( $_POST['__nonce'], 'upload_cover_' . get_current_user_id() ) ) {
			die( wp_json_encode( [ 'success' => false ] ) );
	}

	$photo = ab_upload_user_files( 'cover', 'cover', 1400, 300 );

	if ( is_wp_error( $photo ) ) {
		ap_ajax_json( [
			'success'  => false,
			'snackbar' => [ 'message' => $photo->get_error_messages() ],
		] );
	}

	update_user_meta( get_current_user_id(), 'ap_cover', basename( $photo[ 'file' ] ) );

	ap_ajax_json( [
		'success'  => true,
		'snackbar' => [ 'message' => __( 'Successfully uploaded cover', 'ab' ) ],
		'url'      => esc_url( $photo['url'] ),
		'type'     => 'cover',
	] );
}
add_action( 'wp_ajax_ab_upload_user_cover', 'ab_upload_user_cover' );
