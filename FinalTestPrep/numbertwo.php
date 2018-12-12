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
    $sql = 'SELECT TEAM_ID INTO @TEAM1
    FROM TEAM
    ORDER BY TEAM_NAME
    LIMIT 1;';
    $stmt = $conn->query($sql);
    extract($stmt->fetch(PDO::FETCH_ASSOC));
    $team1 = $TEAM_ID;

    $sql = 'SELECT TEAM_ID INTO @TEAM2
    FROM TEAM
    ORDER BY TEAM_NAME
    LIMIT 1 OFFSET 2;';
    $stmt = $conn->prepare($sql);
    extract($stmt->fetch(PDO::FETCH_ASSOC));
    $team2 = $TEAM_ID;

    $stmt = $conn->prepare('SELECT TEAM_NAME, T3.PLAYER_NAME, T2.GOAL_TIME
                            FROM MATCHES AS T1
                                INNER JOIN SCORE AS T2 ON T1.MATCH_ID = T2.MATCH_ID
                                INNER JOIN PLAYER AS T3 ON T2.PLAYER_ID = T3.PLAYER_ID
                                INNER JOIN TEAM AS T4 ON T3.TEAM_ID = T4.TEAM_ID
                            WHERE T1.TEAM_ID_1 IN ('.$team1.')
                                AND T1.TEAM_ID_2 IN ('.$team2.')
                                OR T1.TEAM_ID_1 IN('.$team2.')
                                AND T1.TEAM_ID_2 IN('.$team1.')
                            ORDER BY T1.MATCH_DATE DESC, T2.GOAL_TIME DESC
                            LIMIT 1;'); 
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
echo "<a href='index.php'>Back to Main Menu</a>"
?>