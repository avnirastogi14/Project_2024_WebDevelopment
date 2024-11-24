<?php
// Database connection (replace with your own connection details)
$servername = "localhost";
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "travelvista"; // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the hotel ID from the URL
$hotel_id = $_GET['id'];

// Fetch hotel details from the database
$sql = "SELECT name, address, number_of_rooms, price FROM hotels WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $hotel_id);
$stmt->execute();
$result = $stmt->get_result();
$hotel = $result->fetch_assoc();

// HTML to display the booking form
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking - <?php echo htmlspecialchars($hotel['name']); ?> - Travel Vista</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Travel Vista</h1>
    </header>
    <main>
        <h2>Booking for <?php echo htmlspecialchars($hotel['name']); ?></h2>
        <p>Address: <?php echo htmlspecialchars($hotel['address']); ?></p>
        <p>Price: $<?php echo htmlspecialchars($hotel['price']); ?> per night</p>        
        <p>Rooms avaiable: <?php echo htmlspecialchars($hotel['number_of_rooms']); ?>   </p>        
        <form action="process_booking.php" method="POST">
            <input type="hidden" name="hotel_id" value="<?php echo htmlspecialchars($hotel_id); ?>">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="checkin_date">Check-in Date:</label>
            <input type="date" id="checkin_date" name="checkin_date" required><br>

            <label for="checkout_date">Check-out Date:</label>
            <input type="date" id="checkout_date" name="checkout_date" required><br>

            <label for="special_requests">Special Requests:</label><br>
            <textarea id="special_requests" name="special_requests" rows="4" cols="50"></textarea><br>

            <input type="submit" value="Book Now">
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Travel Vista. All Rights Reserved.</p>
    </footer>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
