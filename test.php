<?php
    include "includes/navbar.php";
    include "global/varables.php";
    include "global/databaseFunctions.php";
?>

        <div class="container">
                <?php
                    $data = countPhotos("L");
                    echo "<p> Landscape: " . $data[0] . "</p>";
                    echo "Landscape IDs: ";
                    print_r($data[1]);
                    $data = countPhotos("P");
                    echo "<p> Portrait: " . $data[0] . "</p>";
                    echo "Portrait IDs: ";
                    print_r($data[1]);
                ?>