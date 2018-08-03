<?php
/**
 * ab Theme Customizer
 *
 * @package ab
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ab_customize_register( $wp_customize ) {
	$wp_customize->add_section('ab_theme', array(
	    'title'      => __('AskBug Options','ab'),
	    'priority'   => 1,
	));

	$wp_customize->add_setting( 'ab_logo' );
	$wp_customize->add_setting( 'hide_copyright' );
	$wp_customize->add_setting( 'main_color' );
	$wp_customize->add_setting( 'hide_home_background' );
	$wp_customize->add_setting( 'hide_welcome_loggedin' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ab_logo', array(
	    'label'    => __( 'Logo', 'ab' ),
	    'section'  => 'ab_theme',
	    'settings' => 'ab_logo',
	) ) );

	$wp_customize->add_control(
	    'hide_copyright',
	    array(
	        'type' => 'checkbox',
	        'label' => __('Hide copyright in footer', 'ab'),
	        'section' => 'ab_theme',
	    )
	);

	$wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'main_color',
	        array(
	            'label' => __( 'Main color', 'ab' ),
	            'section' => 'ab_theme',
	            'settings' => 'main_color',
	            'default' => '#FF7545',
	        	'sanitize_callback' => 'sanitize_hex_color',
	        )
	    )
	);

	$wp_customize->add_control(
	    'hide_home_background',
	    array(
	        'type' => 'checkbox',
	        'label' => __( 'Hide background color on home', 'ab' ),
	        'section' => 'ab_theme',
	    )
	);

	$wp_customize->add_control(
	    'hide_welcome_loggedin',
	    array(
	        'type' => 'checkbox',
	        'label' => __('Hide home welcome for logged in users', 'ab'),
	        'section' => 'ab_theme',
	    )
	);

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'main_color' )->transport = 'postMessage';
}
add_action( 'customize_register', 'ab_customize_register' );

/**
 * Add intro block fields.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ab_customize_introblock_register( $wp_customize ) {
	$wp_customize->add_section('ab_intro', array(
	    'title'      => __( 'AskBug Intro','ab' ),
	    'priority'   => 2,
	));

	$wp_customize->add_setting( 'ab_intro_qhead' );
	$wp_customize->add_setting( 'ab_intro_qdesc' );
	$wp_customize->add_setting( 'ab_intro_qbuttontext' );
	$wp_customize->add_setting( 'ab_intro_qshowbutton' );

	$wp_customize->add_setting( 'ab_intro_ahead' );
	$wp_customize->add_setting( 'ab_intro_adesc' );
	$wp_customize->add_setting( 'ab_intro_abuttontext' );
	$wp_customize->add_setting( 'ab_intro_ashowbutton' );

	$wp_customize->add_control(
	    'ab_intro_qhead',
	    array(
	        'type' => 'text',
	        'label' => __( 'Question block title', 'ab' ),
	        'section' => 'ab_intro',
	    )
	);

	$wp_customize->add_control(
	    'ab_intro_qdesc',
	    array(
	        'type' => 'text',
	        'label' => __( 'Question block subheading', 'ab' ),
	        'section' => 'ab_intro',
	    )
	);

	$wp_customize->add_control(
	    'ab_intro_qbuttontext',
	    array(
	        'type' => 'text',
	        'label' => __( 'Question block button text', 'ab' ),
	        'section' => 'ab_intro',
	    )
	);

	$wp_customize->add_control(
	    'ab_intro_qshowbutton',
	    array(
	        'type'    => 'checkbox',
	        'label'   => __( 'Question block show button', 'ab' ),
	        'section' => 'ab_intro',
	    )
	);

	$wp_customize->add_control(
	    'ab_intro_ahead',
	    array(
	        'type' => 'text',
	        'label' => __( 'Answer block title', 'ab' ),
	        'section' => 'ab_intro',
	    )
	);

	$wp_customize->add_control(
	    'ab_intro_adesc',
	    array(
	        'type' => 'text',
	        'label' => __( 'Answer block subheading', 'ab' ),
	        'section' => 'ab_intro',
	    )
	);

	$wp_customize->add_control(
	    'ab_intro_abuttontext',
	    array(
	        'type' => 'text',
	        'label' => __( 'Answer block button text', 'ab' ),
	        'section' => 'ab_intro',
	    )
	);

	$wp_customize->add_control(
	    'ab_intro_ashowbutton',
	    array(
	        'type' => 'checkbox',
	        'label' => __('Answer block Show button', 'ab'),
	        'section' => 'ab_intro',
	    )
	);
}
add_action( 'customize_register', 'ab_customize_introblock_register' );

function ab_customize_footerblock_register( $wp_customize ) {
	$wp_customize->add_section('ab_footer_left', array(
	    'title'      => __( 'AskBug Footer Left','ab' ),
	    'priority'   => 2,
	));

	$wp_customize->add_setting( 'ab_fl_title' );
	$wp_customize->add_setting( 'ab_fl_desc' );

	$wp_customize->add_setting( 'ab_social_github' );
	$wp_customize->add_setting( 'ab_social_fb' );
	$wp_customize->add_setting( 'ab_social_twitter' );
	$wp_customize->add_setting( 'ab_social_google' );

	$wp_customize->add_control(
	    'ab_fl_title',
	    array(
	        'type'    => 'text',
	        'label'   => __( 'Footer Left title', 'ab' ),
	        'section' => 'ab_footer_left',
	    )
	);

	$wp_customize->add_control(
	    'ab_fl_desc',
	    array(
	        'type'    => 'textarea',
	        'label'   => __( 'Footer Left description', 'ab' ),
	        'section' => 'ab_footer_left',
	    )
	);

	$wp_customize->add_control(
	    'ab_social_fb',
	    array(
	        'type'    => 'url',
	        'label'   => __( 'FaceBook Link', 'ab' ),
	        'section' => 'ab_footer_left',
	    )
	);

	$wp_customize->add_control(
	    'ab_social_google',
	    array(
	        'type'    => 'url',
	        'label'   => __( 'Google+ Link', 'ab' ),
	        'section' => 'ab_footer_left',
	    )
	);

	$wp_customize->add_control(
	    'ab_social_twitter',
	    array(
	        'type'    => 'url',
	        'label'   => __( 'Twitter Link', 'ab' ),
	        'section' => 'ab_footer_left',
	    )
	);

	$wp_customize->add_control(
	    'ab_social_github',
	    array(
	        'type'    => 'url',
	        'label'   => __( 'GitHub Link', 'ab' ),
	        'section' => 'ab_footer_left',
	    )
	);
}
add_action( 'customize_register', 'ab_customize_footerblock_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ab_customize_preview_js() {
	wp_enqueue_script( 'ab_customizer', get_template_directory_uri() . '/includes/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'ab_customize_preview_js' );

/**
 * Rebuild CSS if main color changes.
 *
 * @param mixed $value Current field value.
 * @return void
 */
function ab_on_mod_main_color_change( $value ) {
	require_once get_template_directory() . '/includes/resources/less/lessc.inc.php';
	$less_dir = get_template_directory() . '/includes/less/';
	$ouput_dir = get_template_directory() . '/includes/css/';

	$parser = new Less_Parser();
	$parser->parseFile( $less_dir . 'color.less' );

	$parser->ModifyVars( array(
		'color1' => $value,
	) );

	file_put_contents( $ouput_dir . 'color.css', $parser->getCss() );
	unset( $parser );

	update_option( 'askbug_color_rev', time() );

	return $value;
}
add_filter( 'pre_set_theme_mod_main_color', 'ab_on_mod_main_color_change' );
