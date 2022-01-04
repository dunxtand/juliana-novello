<?php

include_once get_theme_file_path( '/functions/insights.php' );

$context = Timber::context();

$insights_query = new Timber\PostQuery();

$featured_insight = $insights_query[0];
$insights = array_slice( (array)$insights_query, 1);

$context['insights'] = array_map( 'format_insight_grid', $insights, array_keys( $insights ) );
$context['featured_insight'] = format_insight_featured($featured_insight);

Timber::render('page-insights.twig', $context);
