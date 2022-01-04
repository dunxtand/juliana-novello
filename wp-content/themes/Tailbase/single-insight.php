<?php

include_once get_theme_file_path( '/functions/insights.php' );
// include_once get_theme_file_path( '/functions/team.php' );


$context = Timber::get_context();
$post = new TimberPost();

$context['post'] = format_insight( $post );

$insight = get_field('related_insights');

$context['more_insights'] = $insight;

// grab three random insights (use format_insight)

// $context['process'] = [
//     'header' => $post->process_header,
//     'stats' => $post->meta( 'process_stats' )
// ];
// $context['credits'] = [
//     'header' => $post->credits_header,
//     'client_name' => $post->client_name,
//     'client_url' => $post->client_url,
//     'sectors' => get_the_terms( $post->ID, 'industry' ),
//     'disciplines' => get_the_terms( $post->ID, 'work-type' ),
//     'team_members' => $post->team_members
//         ? array_map( 'format_team', $post->team_members )
//         : array()
// ];


if (post_password_required($post->ID)) {
    Timber::render('single-password.twig', $context);
} else {
    $post_type = $post->post_type === 'revision' ? get_post_type($post->post_parent)  : $post->post_type;
    Timber::render(['single-' . $post->ID . '.twig', 'single-' . $post_type . '.twig', 'single.twig'], $context);
}
