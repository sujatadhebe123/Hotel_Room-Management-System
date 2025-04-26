<?php
include('config.php');  // Include your DB connection file

// Get the room ID from the URL
$room_id = $_GET['id'];

// Fetch the room details from the database
$sql = "SELECT * FROM rooms WHERE room_id = $room_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $room_number = $_POST['room_number'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    // Update the room details in the database
    $update_sql = "UPDATE rooms SET room_number = '$room_number', type = '$type', price = '$price', status = '$status' WHERE room_id = $room_id";
    
    if (mysqli_query($conn, $update_sql)) {
        // Redirect back to the rooms management page after updating
        header("Location: manage_rooms.php");
    } else {
        echo "Error updating room: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Room</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c') no-repeat center center fixed;
            background-size: cover;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.95);
            max-width: 600px;
            margin: 60px auto;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"], input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #2980b9;
        }
        .btn-back {
            display: inline-block;
            margin-top: 25px;
            padding: 10px 20px;
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: background 0.3s ease;
        }
        .btn-back:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Room</h2>
        <form method="POST">
            <label>Room Number:</label>
            <input type="text" name="room_number" value="<?php echo htmlspecialchars($row['room_number']); ?>" required>
            
            <label>Room Type:</label>
            <input type="text" name="type" value="<?php echo htmlspecialchars($row['type']); ?>" required>
            
            <label>Price:</label>
            <input type="number" name="price" value="<?php echo htmlspecialchars($row['price']); ?>" required>
            
            <label>Status:</label>
            <input type="text" name="status" value="<?php echo htmlspecialchars($row['status']); ?>" required>
            
            <input type="submit" value="Update Room">
        </form>
        <a href="manage_rooms.php" class="btn-back">Back to Room List</a>
    </div>
</body>
</html>
