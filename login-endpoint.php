<?php 
	add_action( 'rest_api_init', function () {
        register_rest_route( 'myplugin/v1', '/signin', array(
            'methods' => 'POST',
            'callback' => 'my_custom_signin',
        ) );
    } );
    
    //curl -X POST -d 'username=ntalam&password="An168421."&remember=true' https://restservice.ntalam.com/wp-json/myplugin/v1/signin
    function my_custom_signin( WP_REST_Request $request ) {
        // Get the username and password from the request body
        $username = $request->get_param( 'username' );
        $password = $request->get_param( 'password' );
        $remember = $request->get_param( 'remember' );
    
        // return 'sdf';
        // Perform authentication here
        // ...
    
        // Return the user ID and token as a response
        // return array(
        //     'user_id' => $user_id,
        //     'token' => $token,
        // );

        // Set up the user credentials
        $user_credentials = array(
            'user_login'    => $username,
            'user_password' => $password,
            'remember'      => $remember,
        );
        // print_r($user_credentials) ;
        // Sign the user in
        $user = wp_signon( $user_credentials );
        // print_r($user);
        // Check if the sign-in was successful
        if ( ! is_wp_error( $user ) ) {
            // The user is signed in, do something
            // echo 'yes';
            echo json_encode($user);
        } else {
            // The sign-in failed, display an error message
            $error_message = $user->get_error_message();
            echo "Error: " . $error_message;
        }

    }
    
    
?>