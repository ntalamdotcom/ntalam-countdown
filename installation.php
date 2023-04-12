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
        `deadline` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (`id`),
        INDEX (`id`));";

  $table_exists = $wpdb->get_var("SHOW TABLES LIKE '$tablename'") == $tablename;
  // $filepath = 'error_file.log';

  if ($table_exists) {
  } else {
    $results = $wpdb->get_results($wpdb->prepare($table_create));
    $lastError = $wpdb->last_error;
    if ($lastError) {
      $wpdb->print_error();
      // error_log(PHP_EOL . $lastError, 3, NTALAM_COUNTDOWN__AJAX_ACTION_ERROR_LOG_PATH);
      errorLog($lastError);
      set_transient('ntalam_countdown_admin_error_notice_' . get_current_user_id(), true, 10);
      die();
    }
  }

}

register_activation_hook(NTALAM_COUNTDOWN__PLUGIN_DIR . '/ntalam-countdown.php', 'ntalam_countdown_activation_action');
