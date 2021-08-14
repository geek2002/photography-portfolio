<?php
    include "includes/navbar.php";
    include "global/varables.php";
    include "global/databaseFunctions.php";


    $storedPassword = '$2y$10$K.sug9u3bgMwq64kI8r2zOqZIxLOXGtgjBHbtATRg.KGzNsY4QmVm'; 
    $inputPassword = "GreenCrab264";

    // echo password_hash($inputPassword,PASSWORD_DEFAULT);
    if (password_verify($inputPassword,$storedPassword)) {
        echo "Password Correct";
    }else{
        echo "Password Incorrect";
    }
?>
