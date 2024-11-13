<?php
// اتصال به پایگاه داده
include 'db.php'; // فایل اتصال به دیتابیس

session_start();

// بررسی اینکه آیا نام کاربری در کوکی‌ها وجود دارد
if (isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];

    // کوئری برای خواندن اطلاعات کاربر بر اساس نام کاربری
    $sql = "SELECT firstName FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $firstName = $user['firstName'];
    } else {
        $firstName = '';
    }
} else {
    $firstName = '';
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فروشگاه تلفن همراه</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<!-- شمارش سبد خرید -->
<div>
    <span>سبد خرید: </span><span id="cartCount">0</span> <!-- تعداد آیتم‌ها در سبد خرید اینجا نمایش داده می‌شود -->
</div>
<!-- Header -->
<header class="bg-blue-700 p-4 shadow-lg">
    <div class="container mx-auto flex items-center justify-between">
        <h1 class="text-white text-2xl font-bold">فروشگاه تلفن همراه</h1>
        <div class="relative flex-grow max-w-md mx-4">
            <input type="text" placeholder="جستجو در محصولات..." class="w-full p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button class="absolute right-0 top-0 p-2 bg-blue-500 text-white rounded-r-md">جستجو</button>
        </div>
        <nav class="space-x-4 text-white">
            <a href="#home" class="hover:text-gray-300">خانه</a>
            <a href="#products" class="hover:text-gray-300">محصولات</a>
            <a href="#offers" class="hover:text-gray-300">پیشنهاد ویژه</a>
            <a href="#contact" class="hover:text-gray-300">تماس با ما</a>
        </nav>
        <div class="flex items-center space-x-4">
            <!-- دکمه ورود که در صورت لاگین شدن به جای آن اسم کاربر نمایش داده می‌شود -->
            <button id="loginButton" class="text-white hover:text-gray-300">
                <?php
                if ($firstName != '') {
                    echo $firstName; // نمایش نام کاربر
                } else {
                    echo 'ورود';
                }
                ?>
            </button>
<<<<<<< HEAD
            <button class="text-white hover:text-gray-300">
            <?php
                if ($firstName != '') {
                    echo ""; // نمایش نام کاربر
                } else {
                    echo 'ثبت‌نام';
                }
                ?>

            </button>
            
            <!-- آیکون سبد خرید با نمایش تعداد محصولات -->
            <div class="relative">
                <button class="text-white hover:text-gray-300">
                    <i class="fas fa-shopping-cart"></i> <!-- آیکون سبد خرید -->
                </button>
                <span id="cartCount" class="absolute top-0 right-4 bg-red-600 text-white rounded-full text-xs px-2 py-1">0</span> <!-- تعداد محصولات -->
            </div>
=======
            <button class="text-white hover:text-gray-300">ثبت‌نام</button>
            <a href="cart.html" class="text-gray-800 hover:text-blue-600">سبد خرید</a>
>>>>>>> d9e8c845db35a476a89bacb9eaff621c27c3261f
        </div>
    </div>
</header>

    <!-- Main Banner Slider -->
    <section class="bg-gray-100 py-8">
        <div class="container mx-auto">
            <div class="relative overflow-hidden rounded-lg shadow-lg">
                <!-- اسلایدر تصاویر -->
                <div id="slider" class="h-80 bg-blue-300 flex items-center justify-center text-white text-3xl font-bold">
                    <img id="slide-image" src="assets/images/image1.jpg" alt="پیشنهادات ویژه" class="w-full h-full object-cover rounded-lg">
                </div>
                <!-- دکمه‌های اسلایدر -->
                <button onclick="prevSlide()" class="absolute top-1/2 left-4 bg-blue-500 text-white p-3 rounded-full transform -translate-y-1/2 hover:bg-blue-700">قبلی</button>
                <button onclick="nextSlide()" class="absolute top-1/2 right-4 bg-blue-500 text-white p-3 rounded-full transform -translate-y-1/2 hover:bg-blue-700">بعدی</button>
            </div>
        </div>
    </section>

<!-- Special Offers Section -->
<section id="offers" class="container mx-auto py-8">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">پیشنهادات ویژه</h2>
    <div id="offers-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- کارت پیشنهادات ویژه در اینجا داینامیک اضافه خواهد شد -->
    </div>
</section>

    <!-- بخش محصولات -->
    <section id="products" class="container mx-auto py-8">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">محصولات ما</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- کارت محصول -->
            <div class="bg-white shadow-lg rounded-lg p-4">
                <img src="https://via.placeholder.com/150" alt="گوشی موبایل" class="w-full h-48 object-cover rounded-md">
                <h3 class="text-lg font-semibold text-gray-800 mt-4">مدل گوشی</h3>
                <p class="text-gray-600 mt-2">توضیحات کوتاه از محصول</p>
                <div class="mt-4 flex items-center justify-between">
                    <span class="text-blue-600 font-bold">1,000,000 تومان</span>
                    <button class="bg-blue-600 text-white py-1 px-4 rounded-md hover:bg-blue-700" onclick="addToCart()">افزودن به سبد</button>
                </div>
            </div>
            <!-- سایر محصولات -->
        </div>
    </section>

    <!-- Contact and Social Media Links -->
    <section id="contact" class="bg-blue-700 text-white py-8">
        <div class="container mx-auto text-center">
            <h3 class="text-2xl font-bold mb-4">تماس با ما</h3>
            <p class="mb-4">آدرس: تهران، خیابان انقلاب</p>
            <p>تلفن: 12345678</p>
            <div class="mt-6 flex justify-center space-x-4">
                <a href="#" class="text-white hover:text-gray-200"><i class="fab fa-facebook-f"></i> فیسبوک</a>
                <a href="#" class="text-white hover:text-gray-200"><i class="fab fa-instagram"></i> اینستاگرام</a>
                <a href="#" class="text-white hover:text-gray-200"><i class="fab fa-telegram"></i> تلگرام</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white py-4 text-center">
        <p>© 2024 فروشگاه تلفن همراه - تمام حقوق محفوظ است.</p>
    </footer>



    <script>

        // مقداردهی اولیه سبد خرید
        let cart = [];

        
        // آرایه‌ای از مسیر تصاویر
        const images = [
            'assets/images/1.jpg',
            'assets/images/2.jpg',
            // 'assets/images/3.jpg'
        ];
        
        let currentIndex = 0; // شاخص تصویر فعلی

        // تابع برای نمایش اسلاید قبلی
        function prevSlide() {
            currentIndex = (currentIndex === 0) ? images.length - 1 : currentIndex - 1;
            document.getElementById('slide-image').src = images[currentIndex];
        }

        // تابع برای نمایش اسلاید بعدی
        function nextSlide() {
            currentIndex = (currentIndex === images.length - 1) ? 0 : currentIndex + 1;
            document.getElementById('slide-image').src = images[currentIndex];
        }

        // تنظیم تغییر خودکار اسلاید‌ها هر 5 ثانیه
        setInterval(nextSlide, 5000);


        // درخواست API برای دریافت داده‌ها
<<<<<<< HEAD
        fetch('http://localhost/Fixed/api_mobile.php') // آدرس API خود را اینجا وارد کنید
=======
        fetch('http://localhost/api_mobile.php') // آدرس API خود را اینجا وارد کنید
>>>>>>> d9e8c845db35a476a89bacb9eaff621c27c3261f
            .then(response => response.json())
            .then(data => {
                // فراخوانی تابع برای نمایش داده‌ها
                renderOffers(data);
            })
            .catch(error => console.error('Error:', error));

        // تابع برای نمایش داده‌ها در HTML
        function renderOffers(data) {
            const offersContainer = document.getElementById('offers-container');
            
            data.forEach(item => {
                const offerCard = document.createElement('div');
                offerCard.classList.add('bg-white', 'shadow-md', 'rounded-lg', 'p-4');

                offerCard.innerHTML = `
                    <img src="https://via.placeholder.com/150" alt="${item.product} ${item.model}" class="w-full h-48 object-cover rounded-md">
                    <h3 class="text-lg font-semibold text-gray-800 mt-4">${item.product} ${item.model}</h3>
                    <p class="text-gray-500 mt-2">رنگ: ${item.color} | رم: ${item.ram}</p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-red-600 font-bold line-through">${parseInt(item.price) + 300,000} تومان</span>
                        <span class="text-blue-600 font-bold">${item.price} تومان</span>
                    </div>
                    <button class="mt-4 bg-blue-600 text-white py-1 px-4 rounded-md hover:bg-blue-700 w-full">افزودن به سبد</button>
                `;

                // اضافه کردن کارت به کانتینر
                offersContainer.appendChild(offerCard);
            });
        }

        // تابع افزودن محصول به سبد خرید
        function addToCart() {
            // افزودن یک محصول (برای سادگی اینجا فقط یک آیتم اضافه می‌شود)
            cart.push("product");

            // به‌روزرسانی شمارش سبد خرید
            document.getElementById('cartCount').innerText = cart.length;
        }

        
        // افزودن محصول به سبد خرید
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const product = {
                    name: this.parentElement.querySelector('h3').innerText,
                    price: this.parentElement.querySelector('.text-blue-600').innerText,
                };

                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                cart.push(product);
                localStorage.setItem('cart', JSON.stringify(cart));

                // به‌روزرسانی تعداد محصولات در سبد خرید
                document.getElementById('cartCount').innerText = cart.length;
            });
        });

        // بارگذاری تعداد محصولات از localStorage
        window.onload = function() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            document.getElementById('cartCount').innerText = cart.length;
        };

    </script>

</body>
</html>