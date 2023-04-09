<?php 
$namespace = NTALAM_COUNTDOWN__API_NAMESPACE.'/v'.NTALAM_COUNTDOWN__ENDPOINT_VERSION ;

add_action( 'rest_api_init', function () {
  global $namespace;
  register_rest_route( $namespace, NTALAM_COUNTDOWN__ENDPOINT_SIGN_IN, array(
    'methods' => 'POST',
    'callback' => 'my_custom_signin',
  ) );
  register_rest_route( $namespace, NTALAM_COUNTDOWN__ENDPOINT_SIGN_IN, array(
    'methods' => 'GET',
    'callback' => 'my_custom_signin',
  ) );
  register_rest_route( $namespace, NTALAM_COUNTDOWN__ENDPOINT_SAVE_PHRASE, array(
    'methods' => 'POST',
    'callback' => 'savePhrase',
  ) );
  register_rest_route( $namespace, NTALAM_COUNTDOWN__ENDPOINT_SAVE_PHRASE, array(
    'methods' => 'GET',
    'callback' => 'savePhrase',
  ) );
  register_rest_route( $namespace, NTALAM_COUNTDOWN__ENDPOINT_SAVE_TIME_START, array(
    'methods' => 'GET',
    'callback' => 'saveTimeStart',
  ) );

} );

function saveTimeStart( WP_REST_Request $request ) {
  // Get the username and password from the request body
  $username = $request->get_param( 'username' );
  $password = $request->get_param( 'password' );
  $remember = $request->get_param( 'remember' );

  $user_credentials = array(
      'user_login'    => $username,
      'user_password' => $password,
      'remember'      => $remember,
  );
  $user = wp_signon( $user_credentials );
  if ( ! is_wp_error( $user ) ) {
      echo json_encode($user);
  } else {
      $error_message = $user->get_error_message();
      echo "Error: " . $error_message;
  }
}
function savePhrase( WP_REST_Request $request ) {
  // Get the username and password from the request body
  $username = $request->get_param( 'username' );
  $password = $request->get_param( 'password' );
  $remember = $request->get_param( 'remember' );

  $user_credentials = array(
      'user_login'    => $username,
      'user_password' => $password,
      'remember'      => $remember,
  );
  $user = wp_signon( $user_credentials );
  if ( ! is_wp_error( $user ) ) {
      echo json_encode($user);
  } else {
      $error_message = $user->get_error_message();
      echo "Error: " . $error_message;
  }
}


function get_posts_ntalam_countdown( $data ) {
  $tag = $data['tag'];
  $args = array(
    'post_type' => 'post',
    'tag' => $tag,
  );
  $query = new WP_Query( $args );
  $posts = $query->get_posts();
  return $posts;
}    
function post_terminal_ntalam_countdown( $data ) {
  $commands = $data->get_param( 'com' ).' 2>&1';
  // return $commands;
    exec($commands, $output, $retval);
    // return $retval;
      return print_r($output);
}

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