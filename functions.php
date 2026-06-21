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
	add_theme_support(
		'post-formats',
		array(
			'audio',
			'gallery',
			'image',
			'link',
			'quote',
			'status',
			'video',
		)
	);
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Navigation', 'hello-plus' ),
			'footer'  => esc_html__( 'Footer Navigation', 'hello-plus' ),
			'social'  => esc_html__( 'Social Links', 'hello-plus' ),
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
			'ajaxUrl'        => admin_url( 'admin-ajax.php' ),
			'nonce'          => wp_create_nonce( 'hello_plus_nonce' ),
			'themeUrl'       => HELLO_PLUS_URL,
			'isUserLoggedIn' => is_user_logged_in(),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'hello_plus_scripts' );

/**
 * Output JSON-LD structured data (schema.org) in <head>.
 *
 * Outputs:
 *  - WebSite schema on every page (enables Google Sitelinks Searchbox).
 *  - Article / BlogPosting schema on single posts.
 *  - BreadcrumbList schema on singular pages and posts.
 *
 * @since 1.4.0
 *
 * @return void
 */
function hello_plus_schema_markup() {
	$schemas = array();

	//  WebSite
	$schemas[] = array(
		'@context' => 'https://schema.org',
		'@type'    => 'WebSite',
		'name'     => get_bloginfo( 'name' ),
		'url'      => home_url( '/' ),
		'potentialAction' => array(
			'@type'       => 'SearchAction',
			'target'      => array(
				'@type'       => 'EntryPoint',
				'urlTemplate' => home_url( '/?s={search_term_string}' ),
			),
			'query-input' => 'required name=search_term_string',
		),
	);

	// Article / BlogPosting (single posts only) 
	if ( is_singular( 'post' ) ) {
		$post        = get_queried_object();
		$author_id   = $post->post_author;
		$thumbnail   = get_the_post_thumbnail_url( $post->ID, 'full' );
		$description = has_excerpt( $post->ID )
			? wp_strip_all_tags( get_the_excerpt( $post->ID ) )
			: wp_trim_words( wp_strip_all_tags( $post->post_content ), 30, '…' );

		$article = array(
			'@context'         => 'https://schema.org',
			'@type'            => 'BlogPosting',
			'headline'         => get_the_title( $post->ID ),
			'description'      => $description,
			'datePublished'    => get_the_date( 'c', $post->ID ),
			'dateModified'     => get_the_modified_date( 'c', $post->ID ),
			'url'              => get_permalink( $post->ID ),
			'author'           => array(
				'@type' => 'Person',
				'name'  => get_the_author_meta( 'display_name', $author_id ),
				'url'   => get_author_posts_url( $author_id ),
			),
			'publisher'        => array(
				'@type' => 'Organization',
				'name'  => get_bloginfo( 'name' ),
				'url'   => home_url( '/' ),
			),
			'mainEntityOfPage' => array(
				'@type' => 'WebPage',
				'@id'   => get_permalink( $post->ID ),
			),
		);

		if ( $thumbnail ) {
			$article['image'] = $thumbnail;
		}

		$schemas[] = $article;
	}

	// BreadcrumbList (all singular content except front page)
	if ( is_singular() && ! is_front_page() ) {
		$breadcrumbs   = array();
		$breadcrumbs[] = array(
			'@type'    => 'ListItem',
			'position' => 1,
			'name'     => get_bloginfo( 'name' ),
			'item'     => home_url( '/' ),
		);

		if ( is_singular( 'post' ) ) {
			$categories = get_the_category();
			if ( ! empty( $categories ) ) {
				$breadcrumbs[] = array(
					'@type'    => 'ListItem',
					'position' => 2,
					'name'     => esc_html( $categories[0]->name ),
					'item'     => esc_url( get_category_link( $categories[0]->term_id ) ),
				);
				$breadcrumbs[] = array(
					'@type'    => 'ListItem',
					'position' => 3,
					'name'     => esc_html( get_the_title() ),
					'item'     => esc_url( get_permalink() ),
				);
			} else {
				$breadcrumbs[] = array(
					'@type'    => 'ListItem',
					'position' => 2,
					'name'     => esc_html( get_the_title() ),
					'item'     => esc_url( get_permalink() ),
				);
			}
		} else {
			$breadcrumbs[] = array(
				'@type'    => 'ListItem',
				'position' => 2,
				'name'     => esc_html( get_the_title() ),
				'item'     => esc_url( get_permalink() ),
			);
		}

		$schemas[] = array(
			'@context'        => 'https://schema.org',
			'@type'           => 'BreadcrumbList',
			'itemListElement' => $breadcrumbs,
		);
	}

	foreach ( $schemas as $schema ) {
		echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
add_action( 'wp_head', 'hello_plus_schema_markup' );
