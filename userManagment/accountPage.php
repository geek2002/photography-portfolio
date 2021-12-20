<?php
    session_start();
    $rootLocation = "../";
    include "../global/varables.php";
    include "../global/databaseFunctions.php";
    include "../global/globalFunctions.php";
    include "../includes/navbar.php";

    if(isset($_SESSION['userID']) == false){
        header("Location: ../?error=unauth");
        exit;
        echo "NOT";
    }
?>
