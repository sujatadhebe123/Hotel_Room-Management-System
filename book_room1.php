<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "hotel_management");

    $room_id = $_POST['room_id'];

    // Update the room status to Booked
    $stmt = $conn->prepare("UPDATE rooms SET status = 'Booked' WHERE room_id = ?");
    $stmt->bind_param("i", $room_id);
    $stmt->execute();
    $stmt->close();

    // Redirect to payment scanner
    header("Location: scanner.html");
    exit();
}
?>
