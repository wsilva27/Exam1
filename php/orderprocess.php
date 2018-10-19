<?php
    if(!isset($_SESSION))
        session_start();
    ob_start();
    include "conn_inc.php";

    // Welbert Marques Silva
    // Web Programming II - PHP 
    // Fall 2018
    // Practical Test 1     

    $productid = $_POST["productid"];
    $productdesc = $_POST["productdesc"];
    $price = $_POST["price"];
    $quantity = $_POST["qty"];
    
    $username = $_SESSION['user_logged'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>The PHP Store</title>
</head>
<body>
    <div>
        <table width="500" border="0" cellspacing="0" cellpadding="0">
            <form method="post" action="confirmation.php">
                <table width="60%" cellspacing="2" cellpadding="2"        
                    align="center" border="1" style="border-collapse:collapse;">        
                    <tr>   
                        <td align="left" bgcolor="#D1D1D1" colspan="6">      
                            Order Detail.  Placed by: <?php echo $_SESSION['user_logged']; ?>
                        </td> 
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Description</th>
                        <th>Unit<br />Price</th>
                        <th>Quantity</th>  
                    </tr>
                    <?php
                        for($i = 0; $i < count($productid); $i++){
                            if($quantity[$i] > 0){
                                echo "<tr>";
                                echo "<td align='center'>";
                                echo "<img src='{$productid[$i]}.jpg' width='59' height='75'>";
                                echo "</td>";
                                echo "<td align='center'>{$productdesc[$i]}</td>";
                                echo "<td align='center'>{$price[$i]}</td>";
                                echo "<td align='center'>{$quantity[$i]}";
                                echo "<input type='hidden' name='productid[]' value='{$productid[$i]}' />";
                                echo "<input type='hidden' name='price[]' value='{$price[$i]}'/>";
                                echo "<input type='hidden' name='quantity[]' value='{$quantity[$i]}'/>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        }
                    ?>
                    <tr>
                        <td colspan="4" align="center">
                            <input type="submit" value="Confirm Order">
                        </td>
                    </tr>  
                </table> 
                <br /> 
            </form>
        </table>
    </div> 
</body>
</html>          
 
