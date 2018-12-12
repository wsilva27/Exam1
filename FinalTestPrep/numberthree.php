<?php
echo "<table style='border: solid 1px black;'>";
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
echo "<a href='index.php'>Back to Main Menu</a>";
?>