<?php
/**
 * Template Name: About Page
 */

$context = Timber::context();
$timber_post = new Timber\Post();
$context['post'] = $timber_post;


Timber::render( 'page-about.twig' , $context );
