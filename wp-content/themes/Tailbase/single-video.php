<?php

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

$context['videos'] = array_map(
    function ( $media_item ) {
        $file = $media_item['file'];

        return [
            'src' => $file['url'],
            'type' => $file['mime_type']
        ];
    },
    $post->meta( 'videos' ) ?: array()
);

Timber::render( 'single-video.twig' , $context );
