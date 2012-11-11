<?php
include('DB.class.php');
$idquery = '(SELECT id FROM threads) UNION (SELECT id FROM posts)';
$idresult = DB::query($idquery,array());
print_r($idresult); echo "<br />";
print_r($idresult[0]['id']);
?>