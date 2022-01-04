<?php

include_once get_theme_file_path( '/functions/case-studies.php' );
include_once get_theme_file_path( '/functions/team.php' );


$context = Timber::get_context();
$post = new TimberPost();

$case_study = format_case_study( $post );
$next_project = $post->next_project ? $post->next_project : get_previous_post();


$context['post'] = $case_study;

$context['next_project'] = format_case_study( $next_project );

$context['process'] = [
    'header' => $post->process_header,
    'stats' => $post->meta( 'process_stats' )
];

$context['credits'] = [
    'header' => $post->credits_header,
    'client_name' => $post->client_name,
    'client_url' => $post->client_url,
    'sectors' => get_the_terms( $post->ID, 'industry' ),
    'team_members' => $post->team_members
        ? array_map( 'format_team', $post->team_members )
        : array()
];


Timber::render('single-case-studies.twig', $context);
