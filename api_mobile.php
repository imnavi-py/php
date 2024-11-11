<?php
header('Content-Type: application/json');
include 'db.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];

// دریافت id از URL در صورت وجود
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

switch ($requestMethod) {
    case 'GET':
        if ($id) {
            // دریافت یک موبایل بر اساس id
            $sql = "SELECT * FROM mobiles WHERE id = $id";
            $result = $conn->query($sql);
            $mobile = $result->fetch_assoc();


            echo json_encode($mobile ? $mobile : ["message" => "Mobile not found."]);
        } else {
            // دریافت تمامی موبایل‌ها
            $sql = "SELECT * FROM mobiles";
            $result = $conn->query($sql);
            $mobiles = [];

            while ($row = $result->fetch_assoc()) {
                $mobiles[] = $row;
            }

            echo json_encode($mobiles);
        }
        break;

    case 'POST':
        // اضافه کردن موبایل جدید
        $data = json_decode(file_get_contents('php://input'), true);
        $product = $data['product'];
        $model = $data['model'];
        $color = $data['color'];
        $ram = $data['ram'];
        $price = $data['price'];

        $sql = "INSERT INTO mobiles (product, model, color, ram, price) VALUES ('$product', '$model', '$color', '$ram', '$price')";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(["message" => "Mobile added successfully."]);
        } else {
            echo json_encode(["message" => "Error: " . $conn->error]);
        }
        break;

    case 'PUT':
        // بررسی وجود id برای به‌روزرسانی
        if ($id) {
            $data = json_decode(file_get_contents('php://input'), true);
            $product = $data['product'];
            $model = $data['model'];
            $color = $data['color'];
            $ram = $data['ram'];
            $price = $data['price'];

            $sql = "UPDATE mobiles SET product='$product', model='$model', color='$color', ram='$ram', price='$price' WHERE id=$id";

            if ($conn->query($sql) === TRUE) {
                echo json_encode(["message" => "Mobile updated successfully."]);
            } else {
                echo json_encode(["message" => "Error: " . $conn->error]);
            }
        } else {
            echo json_encode(["message" => "ID is required for updating."]);
        }
        break;

    case 'DELETE':
        // بررسی وجود id برای حذف
        if ($id) {
            $sql = "DELETE FROM mobiles WHERE id=$id";

            if ($conn->query($sql) === TRUE) {
                echo json_encode(["message" => "Mobile deleted successfully."]);
            } else {
                echo json_encode(["message" => "Error: " . $conn->error]);
            }
        } else {
            echo json_encode(["message" => "ID is required for deleting."]);
        }
        break;

    default:
        echo json_encode(["message" => "Unsupported request method"]);
        break;
}

// بستن اتصال به دیتابیس
$conn->close();
?>
