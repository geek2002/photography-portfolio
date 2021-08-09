<?php
    session_id(1);
    session_start();
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    session_destroy();

    echo "Email: " . $email;
    echo "Password: " . $password;
?>