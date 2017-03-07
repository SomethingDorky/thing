<?php

error_reporting(0);

$dbConnect = array(
    'server' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'name' => 'dorkythings'
);

$db = new mysqli(
    $dbConnect['server'],
    $dbConnect['user'],
    $dbConnect['pass'],
    $dbConnect['name']
);

if ($db -> connect_errno > 0) {
    echo "<h1>Something Broke!<h1>";
    exit;
} 
?>