<?php
    session_start();
    // your_name_here
    // Web Programming II - PHP
    // Fall 2018
    // Practical Test 1
?>
<html>
<head>
    <title>The PHP Store</title>
</head>
<body>
    <h1>Thank you for logging into our system
        <b><?php echo $_SESSION['user_logged']; ?></b></h1>
    <p>Orders System Main Menu:</p>
    <ol>
        <li><a href="user_personal.php">Edit your personal Information</a></li>
        <li><a href="orderForm.php">Enter the Order System</a></li>
        <li><a href="inventorytest.php">Inventory Table Maintenance</a></li>
        <li><a href="ordertest.php">Order Table Maintenence</a></li>
        <li><a href="usertest.php">Registered Users</a></li>
    </ol>
</body>
</html>
