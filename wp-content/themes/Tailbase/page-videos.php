<?php
/**
 * Template Name: Videos Page
 */

include_once get_theme_file_path( '/functions/videos.php' );

$context = Timber::context();
$timber_post = new Timber\Post();
$context['post'] = $timber_post;


$videos_query = new WP_Query([
    'post_type' => 'video',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC'
]);

$context['video_projects'] = array_map( 'format_video_project', $videos_query->posts );

Timber::render( 'page-videos.twig' , $context );
