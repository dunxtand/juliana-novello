<?php

function get_timber_post ( $post ) {
    if ( $post instanceof Timber\Post ) {
        return $post;

    } elseif ( is_object( $post ) ) {
        return new Timber\Post( $post->ID );

    } elseif ( is_string( $post ) ) {
        return new Timber\Post( (int)$post );

    } elseif ( is_int( $post ) ) {
        return new Timber\Post( $post );

    } else {
        throw new Exception('Could not get Timber Post.');
    }
}
