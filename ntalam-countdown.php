<?php
/*
    Plugin Name: NTalaM-countdown
    Plugin URI: https://countdown.ntalam.com
    Description: This is my first plugin. It is a simple countdown banner on the top of a website.
    Version: 0.2
    Author: NtalaM
    Author URI: https://ntalam.com
    License: GPL2
    License URI: https://www.gnu.org/licenses/gpl-2.0.html
    Text Domain: wpb-tutorial
    Domain Path: /languages
    */

    /**
     * common vars for the plugin
     */
    include('config.php');
    
    /**
     * When the plugin is active...
     */
    include('activation.php');

    /**
     * For external access. Mobile App soon
     */
    include('endpoints.php');
    
?>