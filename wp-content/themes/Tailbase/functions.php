<?php

 // Bootstrapping theme
require_once __DIR__ . '/app/bootstrap.php';

require_once __DIR__ . '/functions/cpt.php';

require_once( __DIR__ . '/functions/bw.php' );

require_once( __DIR__ . '/functions/acf.php' );

require_once( __DIR__ . '/functions/api.php' );


// index medium images for algolia
// add_filter('algolia_post_images_sizes', function($sizes) {
//   $sizes[] = 'medium';

//   return $sizes;
// });


add_filter('img_caption_shortcode', 'my_img_caption_shortcode_filter',10,3);

/**
 * Filter to replace the [caption] shortcode text with HTML5 compliant code
 *
 * @return text HTML content describing embedded figure
 **/
function my_img_caption_shortcode_filter($val, $attr, $content = null)
{
    extract(shortcode_atts(array(
        'id'    => '',
        'align' => '',
        'width' => '',
        'caption' => ''
    ), $attr));

    if ( 1 > (int) $width || empty($caption) )
        return $val;

    $capid = '';
    if ( $id ) {
        $id = esc_attr($id);
        $capid = 'id="figcaption_'. $id . '" ';
        $id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
    }

    return '<figure ' . $id . 'class="wp-caption ' . esc_attr($align) . '" >'
    . do_shortcode( $content ) . '<p ' . $capid
    . 'class="wp-caption-text">' . $caption . '</p></figure>';
}

function custom_excerpt_length( $length ) {
  return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function wpdocs_excerpt_more( $more ) {
  return '...';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

// hide Posts for sidebar in wp-admin
// function post_remove () {
//   remove_menu_page('edit.php');
// }

// add_action('admin_menu', 'post_remove');


// function remove_wp_nodes () {
//   global $wp_admin_bar;
//   $wp_admin_bar->remove_node( 'new-post' );
// }

// add_action( 'admin_bar_menu', 'remove_wp_nodes', 999 );


/* Timber functions*/

function timber_home($context){
    /* Add to Timber's global context */
    $context['is_front_page'] = is_front_page();
    return $context;
}


add_filter('timber_context', 'timber_home');


add_theme_support( 'post-thumbnails' );

/**
 * allow SVG upload
 */

function mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'mime_types');



/* Remove menu items */
function custom_menu_page_removing() {
    remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'custom_menu_page_removing' );

/* Remove comments system */
// Disable support for comments and trackbacks in post types
function disable_comments_post_types_support() {
$post_types = get_post_types();
foreach ($post_types as $post_type) {
if(post_type_supports($post_type, 'comments')) {
remove_post_type_support($post_type, 'comments');
remove_post_type_support($post_type, 'trackbacks');
}
}
}
add_action('admin_init', 'disable_comments_post_types_support');

// Close comments on the front-end
function disable_comments_status() {
return false;
}
add_filter('comments_open', 'disable_comments_status', 20, 2);
add_filter('pings_open', 'disable_comments_status', 20, 2);

// Hide existing comments
function disable_comments_hide_existing_comments($comments) {
$comments = array();
return $comments;
}
add_filter('comments_array', 'disable_comments_hide_existing_comments', 10, 2);

// Remove comments page in menu
function disable_comments_admin_menu() {
remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'disable_comments_admin_menu');

// Redirect any user trying to access comments page
function disable_comments_admin_menu_redirect() {
global $pagenow;
if ($pagenow === 'edit-comments.php') {
wp_redirect(admin_url()); exit;
}
}
add_action('admin_init', 'disable_comments_admin_menu_redirect');

// Remove comments metabox from dashboard
function disable_comments_dashboard() {
remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'disable_comments_dashboard');

// Remove comments links from admin bar
function disable_comments_admin_bar() {
if (is_admin_bar_showing()) {
remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
}
}
add_action('init', 'disable_comments_admin_bar');

// Showing all custom posts count
function custom_post_types_count()
{
  $glances = array();
  $args = array(
    'public'   => true,  // Showing public post types only
    '_builtin' => false  // Except the build-in wp post types (page, post, attachments)
  );
  // Getting your custom post types
  $post_types = get_post_types($args, 'object', 'and');
  foreach ($post_types as $post_type)
  {
    // Counting each post
    $num_posts = wp_count_posts($post_type->name);
    // Number format
    $num   = number_format_i18n($num_posts->publish);
    // Text format
    $text  = _n($post_type->labels->singular_name, $post_type->labels->name, intval($num_posts->publish));
    // If use capable to edit the post type
    if (current_user_can('edit_posts'))
    {
      // Show with link
      $glance = '<a class="'.$post_type->name.'-count" href="'.admin_url('edit.php?post_type='.$post_type->name).'">'.$num.' '.$text.'</a>';
    }
    else
    {
      // Show without link
      $glance = '<span class="'.$post_type->name.'-count">'.$num.' '.$text.'</span>';
    }
    // Save in array
    $glances[] = $glance;
  }
  // return them
  return $glances;
}
add_action('dashboard_glance_items', 'custom_post_types_count');
