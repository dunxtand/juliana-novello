<?php

function registerwork() {

  // Add Class taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => _x( 'Work Type', 'taxonomy general name' ),
    'singular_name'     => _x( 'Work Type', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Work Type' ),
    'all_items'         => __( 'All Work Type' ),
    'parent_item'       => __( 'Parent Work Type' ),
    'parent_item_colon' => __( 'Parent Work Type:' ),
    'edit_item'         => __( 'Edit Work Type' ),
    'update_item'       => __( 'Update Work Type' ),
    'add_new_item'      => __( 'Add New Work Type' ),
    'new_item_name'     => __( 'New Work Type Name' ),
    'menu_name'         => __( 'Work Type' ),
  );
  $args = array(
    'labels'            => $labels,
    'hierarchical'      => true,
    'query_var'         => true,
    'public'            => true,
    'show_ui'           => true,
    'show_admin_column' => true,
    'rewrite'           => array( 'slug' => 'case-studies/work-type', 'with_front' => true)
  );
  register_taxonomy( 'work-type', array(
    'case-studies',
    'page',
    'insight'
  ), $args );


}
add_action( 'init', 'registerwork' );


function registerindustry() {

  // Add Class taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => _x( 'Industries', 'taxonomy general name' ),
    'singular_name'     => _x( 'Industry', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Industry' ),
    'all_items'         => __( 'All Industry' ),
    'parent_item'       => __( 'Parent Industry' ),
    'parent_item_colon' => __( 'Parent Industry:' ),
    'edit_item'         => __( 'Edit Industry' ),
    'update_item'       => __( 'Update Industry' ),
    'add_new_item'      => __( 'Add New Industry' ),
    'new_item_name'     => __( 'New Industry Name' ),
    'menu_name'         => __( 'Industry' ),
  );
  $args = array(
    'labels'            => $labels,
    'hierarchical'      => true,
    'query_var'         => true,
    'public'            => true,
    'show_ui'           => true,
    'show_admin_column' => true,
    'rewrite'           => array( 'slug' => 'case-studies/industry', 'with_front' => true)
  );
  register_taxonomy( 'industry', array(
    'case-studies',
    'page',
    'insight'
  ), $args );


}
add_action( 'init', 'registerindustry' );

function registertags() {

  // Add Class taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => _x( 'Tags', 'taxonomy general name' ),
    'singular_name'     => _x( 'Tag', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Tag' ),
    'all_items'         => __( 'All Tag' ),
    'parent_item'       => __( 'Parent Tag' ),
    'parent_item_colon' => __( 'Parent Tag:' ),
    'edit_item'         => __( 'Edit Tag' ),
    'update_item'       => __( 'Update Tag' ),
    'add_new_item'      => __( 'Add New Tag' ),
    'new_item_name'     => __( 'New Tag Name' ),
    'menu_name'         => __( 'Tag' ),
  );
  $args = array(
    'labels'            => $labels,
    'hierarchical'      => true,
    'query_var'         => true,
    'public'            => true,
    'show_ui'           => true,
    'show_admin_column' => true,
    'rewrite'           => array( 'slug' => 'insights/tags', 'with_front' => false)
  );
  register_taxonomy( 'post_tag', array(
    'insight'
  ), $args );


}
add_action( 'init', 'registertags' );



