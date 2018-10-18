<?php
    session_start();
    ob_start();
    //connect to the database
    include "conn_inc.php";
    $query = "SELECT * FROM inventory";
    $results = mysqli_query($con, $query) or die(mysqli_error($con));
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>The PHP Store</title>
    <meta name="Generator" content="Alleycode HTML Editor" />
    <meta name="Description" content="PHP Order System Order Form" />
    <meta name="Keywords" content="PHP, Order, Database Usage" />
</head>
<body>
    <div>
        <!--<?php include("movie.php"); ?>-->
        <table width="500" border="0" cellspacing="0" cellpadding="0">
            <form method="post" action="orderProcess.php">
                <table width="60%" cellspacing="2" cellpadding="2"
                    align="center" border="1" style="border-collapse:collapse;">
                    <tr>
                        <td align="left" bgcolor="#D1D1D1" colspan="6">
                            <b>Welcome! Ordering System.
                            Orders for <?php echo $_SESSION['user_logged']; ?><br /></b></td>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Description</th>
                        <th>Unit<br />Price</th>
                        <th>Quantity</th>
                    </tr>
                    <!-- beginning product listing -->
                    <?php
                        $numbr = 1;
                        while ($row = mysqli_fetch_array($results)) {
                            extract($row);
                            if ($numbr%2==0)
                                echo "<tr bgcolor=\"#EDF7EC\">\n";
                            else
                                echo "<tr bgcolor=\"#E0F2DC\">\n";
                            echo "<td width=\"25%\" align=\"center\"><img src='";
                            echo $prodid .".jpg' width='59' height='75'>\n";
                            echo "<input type='hidden' name='productid"
                                .$numbr. "' value=" .$prodid ." /></td>\n";
                            echo "<td width=\"25%\" align=\"center\">";
                            echo $proddesc;
                            echo "</td>\n<td width=\"25%\" align=\"center\">$";
                            echo $price;
                            echo "</td>\n<td width=\"25%\" align=\"center\">";
                            echo "<input type='text'' name='qty"
                                .$numbr ."' size='5' style='text-align:right' />";
                            echo "</td>\n</tr>\n";
                            $numbr += 1;
                        }
                    ?>
                    <!-- end product listing -->
                    <tr>
                        <td colspan="2" align="center"><input type="submit" value="Submit"></td>
                        <td colspan="2" align="center"><input type="reset"></td>
                    </tr>
                </table>
                <br />
            </form>
        </table>
    </div>
    <hr /><br /><center><a href="index.php">Main Page</a></center>
</body>
</html>
