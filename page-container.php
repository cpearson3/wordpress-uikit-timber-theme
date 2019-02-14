<?php
/* Template Name: Container Template */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
Timber::render(  'page-container.twig' , $context );