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
/**
 * It brings the last option based on the key and user id
 */
// function select_last_countdown_options($key,$userId)
function select_last_countdown_options($key)
{
    global $wpdb;
    $table_name = $wpdb->prefix . NTALAM_COUNTDOWN__TABLE_COUNTDOWN_OPTIONS; // replace my_table with your table name
    $query ="SELECT * FROM `".$table_name."` WHERE `key` LIKE '".$key."' ORDER BY `id` DESC LIMIT 1";
    // errorLog($query);
    $res = $wpdb->get_row(
        $wpdb->prepare(
            $query
        )
    );
    if ($res === false) {
        return $error_message = $wpdb->last_error;
    } else {
        return $res;
    }
}
