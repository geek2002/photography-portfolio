<?php
include "processing.php";
session_start();
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
        if (in_array($fileExtension, array('jpg', 'gif', 'png', 'bmp')))
        {
            // directory in which the uploaded file will be moved
            $uploadFileDir = '../uploaded-Images/';
            $dest_path = $uploadFileDir . "original/" . $newFileName . '.jpg';
            switch($fileType){ 
                case 'image/jpeg': 
                    $imageUploadTmp = imagecreatefromjpeg($fileTmpPath); 
                    break;
                case 'image/png': 
                    $imageUploadTmp = imagecreatefrompng($fileTmpPath); 
                    break; 
                case 'image/gif': 
                    $imageUploadTmp = imagecreatefromgif($fileTmpPath); 
                    break;
                case 'image/bmp': 
                    $imageUploadTmp = imagecreatefromgif($fileTmpPath); 
                    break; 
            } 
            if(isset($_POST['rotation'])){
                $imageUploadTmp = rotateImage($imageUploadTmp,$_POST['rotation']);
            }
            imagejpeg($imageUploadTmp,$dest_path);
            $_SESSION['lastUploadedFileId'] = $newFileName;
            // if(move_uploaded_file($fileTmpPath, $dest_path)) 
            // {
            //     $message ='File is successfully uploaded. ' . $dest_path;
                // $_SESSION['lastUploadedFileId'] = $newFileName;
            // }else{
            //     $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
            // }
        }
    }
}
list($imgWidth,$imgHeight) = getimagesize($dest_path);


$image = openImage($dest_path);
$imageRsizeThum = resize_image_preset($image,"thum");
if($fileExtension == "png"){
    imagejpeg($image, $uploadFileDir . "original/" . $newFileName . ".jpg", 100);
    unlink($dest_path);
}



$imageWaterMk = watermark_image($image);
$imageRsizePrev = resize_image_preset($imageWaterMk,"4");
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


header("Location: ../index.php");