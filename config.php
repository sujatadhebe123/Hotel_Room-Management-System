<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "hotel_management";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
