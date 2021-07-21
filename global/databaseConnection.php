<?php
    $hostname = "localhost"; //where is the db - localhost means on your machine or server
    $databasename = "photography"; //name of our database
    $username = "Steven"; //username to log in with
    $password = "0elnb598OgTIE3ZO"; //password for the user

    $pdo = new PDO("mysql:host=$hostname;dbname=$databasename", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>