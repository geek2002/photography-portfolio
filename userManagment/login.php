<?php
    
    session_start();
    $inEmail = $_POST['email'];
    $inPassword = $_POST['password'];

    echo "Input Email: " . $inEmail . "<br>";
    echo "Input Password: " . $inPassword . "<br>";

    try {
        include "../global/databaseConnection.php";
        $sql = "SELECT * FROM users WHERE user_email = '" . $inEmail . "'";
        $stmt = $pdo->query($sql);
        if($stmt->rowCount()){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            echo "Fetched Data <br>";
            print_r($row);
            echo "<br>";

            if (password_verify($inPassword, $row['user_password'])) {
                echo 'Password is valid!';
                echo "Checking User Type";
                $_SESSION['userID'] = $row['userID'];
                $_SESSION['fname'] = $row['user_fname'];
                $_SESSION['lname'] = $row['user_lname'];
                $_SESSION['username'] = $row['user_username '];
                if ($row['user_type'] == 0) {
                    echo "Normal user";
                    header("Location: ../userPages/normal.php");
                    exit;
                }elseif ($row['user_type'] == 1) {
                    echo "Admin user";
                    header("Location: ../userPages/admin.php");
                    exit;
                }
                echo "Redirecting...";

            } else {
                echo 'Invalid password.';
            }
        }else{
            return "No Data";
        }
    } catch (PDOException $errorMessage) {
        echo $errorMessage;
    }
?>