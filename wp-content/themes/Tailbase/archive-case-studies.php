<?php

include_once get_theme_file_path( '/functions/case-studies.php' );

$context = Timber::context();
$case_studies_query = new Timber\PostQuery();


$context['case_studies'] = array_map( 'format_case_study', (array)$case_studies_query );


Timber::render( 'page-case-studies.twig', $context );
