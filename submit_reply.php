<html><body>
<?php
include('titlegenerator.php');
include('DB.class.php');
$Title = $_POST["title"];
$Name = $_POST["name"];
$Message = $_POST["message"];
$File = $_POST["file"];
$Board = "1";
$reply_to = $_POST['reply_to'];
//filter out html-tags in order to prevent html-injection
$filteredTitle = htmlentities ($Title,ENT_COMPAT,"UTF-8");
$filteredName = htmlentities ($Name,ENT_COMPAT,"UTF-8");
$filteredMessage = htmlentities($Message,ENT_COMPAT,"UTF-8");

//generate a valid id
$idquery = '(SELECT id FROM threads) UNION (SELECT id FROM posts)';
$idresult = DB::query($idquery,array());
$idvar = max($idresult);
$id = $idvar['id'];
$id++;

$query = 'INSERT INTO posts (id,board,reply_to,title,poster,message,file) VALUES (?,?,?,?,?,?,?)';
$result = DB::insert($query,array($id,$Board,$reply_to,$filteredTitle,$filteredName,$filteredMessage,$File),'id');
$query1 = 'UPDATE threads SET last_activity=CURRENT_TIMESTAMP WHERE id=?';
$result1 = DB::update($query1,array($reply_to));
if(count($result)>0) {
    echo "Success! \o/";
    print_r($idresult);
}
else {
    echo "massive failure :(";
}
?>
</body></html>