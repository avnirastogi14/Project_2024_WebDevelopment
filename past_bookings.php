<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Past Bookings - Travel Vista</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background-color: #007bff; 
            color: white;
            text-align: center;
            padding: 1rem 0;
        }

        main {
            max-width: 800px;
            margin: 2rem auto;
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        h1, h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th, td {
            text-align: left;
            padding: 0.8rem;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        footer {
            text-align: center;
            padding: 1rem 0;
            margin-top: 2rem;
            background-color: #333;
            color: white;
        }
    </style>
</head>
<body>
    <?php
    session_start(); 
    if (!isset($_SESSION['email'])) {
        header("Location: login.php"); 
        exit;
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "travelvista"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user_email = $_SESSION['email']; 

    $sql = "SELECT b.hotel_id, b.checkin_date, b.checkout_date, b.special_requests, h.name AS hotel_name 
            FROM bookings b 
            JOIN hotels h ON b.hotel_id = h.id 
            WHERE b.user_email = ?"; 
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result();

    ?>

    <header>
        <h1>Travel Vista</h1>
    </header>
    <main class="container">
        <h2>Your Past Bookings</h2>
        <?php if ($result->num_rows > 0): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Hotel Name</th>
                        <th>Check-in Date</th>
                        <th>Check-out Date</th>
                        <th>Special Requests</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['hotel_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['checkin_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['checkout_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['special_requests']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center">You have no past bookings.</p>
        <?php endif; ?>
    </main>
    <footer>
        <p>&copy; 2024 Travel Vista. All Rights Reserved.</p>
    </footer>

    <?php
    $stmt->close();
    $conn->close();
    ?>
</body>
</html>