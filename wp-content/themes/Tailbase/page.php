<?php

$post = new TimberPost();


$file = null;

switch ($post->post_type) {
    case 'post':
        $file = 'single.php';
        break;
    case 'project':
        $file = 'single-project.php';
        break;
    case 'video':
        $file = 'single-video.php';
        break;
}

if ($file) {
    include get_theme_file_path( $file );
} else {
    $context = Timber::get_context();
    $context['post'] = $post;

    Timber::render(['page-' . $post->post_name . '.twig', 'page.twig'], $context);
}
