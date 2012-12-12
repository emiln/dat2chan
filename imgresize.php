<html>
<body>
<?php
class thumbcreator{
    static function create_thumbnail($file,$ext) {
        //this is the max size a thumbnail can have 
        $maxsize=250;   

        //get the file and its properties
        $originalsize = getimagesize($file.$ext);
        $width=$originalsize[0];
        $height=$originalsize[1];


        //determine how many percent we need to shrink the image
        if($width>$height) {
            $percent=($width/$maxsize)*100;
            }
        else if ($height>$width){
            $percent=($height/$maxsize)*100;
            }
        else if($width===$height) {
            $percent=($width/$maxsize)*100;
        }

        $percent = $percent/100;
        $thumb_widt=$width/$percent;
        $thumb_width=(int)$thumb_widt;
        $thumb_heigh=$height/$percent;
        $thumb_height=(int)$thumb_heigh;

        //create a new file for the thumbnail & the original, so we may use it with imagecopyresized below
        $thumb = imagecreatetruecolor($thumb_width,$thumb_height);
        if($ext===".jpg"){
            $source = imagecreatefromjpeg($file.$ext);
        }
        else if($ext===".png") {
            $source = imagecreatefrompng($file.$ext);
        }
        else if($ext===".gif") {
            $source = imagecreatefromgif($file.$ext);
        }
        //apply a gaussian blur
        $gaussian=array(array(1,2,1),
                        array(2,4,1),
                        array(1,2,1));
        $divisor=array_sum(array_map('array_sum',$gaussian));
        imageconvolution($source,$gaussian,$divisor,0);
        //resize
        imagecopyresized($thumb,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);

        if($ext===".jpg"){
            imagejpeg($thumb,$file."_thumb".$ext);
        }
        else if($ext===".png"){
            imagepng($thumb,$file."_thumb".$ext);
        }
        else if($ext===".gif"){
            imagegif($thumb,$file."_thumb".$ext);
        }
    }
}
?>
</body>
</html>