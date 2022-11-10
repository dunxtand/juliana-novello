<?php

include_once get_theme_file_path( '/functions/projects.php' );

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

$context['project_gallery'] = array_map(
    function ( $image ) {
        return $image['sizes']['1536x1536'] ?: $image['url'];
    },
    $post->meta('gallery') ?: array()
);

Timber::render( 'single-project.twig' , $context );
