<?php

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

$context['project_gallery'] = array_map(
    function ( $image ) {
        return $image['url'];
    },
    $post->meta('gallery') ?: array()
);

Timber::render( 'single-project.twig' , $context );
