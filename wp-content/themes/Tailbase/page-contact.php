<?php
/**
 * Template Name: Contact Page
 */

$context = Timber::context();
$timber_post = new Timber\Post();
$context['post'] = $timber_post;


Timber::render( 'page-contact.twig' , $context );
