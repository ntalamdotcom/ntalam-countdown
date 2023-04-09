<?php

$plugin_url = plugin_dir_url(__FILE__);
// include('database-procedures.php');
$sel = select_last_countdown_options();
// echo print_r($sel)
?>
<script>
    var countDownDate = new Date("Nov 3, 2023 00:00:25").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {
        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        const divAlert = document.getElementById("ntalam-div-alert");
        divAlert.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
        divAlert.innerHTML += '<?php echo $sel->value; ?>'
    }, 1000);
</script>
<link rel="stylesheet" href="<?php echo $plugin_url; ?>stylesTimerNtalam.css">
<div class="alert" id="ntalam-div-alert">
    Clock Here!
</div>