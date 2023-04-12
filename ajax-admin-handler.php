<?php
add_action('wp_ajax_save_phrase', 'callback_save_phrase');
add_action('wp_ajax_save_color_1', 'callback_save_color_1');
add_action('wp_ajax_save_color_2', 'callback_save_color_2');
add_action('wp_ajax_save_text_color', 'callback_save_text_color');
add_action('wp_ajax_save_deadline', 'callback_save_deadline');
add_action('wp_ajax_save_deadline', 'callback_save_changes');
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
function callback_save_color_1()
{
    $phrase = $_POST['color1'];
    $res = insert_countdown_options('color1',$phrase,get_current_user_id());
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
function callback_save_color_2()
{
    $phrase = $_POST['color2'];
    $res = insert_countdown_options('color2',$phrase,get_current_user_id());
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
function callback_save_text_color()
{
    $phrase = $_POST['textColor'];
    $res = insert_countdown_options('color2',$phrase,get_current_user_id());
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
function callback_save_deadline()
{
    $phrase = $_POST['deadline'];
    $res = insert_countdown_options('deadline',$phrase,get_current_user_id());
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
// function callback_save_changes()
// {
//     $deadline = $_POST['deadline'];
//     $textColor = $_POST['textColor'];
//     $color1 = $_POST['color1'];
//     $color2 = $_POST['color2'];
//     $phrase = $_POST['phrase'];
//     $res1 = insert_countdown_options('deadline',$deadline,get_current_user_id());
//     $res2 = insert_countdown_options('textColor',$textColor,get_current_user_id());
//     $res3 = insert_countdown_options('color1',$color1,get_current_user_id());
//     $res4 = insert_countdown_options('color2',$color2,get_current_user_id());
//     $res5 = insert_countdown_options('phrase',$phrase,get_current_user_id());
//     if(
//         ($res1 ===true) &&
//         ($res2 ===true) &&
//         ($res3 ===true) &&
//         ($res4 ===true) &&
//         ($res5 ===true)
//         ){
//         $result = array(
//             'success' => true,
//             'message' => 'The result is: ' . $res,
//         );
//         wp_send_json_success($result);
//     }else{
//         wp_send_json_error(array('error' => $res));
//     }  
// }
?>