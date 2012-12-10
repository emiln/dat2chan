<?php header("Location: http://www.dat2chan.org/awsm/"); ?>
<html><body>
<?php

include('titlegenerator.php');
include('DB.class.php');
include('imgresize.php');
$Title = $_POST["title"];
$Name = $_POST["name"];
$Message = $_POST["message"];
$File = $_POST["file"];
$Board = "1";
$reply_to = $_POST['reply_to'];
$imgurl=NULL;
$imgurl_thumb=NULL;
//default name
if (empty($Name)) {
    $Name="Pleb";
}

//filter out html-tags in order to prevent html-injection
$filteredTitle = htmlentities ($Title,ENT_COMPAT,"UTF-8");
$filteredName = htmlentities ($Name,ENT_COMPAT,"UTF-8");
$filteredMessage = htmlentities($Message,ENT_COMPAT,"UTF-8");
//default title
if (empty($Title)) {
    $filteredTitle="&nbsp";
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

$query = 'INSERT INTO posts (id,board,reply_to,title,poster,message,file,imgurl,imgurl_thumb) VALUES (?,?,?,?,?,?,?,?,?)';
$result = DB::insert($query,array($id,$Board,$reply_to,$filteredTitle,$filteredName,$filteredMessage,$File,$imgurl,$imgurl_thumb),'id');
$query1 = 'UPDATE threads SET last_activity=CURRENT_TIMESTAMP WHERE id=?';
$result1 = DB::update($query1,array($reply_to));
if(count($result)>0) {
    echo "Success! \o/";
}
else {
    echo "massive failure :(";
}
?>
</body></html>