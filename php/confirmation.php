<?php
    if(!isset($_SESSION))
        session_start();

    include "conn_inc.php";
    // Welbert Marques Silva
    // Web Programming II - PHP
    // Fall 2018
    // Practical Test 1
    // Get information from Order
    $usertxt = $_SESSION['user_logged'] ? $_SESSION['user_logged'] : "Guest";
    echo $_SESSION['user_logged'] ? "" : "<p style='color:red;'>User browser does not support session</p>";
    
    $productid = $_POST["productid"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    $totalqty = 0;
    for($i = 0; $i < count($productid); $i++){
        $totalqty += $quantity[$i];
    }

    if($totalqty > 0){
        $query = "INSERT INTO orders (username, orderdate)
                  VALUES ('$usertxt', NOW());";
        $results = mysqli_query($con, $query) or die(mysqli_error($con));
        $orderid = mysqli_insert_id($con);
        $message1 = "Order added to Order table.";

        for($i = 0; $i < count($productid); $i++){
            $query = "INSERT INTO orderdetails (orderid, prodid, qty, unitprice)
                      VALUES ($orderid, '$productid[$i]', $quantity[$i], $price[$i]);";
            $results = mysqli_query($con, $query) or die(mysqli_error($con));
            $query = "UPDATE inventory SET QtyOnHand = ";
            $query .= "(QtyOnHand - $quantity[$i]) WHERE prodid = '$productid[$i]'";
            $results = mysqli_query($con, $query) or die(mysqli_error($con));            
            $message2 = "Inventory Quantities Updated.";
        }
    }
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
    <?php
        for($i = 0; $i < count($productid); $i++){
            echo "<tr bgcolor='".($i % 2 == 0 ? "#EDF7EC" : "E0F2DC")."'>";
            echo "<td>$usertxt</td>";
            echo "<td>$productid[$i]</td>";
            echo "<td>$quantity[$i]</td>";
            echo "</tr>";
        }
    ?>
    </table>
    </center>
    <hr />
    <br /><br /><center><a href="index.php">Main Menu</a></center>
</body>
</html>
