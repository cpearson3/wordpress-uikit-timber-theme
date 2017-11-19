<?php
// Display Blog Posts Shortcode Example
add_shortcode( 'posts', 'posts_shortcode' );
function posts_shortcode( $atts ) {
	
	$date = date('Ymd');

	// Original Attributes, for filters
	$original_atts = $atts;

	// Pull in shortcode attributes and set defaults
	$atts = shortcode_atts( array(
		'category'             => '',
		'post_type'			   => 'post',
		'posts_per_page'	   => '3',
		'order'                => 'DESC',
		'orderby'              => 'date',
		'grid'				   => 0
	), $atts, 'blogs' );
	
	$posts_per_page = sanitize_text_field( $atts['posts_per_page'] );
	$post_type = sanitize_text_field($atts['post_type']);
	$grid = sanitize_text_field($atts['grid']);
	
	// Set up initial query for post
	// args
	$args = array(
		'post_type'	=>	$post_type,
		'posts_per_page' => $posts_per_page,
		'order' => 'DESC',
		'orderby' => 'date',
	);
	
	$context = Timber::get_context();
	$context['blogs'] = Timber::get_posts($args);
	
	if ($grid) {
		return Timber::compile( 'shortcode-posts-grid.twig', $context );
	} else {
		return Timber::compile( 'shortcode-posts-list.twig', $context );
	}
}

// Parent Pages
// Create the shortcode
add_shortcode( 'parent-pages', 'parent_pages_shortcode' );
function parent_pages_shortcode( $atts ) {
	
	$date = date('Ymd');
	$post_parent = get_the_ID();
	
	// Original Attributes, for filters
	$original_atts = $atts;

	// Pull in shortcode attributes and set defaults
	$atts = shortcode_atts( array(
		'category'             => '',
		'posts_per_page'	   => '-1',
		'post_parent'		   => $post_parent,
		'order'                => 'DESC',
		'orderby'              => 'date',
		'grid'				   => 0
	), $atts, 'child-pages' );
	
	$posts_per_page = sanitize_text_field( $atts['posts_per_page'] );

	// Set up initial query for post
	// args
	$args = array(
		'post_type'      => 'page',
		'posts_per_page' => $posts_per_page,
		'post_parent'    => $post_parent,
		'order'          => 'ASC',
		'orderby'        => 'menu_order'
	);
	
	$context = Timber::get_context();
	$context['posts'] = Timber::get_posts($args);
	return Timber::compile( 'shortcode-posts-list.twig', $context );

}


// Child Pages
add_shortcode( 'child-pages', 'child_pages_shortcode' );
function child_pages_shortcode( $atts ) {
	
	$date = date('Ymd');

	// Original Attributes, for filters
	$original_atts = $atts;

	// Pull in shortcode attributes and set defaults
	$atts = shortcode_atts( array(
		'category'             => '',
		'posts_per_page'	   => '-1',
		'post_parent'		   => '',
		'order'                => 'DESC',
		'orderby'              => 'date',
		'grid'				   => 0,
		'select'			   => 0
	), $atts, 'child-pages' );
	
	$posts_per_page = sanitize_text_field( $atts['posts_per_page'] );
	$post_id = sanitize_text_field($atts['post_parent']);
	$select = sanitize_text_field($atts['select']);
	$grid = sanitize_text_field($atts['grid']);
	
	// Set up initial query for post
	// args
	$args = array(
		'post_type'      => 'page',
		'posts_per_page' => $posts_per_page,
		'post_parent'    => $post_id,
		'order'          => 'ASC',
		'orderby'        => 'menu_order'
	);
	
	$context = Timber::get_context();
	$context['posts'] = Timber::get_posts($args);
	
	if ($select) {
		return Timber::compile('shortcode-posts-select.twig', $context);
	}
	
	if ($grid) {
		return Timber::compile('shortcode-posts-grid.twig', $context);
	} else {
		return Timber::compile( 'shortcode-posts-list.twig', $context );	
	}
}

?>