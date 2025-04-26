<?php
include('config.php');  // Include your DB connection file

// Get the room ID from the URL
$room_id = $_GET['id'];

// Delete the room from the database
$sql = "DELETE FROM rooms WHERE room_id = $room_id";

if (mysqli_query($conn, $sql)) {
    // Redirect back to the rooms management page after deleting
    header("Location: manage_rooms.php");
} else {
    echo "Error deleting room: " . mysqli_error($conn);
}
?>
