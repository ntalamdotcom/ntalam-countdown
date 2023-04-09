<?php 

function insert_countdown_options(){
    global $wpdb;
    $table_name = $wpdb->prefix . NTALAM_COUNTDOWN__TABLE_COUNTDOWN_OPTIONS; // replace my_table with your table name

    $data = array(
        'column1' => 'value1',
        'column2' => 'value2',
        // add more columns and values as needed
    );

    $wpdb->insert($table_name, $data);

}


?>