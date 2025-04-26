<?php
include('config.php');  // Include your DB connection file

$sql = "SELECT * FROM guests";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Guests</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('https://tse3.mm.bing.net/th?id=OIP.jStoRLa2F72XY3Gypku5ugHaEK&pid=Api&P=0&h=180') no-repeat center center fixed;
            background-size: cover;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.95);
            max-width: 1000px;
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
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            background-color: #ffffff;
        }
        th, td {
            padding: 14px 18px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #2c3e50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #eaeaea;
        }
        .back-btn {
            display: inline-block;
            margin-top: 25px;
            text-align: center;
            padding: 10px 20px;
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: background 0.3s ease;
        }
        .back-btn:hover {
            background-color: #c0392b;
        }
        .btn-container {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registered Guest Details</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['address']); ?></td>
            </tr>
            <?php } ?>
        </table>

        <div class="btn-container">
            <a href="admin_dashboard.php" class="back-btn">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
