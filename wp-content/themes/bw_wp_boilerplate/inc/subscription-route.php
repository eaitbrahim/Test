<?php

add_action('rest_api_init', 'BwWpBpSubscriptionRoutes');

function BwWpBpSubscriptionRoutes() {
  register_rest_route('bwwpbp/v1', '/subscription', array(
    'methods' => 'POST',
    'callback' => 'createSubscription'
  ));

  register_rest_route( 'bwwpbp/v1', '/subscription', array(
    'methods' => 'GET',
    'callback' => 'my_awesome_func',
    'permission_callback' => '__return_true',
  ) );
}

function my_awesome_func(){
    return new WP_REST_Response( 'We look forward to connecting with you soon!', 200 );
}

function createSubscription($data) {
    $email = sanitize_email($data['email']);
    
    $existQuery = new WP_Query(array(
        'post_type' => 'subscription',
        'meta_query' => array(
            array(
                'key' => 'email',
                'compare' => '=',
                'value' => $email
            )
        )
    ));

    if ($existQuery->found_posts == 0) {
        try{
            // Save data to subscription post type
            $subscribe_post_ID = wp_insert_post(array(
                'post_type' => 'subscription',
                'post_status' => 'publish',
                'post_title' => 'Subscription from '.$email,
                'meta_input' => array(
                    'email' => $email
                )
            ));
            
            // Send email notification
            $to = get_bloginfo('admin_email');
            $subject = 'New Subscription';
            $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                </head>
                <body>
                    <div>
                        <h1>New subscription received from: </h1>
                        <ul>
                            <li> email: '.$email.'</li>
                        </ul>
                        <p>
                            <a href="'.admin_url( 'post.php' ).'?post='.$subscribe_post_ID.'&action=edit">Open this subscription</a>
                        </p>
                    </div>
                </body>
            </html>';
    
            wp_mail($to, $subject, $message);

            return new WP_REST_Response( 'We look forward to connecting with you soon!', 200 );
        }
        catch(RuntimeException $ex){
            return new WP_Error( 'cant-subscribe', __( $ex->getMessage(), 'Message' ), array( 'Exception' => $ex ) );
        }
        catch(Exception $ex){
            return new WP_Error( 'cant-subscribe', __( $ex->getMessage(), 'Message' ), array( 'Exception' => $ex ) );
        }
    } else {
        die("You are already subscribed.");
    }
}