<?php 

require_once __DIR__ . '/vendor/autoload.php';

use src\repositories\mySqlConnection;

// db Connection;
$db = new mySqlConnection();
echo "database is succesfully connected" . PHP_EOL;

// Book repository;
?>