<?php

session_start();


if (isset($_COOKIE['user_cookie'])) {
   
    header('Location: home.html');
    exit();
} else {
  
    header('Location: login.html');
    exit();
}
?>