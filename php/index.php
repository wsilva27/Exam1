<?php
    session_start();
    // Welbert Marques Silva
    // Web Programming II - PHP
    // Fall 2018
    // Practical Test 1
    if ((isset($_SESSION['user_logged']) &&
         $_SESSION['user_logged'] != "") &&
        (isset($_SESSION['user_password']) &&
        $_SESSION['user_password'] != "")) {
        include "logged_user.php";
    } else {
        include "unlogged_user.php";
    }
?>
