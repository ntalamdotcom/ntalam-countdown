<?php 

function header_script(){
$phrase = bringingPhrase();
    $plugin_url = plugin_dir_url( __FILE__ );
    // echo '<script src="'.$plugin_url.'timerNtalam.js">
    // </script>
    echo '<script>
    function countdown() {
        var countDownDate = new Date("Nov 3, 2023 00:00:25").getTime();
    
        // Update the count down every 1 second
        var x = setInterval(function () {
            // Get todays date and time
            var now = new Date().getTime();
    
            // Find the distance between now and the count down date
            var distance = countDownDate - now;
    
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            const divAlert = document.getElementById("ntalam-div-alert");
            divAlert.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s " '. $phrase.'
        }, 1000);
    }
    countdown();
    </script>';
    echo '
    <link rel="stylesheet" href="'.$plugin_url.'stylesTimerNtalam.css">
    <div class="alert" id="ntalam-div-alert">
        Clock Here!
    </div>
    ';
}
add_action( 'wp_enqueue_scripts', 'header_script' );
function bringingPhrase(){
    global $wpdb;
    $table_name = $wpdb->prefix . NTALAM_COUNTDOWN__TABLE_COUNTDOWN_OPTIONS;
    $current_user_id = get_current_user_id();
    $record = $wpdb->get_row( "SELECT * FROM $table_name WHERE user_id = $current_user_id", ARRAY_A );

    return $record;
}

?>