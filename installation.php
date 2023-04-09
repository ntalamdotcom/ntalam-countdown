<?php 

function ntalam_countdown_activation_action()
{
  // add_action('wp_ajax_my_ajax_action', 'my_ajax_function');

  // // Handle the AJAX request
  // function my_ajax_function()
  // {
  //     // echo 'holy';
  // }   
    set_transient( 'ntalam_countdown_admin_notice_'.get_current_user_id(), true, 10 );

    global $wpdb;
    $tablename = $wpdb->prefix .NTALAM_COUNTDOWN__TABLE_COUNTDOWN_OPTIONS;
    $table_create = "CREATE TABLE `" . $tablename . "` (
        `id` bigint NOT NULL,
        `key` varchar NOT NULL,
        `value` value NOT NULL,
        `user_id` bigint NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";
        // echo $table_create;
    maybe_create_table($wpdb->prefix . $tablename, $table_create);  
    
}

register_activation_hook(NTALAM_COUNTDOWN__PLUGIN_DIR.'/ntalam-countdown.php', 'ntalam_countdown_activation_action');
?>