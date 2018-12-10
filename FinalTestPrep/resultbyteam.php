<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <title>Team</title>
    </head>
    <body>
        <div id="container">
            <?php
            $teamin = htmlspecialchars($_GET["TEAM_NAME"]);
            require_once 'config.php';
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            $result = mysqli_query($conn,"call GetByTeamName('".$teamin."')");
            $rowcount=mysqli_num_rows($result);
            
            echo "<h3>United States Soccer Reports: Filter by Team " . $teamin . " (".$rowcount .")</h3>";
            
            echo "<table class='table table-bordered table-condensed'>";
            echo "    <thead>";
            echo "        <tr>";
            echo "            <th>Name</th>";
            echo "            <th>Phone</th>";
            echo "            <th>Data of Birth</th>";
            echo "            <th>Jersey Number</th>";
            echo "            <th>Current Position</th>";
            echo "            <th>Current Team</th>";
            echo "        </tr>";
            echo "    </thead>";
            echo "    <body>";
            while ($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td>".htmlspecialchars($row['Name'])."</td>";
                echo "<td>".htmlspecialchars($row['Phone'])."</td>";
                echo "<td>".htmlspecialchars($row['DOB'])."</td>";
                echo "<td>".htmlspecialchars($row['Jersey_Number'])."</td>";
                echo "<td>".htmlspecialchars($row['Current_position'])."</td>";
                echo "<td>".htmlspecialchars($row['Current_Team'])."</td>";
                echo "</tr>";
            }
            echo "    </body>";
            echo "</table>";
            ?>
                
        </div>
            <ul>
                <li><a href="getbyteam.php">Select another Team</a></li>
            </ul>
    </body>
</html>