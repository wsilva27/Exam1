<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <title>Restaurants</title>
    </head>
    <body>
        <div id="container">
            <?php
            $boroin = htmlspecialchars($_GET["boro"]);
            require_once 'config.php';
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            $result = mysqli_query($conn,"call GetByBoro('".$boroin."')");
            $rowcount=mysqli_num_rows($result);
            
            echo "<h3>New York City Restaurants Report: Filter By Borough " . $boroin . " (".$rowcount .")</h3>";
            
            echo "<table class='table table-bordered table-condensed'>";
            echo "    <thead>";
            echo "        <tr>";
            echo "            <th>dba</th>";
            echo "            <th>boro</th>";
            echo "            <th>building</th>";
            echo "            <th>street</th>";
            echo "            <th>zipcode</th>";
            echo "            <th>cuisine_description</th>";
            echo "            <th>inspection_date</th>";
            echo "            <th>critical_flag</th>";
            echo "            <th>grade</th>";
            echo "        </tr>";
            echo "    </thead>";
            echo "    <body>";
            while ($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td>".htmlspecialchars($row['dba'])."</td>";
                echo "<td>".htmlspecialchars($row['boro'])."</td>";
                echo "<td>".htmlspecialchars($row['building'])."</td>";
                echo "<td>".htmlspecialchars($row['street'])."</td>";
                echo "<td>".htmlspecialchars($row['zipcode'])."</td>";
                echo "<td>".htmlspecialchars($row['cuisine_description'])."</td>";
                echo "<td>".htmlspecialchars($row['inspection_date'])."</td>";
                echo "<td>".htmlspecialchars($row['critical_flag'])."</td>";
                echo "<td>".htmlspecialchars($row['grade'])."</td>";
                echo "</tr>";
            }
            echo "    </body>";
            echo "</table>";
            ?>
                
        </div>


    </body>
</html>