<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST['room_id'];

    $conn = new mysqli("localhost", "root", "", "hotel_management");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("UPDATE rooms SET status = 'Booked' WHERE room_id = ?");
    $stmt->bind_param("i", $room_id);

    if ($stmt->execute()) {
        echo "<script>
            alert('Payment confirmed! Room status updated to Booked.');
            window.location.href = 'http://localhost/hotel/check_rooms.php';
        </script>";
    } else {
        echo "Error updating status: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
