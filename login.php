<?php
header('Content-Type: application/json');
include 'db.php'; // فایل اتصال به دیتابیس

$requestMethod = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents('php://input'), true);

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emailAddress = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with this email.";
    }
}

$conn->close();
?>
