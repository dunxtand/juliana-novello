<?php

function permit_public_route () {
    return true;
}


function add_routes () {

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
    
}

add_action('rest_api_init', 'add_routes');
