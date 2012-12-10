<?php
$string = "apostrophe'";
$str = 'Quote "';
$filteredstring=htmlentities($string,ENT_COMPAT,"UTF-8");
$filteredstr=htmlentities($str,ENT_COMPAT,"UTF-8");
echo($filteredstring);
echo($filteredstr);
?>