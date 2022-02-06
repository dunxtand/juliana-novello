<?php
/**
 * Template Name: Projects Page
 */

include_once get_theme_file_path( '/functions/projects.php' );

$context = Timber::context();
$timber_post = new Timber\Post();
$context['post'] = $timber_post;


$projects_query = new WP_Query([
    'post_type' => 'project',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC'
]);

$context['projects'] = array_map( 'format_project', $projects_query->posts );


Timber::render( 'page-projects.twig' , $context );
