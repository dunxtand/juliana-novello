<?php
/**
 * Template Name: Page Home
 */

$context = Timber::context();
$timber_post = new Timber\Post();

$context['post'] = $timber_post;
$context['services'] = get_field('services', 'option');


Timber::render( 'page-home.twig' , $context );
