<?php
    session_start();
    $rootLocation = "../";
    include "../global/varables.php";
    include "../global/databaseFunctions.php";
    include "../global/globalFunctions.php";
    include "../includes/navbar.php";

    if(isset($_SESSION['userID']) == false){
        header("Location: ../?error=unauth");
        exit;
        echo "NOT";
    }
?>

        <div class="container">
            <div class="row">
                <?php
                    $ownedPhotos = getOwnedPhotos($_SESSION['userID']);
                    print_r($ownedPhotos);
                    foreach ($ownedPhotos as &$photoID) {
                        echo "PhotoID: " . $photoID . "<br>";
                        echo "<img style='width: 25%'src='../uploaded-Images/original/" . getPhotoFilename($photoID) . "' alt='" . getPhotoFilename($photoID) . "'>";
                    }
                ?>
            </div>