<?php
    include "includes/navbar.php";
    include "global/varables.php";
    include "global/databaseFunctions.php";
?>

        <div class="container">
            <div class="row">
        <?php
            $portraitImages = countPhotos("P");
            $landscapeImages = countPhotos("L");
            $totalImages = (intval($portraitImages[0]) + intval($landscapeImages[0]));
            // print_r($portraitImages[1]);
            $data = getDatabaseData("select * from photos INNER JOIN categories ON photos.photo_cata_id = categories.cata_id ORDER BY photo_id");
            $rows = $data->rowCount();
            while($row = $data->fetch(PDO::FETCH_ASSOC)){
                $cardSize=3;













                $width = intval($row['photo_width']);
                $height = intval($row['photo_height']);
                $resolution = round(($width * $height)/1000000);
                echo "<div class='col-md-" . strval($cardSize) . "'>";
                echo "    <div class='card'>";
                echo "        <div class='galleryImg' style='background-Image: url(" . $globalUploadLocation . "/preview/" . $row['photo_uploadedFileName'] . ".jpg')'></div>";
                echo "        <div class='card-body'>";
                echo "            <h6>" . $row['photo_title'] . "</h6>";
                echo "            <ul style='list-style-type: none; padding:0px'>";
                echo "                <li><h7><span><i class='fas fa-camera'></i></span> " . $resolution . "MP (" . $row['photo_width'] . " x " . $row['photo_height'] . ") </h7></li>";
                echo "                <li><h7><span><i class='fas fa-map-marker-alt'></i></span> " . $row['photo_location'] . "</h7></li>";
                echo "                <li><h7><span><i class='fas fa-th'></i></span> " . $row['cata_name'] . "</h7></li>";
                echo "                <li><h7><span><i class='fas fa-tag'></i></span> £" . $row['photo_price'] . "</h7></li>";
                echo "            </ul>";
                echo "            <a href='viewImage.php?image=" . $row['photo_uploadedFileName'] . "'><button type='button' class='btn btn-primary btn-lg btn-block'>View Image</button></a>";
                echo "         </div>";
                echo "    </div>";
                echo "</div>";
            }
        ?>
                    
        </div>
    
    </body>
</html>

