<?php

include_once get_theme_file_path( '/functions/get_timber_post.php' );


function format_case_study ( $case_study ) {
    $helper = new Timber\ImageHelper;

    $timber_post = get_timber_post( $case_study );

    $timber_image = new Timber\Image( $timber_post->splash_image );
    $featured_image = new Timber\Image( get_post_thumbnail_id( $timber_post->ID ) );

    $awards = $timber_post->meta( 'awards' ) ?: array();

    $results = $timber_post->meta( 'results' ) ?: array();

    $work_type_terms = get_the_terms( $timber_post->ID, 'work-type' );
    $work_types = array_map( function ( $work_type ) {
            return $work_type->name;
        },
        $work_type_terms ? $work_type_terms : array()
    );


    return [
        'id' => $timber_post->ID,
        'title' => $timber_post->post_title,
        'link' => get_permalink( $timber_post->ID ),
        'tagline' => $timber_post->case_study_tagline,
        'quote' => $timber_post->case_study_quote,
        'image' => $timber_image->src,
        'image_small' => $timber_image->src,
        'splash_image' => $timber_image->src,
        'featured_image' => $featured_image->src,
        'awards' => $awards,
        'results' => $results,
        'is_featured' => boolval( $timber_post->is_featured ),
        'work_types' => $work_types,
        'in_development' => boolval( $timber_post->in_development_coming_soon ),
        'menu_order' => $timber_post->menu_order
    ];
}
