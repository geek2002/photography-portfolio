<?php
session_start();
include "processing.php";
$message = ''; 
if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload')
{
    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)
    {
        // get details of the uploaded file
        $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
        $fileName = $_FILES['uploadedFile']['name'];
        $fileSize = $_FILES['uploadedFile']['size'];
        $fileType = $_FILES['uploadedFile']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // sanitize file-name
        $newFileName = md5(time() . $fileName);

        // check if file has one of the following extensions
        $allowedfileExtensions = array('jpg', 'gif', 'png', 'mp4');

        if (in_array($fileExtension, $allowedfileExtensions))
        {
            // directory in which the uploaded file will be moved
            $uploadFileDir = '../uploaded-Images/';
            $dest_path = $uploadFileDir . "original/" . $newFileName . '.' . $fileExtension;

            if(move_uploaded_file($fileTmpPath, $dest_path)) 
            {
                $message ='File is successfully uploaded. ' . $dest_path;
            }else{
                $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
            }
        }else{
            $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
        }
    }else{
    $message = 'There is some error in the file upload. Please check the following error.<br>';
    $message .= 'Error:' . $_FILES['uploadedFile']['error'];
    }
    $_SESSION['message'] = $message;
}
list($imgWidth,$imgHeight) = getimagesize($dest_path);


$image = convertImage($dest_path);
$imageRsizeThum = resize_image_preset($image,"thum");
if($fileExtension == "png"){
    imagejpeg($image, $uploadFileDir . "original/" . $newFileName . ".jpg", 100);
    unlink($dest_path);
}



$imageWaterMk = watermark_image($image);
// $imageRsizePrev = resize_image($imageWaterMk,3464,2309,True);
$imageRsizePrev = resize_image_preset($imageWaterMk,"4");
// $imageRsizeThum = resize_image($imageWaterMk,500,333,True);
imagejpeg($imageRsizePrev, $uploadFileDir . "preview/" . $newFileName . ".jpg", 100);
imagejpeg($imageRsizeThum, $uploadFileDir . "thumnail/" . $newFileName . ".jpg", 100);
cleanup($image,$imageWaterMk,$imageRsizePrev,$imageRsizeThum);

if($_POST['title']==null){$photo_title = $fileName;}else{$photo_title = $_POST['title'];}
$photo_originalFileName = $fileName;
$photo_location = $_POST['location'];
$photo_width = $imgWidth;
$photo_height = $imgHeight;
$photo_uploadedFileName = $newFileName;
if($_POST['price']==null){$photo_price = 0;}else{$photo_price = $_POST['price'];}
$photo_cata_id = $_POST['catagory'];

try
    {
        include "../global/databaseConnection.php";
        $sql = "INSERT INTO photos(photo_title,photo_originalFileName,photo_location,photo_width,photo_height,photo_uploadedFileName,photo_price,photo_cata_id) VALUES(:title,:origFileName,:location,:width,:height,:upFileName,:price,:cataID)";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':title',$photo_title);
        $statement->bindValue(':origFileName',$photo_originalFileName);
        $statement->bindValue(':location',$photo_location);
        $statement->bindValue(':width',$photo_width);
        $statement->bindValue(':height',$photo_height);
        $statement->bindValue(':upFileName',$photo_uploadedFileName);
        $statement->bindValue(':price',$photo_price);
        $statement->bindValue(':cataID',$photo_cata_id);
        $runstatement = $statement->execute();
        if($runstatement)
        {
            echo "Data entered into the database";
        }
    }
    catch(PDOException $errormessage)
    {
        echo "An error has occured, see the error details below <br>";
        echo $errormessage;
    }

    // echo "Sent: <br>";
    // echo "photo_title: " . $photo_title . "<br>";
    // echo "photo_originalFileName: " . $photo_originalFileName . "<br>";
    // echo "photo_location: " . $photo_location . "<br>";
    // echo "photo_width: " . $photo_width . "<br>";
    // echo "photo_height: " . $photo_height . "<br>";
    // echo "photo_location_full: " . $photo_location_full . "<br>";
    // echo "photo_location_prev: " . $photo_location_prev . "<br>";
    // echo "photo_location_thumb: " . $photo_location_thumb . "<br>";
    // echo "photo_price: " . $photo_price . "<br>";
    // echo "photo_cata_id: " . $photo_cata_id . "<br>";



header("Location: ../index.php?fileName=" . $uploadFileDir . "preview/" . $newFileName . ".jpg");