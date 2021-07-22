<?php
    function getDatabaseData($sql){
        try {
            include "databaseConnection.php";     
            $stmt = $pdo->query($sql);
            if($stmt->rowCount()){
                return $stmt;
            }
        } catch (PDOException $errorMessage) {
            echo $errorMessage;
        }
    }
    function clearTable($table){
        try {
            include "databaseConnection.php";  
            $sql = "TRUNCATE TABLE photos;";   
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        } catch (PDOException $errorMessage) {
            echo $errorMessage;
        }
    }    
?>