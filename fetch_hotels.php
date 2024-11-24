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

// Get the selected city from the form
$city = $_POST['city'];

// Fetch hotels from the database - added number_of_rooms to the SELECT query
$sql = "SELECT id, name, address, price, number_of_rooms FROM hotels WHERE city = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $city);
$stmt->execute();
$result = $stmt->get_result();

// HTML to display the results
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotels in <?php echo htmlspecialchars($city); ?> - Travel Vista</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Travel Vista</h1>
    </header>
    <main>
        <h2>Hotels in <?php echo htmlspecialchars($city); ?></h2>
        <?php if ($result->num_rows > 0): ?>
            <ul>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <li>
                        <strong><a href="booking.php?id=<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['name']); ?></a></strong><br>
                        Address: <?php echo htmlspecialchars($row['address']); ?><br>
                        Price: $<?php echo htmlspecialchars($row['price']); ?> per night<br>
                        Available Rooms: <?php echo htmlspecialchars($row['number_of_rooms']); ?> <!-- Added room count -->
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No hotels found in <?php echo htmlspecialchars($city); ?>.</p>
        <?php endif; ?>
        <a href="index.php">Search Again</a>
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