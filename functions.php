<?php
/**
 * TA2017 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package TA2017
 */

define( 'THEME_DIR', get_template_directory() );
define( 'THEME_URI', get_template_directory_uri() );

define( 'ADMIN_DIR', THEME_DIR. '/framework/admin' );


require_once ADMIN_DIR .'/cs-framework.php';

if ( ! function_exists( 'ta2017_setup' ) ) :

function ta2017_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on TA2017, use a find and replace
	 * to change 'ta2017' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'ta2017', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/* Sets the path to the parent theme directory. */
	define( 'THEME_DIR', get_template_directory() );

	/* Sets the path to the parent theme directory URI. */
	define( 'THEME_URI', get_template_directory_uri() );

	define( 'UIKIT_DIR', get_template_directory() . '/uikit');
	define( 'UIKIT_URI', get_template_directory_uri() . '/uikit');
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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'ta2017' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'ta2017_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'ta2017_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ta2017_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ta2017_content_width', 640 );
}
add_action( 'after_setup_theme', 'ta2017_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ta2017_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ta2017' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ta2017' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ta2017_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ta2017_scripts() {
	

	


	if (!is_admin()) {
		wp_register_script( 'baidu', 'http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js',false, '', true ); 
		wp_register_script( 'uikit', UIKIT_URI . '/js/uikit.min.js',array('baidu'), '', true ); 

		wp_register_style( 'uikit', UIKIT_URI . '/css/uikit.min.css' );  
		//wp_enqueue_script( 'ta2017-navigation', THEME_URI . '/js/navigation.js', array(), '20151215', true );
		//
		wp_deregister_script( 'jquery' );
		wp_enqueue_script( 'baidu' ); 
		wp_enqueue_script( 'uikit' );  

		wp_enqueue_style( 'uikit' );
		wp_enqueue_style( 'ta2017-style', get_stylesheet_uri() );
	}



	

	//wp_enqueue_script( 'ta2017-skip-link-focus-fix', THEME_URI . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'init', 'ta2017_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
