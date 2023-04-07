<?php 
	define('NTALAM_COUNTDOWN_VERSION', '0.1');
    define('NTALAM_COUNTDOWN__ENDPOINT_VERSION', '1');
    define('NTALAM_COUNTDOWN__MINIMUM_WP_VERSION', '7.0');
    
	if(function_exists('plugin_dir_path')){
		define('NTALAM_COUNTDOWN__PLUGIN_DIR', plugin_dir_path(__FILE__));
	}
	
    
	
	define('NTALAM_COUNTDOWN__API_NAMESPACE', 'ntalam-countdown');
	define('NTALAM_COUNTDOWN__TABLE_COUNTDOWN_OPTIONS','ntalam_countdown_options');

	if(function_exists('home_url')){
		define('NTALAM_COUNTDOWN__API_NAMESPACE_ADDRESS',home_url().'/wp-json/'.NTALAM_COUNTDOWN__API_NAMESPACE.'/v'.NTALAM_COUNTDOWN__ENDPOINT_VERSION);
	}
	
	define('NTALAM_COUNTDOWN__ENDPOINT_SAVE_PHRASE','/save-phrase');
	define('NTALAM_COUNTDOWN__ENDPOINT_SIGN_IN','/sign-in');
	define('NTALAM_COUNTDOWN__ENDPOINT_SAVE_TIME_START','/save-time-start');