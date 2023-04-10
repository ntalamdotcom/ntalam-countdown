<?php 

/**
 * A utils function for writing the log
 */
function errorLog($msg){
    error_log(PHP_EOL . $msg, 3, NTALAM_COUNTDOWN__AJAX_ACTION_ERROR_LOG_PATH);
}