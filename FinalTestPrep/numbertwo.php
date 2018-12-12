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
        <h2>United States Soccer Reports</h3>
        <br>
<?php 
include("config.php");
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT TEAM_ID
    FROM TEAM
    ORDER BY TEAM_NAME
    LIMIT 1;';
    $stmt = $conn->query($sql);
    extract($stmt->fetch(PDO::FETCH_ASSOC));
    $team1 = $TEAM_ID;
    
    $sql = 'SELECT TEAM_ID
    FROM TEAM
    ORDER BY TEAM_NAME
    LIMIT 1 OFFSET 2;';
    $stmt = $conn->query($sql);
    extract($stmt->fetch(PDO::FETCH_ASSOC));
    $team2 = $TEAM_ID;
    
    $sql = 'SELECT TEAM_NAME, T3.PLAYER_NAME, T2.GOAL_TIME
    FROM MATCHES AS T1
        INNER JOIN SCORE AS T2 ON T1.MATCH_ID = T2.MATCH_ID
        INNER JOIN PLAYER AS T3 ON T2.PLAYER_ID = T3.PLAYER_ID
        INNER JOIN TEAM AS T4 ON T3.TEAM_ID = T4.TEAM_ID
        WHERE T1.TEAM_ID_1 IN ('.$team1.')
                                AND T1.TEAM_ID_2 IN ('.$team2.')
                                OR T1.TEAM_ID_1 IN('.$team2.')
                                AND T1.TEAM_ID_2 IN('.$team1.')
    ORDER BY T1.MATCH_DATE DESC, T2.GOAL_TIME DESC
    LIMIT 1;';
    
    $q = $conn->prepare($sql);
    $q->execute();

} catch (PDOException $e) {
    die("Error occurred:" . $e->getMessage());
}
?>
<table border="1" class="table table-striped">
    <tr>
        <th>Team Name</th>
        <th>Player Name</th>
        <th>Goal Time</th>
    </tr>
    <?php while ($r = $q->fetch()): ?>
        <tr>
            <td><?php echo $r['TEAM_NAME'] ?></td>
            <td><?php echo $r['PLAYER_NAME'] ?></td>
            <td><?php echo $r['GOAL_TIME'] ?></td>
        </tr>
    <?php endwhile; ?>
</table>
    <ul><li><a href="index.php">Back to the main menu</a></li></ul>
</body>
</html>