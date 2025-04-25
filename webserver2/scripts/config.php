<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dbservername = "localhost";
$dbusername = "lumino_user";
$dbpassword = "HackingIsFun!";
$dbname = "lumino_db";

// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
$GLOBALS['conn'] = $conn;

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
