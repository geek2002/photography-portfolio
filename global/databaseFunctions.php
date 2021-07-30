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
            echo $errorMessage;
        }
    }    
?>