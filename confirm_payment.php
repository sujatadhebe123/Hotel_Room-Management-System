<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// DB connection
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'hotel_management';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST['room_id'];

    // Update room status
    $stmt = $conn->prepare("UPDATE rooms SET status='Booked' WHERE room_id=?");
    $stmt->bind_param("i", $room_id);
    $stmt->execute();

    // Get guest details (latest entry)
    $guestResult = $conn->query("SELECT * FROM guests ORDER BY guest_id DESC LIMIT 1");
    $guest = $guestResult->fetch_assoc();

    // Get room details
    $roomResult = $conn->query("SELECT * FROM rooms WHERE room_id = $room_id");
    $room = $roomResult->fetch_assoc();

    // Send email to guest
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sujatadhebe48@gmail.com'; // your email
        $mail->Password = 'bydyydbjimudcerm'; // your app password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('sujatadhebe48@gmail.com', 'Hotel Booking');
        $mail->addAddress($guest['email'], $guest['name']);

        $mail->isHTML(true);
        $mail->Subject = 'Booking Confirmation';
        $mail->Body = "
            <h3>Booking Confirmed!</h3>
            <p>Dear {$guest['name']},</p>
            <p>Your room booking was successful. Here are the details:</p>
            <ul>
                <li><strong>Room Number:</strong> {$room['room_number']}</li>
                <li><strong>Type:</strong> {$room['type']}</li>
                <li><strong>Price:</strong> ₹{$room['price']}</li>
            </ul>
            <p>Thank you for choosing us!</p>
        ";

        $mail->send();
    } catch (Exception $e) {
        echo "Email error: {$mail->ErrorInfo}";
    }

    // Show receipt
    echo '
    <!DOCTYPE html>
    <html>
    <head>
        <title>Payment Receipt</title>
        <style>
            body {
                font-family: "Segoe UI", sans-serif;
                background-color: #f0f2f5;
                display: flex;
                justify-content: center;
                padding: 50px;
            }
            .receipt-container {
                background-color: #fff;
                padding: 30px 40px;
                border-radius: 12px;
                box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
                width: 480px;
                text-align: left;
            }
            .receipt-container h2 {
                color: #2c3e50;
                text-align: center;
                margin-bottom: 20px;
            }
            .receipt-container p {
                font-size: 16px;
                margin: 10px 0;
            }
            .receipt-container strong {
                color: #333;
            }
            .btn-back {
                display: block;
                margin-top: 30px;
                text-align: center;
            }
            .btn-back button {
                padding: 10px 20px;
                background-color: #27ae60;
                color: white;
                border: none;
                font-size: 16px;
                border-radius: 6px;
                cursor: pointer;
            }
            .btn-back button:hover {
                background-color: #1e8449;
            }
        </style>
    </head>
    <body>
        <div class="receipt-container">
            <h2>Payment Receipt</h2>
            <p><strong>Guest Name:</strong> ' . $guest['name'] . '</p>
            <p><strong>Phone:</strong> ' . $guest['phone'] . '</p>
            <p><strong>Email:</strong> ' . $guest['email'] . '</p>
            <p><strong>Room Number:</strong> ' . $room['room_number'] . '</p>
            <p><strong>Room Type:</strong> ' . $room['type'] . '</p>
            <p><strong>Price:</strong> ₹' . $room['price'] . '</p>
            <p><strong>Status:</strong> Booked</p>
            <div class="btn-back">
                <a href="check_rooms.php"><button>Back to Rooms</button></a>
            </div>
        </div>
    </body>
    </html>';
}
?>
