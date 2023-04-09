<?php

require ABSPATH . 'wp-admin/includes/upgrade.php';

include('installation.php');
// include('config.php');

add_action('admin_menu', 'ntalam_countdown_admin_menu');

function ntalam_countdown_admin_menu()
{
    add_menu_page('Ntalam-countdown', 'Ntalam Countdown', 'manage_options', 'ntalam-countdown', 'init_ntalam_countdown');
}

function init_ntalam_countdown()
{
    include('admin-page.php');
}

function fx_admin_notice_example_notice()
{
    /* Check transient, if available display notice */
    if (get_transient('ntalam_countdown_admin_notice_' . get_current_user_id())) {
?>
        <div class="updated notice is-dismissible">
            <p>NTalam plugin has been installed.</p>
        </div>
    <?php
        /* Delete transient, only display this notice once. */
        delete_transient('ntalam_countdown_admin_notice_' . get_current_user_id());
    }
    if (get_transient('ntalam_countdown_admin_error_notice_' . get_current_user_id())) {
    ?>
        <div class="error">
            <p>NTalam plugin has generated an error. Please check your log.</p>
        </div>
    <?php
        /* Delete transient, only display this notice once. */
        delete_transient('ntalam_countdown_admin_error_notice_' . get_current_user_id());
    }
}

add_action('admin_notices', 'fx_admin_notice_example_notice');
function sample_admin_notice__success()
{
    ?>
    <div class="notice notice-success is-dismissible">
        <p><?php _e('Plugin Ntalam Activated!', 'sample-text-domain'); ?></p>
    </div>
<?php
}

function wpb_demo_shortcode()
{

    // Things that you want to do.
    $message = 'Hello world!';

    // Output needs to be return
    return $message;
};
add_shortcode('ntalaCode', 'wpb_demo_shortcode');

function header_script()
{
    include('js-thing.php');
}
add_action('wp_enqueue_scripts', 'header_script');

?>