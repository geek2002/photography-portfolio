<?php 
$uploadPath = 'uploads/'; 
 
$statusMsg = ''; 
$upload = 0; 
if(isset($_POST['submit'])){ 
    if(!empty($_FILES['file']['name'])){ 
        $fileName = $_FILES['file']['name']; 
        $fileType = $_FILES['file']['type']; 
        $fileTemp = $_FILES['file']['tmp_name']; 
         
        $filePath = $uploadPath.basename($fileName); 
         
        // Allow certain file formats 
        $allowTypes = array('image/png','image/jpg','image/jpeg','image/gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $rotation = $_POST['rotation']; 
            if($rotation == -90 || $rotation == 270){ 
                $rotation = 90; 
            }elseif($rotation == -180 || $rotation == 180){ 
                $rotation = 180; 
            }elseif($rotation == -270 || $rotation == 90){ 
                $rotation = 270; 
            } 
             
            if(!empty($rotation)){ 
                switch($fileType){ 
                    case 'image/png': 
                        $source = imagecreatefrompng($fileTemp); 
                        break; 
                    case 'image/gif': 
                        $source = imagecreatefromgif($fileTemp); 
                        break; 
                    default: 
                        $source = imagecreatefromjpeg($fileTemp); 
                } 
                $imageRotate = imagerotate($source, $rotation, 0); 
                 
                switch($fileType){ 
                    case 'image/png': 
                        $upload = imagepng($imageRotate, $filePath); 
                        break; 
                    case 'image/gif': 
                        $upload = imagegif($imageRotate, $filePath); 
                        break; 
                    default: 
                        $upload = imagejpeg($imageRotate, $filePath); 
                } 
                  
            }elseif(move_uploaded_file($fileTemp, $filePath)){ 
                $upload = 1; 
            }else{ 
                $statusMsg = 'File upload failed, please try again.'; 
            } 
        }else{ 
            $statusMsg = 'Sorry, only JPG/JPEG/PNG/GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select a file to upload.'; 
    } 
} 
 
// Display status 
if($upload == 1){ 
    echo '<h4>File has been uploaded successfully</h4>'; 
    echo '<img src="'.$filePath.'" width="450" height="auto" />'; 
}else{ 
    echo '<h4>'.$statusMsg.'</h4>'; 
} 
?>