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
          'edit_item'                  => __( 'Edit Job', 'textdomain' ),
          'update_item'                => __( 'Update Job', 'textdomain' ),
          'add_new_item'               => __( 'Add New Job', 'textdomain' ),
          'new_item_name'              => __( 'New Job Name', 'textdomain' ),
          'separate_items_with_commas' => __( 'Separate Projects with commas', 'textdomain' ),
          'add_or_remove_items'        => __( 'Add or remove Projects', 'textdomain' ),
          'choose_from_most_used'      => __( 'Choose from the most used Projects', 'textdomain' ),
          'not_found'                  => __( 'No Projects found.', 'textdomain' ),
          'menu_name'                  => __( 'Projects', 'textdomain' ),
      ),
      'public' => true,
      'has_archive' => false,
      'hierarchical' => true,
      'menu_icon' => 'dashicons-book',
      'supports' => array( 'title', 'editor' )
    )
  );
}
add_action('init', 'create_post_types');

