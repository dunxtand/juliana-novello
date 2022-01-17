<?php

include_once get_theme_file_path( '/functions/get_timber_post.php' );


function format_video_project ( $video ) {
    $timber_post = get_timber_post( $video );

    $videos = array_map(
        function ( $media_item ) {
            $file = $media_item['file'];

            return [
                'src' => $file['url'],
                'type' => $file['mime_type']
            ];
        },
        $timber_post->meta( 'videos' ) ?: array()
    );

    return [
        'id' => $timber_post->ID,
        'title' => $timber_post->post_title,
        'link' => get_permalink( $timber_post->ID ),
        'content' => $timber_post->post_content,
        'videos' => $videos
    ];
}
