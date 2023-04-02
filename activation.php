<?php
require ABSPATH . 'wp-admin/includes/upgrade.php';

// $transientActivationSuccess = 'ntalam_countdown_admin_notice_'.get_current_user_id();
// $userId = get_current_user_id();
$baseApi = 'ntalam';
$endpointApi = '/menu';

function fx_admin_notice_example_notice(){
    global $baseApi;
    global $endpointApi;
    /* Check transient, if available display notice */
    if( get_transient( 'ntalam_countdown_admin_notice_'.get_current_user_id() ) ){
        ?>
        <div class="updated notice is-dismissible">
            <p>NTalam plugin has been installed.</p>
            <p><?php echo $baseApi.$endpointApi ?></p>
        </div>
        <?php 
        /* Delete transient, only display this notice once. */
        delete_transient('ntalam_countdown_admin_notice_'.get_current_user_id() );
    }
}

add_action( 'admin_notices', 'fx_admin_notice_example_notice' );
function sample_admin_notice__success() {
    ?>
    <div class="notice notice-success is-dismissible">
        <p><?php _e( 'Plugin Ntalam Activated!', 'sample-text-domain' ); ?></p>
    </div>
    <?php
}
function ntalam_countdown_activation_action()
{
    
    // global $transientActivationSuccess;
    set_transient( 'ntalam_countdown_admin_notice_'.get_current_user_id(), true, 10 );
    // set_transient( 'fx-admin-notice-exampleASDF', true, 500 );

    global $wpdb;
    $tablename = $wpdb->prefix .TABLE_countdown_options;
    $table_create = "CREATE TABLE `" . $tablename . "` (
        `id` bigint NOT NULL,
        `key` varchar NOT NULL,
        `value` value NOT NULL,
        `user_id` bigint NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";
        // echo $table_create;
    maybe_create_table($wpdb->prefix . $tablename, $table_create);  
    
}

register_activation_hook(NTALAM_COUNTDOWN__PLUGIN_DIR.'/ntalam-countdown.php', 'ntalam_countdown_activation_action');
function wpb_demo_shortcode() { 
  
    // Things that you want to do.
    $message = 'Hello world!'; 
      
    // Output needs to be return
    return $message;
    };
add_shortcode('ntalaCode','wpb_demo_shortcode');

function header_script(){
    $plugin_url = plugin_dir_url( __FILE__ );
    echo '<script src="'.$plugin_url.'timerNtalam.js">
    </script>
    <link rel="stylesheet" href="'.$plugin_url.'stylesTimerNtalam.css">
    <div class="alert" id="ntalam-div-alert">
        Clock Here!
    </div>
    ';
}
add_action( 'wp_enqueue_scripts', 'header_script' );

?>