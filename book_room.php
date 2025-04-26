<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['room_id'])) {
    $room_id = $_POST['room_id'];

    $mysqli = new mysqli("localhost", "root", "", "hotel_management");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $stmt = $mysqli->prepare("UPDATE rooms SET status = 'Booked' WHERE room_id = ?");
    $stmt->bind_param("i", $room_id);

    if ($stmt->execute()) {
        header("Location: scanner_page.html"); // Redirect to scanner/payment page
        exit();
    } else {
        echo "Error booking room.";
    }

    $stmt->close();
    $mysqli->close();
} else {
    echo "Invalid request.";
}
