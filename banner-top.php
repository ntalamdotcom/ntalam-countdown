<?php 

// function wpb_demo_shortcode() { 
  
//     // Things that you want to do.
//     $message = 'Hello world!'; 
      
//     // Output needs to be return
//     return $message;
// };
// add_shortcode('ntalaCode','wpb_demo_shortcode');

function header_ntalam_countdown(){
    echo '
    <script src="'.plugin_dir_url(__FILE__).'timerNtalam.js">
    </script>
    <link rel="stylesheet" href="'.plugin_dir_url(__FILE__).'stylesTimerNtalam.css">
    <div class="alert" id="ntalam-div-alert">
        Clock Here!
    </div>
    ';
}
add_action( 'wp_enqueue_scripts', 'header_ntalam_countdown' );
?>