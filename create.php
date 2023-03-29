<?php
function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzQWERTYUIOPASDFGHJKLZXCVBNM1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
createFolder();

function createFolder() {
    $folderName = $_POST['alias'];
    if($folderName=="") {
        $folderName = randomPassword();
    }
    $url=$_POST['url'];
    if (!file_exists($folderName)) {
        mkdir($folderName);
        $file = fopen($folderName.'/index.php', 'w');
        $txt = "<?php header('Location: $url');?>";
        fwrite($file,$txt);
        echo "Your Shorten URL is: <br><input type='text' class='result' value='https://tiny.cu.ma/$folderName'><button onclick='copyurl(this)' class='copy'>copy url</button>";
    }
    else {
        if($folderName==""){
            createFolder();
        }
        else {
            echo "<strong style='font-size:18px'>This alias is already in use, try different</strong>";
        }
    }
}
?>