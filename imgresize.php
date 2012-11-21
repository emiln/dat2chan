<html>
<body>
<?php
class thumbcreator{
    static function create_thumbnail($file,$ext) {
        //this is the max size a thumbnail can have 
        $maxsize=250;   

        //get the file and its properties
        $filename='/home/2/d/dat2chan/www/img/testimg.jpg';
        $originalsize = getimagesize($file.$ext);
        print_r($originalsize);
        $width=$originalsize[0];
        $height=$originalsize[1];


        //determine how many percent we need to shrink the image
        if($width>$height) {
            $percent=($width/$maxsize)*100;
            }
        else if ($height>$width){
            $percent=($height/$maxsize)*100;
            }

        $percent = $percent/100;
        echo $percent;
        echo "<br />";
        $thumb_widt=$width/$percent;
        $thumb_width=(int)$thumb_widt;
        $thumb_heigh=$height/$percent;
        $thumb_height=(int)$thumb_heigh;

        //create a new file for the thumbnail & the original, so we may use it with imagecopyresized below
        $thumb = imagecreatetruecolor($thumb_width,$thumb_height);
        $source = imagecreatefromjpeg($file.$ext);
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
        //output
    }
}
?>
</body>
</html>