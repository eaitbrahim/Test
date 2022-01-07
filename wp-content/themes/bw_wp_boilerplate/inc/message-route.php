<?php

add_action('rest_api_init', 'BwWpBpMessageRoutes');

function BwWpBpMessageRoutes() {
  register_rest_route('bwwpbp/v1', '/message', array(
    'methods' => 'POST',
    'callback' => 'createMessage'
  ));
}

function createMessage($data) {
    $email = sanitize_email($data['email']);
    $name = sanitize_text_field($data['name']);
    $userMessage = sanitize_text_field($data['message']);
    
    $existQuery = new WP_Query(array(
        'post_type' => 'received-message',
        'meta_query' => array(
            array(
                'key' => 'email',
                'compare' => '=',
                'value' => $email
            )
        )
    ));

    if ($existQuery->found_posts < 3) {
        try{
            // Save data to subscription post type
            $message_post_ID = wp_insert_post(array(
                'post_type' => 'received-message',
                'post_status' => 'publish',
                'post_title' => 'Message from '.$name,
                'post_content' => $userMessage,
                'meta_input' => array(
                    'email' => $email,
                    'name' => $name
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
                        <h1>New message received from: </h1>
                        <ul>
                            <li> name: '.$name.'</li>
                            <li> email: '.$mail.'</li>
                            <li> message: '.$userMessage.'</li>
                        </ul>
                        <p>
                            <a href="'.admin_url( 'post.php' ).'?post='.$message_post_ID.'&action=edit">Open this message</a>
                        </p>
                    </div>
                </body>
            </html>';
    
            wp_mail($to, $subject, $message);

            return new WP_REST_Response( 'We look forward to connecting with you soon!', 200 );
        }
        catch(RuntimeException $ex){
            return new WP_Error( 'cant-message', __( $ex->getMessage(), 'Message' ), array( 'Exception' => $ex ) );
        }
        catch(Exception $ex){
            return new WP_Error( 'cant-message', __( $ex->getMessage(), 'Message' ), array( 'Exception' => $ex ) );
        }
    } else {
        die("You have reached your limit.");
    }
}