CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    phoneNumber VARCHAR(15) NOT NULL,
    emailAddress VARCHAR(100) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    userCash DECIMAL(10, 2) DEFAULT 0.00
);





<?php
header('Content-Type: application/json');
include 'db.php'; 

$requestMethod = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents('php://input'), true);

session_start();

if ($requestMethod == 'POST') {

    $emailAddress = $data['emailAddress'];
    $password = $data['password'];

    $sql = "SELECT * FROM users WHERE emailAddress=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $emailAddress);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            echo json_encode(["message" => "Login successful", "redirect" => "dashboard.php"]);
            exit();
        } else {
            echo json_encode(["error" => "Invalid password."]);
        }
    } else {
        echo json_encode(["error" => "No user found with this email."]);
    }

    $stmt->close();
}

$conn->close();
?>
