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
?>
<!-- $sql = "select * from customer INNER JOIN branch ON customer.cust_bran_ID = branch.bran_ID ORDER BY cust_ID"; -->