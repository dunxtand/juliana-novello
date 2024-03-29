<?php
/**
 * Template Name: Book Page
 */

$context = Timber::context();
$timber_post = new Timber\Post();
$context['post'] = $timber_post;

$context['images'] = array_map(
    function ( $image ) {
        return $image['sizes']['1536x1536'] ?: $image['url'];
    },
    $timber_post->meta( 'slideshow' ) ?: array()
);


Timber::render( 'page-book.twig' , $context );
