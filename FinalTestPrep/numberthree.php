<!DOCTYPE html>
<html>
    <head>
        <title>TEST2</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <h3>United States Soccer Reports</h3>
        <br>
<?php
echo "<div class='alert alert-info'>";
echo "<strong>Question 3: </strong> Result of all goals that were scored on the second half.</div>";
echo "<table border='1' class='table table-striped'>";
echo "<tr><th>Team Name</th><th>Player Name</th><th>Goal Time</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 
include("config.php");
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT T3.TEAM_NAME ,T2.PLAYER_NAME ,T1.GOAL_TIME
                            FROM SCORE T1 
                                INNER JOIN PLAYER AS T2 ON T1.PLAYER_ID = T2.PLAYER_ID
                                INNER JOIN TEAM AS T3 ON T2.TEAM_ID = T3.TEAM_ID
                            WHERE T1.GOAL_TIME > 45
                            ORDER BY T3.TEAM_ID, T1.GOAL_TIME;"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
echo "<a href='index.php' class='btn btn-info' role='button'>Main Menu</a>";
?>
</body>
</html>