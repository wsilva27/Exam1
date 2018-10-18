<?php
session_start();
ob_start();
//connect to the database
include "conn_inc.php";

$query = "SELECT * FROM user_info";
$results = mysqli_query($conn, $query) or die(mysqli_error($conn));

echo "<html>";
echo "<head>";
echo "<title>The PHP Store</title>";
echo "</head>";
echo "<body>";
echo "<h2>PHP Store Registered Users</h2>";

$tbl_head =<<<TBL
<table width="800" align="center" border="1">
  <tr>
    <th>Userid</th>
    <th>Password</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
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
  echo "<td align=\"center\">";
  echo $username;
  echo "</td><td align=\"center\">";
  echo $password;
  echo "</td><td align=\"center\">";
  echo $first_name;
  echo "</td><td align=\"center\">";
  echo $last_name;
  echo "</td><td align=\"center\">";
  echo $email;
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
