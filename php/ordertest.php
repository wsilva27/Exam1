<?php
session_start();
ob_start();
//connect to the database
include "conn_inc.php";

$query = "SELECT * FROM ordertbl";
$results = mysqli_query($con, $query)
  or die(mysqli_error($con));


echo "<html>";
echo "<head>";
echo "<title>The PHP Store</title>";
echo "</head>";
echo "<body>";
echo "<h2>PHP Store Orders</h2>";

$tbl_head =<<<TBL
<table width="500" align="center" border="1">
  <tr>
    <th width="20%">Order Number</th>
    <th width="20%">Placed<br />By</th>
    <th width="20%">Quantity 1</th>
    <th width="20%">Quantity 2</th>
    <th width="20%">Quantity 3</th>
  </tr>
TBL;

echo $tbl_head;

$numbr = 1;

while ($row = mysqli_fetch_array($results)) {
  extract($row);
    if ($numbr%2==0) {
         echo "<tr bgcolor=\"#EDF7EC\">";
  }
  else
         echo "<tr bgcolor=\"#E0F2DC\">";
  echo "<td width=\"20%\" align=\"center\">";
  echo $ordernum;
  echo "</td><td width=\"20%\" align=\"center\">";
  echo $username;
  echo "</td><td width=\"20%\" align=\"center\">";
  echo $qty1;
  echo "</td><td width=\"20%\" align=\"center\">";
  echo $qty2;
  echo "</td><td width=\"20%\" align=\"center\">";
  echo $qty3;
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
