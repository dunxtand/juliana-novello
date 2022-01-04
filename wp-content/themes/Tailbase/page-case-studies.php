<?php
/**
 * Template Name: Page Case Studies
 */

include_once get_theme_file_path( '/functions/case-studies.php' );


$context = Timber::context();
$timber_post = new Timber\Post();

$case_studies_query = new WP_Query([
    'post_type' => 'case-studies',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'meta_key' => 'hide_from_case_studies_page',
    'meta_value' => '0',
    'orderby' => 'menu_order',
    'order' => 'ASC'
]);


$context['post'] = $timber_post;
$context['case_studies'] = array_map( 'format_case_study', $case_studies_query->posts );


Timber::render( 'page-case-studies.twig' , $context );
