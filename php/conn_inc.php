<?php
    // Welbert Marques Silva
    // Web Programming II - PHP
    // Fall 2018
    // Practical Test 1
    $conn = mysqli_connect('localhost:8889', 'root', 'root') or die(mysqli_error($conn));
    $db = mysqli_select_db($conn, 'registration') or die(mysqli_error($conn));
    $con = mysqli_connect("localhost", "root", "root") or die(mysqli_error($con));
    $db2 = mysqli_select_db($con, "cis485test1") or die(mysqli_error($con));
?>
