<?php

function ntalam_countdown_activation_action()
{
  global $wpdb;
  $tablename = $wpdb->prefix . NTALAM_COUNTDOWN__TABLE_COUNTDOWN_OPTIONS;
  $table_create = "CREATE TABLE `" . $tablename . "` (
        `id` bigint NOT NULL AUTO_INCREMENT,
        `key` varchar(200) NOT NULL,
        `value` varchar(350) NOT NULL,
        `user_id` bigint NOT NULL,
        PRIMARY KEY  (`id`),
        INDEX (`id`));";

  $table_exists = $wpdb->get_var("SHOW TABLES LIKE '$tablename'") == $tablename;
  $filepath = 'error_file.log';

  if ($table_exists) {
  } else {
    $results = $wpdb->get_results($wpdb->prepare($table_create));
    $lastError = $wpdb->last_error;
    if ($lastError) {
      $wpdb->print_error();
      error_log(PHP_EOL . $lastError, 3, $filepath);
      set_transient('ntalam_countdown_admin_error_notice_' . get_current_user_id(), true, 10);
      die();
    }
    // if ($results) {
    //   // 
    //   for ($i = 0; $i < count($results); $i++) {
    //     error_log(PHP_EOL . $results[$i], 3, $filepath);
    //   }
     
    // }
  }

  // error_log(PHP_EOL.$table_create, 3, $filepath);
  // if ($table_exists) {
  //   echo "Table $table_name exists!";
  // } else {
  //   $errors = dbDelta($table_create);
  //   if (!empty($errors)) {
  //     for ($i = 0; $i < count($errors); $i++) {
  //       error_log(PHP_EOL.$errors[$i], 3, $filepath);
  //     }
  //     set_transient('ntalam_countdown_admin_error_notice_' . get_current_user_id(), true, 10);
  //     die();
  //   }
  // }
}

register_activation_hook(NTALAM_COUNTDOWN__PLUGIN_DIR . '/ntalam-countdown.php', 'ntalam_countdown_activation_action');
