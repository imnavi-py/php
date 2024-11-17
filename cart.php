<?php
header('Content-Type: application/json');
include 'db.php';

// دریافت داده‌های JSON از درخواست
$requestMethod = $_SERVER['REQUEST_METHOD'];

// برای عملیات‌های POST، PUT و DELETE داده‌ها از body درخواست گرفته می‌شوند.
$data = json_decode(file_get_contents("php://input"));

switch ($requestMethod) {
    case 'POST':
        // ایجاد سفارش جدید
        if (isset($data->user_id) && isset($data->mobiles_ids) && isset($data->totalPrice) && isset($data->status)) {
            $user_id = $data->user_id;
            $mobiles_ids = json_encode($data->mobiles_ids);  // تبدیل آرایه به JSON
            $totalPrice = $data->totalPrice;
            $status = $data->status;

            $sql = "INSERT INTO orders (user_id, mobiles_ids, totalPrice, status) 
                    VALUES ('$user_id', '$mobiles_ids', '$totalPrice', '$status')";
            
            if ($conn->query($sql) === TRUE) {
                echo json_encode(["message" => "Order created successfully"]);
            } else {
                echo json_encode(["message" => "Error: " . $conn->error]);
            }
        } else {
            echo json_encode(["message" => "Missing required parameters"]);
        }
        break;

    case 'PUT':
        // آپدیت سفارش موجود
        if (isset($data->order_id) && isset($data->user_id) && isset($data->mobiles_ids) && isset($data->totalPrice) && isset($data->status)) {
            $order_id = $data->order_id;
            $user_id = $data->user_id;
            $mobiles_ids = json_encode($data->mobiles_ids);
            $totalPrice = $data->totalPrice;
            $status = $data->status;

            $sql = "UPDATE orders SET user_id = '$user_id', mobiles_ids = '$mobiles_ids', totalPrice = '$totalPrice', status = '$status' WHERE id = '$order_id'";

            if ($conn->query($sql) === TRUE) {
                echo json_encode(["message" => "Order updated successfully"]);
            } else {
                echo json_encode(["message" => "Error: " . $conn->error]);
            }
        } else {
            echo json_encode(["message" => "Missing required parameters"]);
        }
        break;

    case 'DELETE':
        // پاک کردن سفارش
        if (isset($data->order_id)) {
            $order_id = $data->order_id;

            $sql = "DELETE FROM orders WHERE id = '$order_id'";

            if ($conn->query($sql) === TRUE) {
                echo json_encode(["message" => "Order deleted successfully"]);
            } else {
                echo json_encode(["message" => "Error: " . $conn->error]);
            }
        } else {
            echo json_encode(["message" => "Missing order_id parameter"]);
        }
        break;

    case 'GET':
        // لیست کردن همه سفارشات
        $sql = "SELECT * FROM orders";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $orders = [];
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
            echo json_encode($orders);
        } else {
            echo json_encode(["message" => "No orders found"]);
        }
        break;

    default:
        echo json_encode(["message" => "Invalid request method"]);
        break;
}

// بستن اتصال به دیتابیس
$conn->close();
?>