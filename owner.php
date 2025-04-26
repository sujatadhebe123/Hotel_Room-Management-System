<?php
$conn = new mysqli("localhost", "root", "", "hotel_management");

$username = 'admin';
$password = password_hash('123', PASSWORD_DEFAULT); // Secure hashed password

$sql = "INSERT INTO owner (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();

echo "Admin user created successfully!";
?>
