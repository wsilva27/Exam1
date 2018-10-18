<?php
// // Welbert Marques Silva
// Web Programming II - PHP
// Fall 2018
// Practical Test 1
$conn = mysqli_connect("127.0.0.1:3306", "root", "") or die(mysql_error());
$db = mysqli_select_db($conn, "registration") or die(mysql_error($conn));
$con = mysqli_connect("127.0.0.1:3306", "root", "") or die(mysql_error());
$db2 = mysqli_select_db($con, "cis485test1test1") or die(mysql_error($con));
?>
