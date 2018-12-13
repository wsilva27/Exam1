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
echo "<strong>Question 4: </strong> Player who scored the first goal on each match with his team.</div>";
echo "<table border='1' class='table table-striped'>";
echo "<tr><th>Team Name</th><th>Player Name</th><th>Jersey Number</th><th>Match Date</th><th>Goal Time</th></tr>";

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
    $stmt = $conn->prepare("SELECT T1.TEAM_NAME, T2.PLAYER_NAME, T2.JERSEY_NUMBER, T4.MATCH_DATE, MIN(T3.GOAL_TIME) AS GOAL_TIME
                            FROM TEAM AS T1
                                INNER JOIN PLAYER AS T2 ON T1.TEAM_ID = T2.TEAM_ID
                                INNER JOIN SCORE AS T3 ON T2.PLAYER_ID = T3.PLAYER_ID
                                INNER JOIN MATCHES AS T4 ON T3.MATCH_ID = T4.MATCH_ID
                            GROUP BY T3.MATCH_ID
                            ORDER BY T3.MATCH_ID;"); 
    $stmt->execute();
    
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