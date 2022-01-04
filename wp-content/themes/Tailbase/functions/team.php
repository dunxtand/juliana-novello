<?php

include_once get_theme_file_path( '/functions/get_timber_post.php' );


function format_team ( $team_member ) {
    $timber_post = get_timber_post( $team_member );

    $bio = strlen( $timber_post->team_bio ) > 0
        ? $timber_post->team_bio
        : false;

    $departments = $timber_post->meta( 'departments' )
        ? array_map( function ($d) { return $d['name']; }, $timber_post->meta( 'departments' ) )
        : array();

    $helper = new Timber\ImageHelper;
    $image_url = get_the_post_thumbnail_url( $timber_post->ID );
    $resized_image = $helper::resize( $image_url, 500, 500, 'center' );

    return [
        'id' => $timber_post->ID,
        'name' => $timber_post->post_title,
        'position' => $timber_post->team_title_position,
        'bio' => $bio,
        'image' => $resized_image,
        'departments' => $departments
    ];
}
