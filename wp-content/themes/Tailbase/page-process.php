<?php
/**
 * Template Name: Page Process
 */

include_once get_theme_file_path( '/functions/feedback.php' );


$context = Timber::context();
$timber_post = new Timber\Post();
$featured_feedback_post = new Timber\Post( $timber_post->featured_feedback );


$context['post'] = $timber_post;
$context['featured_feedback'] = format_feedback( $featured_feedback_post );


Timber::render( 'page-process.twig' , $context );
