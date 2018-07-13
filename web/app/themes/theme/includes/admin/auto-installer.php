<?php
/**
 * Auto install theme page for AskBug
 *
 * @package WordPress/AskBug
 */

/**
 * Demo data import class.
 */
class AskBug_Installer {

	/**
	 * Initialize the class.
	 */
	public function __construct() {
		$this->update_default_mods();
		$this->add_default_menu();
		$this->widgets();

		update_option( 'askbug_demo_import', true );
	}

	/**
	 * Update default wp_customize fields.
	 */
	public function update_default_mods() {
		set_theme_mod( 'main_color', '#FF7545' );
	}

	/**
	 * Add default menu.
	 */
	public function add_default_menu() {
		// Check if the menu exists.
		$menu_name = 'Primary';
		$menu_exists = wp_get_nav_menu_object( $menu_name );

		// If it doesn't exist, let's create it.
		if ( ! $menu_exists ) {
			$menu_id = wp_create_nav_menu( $menu_name );

			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title'  => __( 'Questions', 'ab' ),
				'menu-item-url'    => ap_get_link_to( '/' ),
				'menu-item-status' => 'publish',
			) );

			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title'  => __( 'Categories', 'ab' ),
				'menu-item-url'    => ap_get_link_to( '/categories' ),
				'menu-item-status' => 'publish',
			) );

			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title'  => __( 'Tags', 'ab' ),
				'menu-item-url'    => ap_get_link_to( '/tags' ),
				'menu-item-status' => 'publish',
			) );

			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title'  => __( 'Ask', 'ab' ),
				'menu-item-url'    => ap_get_link_to( '/ask' ),
				'menu-item-status' => 'publish',
			) );

			$locations = get_theme_mod( 'nav_menu_locations', [] );

			$locations['primary'] = $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}
	}

	/**
	 * Update widgets position.
	 */
	public function widgets() {
		$widgets = get_option( 'sidebars_widgets', [] );

		$widgets['anspress-top'] = [ 'ap_breadcrumbs_widget-2' ];
		$widgets['ap-qsidebar'] = [ 'anspress_category_widget-2' ];
		$widgets['ap-sidebar'] = [ 'ab_top_users-2', 'anspress_category_widget-3' ];
		$widgets['home-users'] = [ 'ab_top_users-3' ];
		$widgets['stats'] = [ 'ab_site_stats-2' ];

		update_option( 'sidebars_widgets', $widgets );

		update_option( 'widget_ap_breadcrumbs_widget', array(
			2 => [ 'title' => '' ],
		) );

		update_option( 'widget_anspress_category_widget', array(
			2 => array(
				'hide_empty'  => false,
				'icon_height' => 32,
				'icon_width'  => 32,
				'number'      => '10',
				'order'       => 'DESC',
				'orderby'     => 'count',
				'parent'      => '0',
				'title'       => __( 'Categories', 'ab' ),
			),
			3 => array(
				'hide_empty'  => false,
				'icon_height' => 32,
				'icon_width'  => 32,
				'number'      => '10',
				'order'       => 'DESC',
				'orderby'     => 'count',
				'parent'      => '0',
				'title'       => __( 'Categories', 'ab' ),
			),
		) );

		update_option( 'widget_ab_top_users', array(
			2 => [ 'title' => __( 'Top Users', 'ab' ), 'avatar' => 40, 'show' => 10 ],
			3 => [ 'title' => __( 'Top Users', 'ab' ), 'avatar' => 40, 'show' => 4 ],
		) );

		update_option( 'widget_ab_site_stats', array(
			2 => [ 'title' => '' ],
		) );
	}
}

/**
 * Run this class.
 */
function askbug_default_data() {
	if ( is_super_admin( ) ) {
		new AskBug_Installer();
	}

	wp_redirect( admin_url( 'themes.php' ) );
}
add_action( 'admin_post_askbug_default_data', 'askbug_default_data' );

/**
 * Admin notice.
 */
function askbug_install_notice() {
	if ( is_super_admin( ) && ! get_option( 'askbug_demo_import', false ) ) {
		echo '<div class="notice notice-warning"><p>'. __( 'Import AskBug demo data (widgets and menu)', 'ab' ) .' <a class="button" href="' . admin_url( 'admin-post.php?action=askbug_default_data' ) . '">' . __( 'Import now!', 'ab' ) . '</a></p></div>';
	}
}
add_action( 'admin_notices', 'askbug_install_notice' );
