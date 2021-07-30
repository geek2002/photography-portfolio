<?php
    // function convertImage($originalImage, $outputImage, $quality)
    function openImage($originalImage)
    {
        // jpg, png, gif or bmp?
        $exploded = explode('.',$originalImage);
        $ext = $exploded[count($exploded) - 1]; 
        
        if (preg_match('/jpg|jpeg/i',$ext))
            $imageTmpConv=imagecreatefromjpeg($originalImage);
        else if (preg_match('/png/i',$ext))
            $imageTmpConv=imagecreatefrompng($originalImage);
        else if (preg_match('/gif/i',$ext))
            $imageTmpConv=imagecreatefromgif($originalImage);
        else if (preg_match('/bmp/i',$ext))
            $imageTmpConv=imagecreatefrombmp($originalImage);


        return $imageTmpConv;
        imagedestroy($imageTmpConv);
        
    }
    function resize_image_preset($img, $preset,$orientation,$crop=FALSE){
        $megaPixel = '{
            "24":"6000,4000",
            "20":"5477,3651",
            "16":"4899,3266",
            "12":"4243,2828",
            "8" :"3464,2309",
            "4" :"2449,1633",
            "2" :"1732,1155",
            "1" :"1225,816",
            "thum-lg":"1000,666",
            "thum-sm":"500,333"
        }';
        $obj = json_decode($megaPixel);

        
        $resolution = explode(",", $obj->$preset);
        if ($orientation == "L") {
            $width = $resolution[0];
            $height = $resolution[1];
        } elseif ($orientation == "P") {
            $width = $resolution[1];
            $height = $resolution[0];
        }
        
        
        echo "Width: " . $width . "<br>";
        echo "Height: " . $height . "<br>";
        return resize_image($img,$width,$height,$crop);
    }

    function resize_image($img, $w, $h,$crop=FALSE){
        $imgTmpRsize = $img;
        $width = imagesx($imgTmpRsize);
        $height = imagesy($imgTmpRsize);

        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width-($width*abs($r-$w/$h)));
            } else {
                $height = ceil($height-($height*abs($r-$w/$h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w/$h > $r) {
                $newwidth = $h*$r;
                $newheight = $h;
            } else {
                $newheight = $w/$r;
                $newwidth = $w;
            }
        }
        $imgTmpRsizeDest = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($imgTmpRsizeDest, $imgTmpRsize, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

        return $imgTmpRsizeDest;
        imagedestroy($imgTmpRsizeDest);
    }
    function watermark_image($target){
        
        $watermark = imagecreatefrompng("Watermark.png");
        imagealphablending($watermark, false);
        imagesavealpha($watermark, true);

        $imageTemWtrMrk = $target;

        $img_w = imagesx($imageTemWtrMrk);
        $img_h = imagesy($imageTemWtrMrk);
        $wtrmrk_w = imagesx($watermark);
        $wtrmrk_h = imagesy($watermark);
        $dst_x = ($img_w / 2) - ($wtrmrk_w / 2); // For centering the watermark on any image
        $dst_y = ($img_h / 2) - ($wtrmrk_h / 2); // For centering the watermark on any image
        imagecopy($imageTemWtrMrk, $watermark, $dst_x, $dst_y, 0, 0, $wtrmrk_w, $wtrmrk_h);
        imagedestroy($watermark);
        return $imageTemWtrMrk;
        imagedestroy($imageTemWtrMrk);
    }
    function rotateImage($image,$rotation){
        if($rotation == -90 || $rotation == 270){ 
            $rotation = 90; 
        }elseif($rotation == -180 || $rotation == 180){ 
            $rotation = 180; 
        }elseif($rotation == -270 || $rotation == 90){ 
            $rotation = 270; 
        }
        $imageRotateTemp = imagerotate($image, $rotation, 0);
        return $imageRotateTemp;
    }
    function cleanup($image,$imageWaterMk,$imageRsizePrev,$imageRsizeThum){
        imagedestroy($image);
        imagedestroy($imageWaterMk);
        imagedestroy($imageRsizePrev);
        imagedestroy($imageRsizeThum);
    }
?>