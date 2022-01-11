<?php
/**
 * Template Name: Vidoes Page
 */

$context = Timber::context();
$timber_post = new Timber\Post();
$context['post'] = $timber_post;

Timber::render( 'page-videos.twig' , $context );
