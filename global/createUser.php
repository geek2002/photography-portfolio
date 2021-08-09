<?php
    session_start();
    include "databaseFunctions.php";
    include "varables.php";
    $_SESSION['user_id'] = null;
    $_SESSION['user_username'] = null;

    function createRandomUserID(){
        while (true){
            $tempID = rand(0,9999999999);
            if (checkID($tempID)){
                return $tempID;
                break;
            }
        }
    }
    echo "ID: " . createRandomUserID();
    
?>