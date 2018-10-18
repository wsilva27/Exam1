<?php
session_start();
ob_start();
include "conn_inc.php";

// Welbert Marques Silva
// Web Programming II - PHP
// Fall 2018
// Practical Test 1

 $prod1 = $_POST["productid1"];
 $prod2 = $_POST["productid2"];
 $prod3 = $_POST["productid3"];

 $username = $_SESSION['user_logged'];

 $quantity1 = $_POST["qty1"];
 $quantity2 = $_POST["qty2"];
 $quantity3 = $_POST["qty3"];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>The PHP Store</title>
</head>
<body>
<div>
<!--<?php include("movie.php"); ?>-->
<table width="500" border="0" cellspacing="0" cellpadding="0">
<form method="post" action="confirmation.php">
<table width="60%" cellspacing="2" cellpadding="2"
       align="center" border="1" style="border-collapse:collapse;">
<tr>
     <td align="left" bgcolor="#D1D1D1" colspan="6">
    Order Detail.  Placed by: <?php echo $_SESSION['user_logged']; ?></td>
</tr>
<tr>
     <th>&nbsp;</th>
     <th>Description</th>
     <th>Unit<br />Price</th>
     <th>Quantity</th>
</tr>
<tr> <td align="center">
     <img src="<?php echo $prod1; ?>.jpg" width="59" height="75"></td>
     <td align="center">Yellow Scarf</td>
     <td align="center">$15.00</td>
     <td align="center">
          <?php echo $quantity1; ?>
<input type="hidden" name="productid1" value="0001" />
<input type="hidden" name="quantity1" value="<?php echo $quantity1; ?>"/>
     </td>
</tr>
<tr> <td align="center">
     <img src="<?php echo $prod2; ?>.jpg" width="83" height="125"></td>
     <td align="center">Green Gloves</td>
     <td align="center">$20.00</td>
     <td align="center">
          <?php echo $quantity2; ?>
          <input type="hidden" name="productid2" value="0002" />
<input type="hidden" name="quantity2" value="<?php echo $quantity2; ?>"/>
     </td>
</tr>
<tr> <td align="center">
     <img src="<?php echo $prod3; ?>.jpg" width="88" height="88"></td>
     <td align="center">Red Skirt</td>
     <td align="center">$25.00</td>
     <td align="center">
          <?php echo $quantity3; ?>
<input type="hidden" name="productid3" value="0003" />
<input type="hidden" name="quantity3" value="<?php echo $quantity3; ?>"/>
     </td>
</tr>
<tr> <td colspan="4" align="center">
     <input type="submit" value="Confirm Order"></td>
</tr>
</table>

<br />
</form>
</div>
</body></html>
