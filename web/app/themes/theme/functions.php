<?php
/**
 * ab functions and definitions
 *
 * @package ab
 */

define( 'ASKBUG_VERSION', '3.1.8' );


// Check if required version of AnsPress is installed.
if ( ! defined( 'AP_VERSION' ) || ( defined( 'AP_VERSION' ) && version_compare( AP_VERSION, '4.0.0' ) < 0) ) {

	/**
	 * Include warning page template.
	 *
	 * @param string $template Current template.
	 * @return string
	 */
	function ab_warning_template_inc( $template ) {
		$template = locate_template( [ 'warning.php' ] );
		return $template;
	}
	add_filter( 'template_include', 'ab_warning_template_inc', 99 );

	return;
}


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 750;
}

if ( ! function_exists( 'ab_setup' ) ) :
	/**
	 * Set up theme defaults and register support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 */
	function ab_setup() {
		global $cap, $content_width;

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		/**
	 * Add default posts and comments RSS feed links to head
	*/
		add_theme_support( 'automatic-feed-links' );

		/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	*/
		add_theme_support( 'post-thumbnails' );

		/**
	 * Enable support for auto title tag
	 */
		add_theme_support( 'title-tag' );

		/**
	 * Enable support for Post Formats
	*/
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

		/**
	 * Setup the WordPress core custom background feature.
	*/
		add_theme_support( 'custom-background', apply_filters( 'ab_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on ab, use a find and replace
	 * to change 'ab' to the name of your theme in all the template files
	*/
		load_theme_textdomain( 'ab', get_template_directory() . '/languages' );

		/**
	 * This theme uses wp_nav_menu() in one location.
	*/
		register_nav_menus( array(
			'primary'  => __( 'Primary', 'ab' ),
			'top-right-logged'  => __( 'Top Right (logged in)', 'ab' ),
			'top-right-non-logged'  => __( 'Top Right (non logged in)', 'ab' ),
		) );

		// Update old key new AnsPress license interface.
		$old_key = get_option( 'askbug_license_key' );
		if ( !empty( $old_key ) ) {
			$old_status = get_option( 'askbug_license_key_status' );

			$licenses = get_option( 'anspress_license', array() );
			$licenses['askbug'] = array( 'key' => $old_key, 'status' => $old_status );
			update_option( 'anspress_license', $licenses );
			delete_option( 'askbug_license_key' );
			delete_option( 'askbug_license_key_status' );
		}

	}
endif; // ab_setup
add_action( 'after_setup_theme', 'ab_setup' );

/**
 * Register theme auto updater.
 *
 * @param  array $prod AnsPress products.
 * @return array
 */
function ab_theme_updater( $prod ) {
	$theme = wp_get_theme();
	$prod['askbug'] = array(
		'name'      => 'AskBug – Question & Answer Theme',
		'version'   => ASKBUG_VERSION,
		'author'    => 'Rahul Aryan',
		'file'      => __FILE__,
		'is_plugin' => false,
	);
	return $prod;
}
add_filter( 'anspress_license_fields', 'ab_theme_updater' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function ab_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'ab' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="widget-inner">',
	) );

	register_sidebar( array(
		'name'          => __( 'Stats', 'ab' ),
		'id'            => 'stats',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="widget-inner">',
	));

	register_sidebar( array(
		'name'          => __( 'Home users', 'ab' ),
		'id'            => 'home-users',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="widget-inner">',
	));

	register_sidebar( array(
		'name'          => __( 'Home sidebar', 'ab' ),
		'id'            => 'home-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="widget-inner">',
	));

	register_sidebar( array(
		'name'          => __( 'Ask page', 'ab' ),
		'id'            => 'ask-page',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="widget-inner">',
	));

	register_sidebar( array(
		'name'          => __( 'Footer left', 'ab' ),
		'id'            => 'footer-left',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="widget-inner">',
	));

	register_sidebar( array(
		'name'          => __( 'Footer middile left', 'ab' ),
		'id'            => 'footer-ml',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="widget-inner">',
	));

	register_sidebar( array(
		'name'          => __( 'Footer middile right', 'ab' ),
		'id'            => 'footer-mr',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="widget-inner">',
	));

	register_sidebar( array(
		'name'          => __( 'Footer right', 'ab' ),
		'id'            => 'footer-right',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="widget-inner">',
	));

	register_sidebar( array(
		'name'          => __( 'AnsPress Top', 'ab' ),
		'id'            => 'anspress-top',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="widget-inner">',
	));

	register_sidebar( array(
		'name'          => __( 'AnsPress Activities', 'ab' ),
		'id'            => 'activities',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="widget-inner">',
	));
}
add_action( 'widgets_init', 'ab_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function ab_scripts() {
	$css_rev = get_option( 'askbug_color_rev', ASKBUG_VERSION );

	// Load bootstrap css.
	wp_enqueue_style( 'ab-bootstrap', get_template_directory_uri() . '/includes/resources/bootstrap/css/bootstrap.min.css' );

	wp_enqueue_style( 'ab-css', get_template_directory_uri() . '/includes/css/askbug.css', false, $css_rev );

	if ( is_rtl() ) {
		wp_enqueue_style( 'ab-rtl', get_template_directory_uri() . '/includes/css/rtl.css', false, ASKBUG_VERSION );
	}

	// Load ab styles.
	wp_enqueue_style( 'ab-style', get_stylesheet_uri() );
	wp_enqueue_style( 'WorkSans', '//fonts.googleapis.com/css?family=Work+Sans:400,300,600,700' );

	wp_enqueue_style( 'ab-color', get_template_directory_uri() . '/includes/css/color.css', false, $css_rev );

	// Load bootstrap js.
	wp_enqueue_script( 'ab-bootstrapjs', get_template_directory_uri() . '/includes/resources/bootstrap/js/bootstrap.min.js', array( 'jquery' ), ASKBUG_VERSION );

	wp_enqueue_script( 'ab-chart.js', get_template_directory_uri() . '/includes/js/Chart.min.js', array( 'jquery' ), ASKBUG_VERSION, true );

	if ( 'user' === ap_current_page() && 'about' === get_query_var( 'user_page' ) ) {
		wp_enqueue_script( 'ab-user-js', get_template_directory_uri() . '/includes/js/user.js', array( 'backbone', 'masonry', 'anspress-main' ), ASKBUG_VERSION, true );
	}

	// Load bootstrap wp js.
	wp_enqueue_script( 'ab-js', get_template_directory_uri() . '/includes/js/askbug.js', array( 'jquery' ), ASKBUG_VERSION, true );

	wp_enqueue_script( 'ab-skip-link-focus-fix', get_template_directory_uri() . '/includes/js/skip-link-focus-fix.js', array(), ASKBUG_VERSION, true );

	$main_color = get_theme_mod( 'main_color', '#FCFCFC' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'ab-keyboard-image-navigation', get_template_directory_uri() . '/includes/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

}
add_action( 'wp_enqueue_scripts', 'ab_scripts' );

/**
 * Include auto installer.
 */
require get_template_directory() . '/includes/admin/auto-installer.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/includes/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/includes/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
require get_template_directory() . '/includes/bootstrap-wp-navwalker.php';

require get_template_directory() . '/includes/hooks.php';

/**
 * Include widgets
 */
require get_template_directory() . '/includes/widgets/site_stats.php';
require get_template_directory() . '/includes/widgets/top_users.php';
require get_template_directory() . '/includes/simple-color-adjuster.php';
require get_template_directory() . '/includes/user-metabox.php';
