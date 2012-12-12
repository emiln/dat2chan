<?php 
$refer=$_POST['refer'];
header("Location: http://www.dat2chan.org/$refer"); ?>
<html><body>
<?php

include('titlegenerator.php');
include('DB.class.php');
include('imgresize.php');
$Title = $_POST["title"];
$Name = $_POST["name"];
$Message = $_POST["message"];
$File = $_FILES["file"]["name"];
$Board = $_POST["board"];
$clean_title = titlegenerator::cleanurl($Title);
$upload_dir ="/img";
$imgurl=NULL;
$imgurl_thumb=NULL;
if(empty($Title)) {
    $Title="OP is a lazy scrub";
}
//default name
if (empty($Name)) {
    $Name="Pleb";
}

//generate a valid id
$idquery = '(SELECT id FROM threads) UNION (SELECT id FROM posts)';
$idresult = DB::query($idquery,array());
$idvar = max($idresult);
$id = $idvar['id'];
$id++;

//check the extension of the submitted file and store this in $ext.
if ($_FILES["file"]["type"]==="image/jpeg") {
    $ext = ".jpg";
}
else if ($_FILES["file"]["type"]==="image/gif") {
    $ext = ".gif";
}
else if ($_FILES["file"]["type"]==="image/png") {
    $ext = ".png";
}
//upload the file and create thumbnail
if($_FILES["file"]["error"]>0) {
    echo "Something went horribly wrong: " . $_FILES["file"]["error"];}
else if ($_FILES["file"]["size"]>92160000) {
    echo "Try uploading a smaller file, bro";
}
else {
    echo "cool file, bro!";
    move_uploaded_file($_FILES["file"]["tmp_name"],"/home/2/d/dat2chan/www/img/".$id.$ext);
    $File="/home/2/d/dat2chan/www/img/".$id;
    thumbcreator::create_thumbnail($File,$ext);
    $File="/home/2/d/dat2chan/www/img/".$id.$ext;
    $imgurl="http://www.dat2chan.org/img/".$id.$ext;
    $imgurl_thumb="http://www.dat2chan.org/img/".$id."_thumb".$ext;
}
//filter out html-tags in order to prevent html-injection
$filteredTitle = htmlentities ($Title,ENT_COMPAT,"UTF-8");
$filteredName = htmlentities ($Name,ENT_COMPAT,"UTF-8");
$filteredMessage = htmlentities($Message,ENT_COMPAT,"UTF-8");

//violent insertion happens here.
$query = 'INSERT INTO threads (id,board,title,clean_title,poster,message,file,imgurl,imgurl_thumb,url,last_activity) VALUES (?,?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP)';
$result = DB::insert($query,array($id,$Board,$filteredTitle,$clean_title,$filteredName,$filteredMessage,$File,$imgurl,$imgurl_thumb,$clean_title),'id');
if(count($result)>0) {
    echo "Success! \o/"."<br />";
}
else {
    echo "massive failure :(";
}

?>
</body></html>