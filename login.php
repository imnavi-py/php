<?php
header('Content-Type: application/json');
include 'db.php'; // فایل اتصال به دیتابیس

session_start();

// بررسی اینکه آیا درخواست از نوع POST است
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // دریافت داده‌ها از JSON
    $data = json_decode(file_get_contents('php://input'), true);

    // بررسی اینکه داده‌ها موجود باشند
    $username = isset($data['username']) ? $data['username'] : null;
    $password = isset($data['password']) ? $data['password'] : null;

    // بررسی اینکه مقادیر `username` و `password` تهی نباشند
    if ($username && $password) {
        // کوئری برای جستجوی کاربر
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // بررسی رمز عبور
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                setcookie("username", $username, time() + (86400 * 30), "/"); // تنظیم کوکی برای 30 روز
                echo json_encode(["status" => "success", "message" => "Login successful!"]);
                exit();
            } else {
                echo json_encode(["message" => "Invalid password."]);
            }
        } else {
            echo json_encode(["message" => "No user found with this username."]);
        }
    } else {
        echo json_encode(["message" => "Username or password is missing."]);
    }
}


// بستن اتصال دیتابیس
$conn->close();
?>
