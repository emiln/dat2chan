<?php
include('DB.class.php');
$used_storage = disk_total_space(".");
$status = DB::query('SHOW TABLE STATUS',array());
foreach($status as $index => $board) {
    foreach($board as $key => $value) {
        echo "<p><b>$key</b>: $value</p>";
    }
    echo "<br />";
}
echo "<br />";
echo $used_storage;
echo "<br />";
print_r(DB::query('SHOW TABLE STATUS', array()));

