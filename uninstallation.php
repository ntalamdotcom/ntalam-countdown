<?php 


function ntalam_countdown_on_uninstall()
{
    global $wpdb;
    $table_name = $wpdb->prefix . NTALAM_COUNTDOWN__TABLE_COUNTDOWN_OPTIONS;
    $sql = "DROP TABLE IF EXISTS '".NTALAM_COUNTDOWN__TABLE_COUNTDOWN_OPTIONS."'";
    add_action( 'admin_notices', function(){
        ?>
        <div class="notice notice-success is-dismissible">
            <p><?php _e( 'Done!', 'Plugin deactivated' ); ?></p>
        </div>
        <?php
    } );
}

register_uninstall_hook(__FILE__,'ntalam_countdown_on_uninstall');
?>