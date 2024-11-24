<?php
$conn = new mysqli("localhost", "root", "", "travelvista");

$conn->select_db("travelvista");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            session_start();
            $_SESSION['email'] = $email; 
            header("Location: login.php");
            exit(); 
        } else {
            echo "<script>alert('Invalid password!'); window.location.href = 'form.html';</script>";
        }
    } else {
        echo "<script>alert('No user found with this email!'); window.location.href = 'form.html';</script>";
    }
    $stmt->close();
}
$conn->close();
?>