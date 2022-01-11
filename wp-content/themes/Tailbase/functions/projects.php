<?php

include_once get_theme_file_path( '/functions/get_timber_post.php' );


function format_project ( $project ) {
    $timber_post = get_timber_post( $project );

    $gallery = array_map(
        function ( $image ) {
            return $image['url'];
        },
        $timber_post->meta( 'gallery' ) ?: array()
    );

    return [
        'id' => $timber_post->ID,
        'title' => $timber_post->post_title,
        'link' => get_permalink( $timber_post->ID ),
        'content' => $timber_post->post_content,
        'gallery' => $gallery
    ];
}
