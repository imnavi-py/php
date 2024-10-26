<?php
session_start(); // شروع سشن

// تنظیم هدر برای JSON
header('Content-Type: application/json');

// اتصال به دیتابیس
include 'db.php';

if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed.']);
    exit();
}

// دریافت داده‌های POST از فرم
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $firstName = $data['firstName'] ?? null;
    $lastName = $data['lastName'] ?? null;
    $phoneNumber = $data['phoneNumber'] ?? null;
    $emailAddress = $data['emailAddress'] ?? null;
    $username = $data['username'] ?? null;
    $password = isset($data['password']) ? password_hash($data['password'], PASSWORD_DEFAULT) : null;
    $userCash = 0.00;

    // بررسی یکتایی نام کاربری و ایمیل
    $checkSql = "SELECT COUNT(*) FROM users WHERE username = ? OR emailAddress = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("ss", $username, $emailAddress);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();

    if ($count > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Username or email already exists.']);
        exit();
    }

    // بررسی اینکه آیا همه فیلدهای اجباری پر شده‌اند
    if ($firstName && $lastName && $phoneNumber && $emailAddress && $username && $password) {
        // اجرای کوئری
        $sql = "INSERT INTO users (firstName, lastName, phoneNumber, emailAddress, username, password, userCash) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssd", $firstName, $lastName, $phoneNumber, $emailAddress, $username, $password, $userCash);

        if ($stmt->execute()) {
            // ذخیره اطلاعات کاربر در سشن
            $_SESSION['username'] = $username;
            echo json_encode(['status' => 'success', 'message' => 'Registration successful! Redirecting...']);
            exit();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error: Registration failed.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'All mandatory fields are required.']);
    }
}

$conn->close();
?>
