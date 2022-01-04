<?php

include_once get_theme_file_path( '/functions/get_timber_post.php' );


function format_insight ( $insight, $options = [] ) {
    $timber_post = get_timber_post( $insight );

    $image_url = get_the_post_thumbnail_url( $timber_post->ID );
    $helper = new Timber\ImageHelper;

    $image_w = $options['image_w'] ?: 600;
    $image_h = $options['image_h'] ?: 400;
    $resized_image = $helper::resize( $image_url, $image_w, $image_h, 'center' );

    $resized_image_full = $helper::resize( $image_url, 1600, 1000, 'center' );

    $mobile_image_url = get_field( 'mobile_featured_image', $timber_post->ID ) ?: $image_url;

    return [
        'id' => $timber_post->ID,
        'date' => date('m.d.Y', strtotime($timber_post->post_date)),
        'title' => ($timber_post->short_title ?: $timber_post->post_title),
        'description' => strip_tags( explode( "\n", $timber_post->post_content )[0] ),
        'content' => $timber_post->post_content,
        'image' => $resized_image,
        'imagefull' => $resized_image_full,
        'mobile_image' => $mobile_image_url,
        'link' => get_permalink( $timber_post->ID )
    ];
}

function format_insight_featured ( $insight ) {
    return format_insight( $insight, [
        'image_w' => 1200,
        'image_h' => 800
    ] );
}


function format_insight_grid ( $insight, $key ) {
    return format_insight( $insight, [
        'image_w' => 500,
        'image_h' => 350
    ]);
}
