<html><body>
<?php
include('titlegenerator.php');
include('DB.class.php');
$Title = $_POST["title"];
$Name = $_POST["name"];
$Message = $_POST["message"];
$File = $_FILES["file"];
$Board = "1";
$clean_title = titlegenerator::cleanurl($Title);
$upload_dir ="/img";

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
//filter out html-tags in order to prevent html-injection
$filteredTitle = htmlentities ($Title,ENT_COMPAT,"UTF-8");
$filteredName = htmlentities ($Name,ENT_COMPAT,"UTF-8");
$filteredMessage = htmlentities($Message,ENT_COMPAT,"UTF-8");

//violent insertion happens here.
$query = 'INSERT INTO threads (id,board,title,clean_title,poster,message,file,last_activity) VALUES (?,?,?,?,?,?,?,CURRENT_TIMESTAMP)';
$result = DB::insert($query,array($id,$Board,$filteredTitle,$clean_title,$filteredName,$filteredMessage,$File),'id');
if(count($result)>0) {
    echo "Success! \o/"."<br />";
    echo $id;
    if($_FILES["file"]["error"]>0) {
        echo "Something went horribly wrong: " . $_FILES["file"]["error"];}
    else if ($_FILES["file"]["size"]>921600) {
        echo "Try uploading a smaller file, bro";
    }
    else {
        echo "cool file, bro!";
        $quer = 'SELECT id FROM threads WHERE clean_title = ?';
        $res = DB::query($quer,array($clean_title));
        $res = $res[0];
        $id = $res['id'];
        move_uploaded_file($_FILES["file"]["tmp_name"],"/home/2/d/dat2chan/www/img/".$id.$ext);
        print_r($_FILES["file"]);
    }
}
else {
    echo "massive failure :(";
}
?>
</body></html>