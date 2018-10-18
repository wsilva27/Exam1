<?php
    include "conn_inc.php";
    // Welbert Marques Silva
    // Web Programming II - PHP
    // Fall 2018
    // Practical Test 1
    // Get information from Order
    $usertxt = $_SESSION['user_logged'] ? $_SESSION['user_logged'] : "Guest";
    echo $_SESSION['user_logged'] ? "" : "<p style='color:red;'>User browser does not support session</p>";
    $product1 = $_POST['productid1'];
    $product2 = $_POST['productid2'];
    $product3 = $_POST['productid3'];
    $q1 = $_POST['quantity1'] ? $_POST['quantity1'] : 0;
    $q2 = $_POST['quantity2'] ? $_POST['quantity2'] : 0;
    $q3 = $_POST['quantity3'] ? $_POST['quantity3'] : 0;
    // Insert new order in the ordertbl:
    $query = "INSERT INTO ordertbl (
              username,
              qty1,
              qty2,
              qty3)
              VALUES ('$usertxt',$q1,$q2,$q3);";
    $message1 = "Items added to Order table.";
    $results = mysqli_query($con, $query) or die(mysqli_error($con));
    // Update the inventory:
    $query = "UPDATE inventory SET QtyOnHand = ";
    $query .= "(QtyOnHand - $q1) WHERE prodid = '$product1'";
    $results = mysqli_query($con, $query) or die(mysqli_error($con));
    $query = "UPDATE inventory SET QtyOnHand = ";
    $query .= "(QtyOnHand - $q2) WHERE prodid = '$product2'";
    $results = mysqli_query($con, $query) or die(mysqli_error($con));
    $query = "UPDATE inventory SET QtyOnHand = ";
    $query .= "(QtyOnHand - $q3) WHERE prodid = '$product3'";
    $results = mysqli_query($con, $query) or die(mysqli_error($con));
    $message2 = "Inventory Quantities Updated.";
?>
<html>
<head>
    <title>The PHP Store</title>
</head>
<body>
    <h1>PHP Store Order Confirmation</h1>
    Database Maintenance<br />
    Orders Table: <?php echo $message1 ."<br />"; ?>
    Inventory: <?php echo $message2 ."<br />"; ?>
    <center>
    <table width="600" cellspacing="1" cellpadding="1"
    border="1" align="center" style="border-collapse:collapse">
    <caption>
        <h2>Order placed by: <?php echo $usertxt; ?></h2>
    </caption>
    <tr>
        <th>Userid</th>
        <th>Product No.</th>
        <th>Qty</th>
    </tr>
    <tr bgcolor="#EDF7EC">
        <td><?php echo $usertxt; ?></td>
        <td><?php echo $product1; ?></td>
        <td><?php echo $q1; ?></td>
    </tr>
    <tr bgcolor="#E0F2DC">
        <td><?php echo $usertxt; ?></td>
        <td><?php echo $product2; ?></td>
        <td><?php echo $q2; ?></td>
    </tr>
    <tr bgcolor="#EDF7EC">
        <td><?php echo $usertxt; ?></td>
        <td><?php echo $product3; ?></td>
        <td><?php echo $q3; ?></td>
    </tr>
    </table>
    </center>
    <hr />
    <br /><br /><center><a href="index.php">Main Menu</a></center>
</body>
</html>
