<?php

function insert_countdown_options($key, $value, $user_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . NTALAM_COUNTDOWN__TABLE_COUNTDOWN_OPTIONS; // replace my_table with your table name

    //id	key	value	user_id	
    $data = array(
        'key' => $key,
        'value' => $value,
        'user_id' => $user_id
        // add more columns and values as needed
    );
    $res = $wpdb->insert($table_name, $data);
    if ($res === false) {
        return $error_message = $wpdb->last_error;
    } else {
        return true;
    }
}
function select_last_countdown_options()
{
    global $wpdb;
    $table_name = $wpdb->prefix . NTALAM_COUNTDOWN__TABLE_COUNTDOWN_OPTIONS; // replace my_table with your table name

    $res = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT * FROM `wp_ntalam_countdown_options` ORDER by id desc limit 1;"
        )
    );
    if ($res === false) {
        return $error_message = $wpdb->last_error;
    } else {
        return $res;
    }
}
