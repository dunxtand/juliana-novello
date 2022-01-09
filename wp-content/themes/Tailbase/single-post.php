<?php

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

Timber::render( 'pages/writing/single.twig' , $context );
