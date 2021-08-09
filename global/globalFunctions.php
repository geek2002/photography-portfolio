<?php
    include "databaseFunctions.php";
    include "varables.php";
    function globalDeleteAllImages($folder){
        include "varables.php";
        echo "Deleting folder: " . $folder . "<br>";
        $files = glob('../' . $globalUploadLocation . '/' . $folder . '/*'); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file)) {
                echo "  Deleting: " . $file . "<br>";
                unlink($file); // delete file
            }
        }
    }
    function back(){
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    if (isset($_POST['function'])){
        $function = $_POST['function'];
        echo "Function: " . $function . "<br>";
        switch ($function) {
            case 'globalDeleteAllImages':
                globalDeleteAllImages("original");
                globalDeleteAllImages("preview");
                globalDeleteAllImages("thumnail");
                clearTable("photos");
                back();
                break;
            default:
                # code...
                break;
        }
    }
    
    
?>