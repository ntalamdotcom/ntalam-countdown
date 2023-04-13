<?php
/*
    Plugin Name: NTalaM-countdown
    Plugin URI: https://github.com/ntalamdotcom/ntalam-countdown
    Description: This is my first plugin. It is a simple countdown banner on the top of a website.
    Version: 0.2
    Author: NtalaM
    Author URI: https://ntalam.com
    License: GPL3
    License URI: https://www.gnu.org/licenses/gpl-3.0.html
    Text Domain: wpb-tutorial
    Domain Path: /languages
    */
    // add_action('wp_ajax_my_ajax_action', 'my_ajax_action');

    // function my_ajax_action()
    // {
    //     $response = array('message' => 'Hello from the server!');
    //     wp_send_json_success($response);
    //     // die();
    // }

    /**
     * common vars for the plugin
     */
    include('config.php');
    include('utils.php');
    /**
     * When the plugin is active...
     */
    include('activation.php');
    
    include('ajax-admin-handler.php');

?>