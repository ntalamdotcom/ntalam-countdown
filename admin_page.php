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
?>
<script>
    
</script>
<div style="border: gray solid 1px;
    padding: 5px;">
    <h1> NTalam Countdown</h1>
    <form method="post">
        <p><label for="w3review">CopyPaste a GIT command </label></p>
        <div>
            <input id="buttonMakingItSafe" 
            name="isMakingItSafe" class="button" 
            value="Making it Safe"/>
           
            <input type="submit" name="isPulling" class="button" value="Pulling GIT" />
            <input type="submit" name="button2" class="button" value="Button2" />
        </div>
        <p><label for="w3review">CopyPaste a Linux command </label></p>
        <div>
            <input id="buttonGetProcessByPort" 
            name="isGettingProcessByPort" class="button" 
            value="Getting Process By Port"/>
            <input type="submit" name="isPulling" class="button" value="Pulling GIT" />
            <input type="submit" name="button2" class="button" value="Button2" />
        </div>
        <p><label for="w3review">CopyPaste a command </label></p>
        <div>
            <input type="submit" name="isMakingItSafe" class="button" value="Making it Safe" />
            <input type="submit" name="isPulling" class="button" value="Pulling GIT" />
            <input type="submit" name="button2" class="button" value="Button2" />
        </div>
        <input type="submit" name="isMakingItSafe" class="button" value="Making it Safe" />
        <input type="submit" name="isPulling" class="button" value="Pulling GIT" />
        <input type="submit" name="button2" class="button" value="Button2" />

        <p><label for="w3review">Write down your command here:</label></p>
        <textarea id="ntalamCommandTextArea" name="w3review" rows="4" cols="50"></textarea>
        <br>
        <!-- <input type="submit" value="Submit"> -->
        <input id="buttonSubmitAjax" type="button" class="button" value="Execute">
        <p><label for="w3review">Write down your command here:</label></p>
        <textarea id="responseArea" name="responseArea" rows="4" cols="50"></textarea>
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
        function assignButtonById(buttonId,command){
            var buttonMakingItSafe = document.getElementById(buttonId);
            buttonMakingItSafe.onclick = copyPasteCommand(gitMakingItSafe)
            buttonMakingItSafe.addEventListener("click", function(){
                var textArea = document.getElementById("ntalamCommandTextArea");
                textArea.innerHTML = textArea.innerHTML + command
            });
        }
        assignButtonById("buttonMakingItSafe","git config --global --add safe.directory '/var/www/portfolio/portfolio' 2>&1")
        assignButtonById("buttonGetProcessByPort",'lsof -t -i:3000 2>&1')
        var url = 'https://restservice.ntalam.com/wp-json/ntalam-linux-control/v1/terminal'
        var buttonSubmitAjax = document.getElementById("buttonSubmitAjax");
        buttonSubmitAjax.addEventListener("click", function(){
                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = () => {
                    if (xhr.readyState === 4) {
                        console.log(xhr.response);
                        textAreaResponse.innerHTML = xhr.response
                    }
                }
                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('com='+textArea.innerHTML);
            }
        );
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
    </script>
</div>