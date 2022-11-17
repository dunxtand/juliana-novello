<?php
/**
 * Template Name: Writing Page
 */

$context = Timber::context();
$timber_post = new Timber\Post();
$context['post'] = $timber_post;

$posts_query = new WP_Query([
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC'
]);

$query = [];
$url_helper = new Timber\URLHelper();
$url_parts = parse_url( $url_helper->get_current_url() );
parse_str($url_parts['query'], $query);

$category_query = $query['category'] ?: 'main';
$main_posts = [];
$category_posts = [];

foreach ( $posts_query->posts as $default_post) {
    $post = new Timber\Post( $default_post );

    foreach ($post->terms('category') as $category) {
        if ($category_query != 'main' && $category->slug == 'main') {
            continue;
        }

        $found = null;
        foreach ($category_posts as $category_post) {
            if ($category_post['title'] == $category->name && $category->slug != $category_query) {
                $found = $category_post;
                break;
            }
        }

        // add main posts to main posts array
        if ($category->slug == $category_query) {
            $main_posts[] = [
                'title' => $post->post_title,
                'content' => $post->post_content,
                'link' => get_permalink( $post->ID ),
            ];
        
        // create new category posts array instance
        } elseif (!$found && $category->slug != $category_query) {
            $category_posts[] = [
                'title' => $category->name,
                'content' => $post->post_content,
                'link' => '/' . $timber_post->slug . '?category=' . $category->slug,
                'is_category' => true
            ];
        }
    }
}

$context['posts'] = array_merge($main_posts, $category_posts);

Timber::render( 'page-writing.twig' , $context );
