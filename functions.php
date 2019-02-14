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
		add_action( 'init', array( $this, 'register_widget_areas' ) );
		add_action( 'init', array( $this, 'register_navigation_menus') );

		parent::__construct();
	}

	function register_post_types() {
		//this is where you can register custom post types
	}

	function register_taxonomies() {
		//this is where you can register custom taxonomies
	}

	function register_widget_areas() {
		// Register widget areas
		if ( function_exists('register_sidebar') ) {
			register_sidebar(array(
				'name' => 'Left Sidebar',
				'before_widget' => '<div class="sidebar-widget">',
				'after_widget' => '</div>',
				'before_title' => '<div class="uk-text-large">',
				'after_title' => '</div>',
				)
			);
	
			register_sidebar(array(
				'name' => 'Banner',
				'before_widget' => '<div class="banner-widget">',
				'after_widget' => '</div>',
				'before_title' => '<div>',
				'after_title' => '</div>',
				)
			);

			register_sidebar(array(
				'name' => 'Footer Area 1',
				'before_title' => '<div class="uk-text-large">',
				'after_title' => '</div>'
				)
			);
	
			register_sidebar(array(
				'name' => 'Footer Area 2',
				'before_title' => '<div class="uk-text-large">',
				'after_title' => '</div>'
				)
			);

			register_sidebar(array(
				'name' => 'Footer Area 3',
				'before_title' => '<div class="uk-text-large">',
				'after_title' => '</div>'
				)
			);

			register_sidebar(array(
				'name' => 'Footer Area 4',
				'before_title' => '<div class="uk-text-large">',
				'after_title' => '</div>'
				)
			);
		}
	}

	function register_navigation_menus() {
		// Register navigation menus
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu' ),
				'secondary' => __( 'Secondary Menu' )
			)
		);
	}

	// register custom context variables
	function add_to_context( $context ) {
		$context['menu'] = new TimberMenu();
		$context['secondary_menu'] = new TimberMenu('Secondary Menu');
		$context['site'] = $this;
		$context['sidebar_widgets'] = Timber::get_widgets( 'Left Sidebar' );
		$context['banner_widgets'] = Timber::get_widgets( 'Banner' );
		$context['footer_area_1'] = Timber::get_widgets( 'Footer Area 1' );
		$context['footer_area_2'] = Timber::get_widgets( 'Footer Area 2' );
		$context['footer_area_3'] = Timber::get_widgets( 'Footer Area 3' );
		$context['footer_area_4'] = Timber::get_widgets( 'Footer Area 4' );
		return $context;
	}

	function add_to_twig( $twig ) {
		/* this is where you can add your own functions to twig */
		$twig->addExtension( new Twig_Extension_StringLoader() );
		return $twig;
	}
}

new BootsmoothSite();