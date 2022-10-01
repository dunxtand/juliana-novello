<?php

include_once get_theme_file_path( '/functions/get_timber_post.php' );


function format_project ( $project ) {
    $timber_post = get_timber_post( $project );

    $gallery = array();
    $featured = array();

    foreach (($timber_post->meta( 'gallery' ) ?: array()) as $image) {
        $image_url = $image['sizes']['1536x1536'] ?: $image['url'];
        $gallery[] = $image_url;

        if ( boolval( (new TimberImage( $image ))->featured ) ) {
            $featured[] = $image_url;
        }
    }

    return [
        'id' => $timber_post->ID,
        'title' => $timber_post->post_title,
        'link' => get_permalink( $timber_post->ID ),
        'content' => $timber_post->post_content,
        'gallery' => $gallery,
        'featured' => $featured
    ];
}
