<?php

$webUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
$host = $_SERVER['HTTP_HOST'];

$sel = select_last_countdown_options('color1');
if (isset($sel)) {
    $color1Form = $sel->value;
} else {
    $color1Form = 'ERROR LOADING COLOR 1 (DOES IT EXIST?)';
}
$sel = select_last_countdown_options('color2');
if (isset($sel)) {
    $color2Form = $sel->value;
} else {
    $color2Form = 'ERROR LOADING COLOR 1 (DOES IT EXIST?)';
}
$sel = select_last_countdown_options('deadline');
if (isset($sel)) {
    $deadline = $sel->value;
} else {
    $deadline = '2018-07-22';
}
$sel = select_last_countdown_options('textColor');
if (isset($sel)) {
    $textColor = $sel->value;
} else {
    $textColor = '2018-07-22';
}

?>
<style>
    .loader {
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 100px;
        height: 100px;
        -webkit-animation: spin 2s linear infinite;
        /* Safari */
        animation: spin 2s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /*
    */
</style>
<div style="border: gray solid 1px;
    padding: 5px;">
    <h1> NTalam Countdown</h1>
    <div>
        <?php
        // echo home_url().'/wp-json/'.NTALAM_COUNTDOWN__API_NAMESPACE;
        // echo "<p>Page URL: " . $webUrl . "</p>";
        // echo "<p>Protocol URL: " . $protocol . "</p>";
        // echo "<p>Host: " . $host . "</p>";
        // echo "<p>SERVER_ADDR: " . $_SERVER['SERVER_ADDR'] . "</p>";
        // echo "<p>home_url(): " . home_url() . "</p>";
        // echo "<p>SERVER_NAME: " . $_SERVER['SERVER_NAME'] . "</p>";
        // echo "<p>REQUEST_URI: " . $_SERVER['REQUEST_URI'] . "</p>";
        // echo '<p><a href="' . NTALAM_COUNTDOWN__API_NAMESPACE_ADDRESS . '" target="_blank">' . NTALAM_COUNTDOWN__API_NAMESPACE_ADDRESS . '</a></p>';
        // echo '<p><a href="' . NTALAM_COUNTDOWN__API_NAMESPACE_ADDRESS . NTALAM_COUNTDOWN__ENDPOINT_SAVE_PHRASE . '" target="_blank">' . NTALAM_COUNTDOWN__API_NAMESPACE_ADDRESS . NTALAM_COUNTDOWN__ENDPOINT_SAVE_PHRASE . '</a></p>';
        // echo '<p><a href="' . NTALAM_COUNTDOWN__API_NAMESPACE_ADDRESS . NTALAM_COUNTDOWN__ENDPOINT_SAVE_TIME_START . '" target="_blank">' . NTALAM_COUNTDOWN__API_NAMESPACE_ADDRESS . NTALAM_COUNTDOWN__ENDPOINT_SAVE_TIME_START . '</a></p>';
        // echo '<h2>Endpoints</h2>';
        // echo '<p id="treeEndpoints"></p>';
        // echo '<p >'.rest_url().'</p>';
        // echo ;
        // echo "<p>Terminal Endpoint: " . home_url('/ntalam-countdown/') . "</p>";
        ?>
    </div>
    <form method="post" id='formId'>
        <h2>Endpoints (external access)</h2>
        <p id="treeEndpoints"></p>
        <h2>Write a countdown description</h2>
        <textarea id="ntalamCommandTextArea" wrap="off" name="w3review" rows="1" cols="50"></textarea>
        <div id="buttonsContainer">
            <!-- <input id="buttonGetProcessByPort" name="isGettingProcessByPort" class="button" value="Getting Process By Port" /> -->
        </div>
        <div>
            <label for="color1">Color 1</label>
            <input type="color" id="inputColor1" name="color1" value="<?php echo $color1Form; ?>">

            <label for="head">Color 2</label>
            <input type="color" id="inputColor2" name="head" value="<?php echo $color2Form; ?>">
            <label for="head">Text Color</label>
            <input type="color" id="inputTextColor" name="textColor" value="<?php echo $textColor; ?>">

        </div>
        <div>
            <label for="start">Deadline:</label>
            <!-- <div><?php echo $deadline; ?></div> -->
            <input type="datetime-local" id="inputDeadline" name="trip-start" value="<?php echo $deadline; ?>">
        </div>

        <?php
        // add_thickbox();
        ?>
        <!-- <div id="my-content-id" style="display:none;pointer-events: none;">
            <div>
                <div class="loader"></div>
                <p>
                    Please Hold
                </p>
            </div>
        </div>
        <a href="#TB_inline?&width=200&height=250&inlineId=my-content-id" class="thickbox">View my inline content!</a> -->
    </form>
    <?php include('js-thing.php'); ?>
    <script>
        var textAreaInput = document.getElementById("ntalamCommandTextArea");
        textAreaInput.value = '<?php echo $phrase; ?>'


        var ntalamDivAlert = document.getElementById("ntalam-div-alert");
        var inputColor1 = document.getElementById("inputColor1");
        var inputColor2 = document.getElementById("inputColor2");
        var inputTextColor = document.getElementById("inputTextColor");

        function load(url) {
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = () => {
                if (xhr.readyState === 4) {
                    console.log(xhr.response);
                    // callback(xhr.response);
                }
            }
            xhr.open('GET', url, true);
            xhr.send('');
        }

        function addButton(containerId, buttonId, buttonName, buttonText) {
            var buttonsContainer = document.getElementById(containerId);
            var button = document.createElement("input");
            button.type = 'button';
            button.value = buttonText;
            button.innerHTML = "Click me!";
            button.className = "button";
            button.name = buttonName;
            button.id = buttonId;
            button.addEventListener("click", function() {
                //     alert("Button clicked!");
            });
            buttonsContainer.appendChild(button);
            return button;
            // textArea.innerHTML += `<input id="${buttonId}" name="${buttonName}" class="button" value="Getting Process By Port" />`;
        }


        function getEndPoints(url) {
            var xhr = new XMLHttpRequest();
            xhr.onload = function() {
                // alert('asdf')
                var status = xhr.status;
                var treeEndpoints = document.getElementById('treeEndpoints');
                var res = xhr.response
                if (status === 200) {
                    // 

                    // p_route.innerHTML = JSON.stringify(res['routes']);
                    var routes = res['routes']
                    for (var key in routes) {
                        //    console.log(key)
                        var p_route = document.createElement("p");
                        var a_route = document.createElement("a");

                        var link = '<?php echo rest_url(); ?>' + key.substring(1)
                        a_route.innerHTML = link
                        a_route.href = link
                        a_route.target = "_new"
                        p_route.appendChild(a_route)
                        treeEndpoints.appendChild(p_route)
                    }

                } else {
                    // console.log('asdfsadsd')
                    console.log(status, xhr.response);
                }
            };
            xhr.responseType = 'json';
            xhr.open('GET', url, true);
            xhr.send();
        }

        function localAjaxRequest(callback) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    callback(this)
                } else {
                    callback(this.status)
                    // textAreaResponse.value = this.status
                }
            };
            xmlhttp.open("GET", '/ajax-endpoints.php', true);
            xmlhttp.send('action=save-phrase');
        }

        function ajaxRequest(data, callback) {
            toggleActiveAllInputs(true)
            const xhr = new XMLHttpRequest();
            xhr.open('POST', ajaxurl);
            console.log('ajaxurl: ', ajaxurl)
            xhr.onload = function() {
                // console.log(xhr)
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // console.log(response.message);
                        // console.log('response: ', response);
                        if (callback) {
                            callback()
                        }
                    } else {
                        console.log(response.data);
                    }
                } else {
                    console.log('Error: ' + xhr.statusText);
                }
                toggleActiveAllInputs(false)
            };
            xhr.send(data);
        }

        function updateColor() {
            const styleSheets = document.styleSheets;
            for (let i = 0; i < styleSheets.length; i++) {
                const styleSheet = styleSheets[i];
                for (let j = 0; j < styleSheet.cssRules.length; j++) {
                    const cssRule = styleSheet.cssRules[j];
                    if (cssRule.type === window.CSSRule.KEYFRAMES_RULE && cssRule.name === 'change-color') {
                        const keyframesRule = cssRule;
                        keyframesRule.cssRules[0].style.backgroundColor = inputColor1.value;
                        keyframesRule.cssRules[1].style.backgroundColor = inputColor2.value;
                        keyframesRule.cssRules[2].style.backgroundColor = inputColor1.value;
                    }
                }
            }
            ntalamDivAlert.style.color = inputTextColor.value;
            console.log('colors update')
        }

        var inputDeadline = document.getElementById("inputDeadline");

        function toggleActiveAllInputs(valueBool) {
            const form = document.querySelector('#formId');
            form.querySelectorAll('input, button').forEach((el) => {
                el.disabled = valueBool;
            });
        }

        window.onload = function() {
            inputColor1.addEventListener('blur', function() {
                const color = this.value;
                const data = new FormData();
                data.append('action', '<?php echo NTALAM_COUNTDOWN__AJAX_ACTION_SAVE_COLOR_1; ?>');
                data.append('color1', color);
                ajaxRequest(data, updateColor())
            });
            inputColor2.addEventListener('blur', function() {
                const color = this.value;
                // console.log(color)
                const data = new FormData();
                data.append('action', '<?php echo NTALAM_COUNTDOWN__AJAX_ACTION_SAVE_COLOR_2; ?>');
                data.append('color2', color);
                ajaxRequest(data, updateColor())
            });
            inputTextColor.addEventListener('blur', function() {
                const color = this.value;
                // console.log(color)
                const data = new FormData();
                data.append('action', '<?php echo NTALAM_COUNTDOWN__AJAX_ACTION_SAVE_TEXT_COLOR; ?>');
                data.append('textColor', color);
                ajaxRequest(data, updateColor())
            });
            var buttonClear = addButton('buttonsContainer', 'buttonIdClear', 'buttonClear', 'Clear');
            buttonClear.addEventListener("click", function() {
                document.getElementById("ntalamCommandTextArea").value = '';
            });

            var buttonSavePhrase = addButton('buttonsContainer', 'buttonIdClear2', 'buttonClear22', 'Save Phrase');
            buttonSavePhrase.addEventListener('click', function() {
                // toggleActiveAllInputs(true)
                var valText = textAreaInput.value;
                const data = new FormData();
                data.append('action', '<?php echo NTALAM_COUNTDOWN__AJAX_ACTION_SAVE_PHRASE; ?>');
                data.append('phrase', valText);
                ajaxRequest(data, function() {
                    stopInterval()
                    setCountdownDate(null, valText)
                    // toggleActiveAllInputs(false)
                });

            });

            inputDeadline.addEventListener('input', function() {
                // toggleActiveAllInputs(true)
                var valDate = inputDeadline.value;
                const data = new FormData();
                data.append('action', '<?php echo NTALAM_COUNTDOWN__AJAX_ACTION_SAVE_DEADLINE; ?>');
                data.append('deadline', valDate);
                ajaxRequest(data, function() {
                    stopInterval()
                    setCountdownDate(valDate, null)
                    // toggleActiveAllInputs(false)
                });
            });

            getEndPoints('<?php echo NTALAM_COUNTDOWN__API_NAMESPACE_ADDRESS; ?>')
            updateColor()
        };
    </script>
</div>