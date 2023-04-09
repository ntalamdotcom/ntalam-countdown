<?php

$webUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
$host = $_SERVER['HTTP_HOST'];

?>
<script>

</script>
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
        echo '<h2>Endpoints</h2>';
        echo '<p id="treeEndpoints"></p>';
        // echo '<p >'.rest_url().'</p>';
        // echo ;
        // echo "<p>Terminal Endpoint: " . home_url('/ntalam-countdown/') . "</p>";
        ?>
    </div>
    <form method="post">
        <h2>Write a countdown description</h2>
        <textarea id="ntalamCommandTextArea" name="w3review" rows="4" cols="50"></textarea>
        <div id="buttonsContainer">
            <!-- <input id="buttonGetProcessByPort" name="isGettingProcessByPort" class="button" value="Getting Process By Port" /> -->
        </div>

        <br>
        <!-- <input type="submit" value="Submit"> -->
        <!-- <input id="buttonSubmitAjax" type="button" class="button" value="Execute"> -->
        <!-- <input id="buttonSubmitAjaxClear" type="button" class="button" value="Clear"> -->
        <p>Response from terminal...:</p>
        <p id='responseArea'></p>
        <!-- <textarea id="responseArea" name="responseArea" rows="4" cols="50"></textarea> -->
        <br>
    </form>
    <!-- <form id="my-form">
        <input type="text" id="name" name="name" placeholder="Enter your name">
        <input type="text" id="age" name="age" placeholder="Enter your age">
        <button type="submit">Submit</button>
    </form> -->
    <script>
        var textAreaInput = document.getElementById("ntalamCommandTextArea");
        var textAreaResponse = document.getElementById("responseArea");

        var gitMakingItSafe = ""

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

        function ajaxRequest(data) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', ajaxurl);
            console.log('ajaxurl: ', ajaxurl)
            xhr.onload = function() {
                // console.log(xhr)
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);

                    if (response.success) {
                        // console.log(response.message);
                        console.log('response: ', response);
                    } else {
                        console.log(response.data);
                    }
                } else {
                    console.log('Error: ' + xhr.statusText);
                }
            };
            xhr.send(data);
        }

        window.onload = function() {

            var buttonClear = addButton('buttonsContainer', 'buttonIdClear', 'buttonClear', 'Clear');
            buttonClear.addEventListener("click", function() {
                document.getElementById("ntalamCommandTextArea").value = '';
            });

            var buttonClear22 = addButton('buttonsContainer', 'buttonIdClear2', 'buttonClear22', 'Clear22');
            buttonClear22.addEventListener('click', function() {
                const name = 'nameInput.value';
                const data = new FormData();
                data.append('action', '<?php echo NTALAM_COUNTDOWN__AJAX_ACTION_SAVE_PHRASE; ?>');
                data.append('phrase', textAreaInput.value);
                ajaxRequest(data)
            });
            getEndPoints('<?php echo NTALAM_COUNTDOWN__API_NAMESPACE_ADDRESS; ?>')
        };
    </script>
</div>