<?php

include_once get_theme_file_path( '/functions/case-studies.php' );
include_once get_theme_file_path( '/functions/feedback.php' );
include_once get_theme_file_path( '/functions/insights.php' );
include_once get_theme_file_path( '/functions/team.php' );


function permit_public_route () {
    return true;
}


function add_routes () {

    // get homepage relationship posts
    register_rest_route(
        'pages',
        '/(?P<id>\d+)\/carousel-data',
        [
            'methods' => 'GET',
            'args' => [ 'id' ],
            'permission_callback' => 'permit_public_route',
            'callback' => function ( $request ) {
                $page_id = $request['id'];
                $timber_post = new Timber\Post( (int)$page_id );

                $case_studies_query = new WP_Query([
                    'post_type' => 'case-studies',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                    'post__in' => $timber_post->case_studies_relationship
                ]);

                $feedback_query = new WP_Query([
                    'post_type' => 'feedback',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                    'post__in' => $timber_post->feedback_relationship
                ]);

                $insights_query = new WP_Query([
                    'post_type' => 'insight',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                    'post__in' => $timber_post->insights_relationship
                ]);

                return [
                    'case_studies' => array_map( 'format_case_study', $case_studies_query->posts ),
                    'feedback' => array_map( 'format_feedback', $feedback_query->posts ),
                    'insights' => array_map( 'format_insight', $insights_query->posts ),
                ];
            }
        ]
    );


    // get team members
    register_rest_route(
        'team',
        '/members',
        [
            'methods' => 'GET',
            'permission_callback' => 'permit_public_route',
            'callback' => function () {
                $team_query = new WP_Query([
                    'post_type' => 'team',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                    'meta_key' => 'active',
                    'meta_value' => '1',
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ]);

                return array_map( 'format_team' , $team_query->posts );
            }
        ]
    );


    // get contact form & fields
    register_rest_route( 'contact', '/(?P<page_id>\d+)\/form', array(
        'methods' => 'GET',
        'args' => [ 'page_id' ],
        'permission_callback' => 'permit_public_route',
        'callback' => function ( $request ) {
            $page_id = $request['page_id'];
            $contact_page = get_page( (int)$page_id );

            $form_id = $contact_page->form_id;
            $ck = $contact_page->consumer_key;
            $cs = $contact_page->consumer_secret;

            $site_url = get_site_url();

            $response = wp_remote_get(
                $site_url . '/wp-json/gf/v2/forms/' . $form_id,
                array(
                    'sslverify' => FALSE,
                    'headers' => array(
                        'Authorization' => 'Basic ' . base64_encode( "{$ck}:{$cs}" )
                    )
                )
            );
            
            $response_body = wp_remote_retrieve_body( $response );
            return json_decode( $response_body );
        }
    ));


    // add new contact form entry
    register_rest_route( 'contact', '/(?P<page_id>\d+)\/entries', array(
        'methods' => 'POST',
        'args' => [ 'page_id' ],
        'permission_callback' => 'permit_public_route',
        'callback' => function ( $request ) {
            $page_id = $request['page_id'];
            $contact_page = get_page( (int)$page_id );

            $form_id = $contact_page->form_id;
            $ck = $contact_page->consumer_key;
            $cs = $contact_page->consumer_secret;

            $body = $request->get_json_params();
            $body['form_id'] = $form_id;

            $site_url = get_site_url();

            $entry_response = wp_remote_post(
                $site_url . '/wp-json/gf/v2/forms/' . $form_id . '/entries',
                array(
                    'sslverify' => false,
                    'headers' => array(
                        'Authorization' => 'Basic ' . base64_encode( "{$ck}:{$cs}" ),
                        'Content-Type' => 'application/json'
                    ),
                    'body' => json_encode( $body )
                )
            );

            $entry_response_body = wp_remote_retrieve_body( $entry_response );
            $entry_data = json_decode( $entry_response_body );


            $notifications_response = wp_remote_post(
                $site_url . '/wp-json/gf/v2/entries/' . $entry_data->id . '/notifications',
                array(
                    'sslverify' => false,
                    'headers' => array(
                        'Authorization' => 'Basic ' . base64_encode( "{$ck}:{$cs}" )
                    )
                )
            );

            $notifications_response_body = wp_remote_retrieve_body( $notifications_response );
            $notifications_data = json_decode( $notifications_response_body );


            return [
                'entry' => $entry_data,
                'notifications' => $notifications_data
            ];
        }
    ));


    // get all jobs CPT for jobs page
    register_rest_route(
        'jobs',
        '/all',
        [
            'methods' => 'GET',
            'permission_callback' => 'permit_public_route',
            'callback' => function ( $request ) {

                $jobs_query = new WP_Query([
                    'post_type' => 'jobs',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                ]);

                $jobs = array_map( function ( $job ) {
                    $timber_post = new Timber\Post( $job );

                    return [
                        'id' => $timber_post->ID,
                        'title' => $timber_post->post_title,
                        'description' => $timber_post->content,
                        'location' => $timber_post->location,
                        'report' => $timber_post->report,
                        'compensation' => $timber_post->compensation,
                        'link' => $timber_post->link
                    ];
                }, $jobs_query->posts );

                return $jobs;
            }
        ]
    );
}

add_action('rest_api_init', 'add_routes');
