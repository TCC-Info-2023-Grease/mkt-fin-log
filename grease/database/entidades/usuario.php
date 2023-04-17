<?php
require dirname(__DIR__) . '/db.php';

global $conn;

$sql = "SELECT * FROM USUARIOS";
$sql = mysqli_query($sql, $conn);

print_r($sql);