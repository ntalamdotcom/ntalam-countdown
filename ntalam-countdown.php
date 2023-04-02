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

    define('NTALAM_COUNTDOWN_VERSION', '0.1');
    define('NTALAM_COUNTDOWN__MINIMUM_WP_VERSION', '7.0');
    define('NTALAM_COUNTDOWN__PLUGIN_DIR', plugin_dir_path(__FILE__));
    define('NTALAM_COUNTDOWN_DELETE_LIMIT', 10000);

    define('TABLE_countdown_options','ntalam_countdown_options');

    include('activation.php');

    include('deactivation.php');
    include('login-endpoint.php');
    add_action('admin_menu', 'ntalam_countdown_admin_menu');

    function ntalam_countdown_admin_menu()
    {
        add_menu_page('Ntalam-countdown', 'Ntalam Countdown', 'manage_options', 'ntalam-countdown', 'init_ntalam_countdown');
    }

    function init_ntalam_countdown()
    {
        include('admin_page.php');
}
?>