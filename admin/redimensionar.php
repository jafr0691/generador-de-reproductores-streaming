	<?php
/*function resizeImage($image,$tmax){
    list($imagewidth, $imageheight, $imageType) = getimagesize($image);
    $scale = $tmax/$imagewidth;
    $imageType = image_type_to_mime_type($imageType);
    $newImageWidth = ceil($imagewidth * $scale);
    $newImageHeight = ceil($imageheight * $scale);
    $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
    switch($imageType) {
        case "image/gif":
                    $source=imagecreatefromgif($image);
        break;
        case "image/pjpeg":
        case "image/jpeg":
        case "image/jpg":
                    $source=imagecreatefromjpeg($image);
        break;
        case "image/png":
                    $source=imagecreatefrompng($image);
                    $negro = imagecolorallocate($newImage, 0, 0, 0);
                    imagecolortransparent($newImage, $negro);
                    imagefilledrectangle($newImage, 0, 0, $newImageWidth, $newImageHeight, 0);
        break;
      }
    imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$imagewidth,$imageheight);
    switch($imageType) {
            case "image/gif":
                imagegif($newImage,$image);
            break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($newImage,$image,90);
            break;
            case "image/png":
            case "image/x-png":
                imagepng($newImage, $image);
            break;
        }
    chmod($image, 0777);
    return $image;
}*/

function resizeImage($resourceType,$image_width,$image_height) {
    $resizeWidth = 500;
    $resizeHeight = 250;
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}
?>