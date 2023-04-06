<?php 

add_action( 'uninstall_plugin', 'custom_uninstall_message' );
function custom_uninstall_message( $plugin ) {
        wp_die( 'Are you sure you want to uninstall this plugin? This action cannot be undone.',
        'Warning '.$plugin );
        global $wpdb;
        $table_name = $wpdb->prefix . 'custom_table';
        $wpdb->query( "DROP TABLE IF EXISTS '".NTALAM_COUNTDOWN__TABLE_COUNTDOWN_OPTIONS."'" );
        
}

?>