<?php
session_start();
$conn = new mysqli("localhost", "root", "", "hotel_management");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Using MD5 to match the stored hash

    $result = $conn->query("SELECT * FROM admin WHERE username='$username' AND password='$password'");
    if ($result->num_rows === 1) {
        $_SESSION['admin'] = $username;
        header("Location: admin_dashboard.php");
    } else {
        echo "<script>alert('Invalid login'); window.location='admin_login.php';</script>";
    }
}
?>
