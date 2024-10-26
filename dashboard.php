<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>داشبورد وب‌سایت</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1 style="color: white;">لوگوی سایت</h1>
    <nav>
        <a href="#">خانه</a>
        <a href="#">خدمات</a>
        <a href="#">درباره ما</a>
        <a href="#">تماس با ما</a>
    </nav>
    <div style="color: white;">
        <p>کاربر: <?php echo $user['firstName'] . " " . $user['lastName']; ?> | <a href="logout.php" style="color: white;">خروج</a></p>
    </div>
</header>

<div class="submenu">
    <a href="#">اخبار</a>
    <a href="#">رویدادها</a>
    <a href="#">مقالات</a>
    <a href="#">گالری</a>
</div>

<div class="slider">
    <div class="slides">
        <div class="slide" style="background-image: url('assets/image1.jpg');"></div>
        <div class="slide" style="background-image: url('assets/image2.jpg');"></div>
        <div class="slide" style="background-image: url('assets/image3.jpg');"></div>
    </div>
</div>

<div class="content">
    <h2>آخرین اخبار و مطالب</h2>
    <p>این قسمت می‌تواند شامل بلاگ‌پست‌ها و اخبار جدید باشد.</p>
</div>

<footer>
    <p>© 2024 تمامی حقوق محفوظ است</p>
    <p><a href="#" style="color: white;">سیاست‌نامه</a> | <a href="#" style="color: white;">شرایط و ضوابط</a></p>
</footer>

<script src="script.js"></script>

</body>
</html>
