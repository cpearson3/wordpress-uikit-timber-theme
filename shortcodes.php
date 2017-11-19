<?php
// Display Blog Posts Shortcode Example
add_shortcode( 'blogs', 'blogs_shortcode' );
function blogs_shortcode( $atts ) {
	
	$date = date('Ymd');

	// Original Attributes, for filters
	$original_atts = $atts;

	// Pull in shortcode attributes and set defaults
	$atts = shortcode_atts( array(
		'category'             => '',
		'posts_per_page'	   => '3',
		'order'                => 'DESC',
		'orderby'              => 'date'
	), $atts, 'blogs' );
	
	$posts_per_page = sanitize_text_field( $atts['posts_per_page'] );
	
	// Set up initial query for post
	// args
	$args = array(
		'posts_per_page' => $posts_per_page,
		'order' => 'DESC',
		'orderby' => 'date',
	);
	
	$context = Timber::get_context();
	$context['blogs'] = Timber::get_posts($args);
	return Timber::compile( 'shortcode-blogs.twig', $context );
}

// Hello world! Shortcode
add_shortcode( 'hello_world', 'hello_word_shortcode' );
function hello_word_shortcode() {
    return 'Hello world.';
}