<html>
    <body>
        <h1>Account Managment Page</h1>
        <h2>Welcome User ID: 
        <?php
            session_start();
            echo $_SESSION['userID'];
        ?>
        </h2>
    </body>
</html>