<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "hotel_management";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$room_id = $_GET['room_id'] ?? 0;

$room_query = $conn->prepare("SELECT * FROM rooms WHERE room_id = ?");
$room_query->bind_param("i", $room_id);
$room_query->execute();
$room_result = $room_query->get_result();
$room = $room_result->fetch_assoc();

$guest_result = $conn->query("SELECT * FROM guests ORDER BY id DESC LIMIT 1");
$guest = $guest_result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Receipt</title>
    <style>
        body {
            font-family: Arial;
            text-align: center;
            background-color: #f2f2f2;
        }
        .receipt {
            margin: 50px auto;
            padding: 25px;
            background: #fff;
            width: 420px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #ccc;
        }
        h2 {
            color: #2e8b57;
        }
        .btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #2e8b57;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
    </style>
</head>
<body>

<div class="receipt">
    <h2>Payment Receipt</h2>
    <p><strong>Guest Name:</strong> <?php echo htmlspecialchars($guest['name']); ?></p>
    <p><strong>Room Number:</strong> <?php echo $room['room_number']; ?></p>
    <p><strong>Room Type:</strong> <?php echo $room['type']; ?></p>
    <p><strong>Price:</strong> ₹<?php echo $room['price']; ?></p>
    <p style="color:green;"><strong>Status:</strong> Booked Successfully</p>
    <a href="check_rooms.php" class="btn">Back to Rooms</a>
</div>

</body>
</html>
