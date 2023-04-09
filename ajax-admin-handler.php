<?php
add_action('wp_ajax_save_phrase', 'callback_save_phrase');
// add_action('wp_ajax_nopriv_my_action', 'my_action_callback');
include('database-procedures.php');
function callback_save_phrase()
{
    $name = $_POST['name'];
    $age = $_POST['age'];
    $result = array(
        'success' => true,
        'message' => 'Hello ' . $name . '! You are ' . $age . ' years old. is logged: '.is_user_logged_in(),
    );
    insert_countdown_options();

    wp_send_json_success($result);
}
?>