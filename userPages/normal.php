<?php
    // session_start();
    include "../includes/navbar.php";
    include "../global/varables.php";
    include "../global/databaseFunctions.php";
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