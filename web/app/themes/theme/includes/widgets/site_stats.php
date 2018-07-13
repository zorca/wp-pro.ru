<?php
class AB_Site_Stats extends WP_Widget {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		parent::__construct(
			'ab_site_stats',
			__( '(AskBug) Site Stats', 'ab' ),
			array( 'description' => __( 'Shows current site stats', 'ab' ) )
		);
	}

	public function widget( $args, $instance ) {
		$title 			= apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		?>
		<div class="site-stats clearfix">
			<div class="stats-item">
				<i class="apicon-question"></i>
				<div class="no-overflow">
					<span><?php printf(__('%d Questions', 'ab'), ap_total_published_questions()); ?></span>
					<span><?php _e('total questions asked', 'ab'); ?></span>
				</div>
			</div>
			<div class="stats-item">
				<i class="apicon-check"></i>
				<div class="no-overflow">
					<span><?php printf(__('%d Solved', 'ab'), ap_total_solved_questions()); ?></span>
					<span><?php _e('total solved questions', 'ab'); ?></span>
				</div>
			</div>
			<div class="stats-item">
				<i class="apicon-answer"></i>
				<div class="no-overflow">
					<?php $answers = ap_total_posts_count('answer'); ?>
					<span><?php printf(__('%d Answers', 'ab'), $answers->publish); ?></span>
					<span><?php _e('total answer posted', 'ab'); ?></span>
				</div>
			</div>
			<div class="stats-item">
				<i class="apicon-users"></i>
				<div class="no-overflow">
					<?php $users = count_users(); ?>
					<span><?php printf(__('%d Total users', 'ab'), $users['total_users']); ?></span>
					<span><?php _e('total community members', 'ab'); ?></span>
				</div>
			</div>
		</div>
		<?php
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Site stats', 'ap' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
}

function AB_Site_Stats_register_widgets() {
	register_widget( 'AB_Site_Stats' );
}

add_action( 'widgets_init', 'AB_Site_Stats_register_widgets' );