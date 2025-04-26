<?php
$conn = new mysqli("localhost", "root", "", "hotel_management");
$result = $conn->query("SELECT * FROM rooms");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Available Rooms</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
      background: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c') no-repeat center center fixed;
      background-size: cover;
    }

    .overlay {
      background: rgba(0, 0, 0, 0.6);
      min-height: 100vh;
      padding: 80px 20px 50px;
    }

    h2 {
      text-align: center;
      color: #fff;
      margin-bottom: 40px;
      font-size: 36px;
      text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.6);
    }

    .room-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 25px;
      max-width: 1200px;
      margin: 0 auto;
      margin-top: 20px;
    }

    .room-card {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      text-align: center;
      height: 260px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .room-card h3 {
      margin-bottom: 10px;
      font-size: 20px;
      color: #333;
    }

    .room-card p {
      margin: 6px 0;
      font-size: 16px;
    }

    .booked {
      color: red;
      font-weight: bold;
    }

    .available {
      color: green;
      font-weight: bold;
    }

    form {
      margin-top: 10px;
    }

    button {
      background: #007bff;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background: #0056b3;
    }

    button:disabled {
      background: #ccc;
      cursor: not-allowed;
    }
  </style>
</head>
<body>
  <div class="overlay">
    <h2>Available Rooms</h2>
    <div class="room-grid">
      <?php while($room = $result->fetch_assoc()): ?>
        <div class="room-card">
          <h3>Room <?php echo $room['room_number']; ?> - <?php echo $room['type']; ?></h3>
          <p>Price: ₹<?php echo $room['price']; ?></p>
          <p>Status:
            <span class="<?php echo $room['status'] === 'Booked' ? 'booked' : 'available'; ?>">
              <?php echo $room['status']; ?>
            </span>
          </p>
          <?php if ($room['status'] === 'Available'): ?>
            <form action="scanner.html" method="GET">
              <input type="hidden" name="room_id" value="<?php echo $room['room_id']; ?>">
              <button type="submit">Book Now</button>
            </form>
          <?php else: ?>
            <button disabled>Booked</button>
          <?php endif; ?>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</body>
</html>
