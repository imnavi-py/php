<?php
header("Content-Type: application/json");

// تنظیمات پایگاه داده
$host = 'localhost'; // آدرس سرور
$db = 'site'; // نام پایگاه داده
$user = 'root'; // نام کاربری پایگاه داده
$pass = ''; // رمز عبور پایگاه داده

// اتصال به پایگاه داده
$conn = new mysqli($host, $user, $pass, $db);

// بررسی اتصال
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// تعیین عمل مورد نظر (GET یا POST)
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // دریافت اطلاعات
    $sql = "SELECT * FROM orders";
    $result = $conn->query($sql);

    $orders = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
    }
    echo json_encode($orders);

} elseif ($method === 'POST') {
    // دریافت داده‌های JSON
    $data = json_decode(file_get_contents("php://input"), true);

    $user_id = $data['user_id'] ?? null;
    $total_price = $data['total_price'] ?? null;
    $status = $data['status'] ?? null;
    $mobile_ids = $data['mobile_ids'] ?? null;

    // بررسی اطلاعات
    if ($user_id && $total_price && $status) {
        $stmt = $conn->prepare("INSERT INTO cart (user_id, total_price, status, mobile_ids) VALUES (?, ?, ?, ?)");
        
        // بررسی موفقیت آماده‌سازی
        if ($stmt === false) {
            die(json_encode(["error" => "Prepare failed: " . $conn->error]));
        }

        // بایند کردن پارامترها
        $stmt->bind_param("ssss", $user_id, $total_price, $status, $mobile_ids);
        
        // اجرای دستور
        if ($stmt->execute()) {
            echo json_encode(["success" => "Order created successfully."]);
        } else {
            echo json_encode(["error" => "Error: " . $stmt->error]);
        }
    
        $stmt->close();
    } else {
        echo json_encode(["error" => "Missing required fields."]);
    }
} else {
    echo json_encode(["error" => "Invalid request method."]);
}

// بستن اتصال
$conn->close();
?>
