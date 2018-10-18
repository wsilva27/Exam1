<?php
    include "auth_user_inc.php";
    include "conn_inc.php";
    // Welbert Marques Silva
    // Web Programming II - PHP
    // Fall 2018
    // Practical Test 1
?>
<html>
<head>
    <title>The PHP Store</title>
</head>
<body>
    <h1>Welcome to your personal information area</h1>
    <p>
        Here you can update your personal information.<br />
        Your personal information is shown below:<br />
        <a href="index.php">Click here</a> to return to the home page<br /><br>
        <?php
            $query = "SELECT * FROM user_info " .
                     "WHERE username = '" . $_SESSION['user_logged'] . "' " .
                     "AND password = (PASSWORD('" . $_SESSION['user_password'] . "')) ";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
            $row = mysqli_fetch_array($result);
        ?>
        First Name: <?php echo $row['first_name']; ?><br />
        Last Name: <?php echo $row['last_name']; ?><br />
        City: <?php echo $row['city']; ?><br />
        State: <?php echo $row['state']; ?><br />
        Email: <?php echo $row['email']; ?><br />
        Hobbies/Interests: <?php echo $row['hobbies']; ?><br /><br />
        <a href="update_account.php">Update Account</a>
    </p>
</body>
</html>
