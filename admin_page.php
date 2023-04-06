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
$terminal_endpoint = $protocol . "://" . $host . '/wp-json/' . NTALAM_COUNTDOWN__API_NAMESPACE . '/v1/terminal';
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
        echo "<p>Page URL: " . $webUrl . "</p>";
        echo "<p>Protocol URL: " . $protocol . "</p>";
        echo "<p>Host: " . $host . "</p>";
        echo '<a href="' . $terminal_endpoint . '" target="_blank">' . NTALAM_COUNTDOWN__API_NAMESPACE . '/v' . NTALAM_COUNTDOWN__ENDPOINT_VERSION . '</a>';
        echo "<p>Terminal Endpoint: " . $terminal_endpoint . "</p>";
        ?>
    </div>
    <form method="post" id='adminForm'>
        <p><label for="w3review">CopyPaste a Linux command </label></p>
        <div>
            <input id="buttonGetProcessByPort" name="isGettingProcessByPort" class="button" value="Getting Process By Port" />
        </div>

        <p>Write down your countdown phrase here:</p>
        <textarea id="ntalamCommandTextArea" name="w3review" rows="4" cols="50"></textarea>
        <br>
        <!-- <input type="submit" value="Submit"> -->
        <div id='ajaxAreaDiv'>
            <input id="buttonSubmitAjax" type="button" class="button" value="Execute">
            <input id="buttonSubmitAjaxClear" type="button" class="button" value="Clear">
        </div>

        <p>Visualization:</p>

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
            buttonMakingItSafe.onclick = copyPasteCommand(gitMakingItSafe)
            buttonMakingItSafe.addEventListener("click", function() {
                var textArea = document.getElementById("ntalamCommandTextArea");
                textArea.innerHTML = textArea.innerHTML + command
            });
        }
        // assignButtonById("buttonMakingItSafe", "git config --global --add safe.directory '/var/www/portfolio/portfolio'")
        assignButtonById("buttonGetProcessByPort", 'lsof -t -i:3000')
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

        function addButton(containerId, commandParameter, buttonId, stringValue) {
            var buttonContainer = document.getElementById(containerId);
            buttonContainer.innerHTML += '<input id="' + buttonId +
                '" type="button" class="button" value="' + stringValue + '">'

            assignButtonById(buttonId, commandParameter)
        }
        addButton('ajaxAreaDiv','savePhrase','buttonSavePhrase','Save Phrase')
        
    </script>
</div>