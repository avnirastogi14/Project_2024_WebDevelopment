<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travelvista";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nameExists = false;
$message = "";
$userEmail = $_SESSION['email'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST['name'];
    $review = $_POST['review'];

    $stmt = $conn->prepare("SELECT COUNT(*) FROM bookings WHERE name = ?");
    $stmt->bind_param("s", $userName);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        $stmt = $conn->prepare("INSERT INTO reviews (name, review) VALUES (?, ?)");
        $stmt->bind_param("ss", $userName, $review);
        
        if ($stmt->execute()) {
            $message = "Review posted successfully!";
        } else {
            $message = "Error posting review: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = "Name does not exist in the bookings table.";
    }
}

$pastReviews = [];
$stmt = $conn->prepare("SELECT review FROM reviews WHERE name = ? ORDER BY id DESC");
$stmt->bind_param("s", $userName);
$stmt->execute();
$stmt->bind_result($pastReview);
while ($stmt->fetch()) {
    $pastReviews[] = htmlspecialchars($pastReview);
}
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews - Travel Vista</title>
    <link rel="stylesheet" href="rev_style.css">
</head>
<style>body {
    font-family: 'Arial', sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

.container {
    width: 90%;
    max-width: 1000px;
    margin: 20px auto;
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

header {
    text-align: center;
    margin-bottom: 30px;
}

h1 {
    color: #333;
    font-size: 2.5em;
}

h2 {
    color: #444;
    margin-top: 40px;
    font-size: 1.8em;
}

p {
    color: #666;
}

form {
    margin-bottom: 40px;
}

label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

input[type="text"],
textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 16px;
    transition: border-color 0.3s;
}

input[type="text"]:focus,
textarea:focus {
    border-color: #007bff;
    outline: none;
}

button {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #218838;
}

.message {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
    padding: 15px;
    border-radius: 6px;
    margin-bottom: 30px;
}

.past-reviews-list,
.reviews-list {
    margin-top: 30px;
}

.review {
    background-color: #f8f9fa;
    border-left: 5px solid #007bff;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 6px;
}

.review strong {
    color: #007bff;
}

@media (max-width: 768px) {
    .container {
        width: 95%;
    }

    h1, h2 {
        font-size: 1.8em;
    }

    button {
        width: 100%;
    }
}
</style>
<body>
    <div class="container">
        <header>
            <h1>Post a Review</h1>
            <p>Share your experience with us!</p>
        </header>
        
        <form action="review.php" method="post">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="review">Your Review:</label>
            <textarea id="review" name="review" rows="5" required></textarea>
            
            <button type="submit">Submit Review</button>
        </form>

        <?php if ($message): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <h2>Your Past Reviews</h2>
        <div class="past-reviews-list">
            <?php if (!empty($pastReviews)): ?>
                <?php foreach ($pastReviews as $pastReview): ?>
                    <div class='review'>
                        <strong>Your Review:</strong> <?php echo $pastReview; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>You have not posted any reviews yet.</p>
            <?php endif; ?>
        </div>

        <h2>All Reviews</h2>
        <div class="reviews-list">
            <?php
            $conn = new mysqli($servername, $username, $password, $dbname);
            $result = $conn->query("SELECT name, review FROM reviews ORDER BY id DESC");

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='review'>";
                    echo "<strong>" . htmlspecialchars($row['name']) . ":</strong> " . htmlspecialchars($row['review']);
                    echo "</div>";
                }
            } else {
                echo "<p>No reviews yet.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>