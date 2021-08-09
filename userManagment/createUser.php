<?php
    include "../global/databaseFunctions.php";
    include "../global/varables.php";

    function createRandomUserID(){
        while (true){
            $tempID = rand(0,9999999999);
            $available = checkID($tempID);
            if ($available == true){
                echo $tempID . "<br>";
                return $tempID;
                break;
            }
        }
    }

    // $new_user_id = createRandomUserID();
    // echo $new_user_id;



    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $action = $_POST['action'];
    try
    {
        include "../global/databaseConnection.php";
        $data = [
            'newuserid' => createRandomUserID(),
            'email' => $username,
            'username' => $username,
            'password' => $password,
            'fname' => $fname,
            'lname' => $lname
        ];
        $sql = "INSERT INTO users(userID, user_email, user_username, user_password, user_fname, user_lname  ) VALUES(:newuserid,:email,:username,:password,:fname,:lname)";
        // $sql = "INSERT INTO users (name, surname, sex) VALUES (:name, :surname, :sex)";
        $stmt= $pdo->prepare($sql);
        $stmt->execute($data);
        // if($runstatement)
        // {
        //     echo "Data entered into the database";
        //     if($action == "login"){
        //         session_id(1);
        //         session_start();
        //         $_SESSION['email'] = $email;
        //         $_SESSION['password'] = $password;
        //         header("Location: login.php");  
        //     }
        // }
    }
    catch(PDOException $errormessage)
    {
        echo "An error has occured, see the error details below <br>";
        echo $errormessage;
    }
    
?>