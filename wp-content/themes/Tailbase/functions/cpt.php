<?php



function create_post_types(){
  register_post_type(
    'project',
    array(
      'labels' => array(
          'name'                       => _x( 'Projects', 'taxonomy general name', 'textdomain' ),
          'singular_name'              => _x( 'Project', 'taxonomy singular name', 'textdomain' ),
          'search_items'               => __( 'Search Projects', 'textdomain' ),
          'popular_items'              => __( 'Popular Projects', 'textdomain' ),
          'all_items'                  => __( 'All Projects', 'textdomain' ),
          'parent_item'                => null,
          'parent_item_colon'          => null,
          'edit_item'                  => __( 'Edit Project', 'textdomain' ),
          'update_item'                => __( 'Update Project', 'textdomain' ),
          'add_new_item'               => __( 'Add New Project', 'textdomain' ),
          'new_item_name'              => __( 'New Project Name', 'textdomain' ),
          'separate_items_with_commas' => __( 'Separate Projects with commas', 'textdomain' ),
          'add_or_remove_items'        => __( 'Add or remove Projects', 'textdomain' ),
          'choose_from_most_used'      => __( 'Choose from the most used Projects', 'textdomain' ),
          'not_found'                  => __( 'No Projects found.', 'textdomain' ),
          'menu_name'                  => __( 'Projects', 'textdomain' ),
      ),
      'public' => true,
      'has_archive' => false,
      'hierarchical' => true,
      'show_in_graphql' => true,
      'graphql_single_name' => 'project',
      'graphql_plural_name' => 'projects',
      'menu_icon' => 'dashicons-camera',
      'supports' => array( 'title', 'editor' )
    )
  );

  register_post_type(
    'video',
    array(
      'labels' => array(
          'name'                       => _x( 'Video Projects', 'taxonomy general name', 'textdomain' ),
          'singular_name'              => _x( 'Video Project', 'taxonomy singular name', 'textdomain' ),
          'search_items'               => __( 'Search Video Projects', 'textdomain' ),
          'popular_items'              => __( 'Popular Video Projects', 'textdomain' ),
          'all_items'                  => __( 'All Video Projects', 'textdomain' ),
          'parent_item'                => null,
          'parent_item_colon'          => null,
          'edit_item'                  => __( 'Edit Video Project', 'textdomain' ),
          'update_item'                => __( 'Update Video Project', 'textdomain' ),
          'add_new_item'               => __( 'Add New Video Project', 'textdomain' ),
          'new_item_name'              => __( 'New Video Project Name', 'textdomain' ),
          'separate_items_with_commas' => __( 'Separate Video Projects with commas', 'textdomain' ),
          'add_or_remove_items'        => __( 'Add or remove Video Projects', 'textdomain' ),
          'choose_from_most_used'      => __( 'Choose from the most used Video Projects', 'textdomain' ),
          'not_found'                  => __( 'No Video Projects found.', 'textdomain' ),
          'menu_name'                  => __( 'Video Projects', 'textdomain' ),
      ),
      'public' => true,
      'has_archive' => false,
      'hierarchical' => true,
      'show_in_graphql' => true,
      'graphql_single_name' => 'videoProject',
      'graphql_plural_name' => 'videoProjects',
      'menu_icon' => 'dashicons-video-alt',
      'supports' => array( 'title', 'editor' )
    )
  );
}

add_action('init', 'create_post_types');
