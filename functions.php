<?php
/**
 * Theme functions and definitions
 *
 * @package HelloPlus
 * @since 1.0.0
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Define theme constants
 */
define( 'HELLO_PLUS_VERSION', wp_get_theme()->get( 'Version' ) );
define( 'HELLO_PLUS_PATH', get_template_directory() );
define( 'HELLO_PLUS_URL', get_template_directory_uri() );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since 1.0.0
 *
 * @return void
 */
function hello_plus_setup() {
	// Make theme available for translation.
	load_theme_textdomain( 'hello-plus', HELLO_PLUS_PATH . '/languages' );
	add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'primary'   => esc_html__( 'Primary Navigation', 'hello-plus' ),
			'footer'    => esc_html__( 'Footer Navigation', 'hello-plus' ),
			'social'    => esc_html__( 'Social Links', 'hello-plus' ),
		)
	);
}
add_action( 'after_setup_theme', 'hello_plus_setup' );

/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 *
 * @return void
 */
function hello_plus_scripts() {
	// Enqueue theme stylesheet.
	wp_enqueue_style(
		'hello-plus-style',
		get_stylesheet_uri(),
		array(),
		HELLO_PLUS_VERSION
	);

	// Enqueue theme script with Interactivity API support.
	$script_asset_path = HELLO_PLUS_PATH . '/build/theme/theme.asset.php';
	$script_asset      = file_exists( $script_asset_path )
		? require $script_asset_path
		: array(
			'dependencies' => array(),
			'version'      => HELLO_PLUS_VERSION,
		);

	wp_enqueue_script(
		'hello-plus-script',
		HELLO_PLUS_URL . '/build/theme/theme.js',
		$script_asset['dependencies'],
		$script_asset['version'],
		true
	);

	// Localize script for AJAX and other dynamic data.
	wp_localize_script(
		'hello-plus-script',
		'helloPlusData',
		array(
			'ajaxUrl'          => admin_url( 'admin-ajax.php' ),
			'nonce'            => wp_create_nonce( 'hello_plus_nonce' ),
			'themeUrl'         => HELLO_PLUS_URL,
			'isUserLoggedIn'   => is_user_logged_in(),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'hello_plus_scripts' );
