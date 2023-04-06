<?php 

function ntalam_countdown_activation_action()
{
    
    set_transient( 'ntalam_countdown_admin_notice_'.get_current_user_id(), true, 10 );
    
    global $wpdb;
    $tablename = $wpdb->prefix .NTALAM_COUNTDOWN__TABLE_COUNTDOWN_OPTIONS;
    $table_create = "CREATE TABLE `" . $tablename . "` (
        `id` bigint NOT NULL,
        `key` varchar(300) NOT NULL,
        `value` varchar(300) NOT NULL,
        `user_id` bigint NOT NULL
      );";
        //  echo $table_create;
        // set_transient( $table_create, true, 1000 );
    maybe_create_table($tablename, $table_create);  
    
}

register_activation_hook(NTALAM_COUNTDOWN__PLUGIN_DIR.'/ntalam-countdown.php', 'ntalam_countdown_activation_action');
?>