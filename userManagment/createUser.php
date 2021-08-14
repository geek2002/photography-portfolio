<?php
    include "../global/globalFunctions.php";

    
    $inId = createRandomUserID();
    $inEmail = $_POST['email'];
    $inUsername = $_POST['username'];
    $inPassword = $_POST['password'];
    $inFname = $_POST['fname'];
    $inLname = $_POST['lname'];
    $inUserType = $_POST['userType'];

    $hashedPassword = password_hash($inPassword , PASSWORD_DEFAULT);
    echo "ID: " . $inId . "<br>";
    echo "Email: " . $inEmail . "<br>";
    echo "Username: " . $inUsername . "<br>";
    echo "Password: " . $inPassword . "<br>";
    echo "Hashed Password: " . $hashedPassword . "<br>";
    echo "First Name: " . $inFname . "<br>";
    echo "Last Name: " . $inLname . "<br>";
    echo "User Type: " . $inUserType . "<br>";

    if (checkEmail($inEmail)) {
       echo "Email Available";
    }else{
        echo "Email already in use";
        global_back("Email Already in use");
        exit;
    }

    try
    {
        include "../global/databaseConnection.php";
        $data = [
            'newuserid' => $inId,
            'email' => $inEmail,
            'username' => $inUsername,
            'password' => $hashedPassword,
            'fname' => $inFname,
            'lname' => $inLname,
            'userType' => $inUserType
        ];
        $sql = "INSERT INTO users(userID, user_email, user_username, user_password, user_fname, user_lname, user_type) VALUES(:newuserid,:email,:username,:password,:fname,:lname,:userType)";
        $stmt= $pdo->prepare($sql);
        $stmt->execute($data);
        if ($stmt){
            echo "Data entered into the database sucsessfully";

        }

    }catch(PDOException $errormessage){
        echo "An error has occured, see the error details below <br>";
        echo $errormessage;
    }
?>