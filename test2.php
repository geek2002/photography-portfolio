<?php
    $passIn = "GreenCrab261";
    $passOut = password_hash($passIn,PASSWORD_DEFAULT);
    echo "Input Password: " . $passIn . "<br>";
    echo "Hashed Password: " . $passOut;

?>