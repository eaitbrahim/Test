<?php
require get_template_directory() . '/DotEnv.php';
use BwWpBp\DotEnv;
(new DotEnv(get_template_directory() . '/.env'))->load();

/**
 * bw_wp_boilerplate functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package bw_wp_boilerplate
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'bw_wp_boilerplate_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bw_wp_boilerplate_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on bw_wp_boilerplate, use a find and replace
		 * to change 'bw_wp_boilerplate' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'bw_wp_boilerplate', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'bw_wp_boilerplate-full-bleed', 2000, 1200, true );


		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Header', 'bw_wp_boilerplate' ),
				'social' => esc_html__( 'Social Media Menu', 'bw_wp_boilerplate' ),
				'footer' => esc_html__( 'Footer Menu', 'bw_wp_boilerplate' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'bw_wp_boilerplate_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 90,
				'width'       => 90,
				'flex-width'  => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'bw_wp_boilerplate_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bw_wp_boilerplate_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bw_wp_boilerplate_content_width', 640 );
}
add_action( 'after_setup_theme', 'bw_wp_boilerplate_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bw_wp_boilerplate_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Address', 'bw_wp_boilerplate' ),
			'id'            => 'address',
			'description'   => esc_html__( 'Add address here.', 'bw_wp_boilerplate' ),
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'bw_wp_boilerplate' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'bw_wp_boilerplate' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widgets', 'bw_wp_boilerplate' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add footer widgets here.', 'bw_wp_boilerplate' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'bw_wp_boilerplate_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bw_wp_boilerplate_scripts() {
	// Enqueue Google Fonts: Source Sans pro and PT Serif
	wp_enqueue_style( 'bw_wp_boilerplate-fonts', bw_wp_boilerplate_fonts_url() );
	wp_enqueue_style( 'bw_wp_boilerplate-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'bw_wp_boilerplate-style', 'rtl', 'replace' );
	$googleapis = '//maps.googleapis.com/maps/api/js?key='. getenv('GOOGLE_API_KEY');
	wp_enqueue_script('googleMap', $googleapis, NULL, '1.0', true);
	
	wp_enqueue_script( 'bw_wp_boilerplate-functions', get_template_directory_uri() . '/js/functions.js', array('jquery'), '20161201', true );

	wp_enqueue_script( 'bw_wp_boilerplate-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script('bw_wp_boilerplate-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
	
	wp_enqueue_script( 'bw_wp_boilerplate-functions', get_template_directory_uri() . '/js/functions.js', array('jquery'), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_localize_script('bw_wp_boilerplate-js', 'bwwpbpData', array(
    'root_url' => get_site_url(),
		'rest_url' 		=> esc_url_raw( rest_url() ),
    'nonce' => wp_create_nonce('wp_rest')
  ));
}
add_action( 'wp_enqueue_scripts', 'bw_wp_boilerplate_scripts' );

function bw_wp_boilerplate_fonts_url(){
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Lato, Source Sans Pro and PT Serif, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$on = 'on';
	$off = 'off';

	 $defaultFont = _x( $on, 'Lato: on or off', 'bw_wp_boilerplate' );
	$replacementFont = _x( $on, 'Source Sans Pro font: on or off', 'bw_wp_boilerplate' );
	$pt_serif = _x( $on, 'PT Serif font: on or off', 'bw_wp_boilerplate' );
	
	$font_families = array();
	
	if ( $off !== $defaultFont ) {
		$font_families[] = 'Lato:400,400i,700,900';
	}

	if ( $off !== $replacementFont ) {
		$font_families[] = 'Source Sans Pro:400,400i,700,900';
	}
	
	if ( $off !== $pt_serif ) {
		$font_families[] = 'PT Serif:400,400i,700,700i';
	}
	
	
	if ( in_array( $on, array($replacementFont, $pt_serif, $defaultFont) ) ) {

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function bw_wp_boilerplate_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'bw_wp_boilerplate-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'bw_wp_boilerplate_resource_hints', 10, 2 );

function bw_wp_boilerplate_MapKey($api) {
  $api['key'] = getenv('GOOGLE_API_KEY');
  return $api;
}

add_filter('acf/fields/google_map/api', 'bw_wp_boilerplate_MapKey');

require_once get_template_directory() .'/inc/bw-wp-bp-rest-controller.php';
require get_template_directory() .  '/inc/subscription-route.php';
require get_template_directory() .  '/inc/message-route.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

require get_template_directory() . '/inc/mailchimp-route.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load SVG icon functions.
 */
require get_template_directory() . '/inc/icon-functions.php';


