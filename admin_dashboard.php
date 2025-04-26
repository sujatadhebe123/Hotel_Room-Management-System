<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "hotel_management");

// Count data
$totalRooms = $conn->query("SELECT COUNT(*) as total FROM rooms")->fetch_assoc()['total'];
$availableRooms = $conn->query("SELECT COUNT(*) as available FROM rooms WHERE status='Available'")->fetch_assoc()['available'];
$bookedRooms = $conn->query("SELECT COUNT(*) as booked FROM rooms WHERE status='Booked'")->fetch_assoc()['booked'];
$totalGuests = $conn->query("SELECT COUNT(*) as guests FROM guests")->fetch_assoc()['guests'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url("https://tse1.mm.bing.net/th?id=OIP.Yy-RN2Ub2UBOxhaZslGInAHaC7&pid=Api&P=0&h=180") no-repeat center center fixed;
            background-size: cover;
        }
        .dashboard-container {
            max-width: 900px;
            margin: 60px auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }
        h2 {
            text-align: center;
            color: #2c3e50;
        }
        .summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }
        .card {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
        }
        .card h3 {
            margin: 0;
            font-size: 16px;
            color: #555;
        }
        .card p {
            font-size: 28px;
            font-weight: bold;
            margin-top: 10px;
            color: #2c3e50;
        }
        .nav-links {
            text-align: center;
            margin-top: 30px;
        }
        .nav-links a {
            display: inline-block;
            margin: 0 10px;
            text-decoration: none;
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            transition: background 0.3s ease;
        }
        .nav-links a.logout {
            background: #e74c3c;
        }
        .nav-links a:hover {
            background: #0056b3;
        }
        .nav-links a.logout:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, Admin</h2>

        <!-- Summary Cards -->
        <div class="summary-cards">
            <div class="card">
                <h3>Total Rooms</h3>
                <p><?php echo $totalRooms; ?></p>
            </div>
            <div class="card">
                <h3>Available Rooms</h3>
                <p><?php echo $availableRooms; ?></p>
            </div>
            <div class="card">
                <h3>Booked Rooms</h3>
                <p><?php echo $bookedRooms; ?></p>
            </div>
            <div class="card">
                <h3>Registered Guests</h3>
                <p><?php echo $totalGuests; ?></p>
            </div>
        </div>

        <!-- Navigation -->
        <div class="nav-links">
            <a href="view_guests.php">View Guest Details</a>
            <a href="manage_rooms.php">Manage Rooms</a>
            <a href="logout.php" class="logout">Logout</a>
        </div>
    </div>
</body>
</html>