function create_post_types(){

  register_post_type(
    'case-studies',
    array(
      'labels' => array(
          'name'                       => _x( 'Case Studies', 'taxonomy general name', 'textdomain' ),
          'singular_name'              => _x( 'Case Study', 'taxonomy singular name', 'textdomain' ),
          'search_items'               => __( 'Search Case Studies', 'textdomain' ),
          'popular_items'              => __( 'Popular Case Studies', 'textdomain' ),
          'all_items'                  => __( 'All Case Studies', 'textdomain' ),
          'parent_item'                => null,
          'parent_item_colon'          => null,
          'edit_item'                  => __( 'Edit Case Study', 'textdomain' ),
          'update_item'                => __( 'Update Case Study', 'textdomain' ),
          'add_new_item'               => __( 'Add New Case Study', 'textdomain' ),
          'new_item_name'              => __( 'New Case Study Name', 'textdomain' ),
          'separate_items_with_commas' => __( 'Separate Case Studies with commas', 'textdomain' ),
          'add_or_remove_items'        => __( 'Add or remove Case Studies', 'textdomain' ),
          'choose_from_most_used'      => __( 'Choose from the most used Case Studies', 'textdomain' ),
          'not_found'                  => __( 'No Case Studies found.', 'textdomain' ),
          'menu_name'                  => __( 'Case Studies', 'textdomain' ),
      ),
      'public' => true,
      'has_archive' => false,
      'hierarchical' => true,
      'menu_icon' => 'dashicons-book',
      'supports' => array('title','thumbnail'),
      'rewrite' => array( 'slug' => 'case-studies', 'with_front'=> true )
    )
  );

  register_post_type(
    'Feedback',
    array(
      'labels' => array(
          'name'                       => _x( 'Feedback', 'taxonomy general name', 'textdomain' ),
          'singular_name'              => _x( 'Feedback', 'taxonomy singular name', 'textdomain' ),
          'search_items'               => __( 'Search Feedback', 'textdomain' ),
          'popular_items'              => __( 'Popular Feedback', 'textdomain' ),
          'all_items'                  => __( 'All Feedback', 'textdomain' ),
          'parent_item'                => null,
          'parent_item_colon'          => null,
          'edit_item'                  => __( 'Edit Feedback', 'textdomain' ),
          'update_item'                => __( 'Update Feedback', 'textdomain' ),
          'add_new_item'               => __( 'Add New Feedback', 'textdomain' ),
          'new_item_name'              => __( 'New Feedback', 'textdomain' ),
          'separate_items_with_commas' => __( 'Separate Feedback with commas', 'textdomain' ),
          'add_or_remove_items'        => __( 'Add or remove Feedback', 'textdomain' ),
          'choose_from_most_used'      => __( 'Choose from the most used Feedback', 'textdomain' ),
          'not_found'                  => __( 'No Feedback found.', 'textdomain' ),
          'menu_name'                  => __( 'Feedback', 'textdomain' ),
      ),
      'public' => true,
      'has_archive' => true,
      'hierarchical' => true,
      'menu_icon' => 'dashicons-editor-quote',
      'supports' => array('title','thumbnail'),
      'rewrite' => array( 'slug' => 'feedback', 'with_front'=> true )
    )
  );

  register_post_type(
    'Client Resource',
    array(
      'labels' => array(
          'name'                       => _x( 'Client Resources', 'taxonomy general name', 'textdomain' ),
          'singular_name'              => _x( 'Client Resource', 'taxonomy singular name', 'textdomain' ),
          'search_items'               => __( 'Search Client Resources', 'textdomain' ),
          'popular_items'              => __( 'Popular Client Resources', 'textdomain' ),
          'all_items'                  => __( 'All Client Resources', 'textdomain' ),
          'parent_item'                => null,
          'parent_item_colon'          => null,
          'edit_item'                  => __( 'Edit Client Resource', 'textdomain' ),
          'update_item'                => __( 'Update Client Resource', 'textdomain' ),
          'add_new_item'               => __( 'Add New Client Resource', 'textdomain' ),
          'new_item_name'              => __( 'New Client Resource', 'textdomain' ),
          'separate_items_with_commas' => __( 'Separate Client Resource with commas', 'textdomain' ),
          'add_or_remove_items'        => __( 'Add or remove Client Resource', 'textdomain' ),
          'choose_from_most_used'      => __( 'Choose from the most used Client Resource', 'textdomain' ),
          'not_found'                  => __( 'No Client Resource found.', 'textdomain' ),
          'menu_name'                  => __( 'Client Resources', 'textdomain' ),
      ),
      'public' => true,
      'has_archive' => false,
      'hierarchical' => false,
      'menu_icon' => 'dashicons-admin-network',
      'supports' => array('title','thumbnail', 'editor'),
      'rewrite' => array( 'slug' => 'client-resources', 'with_front'=> false )
    )
  );

  register_post_type(
    'Insight',
    array(
      'labels' => array(
          'name'                       => _x( 'Insights', 'taxonomy general name', 'textdomain' ),
          'singular_name'              => _x( 'Insight', 'taxonomy singular name', 'textdomain' ),
          'search_items'               => __( 'Search Insights', 'textdomain' ),
          'popular_items'              => __( 'Popular Insights', 'textdomain' ),
          'all_items'                  => __( 'All Insights', 'textdomain' ),
          'parent_item'                => null,
          'parent_item_colon'          => null,
          'edit_item'                  => __( 'Edit Insight', 'textdomain' ),
          'update_item'                => __( 'Update Insight', 'textdomain' ),
          'add_new_item'               => __( 'Add New Insight', 'textdomain' ),
          'new_item_name'              => __( 'New Insight', 'textdomain' ),
          'separate_items_with_commas' => __( 'Separate Insight with commas', 'textdomain' ),
          'add_or_remove_items'        => __( 'Add or remove Insight', 'textdomain' ),
          'choose_from_most_used'      => __( 'Choose from the most used Insight', 'textdomain' ),
          'not_found'                  => __( 'No Insight found.', 'textdomain' ),
          'menu_name'                  => __( 'Insights', 'textdomain' ),
      ),
      'public' => true,
      'has_archive' => true,
      'hierarchical' => true,
      'menu_icon' => 'dashicons-lightbulb',
      'supports' => array('title','thumbnail', 'editor'),
      'rewrite' => array( 'slug' => 'insights', 'with_front'=> true )
    )
  );

  register_post_type(
    'Team',
    array(
      'labels' => array(
          'name'                       => _x( 'Team', 'taxonomy general name', 'textdomain' ),
          'singular_name'              => _x( 'Team', 'taxonomy singular name', 'textdomain' ),
          'search_items'               => __( 'Search Team', 'textdomain' ),
          'popular_items'              => __( 'Popular Team', 'textdomain' ),
          'all_items'                  => __( 'All Team', 'textdomain' ),
          'parent_item'                => null,
          'parent_item_colon'          => null,
          'edit_item'                  => __( 'Edit Team', 'textdomain' ),
          'update_item'                => __( 'Update Team', 'textdomain' ),
          'add_new_item'               => __( 'Add New Team', 'textdomain' ),
          'new_item_name'              => __( 'New Team', 'textdomain' ),
          'separate_items_with_commas' => __( 'Separate Team with commas', 'textdomain' ),
          'add_or_remove_items'        => __( 'Add or remove Team', 'textdomain' ),
          'choose_from_most_used'      => __( 'Choose from the most used Team', 'textdomain' ),
          'not_found'                  => __( 'No Team found.', 'textdomain' ),
          'menu_name'                  => __( 'Team', 'textdomain' ),
      ),
      'public' => true,
      'publicly_queryable'  => false,
      'has_archive' => false,
      'hierarchical' => true,
      'menu_icon' => 'dashicons-admin-users',
      'supports' => array('title','thumbnail'),
      'rewrite' => array( 'slug' => 'team', 'with_front'=> false )
    )
  );

  register_post_type(
    'jobs',
    array(
      'labels' => array(
          'name'                       => _x( 'Jobs', 'taxonomy general name', 'textdomain' ),
          'singular_name'              => _x( 'Job', 'taxonomy singular name', 'textdomain' ),
          'search_items'               => __( 'Search Jobs', 'textdomain' ),
          'popular_items'              => __( 'Popular Jobs', 'textdomain' ),
          'all_items'                  => __( 'All Jobs', 'textdomain' ),
          'parent_item'                => null,
          'parent_item_colon'          => null,
          'edit_item'                  => __( 'Edit Job', 'textdomain' ),
          'update_item'                => __( 'Update Job', 'textdomain' ),
          'add_new_item'               => __( 'Add New Job', 'textdomain' ),
          'new_item_name'              => __( 'New Job Name', 'textdomain' ),
          'separate_items_with_commas' => __( 'Separate Jobs with commas', 'textdomain' ),
          'add_or_remove_items'        => __( 'Add or remove Jobs', 'textdomain' ),
          'choose_from_most_used'      => __( 'Choose from the most used Jobs', 'textdomain' ),
          'not_found'                  => __( 'No Jobs found.', 'textdomain' ),
          'menu_name'                  => __( 'Jobs', 'textdomain' ),
      ),
      'public' => true,
      'has_archive' => false,
      'hierarchical' => true,
      'menu_icon' => 'dashicons-book',
      'supports' => array( 'title', 'editor' ),
      'rewrite' => array( 'slug' => 'jobs', 'with_front'=> true )
    )
  );

}
add_action('init', 'create_post_types');

