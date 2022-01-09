<?php

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

Timber::render( 'pages/projects/single.twig' , $context );
