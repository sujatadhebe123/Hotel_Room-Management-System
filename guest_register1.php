<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'config.php'; // your DB connection file

    $name = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $address = $_POST['address'] ?? '';

    $sql = "INSERT INTO guests (name, phone, email, address)
            VALUES ('$name', '$phone', '$email', '$address')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['guest_id'] = $conn->insert_id;

        // 🔁 Redirect to dashboard after successful registration
        header("Location: dashboard.html"); 
        exit;
    } else {
        header("Location: guest_register.html?error=" . urlencode("Error: Could not register guest."));
        exit;
    }

    $conn->close();
} else {
    header("Location: guest_register.html");
    exit;
}
