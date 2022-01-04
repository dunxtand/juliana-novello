<?php

include_once get_theme_file_path( '/functions/get_timber_post.php' );


function format_feedback ( $fb ) {
    $timber_post = get_timber_post( $fb );

    $case_study_url =  $timber_post->associatedcase
        ? get_permalink( (int)$timber_post->associatedcase )
        : null;

    return [
        'id' => $fb->ID,
        'quote' => $timber_post->feedback_copy,
        'attribution_name' => $timber_post->quote_attribution_name,
        'attribution_title' => $timber_post->quote_attribution_title,
        'case_study_url' => $case_study_url
    ];
}
