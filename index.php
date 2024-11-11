<?php
session_start();

if (isset($_COOKIE['username'])) {
    // هدایت کاربر به صفحه home.php در صورت وجود کوکی
    header('Location: home.php');
    exit();
} else {
    // هدایت کاربر به صفحه login.html در صورت نبود کوکی
    header('Location: login.html');
    exit();
}
?>