<?php
    function back($reference = null){
        if (isset($reference)) {
            header('Location: ' . $_SERVER['HTTP_REFERER'] . "?" . $reference);
        }else{
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } 
    }
    function getDatabaseData($sql){
        try {
            include "databaseConnection.php";     
            $stmt = $pdo->query($sql);
            if($stmt->rowCount()){
                if ($stmt->rowCount() > 0) {
                    return $stmt;
                }
            }else{
                return "No Data";
            }
        } catch (PDOException $errorMessage) {
            echo "<samp>" . $errorMessage . "</samp>";
        }
    }
    function clearTable($table){
        try {
            include "databaseConnection.php";  
            $sql = "TRUNCATE TABLE photos;";   
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        } catch (PDOException $errorMessage) {
            echo "<samp>" . $errorMessage . "</samp>";
        }
    }
    function countPhotos($orientation=null){
        if ($orientation == null){
            $sql = "SELECT * FROM photos;"; 
        }else{         
            $sql = "SELECT * FROM photos WHERE photo_orientation='" . $orientation . "';"; 
        }
        $ids = array();
        try {
            include "databaseConnection.php";     
            $stmt = $pdo->query($sql);
            if($stmt->rowCount()){
                $data = $stmt;
                while($row = $data->fetch(PDO::FETCH_ASSOC)){
                    array_push($ids,$row['photo_id']);
                }
                $returnData = array($stmt->rowCount(), $ids);
                // print_r($returnData[1]);
                return $returnData;
            }
        } catch (PDOException $errorMessage) {
            echo "<samp>" . $errorMessage . "</samp>";
        }
    }
    function checkID($checkID){
        try {
            include "databaseConnection.php";  
            $sql = "SELECT userID FROM users WHERE userID = " . $checkID;   
            $stmt = $pdo->query($sql);
            if($stmt->rowCount()){
                $available = false;
            }else{
                $available = true;
            }
            // echo $available;
            return $available;
        } catch (PDOException $errorMessage) {
            echo "<samp>" . $errorMessage . "</samp>";
        }
    }
    function checkEmail($email){
        try {
            include "databaseConnection.php";  
            $sql = "SELECT user_email FROM users WHERE user_email = '" . $email . "'";   
            $stmt = $pdo->query($sql);
            if($stmt->rowCount()){
                $available = false;
            }else{
                $available = true;
            }
            echo $available;
            return $available;
        } catch (PDOException $errorMessage) {
            echo "<samp>" . $errorMessage . "</samp>";
        }
    }
    function getTokens($userID){
        try {
            include "databaseConnection.php";  
            $sql = "SELECT user_tokens FROM users WHERE userID = " . $userID;   
            $stmt = $pdo->query($sql);
            if($stmt->rowCount()){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $tokens = $row['user_tokens'];
                    return $tokens;
                }
            }else{
                echo "Error: No account found";
            }
            echo $available;
            return $available;
        } catch (PDOException $errorMessage) {
            echo "<samp>" . $errorMessage . "</samp>";
        }
    }
    function increaseTokens($userID,$ammount){
        $currentTokens = getTokens($userID);
        $newTokens = $currentTokens + $ammount;
        
        try {
            include "databaseConnection.php";  
            $sql = "UPDATE users SET user_tokens = :tokens WHERE userID = :userID";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':tokens',$newTokens);
            $stmt->bindValue(':userID',$userID);
            $stmt->execute();
            echo $stmt->rowCount() . " records UPDATED successfully";
        } catch (PDOException $errorMessage) {
            echo "<samp>" . $errorMessage . "</samp>";
        }
    }
    function decreaseTokens($userID,$ammount){
        $currentTokens = getTokens($userID);
        $newTokens = $currentTokens - $ammount;
        
        try {
            include "databaseConnection.php";  
            $sql = "UPDATE users SET user_tokens = :tokens WHERE userID = :userID";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':tokens',$newTokens);
            $stmt->bindValue(':userID',$userID);
            $stmt->execute();
            echo $stmt->rowCount() . " records UPDATED successfully";
        } catch (PDOException $errorMessage) {
            echo "<samp>" . $errorMessage . "</samp>";
        }
    }

    function getOwnedPhotos($userID){
        try {
            include "databaseConnection.php";  
            $sql = "SELECT photoID FROM user_photo_link WHERE userID = " . $userID;   
            $stmt = $pdo->query($sql);
            if($stmt->rowCount()){
                $photos = [];
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $photoID = $row['photoID'];
                    array_push($photos, $photoID);
                }
                return $photos;
            }else{
                echo "<samp> Error: No Photos found </samp>";
            }
        } catch (PDOException $errorMessage) {
            echo "<samp>" . $errorMessage . "</samp>";
        }
    }
    function getPhotoFilename($photoID){
        try {
            include "databaseConnection.php";  
            $sql = "SELECT photo_uploadedFileName FROM photos WHERE photoID = " . $photoID;   
            $stmt = $pdo->query($sql);
            if($stmt->rowCount()){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $filename = $row['photo_uploadedFileName'];
                    return $filename . ".jpg";
                }
            }else{
                echo "Error: No Photo found";
            }
        } catch (PDOException $errorMessage) {
            echo "<samp>" . $errorMessage . "</samp>";
        }
    }
    function getCatagories(){
        try {
            include "databaseConnection.php";  
            $sql = "SELECT * FROM categories";   
            $stmt = $pdo->query($sql);
            if($stmt->rowCount()){
                $catagories = [];
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $cataID = $row['cataID'];
                    array_push($catagories, $cataID);
                }
                return $catagories;
            }else{
                echo "<samp> Error: No Photos found </samp>";
            }
        } catch (PDOException $errorMessage) {
            echo "<samp>" . $errorMessage . "</samp>";
        }
    }
    function getCatagoryName($cataID){
        try {
            include "databaseConnection.php";  
            $sql = "SELECT cata_name FROM categories WHERE cataID = " . $cataID;   
            $stmt = $pdo->query($sql);
            if($stmt->rowCount()){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $name = $row['cata_name'];
                    return $name;
                }
            }else{
                echo "Error: No Catagories found";
            }
        } catch (PDOException $errorMessage) {
            echo "<samp>" . $errorMessage . "</samp>";
        }
    }
    function getEmail($userID){
        try {
            include "databaseConnection.php";  
            $sql = "SELECT user_email FROM users WHERE userID = " . $userID;   
            $stmt = $pdo->query($sql);
            if($stmt->rowCount()){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $email = $row['user_email'];
                    return $email;
                }
            }else{
                echo "Error: No Email found";
            }
        } catch (PDOException $errorMessage) {
            echo "<samp>" . $errorMessage . "</samp>";
        }
    }



    if (isset($_POST['func'])){
        $tokenAmmount = $_POST['func'];
    }
    if (isset($_POST['func'])){
        $function = $_POST['func'];
        echo "Function: " . $function . "<br>";
        switch ($function) {
            case 'incrToken':
                increaseTokens($_SESSION['userID'],$tokenAmmount);
                back();
                break;
            case 'descToken':
                decreaseTokens($_SESSION['userID'],$tokenAmmount);
                back();
                break;
            default:
                # code...
                break;
        }
    }
?>

