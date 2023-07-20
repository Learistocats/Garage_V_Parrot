<?php
require_once 'C:/xampp/htdocs/GarageVParrot/private/config.php';
$host = DB_HOST;
$username = DB_USER; 
$password = DB_PASS; 
$databaseName = DB_NAME;

$conn = mysqli_connect($host, $username, $password, $databaseName);
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
    
}
?>