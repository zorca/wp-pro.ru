<?php
/**
 * Top users widget class
 *
 * Shows top users by reputation
 *
 * @link http://anspress.io
 * @since 1.01
 *
 * @package AskBug
 */

class AB_Top_Users extends WP_Widget {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		parent::__construct(
			'ab_top_users',
			__( '(AskBug) Top Users', 'ab' ),
			array( 'description' => __( 'Shows top users by selected group', 'ab' ) )
		);
	}

	public function widget( $args, $instance ) {
		global $avatar_size, $ap_user_query;

		$title 			= apply_filters( 'widget_title', $instance['title'] );
		$number 		= $instance['number'] ;
		$avatar_size 	= $instance['avatar'] ;

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . '<a href="'.ap_get_link_to('users').'" class="view-all">'.__('View all users', 'ab').'</a>' .$args['after_title'];
		}

		$user_args = array(
			'ap_query'     => true,
			'role__not_in' => [ 'administrator', 'ap_moderator' ],
			'number'       => $number,
		);

		$ap_user_query = get_users( $user_args );
		echo '<div class="top-users clearfix">';
		get_template_part( 'parts/top-users' );
		echo '</div>';
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title = __( 'Users', 'ap' );

		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}

		$avatar 		= 40;
		$number 		= 5;

		if ( isset( $instance[ 'avatar' ] ) )
			$avatar = $instance[ 'avatar' ];

		if ( isset( $instance[ 'number' ] ) )
			$number = $instance[ 'number' ];

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'avatar' ); ?>"><?php _e( 'Avatar:', 'ap' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'avatar' ); ?>" name="<?php echo $this->get_field_name( 'avatar' ); ?>" type="text" value="<?php echo esc_attr( $avatar ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Show', 'ap' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>">
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : 5;
		$instance['avatar'] = ( ! empty( $new_instance['avatar'] ) ) ? strip_tags( $new_instance['avatar'] ) : 40;

		return $instance;
	}
}

function ab_top_users_register_widgets() {
	register_widget( 'AB_Top_Users' );
}

add_action( 'widgets_init', 'ab_top_users_register_widgets' );