<?php
    if(!isset($_SESSION))
        session_start();
    ob_start();
    //connect to the database
    include "conn_inc.php";
    $query = "SELECT 
                o.orderid, o.username, o.orderdate, count(d.prodid) as numberofproduct, 
                sum(d.qty) as totalqty, sum(d.qty * d.unitprice) as totalprice
              FROM orders o, orderdetails d
              WHERE o.orderid = d.orderid
              GROUP BY orderid, username, orderdate";
    $results = mysqli_query($con, $query) or die(mysqli_error($con));
    echo "<html>";
    echo "<head>";
    echo "<title>The PHP Store</title>";
    echo "</head>";
    echo "<body>";
    echo "<h2>PHP Store Orders</h2>";
    $tbl_head =<<<TBL
<table width="900" align="center" border="1">
    <tr>
        <th width="12%">Order<br />Number</th>
        <th width="20%">Placed<br />By</th>
        <th width="12%">Number<br />of Product</th>
        <th width="15%">Total Qtys</th>
        <th width="20%">Total Price</th>
        <th width="21%">Order Date</th>
    </tr>
TBL;
    echo $tbl_head;
    $numbr = 1;
    while ($row = mysqli_fetch_array($results)) {
        extract($row);
        if ($numbr%2==0)
            echo "<tr bgcolor=\"#EDF7EC\">";
        else
            echo "<tr bgcolor=\"#E0F2DC\">";
        echo "<td width=\"12%\" align=\"center\">";
        echo $orderid;
        echo "</td><td width=\"20%\" align=\"center\">";
        echo $username;
        echo "</td><td width=\"12%\" align=\"center\">";
        echo $numberofproduct;
        echo "</td><td width=\"15%\" align=\"center\">";
        echo $totalqty;
        echo "</td><td width=\"20%\" align=\"center\">";
        echo $totalprice;
        echo "</td>";
        echo "</td><td width=\"21%\" align=\"center\">";
        echo $orderdate;
        echo "</td></tr>";
        $numbr += 1;
    }
    echo "</table>";
    echo "<br /><br />";
    echo "<hr />";
    echo "<center><a href='index.php'>Main Page</a></center>";
    echo "</body>";
    echo "</html>";
?>
