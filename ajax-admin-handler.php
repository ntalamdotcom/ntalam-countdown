<?php
add_action('wp_ajax_save_phrase', 'callback_save_phrase');
// add_action('wp_ajax_nopriv_my_action', 'my_action_callback');
include('database-procedures.php');
function callback_save_phrase()
{
    $phrase = $_POST['phrase'];
    
    $res = insert_countdown_options('phrase',$phrase,get_current_user_id());
    if($res ===true){
        $result = array(
            'success' => true,
            'message' => 'The result is: ' . $res,
        );
        wp_send_json_success($result);
    }else{
        wp_send_json_error(array('error' => $res));
    }
    
}
?>