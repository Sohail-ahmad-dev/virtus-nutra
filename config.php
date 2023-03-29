<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cart";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    //$conn = mysqli_connect($servername, 'root', '', $dbname);
    die("Connection failed: " . mysqli_connect_error());
}
error_reporting(E_ERROR | E_PARSE);
session_start();
?>

