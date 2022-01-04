<?php
/**
 * Template Name: Page Contact
 */

$context = Timber::context();
$timber_post = new Timber\Post();
$context['post'] = $timber_post;


Timber::render( 'page-contact.twig' , $context );
