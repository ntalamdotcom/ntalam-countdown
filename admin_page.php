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
        echo '<p><a href="' . NTALAM_COUNTDOWN__API_NAMESPACE_ADDRESS . '" target="_blank">' . NTALAM_COUNTDOWN__API_NAMESPACE_ADDRESS . '</a></p>';
        echo '<p><a href="' . NTALAM_COUNTDOWN__API_NAMESPACE_ADDRESS.NTALAM_COUNTDOWN__ENDPOINT_SAVE_PHRASE . '" target="_blank">' . NTALAM_COUNTDOWN__API_NAMESPACE_ADDRESS.NTALAM_COUNTDOWN__ENDPOINT_SAVE_PHRASE . '</a></p>';
        echo '<p><a href="' . NTALAM_COUNTDOWN__API_NAMESPACE_ADDRESS.NTALAM_COUNTDOWN__ENDPOINT_SAVE_TIME_START . '" target="_blank">' . NTALAM_COUNTDOWN__API_NAMESPACE_ADDRESS.NTALAM_COUNTDOWN__ENDPOINT_SAVE_TIME_START . '</a></p>';
        // echo "<p>Terminal Endpoint: " . home_url('/ntalam-countdown/') . "</p>";
        ?>
    </div>
    <form method="post">
        <p><label for="w3review">CopyPaste a Linux command </label></p>
        <div id="buttonsContainer">
            <!-- <input id="buttonGetProcessByPort" name="isGettingProcessByPort" class="button" value="Getting Process By Port" /> -->
        </div>

        <p><label for="w3review">Write down your command here:</label></p>
        <textarea id="ntalamCommandTextArea" name="w3review" rows="4" cols="50"></textarea>
        <br>
        <!-- <input type="submit" value="Submit"> -->
        <input id="buttonSubmitAjax" type="button" class="button" value="Execute">
        <input id="buttonSubmitAjaxClear" type="button" class="button" value="Clear">
        <p>Response from terminal...:</p>
        <p id='responseArea'></p>
        <!-- <textarea id="responseArea" name="responseArea" rows="4" cols="50"></textarea> -->
        <br>
    </form>
    <script>
        var textArea = document.getElementById("ntalamCommandTextArea");
        var textAreaResponse = document.getElementById("responseArea");

        function copyPasteCommand(para) {

            textArea.innerHTML = textArea.innerHTML + para
            // console.log("copyPasteCommand")
        }
        // var gitMakingItSafe = "git config --global --add safe.directory 'REPLACE-THIS' 2> & 1"

        var gitMakingItSafe = ""

        function assignButtonById(buttonId, command) {
            var buttonMakingItSafe = document.getElementById(buttonId);
            if (buttonMakingItSafe) {
                buttonMakingItSafe.onclick = copyPasteCommand(gitMakingItSafe)
                buttonMakingItSafe.addEventListener("click", function() {
                    var textArea = document.getElementById("ntalamCommandTextArea");
                    textArea.innerHTML = textArea.innerHTML + command
                });
            } else {
                alert('null: ', buttonId)
                alert('null: ', command)
            }

        }

        var url = '<?php
                    echo $terminal_endpoint; ?>'
        var buttonSubmitAjax = document.getElementById("buttonSubmitAjax");
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
        var buttonSubmitAjaxClear = document.getElementById("buttonSubmitAjaxClear");
        buttonSubmitAjaxClear.addEventListener("click", function() {
            textArea.innerHTML = '';
        });

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
        window.onload = function() {
            // assignButtonById("buttonMakingItSafe", "git config --global --add safe.directory '/var/www/portfolio/portfolio'")
            // assignButtonById("buttonGetProcessByPort", 'lsof -t -i:3000') // your script goes here
            // assignButtonById("buttonGetProcessByPort", 'lsof -t -i:3000') // your script goes here
            var buttonsContainer = addButton('buttonsContainer', 'buttonIdSave', 'buttonNameSave', 'Save Phrase');
            buttonsContainer.addEventListener("click", function() {
               
            });
        };
    </script>
</div>