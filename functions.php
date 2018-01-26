<?php

// Check for Timber
if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php') ) . '</a></p></div>';
	});
	
	add_filter('template_include', function($template) {
		return get_stylesheet_directory() . '/static/no-timber.html';
	});
	
	return;
}

// Define paths to Twig templates

Timber::$dirname = array(
	'views',
	'templates'
);

// Define TimeberSite Child Class
class BootsmoothSite extends TimberSite {

	function __construct() {

		// Enable theme support for core WP functionality
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		
		parent::__construct();
	}

	function register_post_types() {
		//this is where you can register custom post types
	}

	function register_taxonomies() {
		//this is where you can register custom taxonomies
	}

	// register custom context variables
	function add_to_context( $context ) {
		$context['menu'] = new TimberMenu();
		$context['site'] = $this;
		$context['sidebar_widgets'] = Timber::get_widgets( 'Single Post Sidebar' );
		$context['banner_widgets'] = Timber::get_widgets( 'Archive Banner' );
		return $context;
	}

	function add_to_twig( $twig ) {
		/* this is where you can add your own functions to twig */
		$twig->addExtension( new Twig_Extension_StringLoader() );
		return $twig;
	}
}

new BootsmoothSite();

// include shortcodes
include 'shortcodes.php';

function register_theme_features() {
	// Register widget areas
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name' => 'Single Post Sidebar',
			'before_widget' => '<div class="sidebar-widget">',
			'after_widget' => '</div>',
			'before_title' => '<h5 class="usa-heading-alt">',
			'after_title' => '</h5>',
			)
		);

		register_sidebar(array(
			'name' => 'Archive Banner',
			'before_widget' => '<div class="banner-widget">',
			'after_widget' => '</div>',
			'before_title' => '<div>',
			'after_title' => '</div>',
			)
		);
	}

	// Register navigation menus
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu' ),
			'secondary' => __( 'Secondary Menu' )
		)
	);
}
add_action( 'init', 'register_theme_features' );