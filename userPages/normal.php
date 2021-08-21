<?php
    session_start();
    include "../includes/navbar.php";
    include "../global/varables.php";
    include "../global/databaseFunctions.php";
?>

        <div class="container">
            <div class="row">
                <p>Your Current Tokens: <?php echo getTokens($_SESSION['userID']);?></p><br>
                <?php decreaseTokens($_SESSION['userID'], 100) ?><br>
                <p>Your New Tokens: <?php echo getTokens($_SESSION['userID']);?></p><br>
            </div>