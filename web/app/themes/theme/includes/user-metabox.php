<?php

/**
 * User metaboxes ajax actions.
 */
class AB_MetaBoxes {
	/**
	 * Initialize class.
	 */
	public static function init() {
		add_action( 'ap_ajax_ab_user_metabox_answers', [ __CLASS__, 'answers' ] );
	}

	/**
	 * Ajax callback for loading reputations.
	 */
	public static function reputations() {
		$user_id = ap_sanitize_unslash( 'user_id', 'r' );
		$reputations = new AnsPress_Reputation_Query( [ 'user_id' => $user_id, 'number' => 5 ] );

		ob_start();
		include ap_get_theme_location( 'addons/user/about-reputations.php' );
		$html = ob_get_clean();
		ap_ajax_json( array(
			'success' => true,
			'html' => $html,
		) );
	}

	/**
	 * Ajax callback for loading votes.
	 */
	public static function votes() {
		$user_id = ap_sanitize_unslash( 'user_id', 'r' );
		ob_start();
		include ap_get_theme_location( 'addons/user/about-votes.php' );
		$html = ob_get_clean();
		ap_ajax_json( array(
			'success' => true,
			'html' => $html,
		) );
	}

	/**
	 * Ajax callback for loading questions.
	 */
	public static function questions() {
		global $questions;

		$user_id = ap_sanitize_unslash( 'user_id', 'r' );
		$questions = ap_get_questions( array(
			'ap_current_user_ignore' => true,
			'author' => $user_id,
			'limit' => 5,
		) );
		ob_start();
		include ap_get_theme_location( 'addons/user/about-questions.php' );
		$html = ob_get_clean();
		ap_ajax_json( array(
			'success' => true,
			'html' => $html,
		) );
	}

	/**
	 * Ajax callback for loading about.
	 */
	public static function about() {
		$user_id = ap_sanitize_unslash( 'user_id', 'r' );

		ob_start();
		include ap_get_theme_location( 'addons/user/about-about.php' );
		$html = ob_get_clean();
		ap_ajax_json( array(
			'success' => true,
			'html' => $html,
		) );
	}

	/**
	 * Ajax callback for loading answers.
	 */
	public static function answers() {
		global $answers;
		$user_id = ap_sanitize_unslash( 'user_id', 'r' );

		anspress()->answers = $answers = new Answers_Query( array(
			'ap_current_user_ignore' => true,
			'author'                 => $user_id,
			'limit'                  => 5,
		) );

		ob_start();
		include ap_get_theme_location( 'addons/user/about-answers.php' );
		$html = ob_get_clean();
		ap_ajax_json( array(
			'success' => true,
			'html' => $html,
		) );
	}

	/**
	 * Ajax callback for loading counts.
	 */
	public static function counts() {
		$user_id = ap_sanitize_unslash( 'user_id', 'r' );
		ob_start();
		include ap_get_theme_location( 'addons/user/about-counts.php' );
		$html = ob_get_clean();
		ap_ajax_json( array(
			'success' => true,
			'html' => $html,
		) );
	}
}
AB_MetaBoxes::init();

/**
 * AnsPress user meta boxes.
 */
function ab_get_user_metaboxs() {
	$meta_boxes = array(
		array(
			'id' => 'counts',
			'cb' => [ 'AB_MetaBoxes', 'counts' ],
			'col' => '12',
			'wrapper' => false,
			'order' => 1,
		),
		array(
			'id' => 'reputations',
			'cb' => [ 'AB_MetaBoxes', 'reputations' ],
			'title' => __( 'Reputation', 'ab' ),
			'col' => '6',
		),
		array(
			'id' => 'votes',
			'cb' => [ 'AB_MetaBoxes', 'votes' ],
			'title' => __( 'Votes', 'ab' ),
			'col' => '6',
		),
		array(
			'id' => 'questions',
			'cb' => [ 'AB_MetaBoxes', 'questions' ],
			'title' => __( 'Questions', 'ab' ),
			'col' => '6',
		),
		array(
			'id' => 'about',
			'cb' => [ 'AB_MetaBoxes', 'about' ],
			'title' => __( 'About', 'ab' ),
			'col' => '6',
			'order' => 3,
		),
		array(
			'id' => 'answers',
			'cb' => [ 'AB_MetaBoxes', 'answers' ],
			'title' => __( 'Answers', 'ab' ),
			'col' => '6',
		),
	);

	$meta_boxes = apply_filters( 'ab_user_metaboxs', $meta_boxes );

	foreach ( $meta_boxes as $k => $m ) {
		if ( empty( $m['order'] ) ) {
			$meta_boxes[ $k ]['order'] = 5;
		}
	}

	return ap_sort_array_by_order( $meta_boxes );
}

/**
 * Print user metabox JSON.
 *
 * @param integer|false $user_id User id.
 */
function ab_user_metaboxs( $user_id = false ) {
	if ( false === $user_id ) {
		$user_id = (int) get_query_var( 'ap_user_id' );
	}

	$metaboxs = [];

	foreach ( ab_get_user_metaboxs() as $metabox ) {
		unset( $metabox['cb'] );
		$metabox['user_id'] = $user_id;
		$metaboxs[] = $metabox;
	}

	echo '<script id="ap-user-metaboxes" type="application/json">';
	echo wp_json_encode( $metaboxs );
	echo '</script>';
}
