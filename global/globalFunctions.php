<?php
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
    function global_back($reference = null){
        if (isset($reference)) {
            header('Location: ' . $_SERVER['HTTP_REFERER'] . "?" . $reference);
        }else{
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } 
    }
    function createRandomUserID(){
        while (true){
            $tempID = rand(1111111111,9999999999);
            $available = checkID($tempID);
            if ($available == true){
                return $tempID;
                break;
            }
        }
    }
    function hideEmail($email){
        $var = '24';
        return $email;
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
                global_back();
                break;
            default:
                # code...
                break;
        }
    }
    
    
?>