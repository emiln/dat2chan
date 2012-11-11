<?php
include('DB.class.php');
$used_storage = disk_total_space("/home/2/d/dat2chan/www/img");

echo $used_storage;
echo(getcwd());
