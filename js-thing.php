<?php

$plugin_url = plugin_dir_url(__FILE__);
// include('database-procedures.php');
$sel = select_last_countdown_options('phrase');
if (isset($sel)) {
    $phrase = $sel->value;
} else {
    $phrase = 'ERROR LOADING LAST PHRASE (DOES IT EXIST?)';
}
$sel = select_last_countdown_options('color1');
if (isset($sel)) {
    $color1 = $sel->value;
} else {
    $color1 = 'ERROR LOADING COLOR 1 (DOES IT EXIST?)';
}
$sel = select_last_countdown_options('color2');
if (isset($sel)) {
    $color2 = $sel->value;
} else {
    $color2 = 'ERROR LOADING COLOR 2 (DOES IT EXIST?)';
}

?>
<script>
    var intervalId;

    function setCountdownDate(newDate, newPhrase) {
        var countDownDate = new Date("Nov 3, 2023 00:00:25").getTime();
        if (newDate) {
            countDownDate = new Date(newDate).getTime();
            console.log("countdowndate: ",countDownDate)
        }
        intervalId = setInterval(function() {
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
            if (newPhrase) {
                divAlert.innerHTML += newPhrase;
            } else {
                divAlert.innerHTML += '<?php echo $phrase; ?>';
            }

        }, 1000);
    }

    function stopInterval() {
        clearInterval(intervalId);
    }
    setCountdownDate()
</script>
<style>
    div.alert {
        background-color: pink;
        animation: change-color 3s infinite;
        font-weight: bold;
        padding: 10px;
    }


    @keyframes change-color {
        0% {
            background-color: <?php echo $color1; ?>;
        }

        50% {
            background-color: <?php echo $color2; ?>;
        }

        100% {
            background-color: <?php echo $color1; ?>;
        }
    }
</style>

<div class="alert" id="ntalam-div-alert">
    Clock Here!
</div>