<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "travelvista";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$create_table_sql = "CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hotel_id INT,
    user_email VARCHAR(255),  
    name VARCHAR(255),
    checkin_date DATE,
    checkout_date DATE,
    special_requests TEXT
)"; 

$conn->query($create_table_sql);

$hotel_id = $_POST['hotel_id'];
$name = $_POST['name'];
$user_email = $_SESSION['email']; 
$checkin_date = $_POST['checkin_date'];
$checkout_date = $_POST['checkout_date'];
$special_requests = $_POST['special_requests'];

$sql = "SELECT name, address, price, number_of_rooms FROM hotels WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $hotel_id);
$stmt->execute();
$result = $stmt->get_result();
$hotel = $result->fetch_assoc();

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #4CAF50;
        }
        p {
            margin: 10px 0;
        }
        .button {
            display: inline-block;
            padding: 10px 15px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">';

if ($hotel['number_of_rooms'] > 0) {
    $new_room_count = $hotel['number_of_rooms'] - 1;

    $update_sql = "UPDATE hotels SET number_of_rooms = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ii", $new_room_count, $hotel_id);

    if ($update_stmt->execute()) {
        $insert_booking_sql = "INSERT INTO bookings (hotel_id, user_email, name, checkin_date, checkout_date, special_requests) VALUES (?, ?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_booking_sql);
        $insert_stmt->bind_param("isssss", $hotel_id, $user_email, $name, $checkin_date, $checkout_date, $special_requests); // Correct bind_param

        if ($insert_stmt->execute()) {
            echo "<h2>Booking successful!</h2>";
            echo "<p>You have successfully booked a room at <strong>" . $hotel['name'] . "</strong>.</p>";
            echo "<p>Check-in: <strong>" . $checkin_date . "</strong></p>";
            echo "<p>Check-out: <strong>" . $checkout_date . "</strong></p>";
            echo '<a href="login.php" class="button">Go to Homepage</a>'; 
        } else {
            echo "<h2>Error booking.</h2>";
        }
        $insert_stmt->close();
    } else {
        echo "<h2>Error updating room availability.</h2>";
    }
    $update_stmt->close();
} else {
    echo "<h2>Sorry, no rooms are available at this hotel.</h2>";
    echo '<a href="login.php" class="button">Go to Homepage</a>'; 
}

echo '    </div>
</body>
</html>';

$conn->close();
?>