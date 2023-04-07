<?php
// global $wp;
// $current_url = $wp->request;
// echo 'currentasdfasfdf'. $current_url;
// if ($_POST) {
//     // echo 'posting... ';
//     $isPulling = $_POST['isPulling'];
//     if (isset($isPulling)) {
//         exec("git -C '/var/www/portfolio/portfolio' pull 2>&1", $output, $retval);
//         // echo "Returned with status $retval and output:\n";
//         print_r($output);
//     }

//     $isMakingItSafe = $_POST['isMakingItSafe'];
//     if (isset($isMakingItSafe)) {
//         exec("git config --global --add safe.directory '/var/www/portfolio/portfolio' 2>&1", $output, $retval);
//         // echo "Returned with status $retval and output:\n";
//         print_r($output);
//     }
//     $isGettingProcessByPort = $_POST['isGettingProcessByPort'];
//     if (isset($isGettingProcessByPort)) {
//         exec("git config --global --add safe.directory '/var/www/portfolio/portfolio' 2>&1", $output, $retval);
//         // echo "Returned with status $retval and output:\n";
//         print_r($output);
//     }
// }
$webUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
$host = $_SERVER['HTTP_HOST'];
// $terminal_endpoint = $protocol . "://" . $host . '/wp-json/' . NTALAM_COUNTDOWN__API_NAMESPACE . '/v1/terminal';
// echo "<p>".$protocol.'://'.$_SERVER['HTTP_HOST']."</p>";
// include('config.php');
// Register the AJAX action
// include('wp-load.php');

add_action('wp_ajax_my_ajax_action', 'my_ajax_function');

// Handle the AJAX request
function my_ajax_function()
{
    $response = array('message' => 'Hello from the server!');
    wp_send_json_success($response);
}

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
    <script>
        var textArea = document.getElementById("ntalamCommandTextArea");
        var textAreaResponse = document.getElementById("responseArea");

        var gitMakingItSafe = ""

        function assignButtonById(buttonId, command) {
            var buttonMakingItSafe = document.getElementById(buttonId);
            if (buttonMakingItSafe) {
                buttonMakingItSafe.onclick = copyPasteCommand(gitMakingItSafe)
                buttonMakingItSafe.addEventListener("click", function() {
                    // textArea = document.getElementById("ntalamCommandTextArea");
                    textArea.value = textArea.value + command
                });
            } else {
                alert('null: ', buttonId)
                alert('null: ', command)
            }

        }

        var url = '<?php
                    echo NTALAM_COUNTDOWN__API_NAMESPACE_ADDRESS; ?>'

        function buttonSubmitAjaxFunction() {
            var buttonSubmitAjax = document.getElementById("buttonSubmitAjax");
            if (!buttonSubmitAjax) {
                alert('null: ')
            }
            buttonSubmitAjax.addEventListener("click", function() {
                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = () => {
                    if (xhr.readyState === 4) {
                        console.log(xhr.response);
                        textAreaResponse.innerHTML = xhr.response
                    }
                }
                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('com=' + textArea.innerHTML);
            });
        }
        // var buttonSubmitAjaxClear = document.getElementById("buttonSubmitAjaxClear");
        // buttonSubmitAjaxClear.addEventListener("click", function() {
        //     textArea.innerHTML = '';
        // });

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
            xmlhttp.open("POST", '/ajax-endpoints.php', true);

            xmlhttp.send('action=save-phrase');
        }

        window.onload = function() {
            var buttonNameSave = addButton('buttonsContainer', 'buttonIdSave', 'buttonNameSave', 'Save Phrase');
            buttonNameSave.addEventListener("click", function() {
                localAjaxRequest(function(t) {
                    textAreaResponse.value = t
                })
            });
            var buttonClear2 = addButton('buttonsContainer', 'buttonIdClear', 'buttonClear2', 'Clear2');
            buttonClear2.addEventListener("click", function() {
                document.getElementById("ntalamCommandTextArea").value = '';
            });

            var buttonClear22 = addButton('buttonsContainer', 'buttonIdClear2', 'buttonClear22', 'Clear22');
            buttonClear22.addEventListener('click', function() {

                // Create a new XMLHttpRequest object
                const xhr = new XMLHttpRequest();

                // Set the AJAX action and the data to send
                const action = 'my_ajax_action';
                const data = 'action=' + action;
                console.log(ajaxurl)
                // Open the XMLHttpRequest and set the request method to POST
                xhr.open('POST', ajaxurl, true);

                // Set the request header to indicate that we're sending form data
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

                // Add an event listener to the XMLHttpRequest object to handle the response
                xhr.addEventListener('load', function() {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        console.log(response.message);
                    }
                });

                // Send the AJAX request with the data
                xhr.send(data);
            });
            getEndPoints('<?php echo NTALAM_COUNTDOWN__API_NAMESPACE_ADDRESS; ?>')
        };


        // Add a click event listener to the button
    </script>
</div>