<?php

add_action('rest_api_init', 'stayInLoopRegisterMailchimp');

function stayInLoopRegisterMailchimp(){
    register_rest_route('stayinloop/v1', 'mailchimp', array(
          'methods'             => WP_REST_SERVER::CREATABLE,
          'callback'            => 'stayInLoopRegisterMailchimpResults',
      ));
}

function stayInLoopRegisterMailchimpResults($request){
    if (!defined('MAILCHIMP_API_URL') || !defined('MAILCHIMP_LIST_ID') || !defined('MAILCHIMP_API_KEY')){
        return new WP_Error( 'cant-subscribe', __( 'Mailchimp info is not set!', 'text-domain' ), array( 'status' => 404 ) );
    }

    // API to mailchimp
    $api_url = MAILCHIMP_API_URL;
    $list_id = MAILCHIMP_LIST_ID;
    $group_id = MAILCHIMP_GROUP_ID_STAY_IN_LOOP;
    $authToken = MAILCHIMP_API_KEY;

    //return getInterests();

    // Validate Email
    if (!is_email($request['email'])) {
        // invalid emailaddress
        return new WP_Error( 'cant-subscribe', __( 'Invalid email address!', 'text-domain' ), array( 'status' => 404 ) );
    }

    // The data to send to the API
    $postData = array(
        "email_address" => $request['email'],
        "status" => "pending",
        "merge_fields" => array("COMPANY"=> $request["company"]),
        "interests" => array($group_id => true)
    );

    // Setup cURL
    $mailchimp_url = $api_url . $list_id . '/members';
    $ch = curl_init($mailchimp_url);
    curl_setopt_array($ch, array(
        CURLOPT_POST => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_HTTPHEADER => array(
            'Authorization: apikey ' . $authToken,
            'Content-Type: application/json'
        ),
        CURLOPT_POSTFIELDS => json_encode($postData)
    ));
    // Send the request
    $response = json_decode(curl_exec($ch), true);
    
    if($response['status'] == 200){
        return new WP_REST_Response( $response, 200 );
    }

    return new WP_Error( 'cant-subscribe', __( $response['errors'], 'text-domain' ), array( 'status' => $response['status'], 
    'response' => $response) );
}

function getInterests(){
    $output = '';
    $response = '';
    $output = '';
    $api_key = MAILCHIMP_API_KEY;
    $list_id = MAILCHIMP_LIST_ID;
    $dc = substr( $api_key, strpos( $api_key, '-' ) + 1 ); // datacenter, it is the part of your api key - us5, us8 etc
    
    $args = array(
        'headers' => array('Authorization' => 'apikey ' . $api_key, 'Content-Type' => 'application/json')
    );
    
    $response = wp_remote_get( 'https://'.$dc.'.api.mailchimp.com/3.0/lists/'.$list_id . '/interest-categories', $args );
    $body = json_decode( wp_remote_retrieve_body( $response ) );
    
    if ( wp_remote_retrieve_response_code( $response ) == 200 && $body->total_items > 0 ) {
        foreach ( $body->categories as $group ) { 
            // we can skip hidden interests
            // if( $group->type == 'hidden')
            //     continue;

            // heading, name of the Interest Category
            $output .= 'Title=' . $group->title . ', Id='.$group->id;

            // connect to API to get interests from each category
            $response = wp_remote_get( 'https://'.$dc.'.api.mailchimp.com/3.0/lists/'.$list_id . '/interest-categories/' . $group->id . '/interests', $args );
            $body = json_decode( wp_remote_retrieve_body( $response ) );
            
            return new WP_REST_Response( $body, 200 );
    
            if ( wp_remote_retrieve_response_code( $response ) == 200 && $body->total_items > 0 ) {   
                foreach( $body->interests as $interest ){
                    $output .= ' Intrest Id=' . $interest->id . ' name=' . $interest->name;
                }
                return new WP_REST_Response( $output, 200 );
            }
        }
    }

    return new WP_Error( 'cant-get-data', __( $body['errors'], 'text-domain' ), array( 'status' => $body['status'], 
    'body' => $body) );
}
