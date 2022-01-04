<?php
/**
 * Template Name: Page About
 */

include_once get_theme_file_path( '/functions/team.php' );


$context = Timber::context();
$timber_post = new Timber\Post();

$context['post'] = $timber_post;
$context['services'] = get_field('services', 'option');


$team_query = new WP_Query([
    'post_type' => 'team',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'meta_key' => 'active',
    'meta_value' => '1',
    'orderby' => 'menu_order',
    'order' => 'ASC'
]);

$context['team'] = array_map( 'format_team' , $team_query->posts );


Timber::render( 'page-about.twig' , $context );
