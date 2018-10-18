<?php
    session_start();
    ob_start();
    //connect to the database
    include "conn_inc.php";
    $query = "SELECT * FROM inventory";
    $results = mysqli_query($con, $query) or die(mysqli_error($con));
?>
<html>
<head>
    <title>The PHP Store</title>
</head>
<body>
    <h2>PHP Store Inventory</h2>
    <table width="500" align="center" border="1">
        <tr>
            <th width="25%">Product ID</th>
            <th width="25%">Description</th>
            <th width="25%">Quantity<br />On Hand</th>
            <th width="25%">Price</th>
        </tr>
        <?php
            $numbr = 1;
            while ($row = mysqli_fetch_array($results)) {
                extract($row);
                if ($numbr%2==0) {
                    echo "<tr bgcolor=\"#EDF7EC\">";
                }
                else
                    echo "<tr bgcolor=\"#E0F2DC\">";
                echo "<td width=\"25%\" align=\"center\">";
                echo $prodid;
                echo "<td width=\"25%\" align=\"center\">";
                echo $proddesc;
                echo "<td width=\"25%\" align=\"center\">";
                echo $QtyOnHand;
                echo "</td><td width=\"25%\" align=\"center\">$";
                echo $price;
                echo "</td></tr>";
                $numbr += 1;
            }
        ?>
    </table>
    <br /><br />
    <hr />
    <center><a href="index.php">Main Page</a></center>
</body>
</html>
