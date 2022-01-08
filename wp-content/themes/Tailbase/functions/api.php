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
    
}

add_action('rest_api_init', 'add_routes');
