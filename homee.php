<?php
session_start(); // شروع جلسه

// بررسی اینکه آیا کاربر وارد شده است یا خیر
if (!isset($_SESSION['username'])) {
    // هدایت به صفحه ورود در صورتی که کاربر وارد نشده باشد
    header("Location: login.html");
} else {
    // هدایت به صفحه home.html در صورتی که کاربر وارد شده باشد
    header("Location: home.html");
}
exit(); // جلوگیری از اجرای کدهای بعدی
?>
