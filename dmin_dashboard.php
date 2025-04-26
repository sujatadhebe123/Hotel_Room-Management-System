<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        h2 { color: #333; }
        a {
            display: inline-block;
            margin-right: 15px;
            margin-top: 10px;
            color: #007bff;
        }
    </style>
</head>
<body>
    <h2>Welcome, Admin</h2>
    <a href="view_guests.php">View Guests</a>
    <a href="manage_rooms.php">Manage Rooms</a>
    <a href="logout.php">Logout</a>
</body>
</html>
