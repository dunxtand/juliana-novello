<?php
/**
 * Template Name: Writing Page
 */

$context = Timber::context();
$timber_post = new Timber\Post();
$context['post'] = $timber_post;


$posts_query = new WP_Query([
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC'
]);

$context['posts'] = array_map(
    function ( $post ) {
        return [
            'title' => $post->post_title,
            'content' => $post->post_content,
            'link' => get_permalink( $post->ID )
        ];
    }, 
    $posts_query->posts
);


Timber::render( 'page-writing.twig' , $context );
